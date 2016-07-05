<?php
/* Class Admin include
 * 23 Mehr 94 - Yazd University
 * 9130403 - Ali Khodabakhshian
 */
class Admin
{
    public $id;
    public $username;
    public $password;
    public $email;

    public function __construct() //saazande
    {
        $set = new Settings();
        if($set->AdminIsLogged())
        {
            $this->id = $_COOKIE['admin_id'];
            $this->username = $_COOKIE['admin_username'];
            $this->password = $_COOKIE['admin_password'];
        }
    }

    public function GetAdminCount ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_admin");
        $db->execute();
        return $db->rowCount();
    }

    public function CheckDuplicateUsernameEmailToEdit($type,$string,$id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_admin WHERE $type = ? AND  id != ? ");
        $db->bind(1,$string);
        $db->bind(2,$id);
        $db->execute();
        if($db->rowCount() == 0)
            return true;
        return false;
    }

    public function DeleteAdmin ()
    {
        require("language.php");

        if(isset($_POST['delete_admin']))
        {
            if(isset($_GET['delete']))
            {
                if(is_numeric($_GET['delete']))
                {
                    if (intval($_GET['delete']))
                    {
                        if ($_GET['delete'] != $_COOKIE['admin_id'])
                        {
                            $admin_id = $_GET['delete'];
                            $db = new Database();
                            $db->query("DELETE FROM tbl_admin WHERE id = ? ");
                            $db->bind(1,$admin_id);
                            $db->execute();
                            if($db->rowCount() == 1)
                            {
                                header("refresh:2;url=admin.php");
                                return $str['admin_has_been_removed'];
                            }
                            else
                            {
                                header("Location: admin.php");
                            }
                        }
                        else
                        {
                            header("Location: admin.php");
                        }
                    }
                    else
                    {
                        header("Location: admin.php");
                    }
                }
                else
                {
                    header("Location: admin.php");
                }
            }
            else
            {
                header("Location: admin.php");
            }
        }
        elseif(isset($_GET['delete']))
        {
            if(is_numeric($_GET['delete']))
            {
                if(intval($_GET['delete']))
                {
                    if($_GET['delete'] != $_COOKIE['admin_id'])
                    {
                        $id = $_GET['delete'];
                        if($this->GetAdminInfo($id) != false)
                        {
                            return $this->GetAdminInfo($id);
                        }
                        else
                        {
                            header("Location: admin.php");
                        }
                    }
                    else
                    {
                        header("Location: admin.php");
                    }
                }
                else
                {
                    header("Location: admin.php");
                }
            }
            else
            {
                header("Location: admin.php");
            }
        }
        return 0;
    }

    public function EditAdmin ()
    {
        require("language.php");
        if(isset($_POST['edit_admin']))
        {
            if(isset($_GET['edit']))
            {
                if(intval($_GET['edit']))
                {
                    $flag = false;
                    $result = array();
                    if(empty($_POST['email']) || empty($_POST['username']))
                    {
                        $result['message'] = $str['error_message_empty'];
                        return $result;
                    }
                    else
                    {
                        $set = new Settings();
                        if(!empty($_POST['password']))
                        {
                            $flag = true;
                        }
                        $admin_id = $_GET['edit'];
                        $username = $set->Check_Param($_POST['username']);
                        $email = $set->Check_Param($_POST['email']);
                        if(!$this->CheckDuplicateUsernameEmailToEdit("username",$username,$admin_id))
                        {
                            $result['message'] =  $str['duplicate_error_username'];
                            return $result;
                        }
                        if(!$this->CheckDuplicateUsernameEmailToEdit("email",$email,$admin_id))
                        {
                            $result['message'] = $str['duplicate_error_email_user'];
                            return $result;
                        }
                        if($flag) // Edit with password
                        {
                            $password = $set->HashCode($set->Check_Param($_POST['password'])) ;
                            $d = new Database();
                            $d->query("UPDATE tbl_admin SET username = ? , email = ? , password = ? WHERE id = ?");
                            $d->bind(1,$username);
                            $d->bind(2,$email);
                            $d->bind(3,$password);
                            $d->bind(4,$admin_id);
                            $d->execute();
                            $result['message'] = $str['edit_information_password_successfully'];
                            return $result;
                        }
                        else // Edit Without Password
                        {
                            $d = new Database();
                            $d->query("UPDATE tbl_admin SET username = ? , email = ? WHERE id = ?");
                            $d->bind(1,$username);
                            $d->bind(2,$email);
                            $d->bind(3,$admin_id);
                            $d->execute();
                            $result['message'] = $str['edit_information_successfully'];
                            return $result;
                        }
                    }
                }
                else
                {
                    header("Location: admin.php");
                }
            }
            else
            {
                header("Location: admin.php");
            }
        }
        elseif(isset($_GET['edit']))
        {
            if(is_numeric($_GET['edit']))
            {
                if(intval($_GET['edit']))
                {
                    if($_GET['edit'] != $_COOKIE['admin_id'])
                    {
                        $id = $_GET['edit'];
                        if($this->GetAdminInfo($id) != false)
                        {
                            return $this->GetAdminInfo($id);
                        }
                        else
                        {
                            header("Location: admin.php");
                        }
                    }
                    else
                    {
                        header("Location: admin_profile.php");
                    }

                }
                else
                {
                    header("Location: admin.php");
                }
            }
            else
            {
                header("Location: admin.php");
            }
        }
        else
        {
            header("Location: admin.php");
        }
        return 0;
    }

    public function PasswordIsOk($id,$password)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_admin WHERE password = ? AND id = ?");
        $db->bind(1,$password);
        $db->bind(2,$id);
        $db->execute();
        if($db->rowCount() == 1)
            return true;
        return false;
    }

    public function EditYourSelf ()
    {
        require("language.php");
        $id = 1;
        $user_id = $_COOKIE['admin_id'];
        $set = new Settings();
        if(isset($_POST['edit_admin']))
        {
            if(empty($_POST['username'])||empty($_POST['email']))
            {
                return $str['error_message_empty'];
            }
            if(!empty($_POST['password']) && !empty($_POST['new_password']))
            {
                $id = 2;
                $password = $set->HashCode($set->Check_Param($_POST['password']));
                $result = $this->PasswordIsOk($this->id,$password);
                if( $result == false)
                {
                    return $str['password_incorrect'];
                }
            }
            if(empty($_POST['password']) && !empty($_POST['new_password']))
            {
                return $str['password_newpassword_is_empty'];
            }
            elseif(!empty($_POST['password']) && empty($_POST['new_password']))
            {
                return $str['password_newpassword_is_empty'];
            }
            else
            {
                $username = $set->Check_Param($_POST['username']);
                $email = $set->Check_Param($_POST['email']);
                if(!$this->CheckDuplicateUsernameEmailToEdit("username",$username,$user_id))
                {
                    return $str['duplicate_error_username'];
                }
                if(!$this->CheckDuplicateUsernameEmailToEdit("email",$email,$user_id))
                {
                    return $str['duplicate_error_email_user'];
                }
                switch($id)
                {
                    case 1:
                        $d = new Database();
                        $d->query("UPDATE tbl_admin SET username = ? , email = ? WHERE id = ? ");
                        $d->bind(1,$username);
                        $d->bind(2,$email);
                        $d->bind(3,$user_id);
                        $d->execute();
                        $set->UpdateCookieAdmin($username,null);
                        return $str['user_information_changed_successfully'];
                        break;
                    case 2:
                        $d = new Database();
                        $password = $set->HashCode($set->Check_Param($_POST['new_password']));
                        $d->query("UPDATE tbl_admin SET username = ? , email = ? , password = ? WHERE id = ? ");
                        $d->bind(1,$username);
                        $d->bind(2,$email);
                        $d->bind(3,$password);
                        $d->bind(4,$user_id);
                        $set->UpdateCookieAdmin($username,$password);
                        $d->execute();
                        return $str['user_password_inforamtion_changed_successfully'];
                        break;
                }
            }
        }
        return false;
    }

    public function GetAdminInfo($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_admin WHERE id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() == 1)
            return $db->single();
        else
            return false;
    }

    private function CheckDuplicateUsernameEmail ($type,$string)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_admin WHERE $type = ?");
        $db->bind(1,$string);
        $db->execute();
        if($db->rowCount() == 0)
            return true;
        return false;
    }

    public function AddAdmin ()
    {
        require("language.php");
        if(isset($_POST['register_admin']))
        {
            if(empty($_POST['username'])||empty($_POST['password'])||empty($_POST['email']))
            {
                return $str['error_message_empty'];
            }
            else
            {
                $set = new Settings();
                $username = $set->Check_Param($_POST['username']);
                $email = $set->Check_Param($_POST['email']);
                $password = $set->HashCode($set->Check_Param($_POST['password']));
                if(!$this->CheckDuplicateUsernameEmail("username",$username))
                {
                    return $str['duplicate_error_username'];
                }
                if(!$this->CheckDuplicateUsernameEmail("email",$email))
                {
                    return $str['duplicate_error_email_user'];
                }
                $db = new Database();
                $db->query("INSERT INTO tbl_admin (username,password,email) VALUES (?,?,?)");
                $db->bind(1,$username);
                $db->bind(2,$password);
                $db->bind(3,$email);
                $db->execute();
                return $str['admin_add_successfully'];
            }
        }
        return false;
    }

    public function GetCountUsers ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_admin");
        $db->execute();
        return $db->rowCount();
    }

    public function ShowAdmin()
    {
        $db = new Database();
        $limit = 10;
        if(isset($_POST['limit']))
        {
            if (intval($_POST['number']) > 0)
            {
                $limit = $_POST['number'];
                $db->query("SELECT * FROM tbl_admin ORDER BY id DESC LIMIT $limit");
                $db->execute();
                return $db->resultset();
            }
        }
        elseif(isset($_POST['select']))
        {
            if(!empty($_POST['from']) && !empty($_POST['to']))
            {
                if(intval($_POST['from']) > 0 && intval($_POST['to']) > 0)
                {
                    $from = $_POST['from']-1;
                    $to = $_POST['to']-1;
                    $db->query("SELECT * FROM tbl_admin ORDER BY id ASC LIMIT $from,$to");
                    $db->execute();
                    return $db->resultset();
                }
            }
        }
        $db->query("SELECT * FROM tbl_admin LIMIT $limit");
        $db->execute();
        return $db->resultset();
    }

    public function CheckAdminIsCorrect($username,$password)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_admin WHERE username = ? AND password = ?");
        $db->bind(1,$username);
        $db->bind(2,$password);
        $db->execute();
        if($db->rowCount() == 1)
        {
            return $db->single();
        }
        else
        {
            return false;
        }
    }

    public function LoginToAdminArea()
    {
        require("language.php");
        $set = new Settings();
        if(isset($_GET['logout']))
        {
            if($_GET['logout'] == "true")
            {
                $set->UnSetCookieAdmin();
                return $str['logout_success'];
            }
        }
        elseif(isset($_GET['access']))
        {
            if($_GET['access'] == "user")
            {
                return $str['you_should_logout_from_users'];
            }
            elseif($_GET['access'] == "false")
            {
                return $str['access_denied'];
            }
        }
        elseif($set->AdminIsLogged())
        {
            header("Location: index.php");
        }
        elseif (isset($_POST['login']))
        {
            if(empty($_POST['username']) || empty($_POST['password']))
            {
                return $str['error_message_empty'];
            }
            else
            {
                if(!$set->UserIsLogged())
                {
                    $this->username = $set->Check_Param($_POST['username']);
                    $this->password = $set->HashCode($set->Check_Param($_POST['password']));
                    $result = $this->CheckAdminIsCorrect($this->username,$this->password);
                    if($result != false)
                    {
                        $set->SetCookieAdmin($result['id'],$result['username'],$result['password']);
                        header("Location: index.php");
                    }
                    else
                    {
                        return $str['invalid_username_password'];
                    }
                }
                else
                {
                    header("Location: login.php?access=user");
                }

            }
        }
        return false;
    }

    public function ValidateToAdminLogin ()
    {
        $set = new Settings();
        if($set->UserIsLogged())
        {
            header("Location: login.php?access=user");
        }
        elseif(!$set->AdminIsLogged())
        {
            header("Location: login.php?access=false");
        }
        elseif(isset($_GET['logout']))
        {
            if($_GET['logout'] == "true")
            {
                header("Location: login.php?logout=true");
            }
        }
    }

    public function FetchAdmin ($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_admin WHERE id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() == 1)
            return $db->single();
        else
            return false;
    }

    public function SearchAdminUsername ($username)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_admin WHERE username = ?");
        $db->bind(1,$username);
        $db->execute();
        if($db->rowCount()>0)
            return $db->single();
        else
            return false;
    }
}