<?php
/* Class Settings include
 * 23 Mehr 94 - Yazd University
 * 9130403 - Ali Khodbakhshian
 *
 */
class Settings
{
    public $msg = null;

    private function IsNumberValid($number)
    {
        if(is_numeric($number))
        {
            if(intval($number)>0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function HashCode ($string)
    {
        return md5($string);
    }

    public function Check_Param ($string)
    {
        $string = htmlspecialchars($string);
        $string = strip_tags($string);
        return $string;

    }

    public function GetSettings ($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_settings WHERE id = ?");
        $db->bind(1,$id);
        $db->execute();
        $row = $db->single();
        return $row['name'];
    }

    public function UpdateCookieAdmin ($username,$password)
    {
        setcookie('admin_username', $username , false, '/');
        if($password!=null)
            setcookie('admin_password', $password, false, '/');
    }

    public function Menu ()
    {
        /*
         * Retuns is => Panel.php
         * Number Menus (1,2,3);
         */
        require('language.php');
        if(isset($_GET['logout']))
        {
            if($_GET['logout'] == "true")
            {
                setcookie('id', null, -1, '/');
                setcookie('username', null, -1, '/');
                setcookie('password', null, -1, '/');
                unset($_COOKIE['id']);
                unset($_COOKIE['username']);
                unset($_COOKIE['password']);
                $this->msg = $str['logout_success'];
                if(basename($_SERVER['PHP_SELF']) != "index.php")
                    header ("Location: index.php?logout=true");
            }
        }
        elseif($this->AdminIsLogged())
        {
            return 2;
        }
        elseif($this->UserIsLogged())
        {
            return 1;
        }
        elseif (isset($_GET['access']))
        {
            if($_GET['access'] == "false")
            {
                $this->msg=$str['access_denied'];
                return 3;
            }
        }
        elseif(isset($_POST['login']))
        {
            if(empty($_POST['username']) || empty($_POST['password']))
            {
                $this->msg = $str['error_message_empty'];
                return 3;
            }
            else
            {
                $user = new User();
                $db = new Database();
                $user->username = $this->Check_Param($_POST['username']);
                $user->password = $this->HashCode(($this->Check_Param($_POST['password'])));
                $db->query("SELECT * FROM tbl_user WHERE username = ? AND password = ?");
                $db->bind(1,$user->username);
                $db->bind(2,$user->password);
                $db->execute();
                if ($db->rowCount() == 1)
                {
                    $row = $db->single();
                    $user->id = $row['id'];
                    $user->username = $row['username'];
                    $user->password = $row['password'];
                    setcookie('id', $user->id, false, '/');
                    setcookie('username', $user->username , false, '/');
                    setcookie('password', $user->password, false, '/');
                    $address = $_SERVER['PHP_SELF'];
                    header("Location: $address");
                    return 1;
                }
                else
                {
                    $this->msg = $str['invalid_username_password'];
                    return 3;
                }
            }
        }
        return 3;
    }

    public function RandomPassword()
    {
        $alphabet = '$%!@%&*()abcd(efg$$$hij(klmn!o#pqr!stuvwxyzABC##DEFGHIJ@!&!@KLMNOPQRSTU)(VWXYZ12P)(@#34567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }


    public function ContactUs ()
    {
        require("language.php");
        if(isset($_POST['send']))
        {
            if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']))
            {
                $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
                if(!preg_match($email_exp,$_POST['email']))
                {
                    return $str['your_email_is_not_valid'];
                }
                if(strlen($_POST['message']) < 10)
                {
                    return $str['your_message_is_too_short'];
                }
                $email_to = $this->GetSettings(4);
                $subject = $this->Check_Param($_POST['subject']);
                $name = $this->Check_Param($_POST['name']);
                $email = $this->Check_Param($_POST['email']);
                $message = $this->Check_Param($_POST['message']);
                $message_send = $str['a_message_from']." ".$name." <br />".$message." <br />".$str['subject'].": ".$subject." ,".$str['email'].": ".$email;
                $headers =
                    'From: '.$email."\r\n".
                    'Reply-To: '.$email."\r\n" .
                    'X-Mailer: PHP/'.phpversion();
                @mail($email_to, $subject, $message_send, $headers);
                $header =
                    'From: '.$email_to."\r\n".
                    'Reply-To: '.$email_to."\r\n" .
                    'X-Mailer: PHP/'.phpversion();
                @mail($email,$str['your_email_received'],$str['we_get_your_email_and_answer_you_very_soon'],$header);
                return $str['your_message_has_been_sent'];
            }
            else
            {
                return $str['error_message_empty'];
            }
        }
        return null;
    }

    public function UpdateConfigSite()
    {
        require("language.php");
        if(isset($_POST['CHANGE_SITE_CONFIG']))
        {
            if(empty($_POST['site_email']) || empty($_POST['max_order_users']) || empty($_POST['max_time_for_cancel_order']) || empty($_POST['max_number_for_balance']) || empty($_POST['site_title']))
            {
                return $str['error_message_empty'];
            }
            else
            {
                $A = array();
                $A[4] = $this->Check_Param($_POST['site_email']);
                $A[2] = $this->Check_Param($_POST['max_order_users']);
                $A[3] = $this->Check_Param($_POST['max_time_for_cancel_order']);
                $A[1] = $this->Check_Param($_POST['site_title']);
                $A[5] = $this->Check_Param($_POST['max_number_for_balance']);
                $db = new Database();
                for($i=1;$i<=5;$i++)
                {
                    $db->query("UPDATE tbl_settings SET name = ? WHERE id = ?");
                    $db->bind(1,$A[$i]);
                    $db->bind(2,$i);
                    $db->execute();
                }
                return $str['change_was_successfully'];
            }
        }
        return 0;
    }

    public function Redirect()
    {
        if(!$this->UserIsLogged())
        {
            header("Location: index.php?access=false");
        }
        return false;
    }

    public function SetCookieAdmin($id,$username,$password)
    {
        setcookie('admin_id', $id, false, '/');
        setcookie('admin_username', $username , false, '/');
        setcookie('admin_password', $password, false, '/');
    }

    public function UnSetCookieAdmin ()
    {
        setcookie('admin_id', null, -1, '/');
        setcookie('admin_username', null, -1, '/');
        setcookie('admin_passowrd', null, -1, '/');
        unset($_COOKIE['admin_id']);
        unset($_COOKIE['admin_username']);
        unset($_COOKIE['admin_password']);
    }

    public function UserIsLogged ()
    {
        if(isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['id']))
            return true;
        return false;
    }

    public function AdminIsLogged ()
    {
        if(isset($_COOKIE['admin_username']) && isset($_COOKIE['admin_password']) && isset($_COOKIE['admin_id']))
            return true;
        return false;
    }

    private function ConvertDigits ($var)
    {
        switch($var)
        {
            case 1:
                $var = "01";
                return $var;
                break;
            case 2:
                $var = "02";
                return $var;
                break;
            case 3:
                $var = "03";
                return $var;
                break;
            case 4:
                $var = "04";
                return $var;
                break;
            case 5:
                $var = "05";
                return $var;
                break;
            case 6:
                $var = "06";
                return $var;
                break;
            case 7:
                $var = "07";
                return $var;
                break;
            case 8:
                $var = "08";
                return $var;
                break;
            case 9:
                $var = "09";
                return $var;
                break;
            default:
                return $var;
        }

    }

    public function PickTime ($var)
    {
        $var = $this->Check_Param($var);
        $arr = explode(" ",$var);
        $date = explode("-",$arr[0]);
        $time = explode(":",$arr[1]);
        $day = $this->ConvertDigits($date[0]);
        $month = $this->ConvertDigits($date[1]);
        $year = $this->ConvertDigits($date[2]);
        $hour = $this->ConvertDigits($time[0]);
        $minute = $this->ConvertDigits($time[1]);
        $second = $this->ConvertDigits($time[2]);
        $var = $year."-".$month."-".$day." ".$hour.":".$minute.":".$second;
        return $var;
    }

    public function CanUserCancel ($time)
    {
        $diff = strtotime(date("Y-m-d H:i:s"))-strtotime($time);
        $max_time = $this->GetSettings(3)*60;
        if($max_time-$diff >= 0)
            return true;
        else
            return false;
    }

    public function PermissionToAdmin ()
    {
        $admin = new Admin();
        if ($admin->id != 1)
        {
            header("location: admin_profile.php");
        }
    }

    public function ViewReport ()
    {
        if($this->UserIsLogged())
        {
            if(isset($_GET['type']) && isset($_GET['id']))
            {
                $type = $this->Check_Param($_GET['type']);
                $id = $this->Check_Param($_GET['id']);
                if(!$this->IsNumberValid($id))
                {
                    header("location: index.php?3");
                }
                switch($type)
                {
                    /*
                     * return result[0] => type (1=>order,2=>orders)
                     * return result[1] => RESULT
                     */
                    case "order":
                        $order = new Order();
                        $result = $order->OneOrder($order->user_id,$id);
                        if($result != false)
                        {
                            return array(1,$result);
                        }
                        else
                        {
                            header("location: index.php?0");
                        }
                    break;
                    case "orders":
                        $order = new Order();
                        if($id == $order->user_id)
                        {
                            $result = $order->FetchUserOrder($order->user_id);
                            if($result != false)
                            {
                                return array(2,$result);
                            }
                            else
                            {
                                return array(0,null);
                            }
                        }
                        else
                        {
                            header("location: index.php?0");
                        }
                        break;
                    case "credit":
                        $credit = new Credits();
                        $result = $credit->FetchCreditId($id);
                        if($result != false)
                        {
                            return array(3,$result);
                        }
                        else
                        {
                            header("location: index.php?0");
                        }
                        break;
                    case "credits":
                        $credit = new Credits();
                        if($id == $credit->user_id)
                        {
                            $result = $credit->FetchCreditUserId($credit->user_id);
                            if($result != false)
                            {
                                return array(4,$result);
                            }
                            else
                            {
                                return array(0,null);
                            }
                        }
                        else
                        {
                            header("location: index.php?0");
                        }
                        break;
                    default:
                        header("location: index.php?2");
                }
            }
        }
        else
        {
            header("location: index.php");
        }
    }

    public function ReportName ()
    {
        if(isset($_GET['type']) && isset($_GET['id']))
        {
            $type = $this->Check_Param($_GET['type']);
            $id = $this->Check_Param($_GET['id']);
            if(!$this->IsNumberValid($id))
            {
                header("location: index.php?3");
            }
            switch($type)
            {
                /*
                 * return result[1] => not found
                 * return result[0] => type (1=>order,2=>allorders,3=>user,4=>order,5=>food_user,6=>alluser,credit_user,8=>credit_system,9=>credit)
                 * return result[2] => RESULT
                 */
                case "order":
                    $order = new Order();
                    if($order->FetchOrdersId($id) != false)
                    {
                        return array(1,1,$order->FetchOrdersId($id));
                    }
                    else
                    {
                        return array(1,0,null);
                    }
                break;
                case "allorder":
                    $order = new Order();
                    $result = $order->SearchUserOrder($id);
                    if($result != false)
                    {
                        return array(2,1,$result);
                    }
                    else
                    {
                        return array(1,0,null);
                    }
                    break;
                case "user":
                    $user = new User();
                    $result = $user->FetchUserInfo($id);
                    if($result != false)
                    {
                        return array(3,1,$result);
                    }
                    else
                    {
                        return array(1,0,null);
                    }
                break;
                case "food":
                    $food = new Food();
                    $result = $food->FetchFood($id);
                    if($result != false)
                    {
                        return array(4,1,$result);
                    }
                    else
                    {
                        return array(1,0,null);
                    }
                break;
                case "food_user":
                    $food = new Food();
                    $result = $food->GetFoodByUserId($id);
                    if($result != false)
                    {
                        return array(5,1,$result);
                    }
                    else
                    {
                        return array(1,0,null);
                    }
                break;
                case "allusers":
                    $user = new User();
                    $result = $user->GetUserCount();
                    if($result > 0)
                    {
                        return array(6,1,$user->UserList());

                    }
                    else
                    {
                        return array(1,0,null);
                    }
                    break;
                case "credit_user":
                    $credit = new Credits();
                    $result = $credit->CreditReportAdmin($id);
                    if($result != false)
                    {
                        return array(7,1,$result);
                    }
                    else
                    {
                        return array(1,0,null);
                    }
                break;
                case "credit_system":
                    $credit = new Credits();
                    $result = $credit->SystemCredit();
                    if($result != false)
                    {
                        return array(8,1,$result);
                    }
                    else
                    {
                        return array(1,0,null);
                    }
                    break;
                case "credit":
                    $credit = new Credits();
                    $result = $credit->FetchCreditId($id);
                    if($result != false)
                    {
                        return array(9,1,$result);
                    }
                    else
                    {
                        return array(1,0,null);
                    }
                    break;
                case "credit_type":
                    $credit = new Credits();
                    require("language.php");
                    switch($id)
                    {
                        /*
                         * 1=>refund , 2=> buy , 3=> increase
                         */
                        case 1:
                            $result = $credit->SearchCreditType($str['refund']);
                            if($result != false)
                            {
                                return array(10,1,$result);
                            }
                            else
                            {
                                return array(1,0,null);
                            }
                            break;
                        case 2:
                            $result = $credit->SearchCreditType($str['order_case']);
                            if($result != false)
                            {
                                return array(10,1,$result);
                            }
                            else
                            {
                                return array(1,0,null);
                            }
                            break;
                        case 3:
                            $result = $credit->SearchCreditType($str['increase_credit']);
                            if($result != false)
                            {
                                return array(10,1,$result);
                            }
                            else
                            {
                                return array(1,0,null);
                            }
                            break;
                        default:
                            return array(1,0,null);
                    }
            }
        }
        else
        {
            header("location: index.php?1");
        }
    }

    public function SearchWebSite ()
    {
        /*
         * return (1=> nothing, 2=> not found , 3=> fill input , 4=> find),(result)
         */
        if(isset($_POST['search']))
        {
            if(!empty($_POST['search_input']))
            {
                $food = new Food();
                $value = $this->Check_Param($_POST['search_input']);
                $result = $food->FetchFoodnameSearchuser($value);
                if($result != false)
                {
                    return array(4,$result);
                }
                else
                {
                    return array(2,null);
                }
            }
            else
            {
                return array(3,null);
            }
        }
        return array(1,null);
    }
}
?>