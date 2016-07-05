<?php
/* Class Food include
 * 23 Mehr 94 - Yazd University
 * 9130403 - Ali Khodabakhshian
 */
class Food
{
    public $id;
    public $name;
    public $price;
    public $balance;
    public $active;
    public $user_id;
    public $cat_id;

    public function UpdateFoodBalance ($id,$number)
    {
        $p_balance = $this->SearchFood ($id);
        $this->balance = $p_balance ['balance'] - $number;
        $df = new Database();
        $df->query("UPDATE tbl_food SET balance = ? WHERE id = ?");
        $df->bind(1,$this->balance);
        $df->bind(2,$id);
        if($df->execute())
            return true;
        else
            return false;
    }

    public function Property()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE active = 1");
        $db->execute();
        if($db->rowCount() > 0)
        {
            $sum = 0;
            foreach ($db->resultset() as $row) {
                $sum = $sum + $row['price']*$row['balance'];
            }
            return $sum;

        }
        else
        {
            return 0;
        }

    }

    public function RefundFoodBalance ($id,$number)
    {
        $df = new Database();
        $df->query("UPDATE tbl_food SET balance = ? WHERE id = ?");
        $df->bind(1,$number);
        $df->bind(2,$id);
        if($df->execute())
            return true;
        else
            return false;
    }

    public function PrintFoodAsComplete ()
    {
        require("language.php");
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE active = '1'");
        $db->execute();
        $dname_list = array();
        foreach ($db->resultset() as $row) {
            $dname_list[] = $row['name'];
        }
        echo json_encode($dname_list);

    }

    public function SearchFood ($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE id = ? AND active = 1");
        $db->bind(1,$id);
        $db->execute();
        $arr = $db->single();
        return $arr;
    }

    public function CheckFoodIsAvaliable ($food_id,$number)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE `id` = ?  AND balance >= ? AND `active` = 1");
        $db->bind(1,$food_id);
        $db->bind(2,$number);
        $db->execute();
        if($db->rowCount() == 1)
            return true;
        else
            return false;
    }

    public function FoodList ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE active = 1 AND balance > 0");
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    public function FoodOfCategory ()
    {
        $limit = 5;
        if(isset($_GET['id']))
        {
            if (intval($_GET['id']) > 0)
            {
                if(isset($_POST['change']))
                {
                    if(intval($_POST['change']) > 0)
                    {
                        $limit = $_POST['change'];
                    }
                }
                $id = $_GET['id'];
                $db = new Database();
                $db->query("SELECT * FROM tbl_food WHERE cat_id = ? ORDER BY id DESC LIMIT $limit");
                $db->bind(1,$id);
                $db->execute();
                if ($db->rowCount() < 1)
                    return false;
                $result = $db->resultset();
                return $result;
            }
            return false;
        }
        return false;
    }

    /*
     *
     * Admin Area is here!
     *
     */

    private function CheckDuplicateFoodNameEditAdmin ($name,$id)
    {
        $db2 = new Database();
        $db2->query("SELECT * FROM tbl_food WHERE name = ? AND id != ?");
        $db2->bind(1,$name);
        $db2->bind(2,$id);
        $db2->execute();
        if($db2->rowCount() > 0)
            return true;
        else
            return false;
    }

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

    private function CheckDuplicateFoodNameAdmin ($str)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE name = ?");
        $db->bind(1,$str);
        $db->execute();
        if($db->rowCount() > 0)
            return true;
        else
            return false;
    }

    public function FetchFood($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->single();
        else
            return false;
    }

    private function FetchFoodSearch($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    public function FetchFoodName ($str)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE name = ?");
        $db->bind(1,$str);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->single();
        else
            return false;
    }

    private function GetNonActiveFoodsAdmin ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE active != 1");
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    private function GetActiveFoodsAdmin ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE active != 1");
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    public function FetchFoodnameSearchuser($str)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE name LIKE ? AND active = 1");
        $db->bind(1,$str."%");
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    private function FetchFoodNameSearch ($str)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE name LIKE ?");
        $str = $str."%";
        $db->bind(1,$str);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    private function SearchFoodByUserIdAddedAdmin ($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE user_id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    private function SearchFoodByUserNameAddedAdmin ($username)
    {
        $admin = new Admin();
        $result = $admin->SearchAdminUsername($username);
        if ($result != false)
            return ($this->SearchFoodByUserIdAddedAdmin($result['id']));
        else
            return false;

    }

    public function SearchFoodByCatId ($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE cat_id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    private function SearchFoodsByCatName ($name)
    {
        $cat = new Category();
        $result = $cat->GetCatIdByNameAdmin($name);
        if($result == false)
            return false;
        else
        {
            return $this->SearchFoodByCatId($result['id']);
        }
    }

    public function GetFoodCount ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food");
        $db->execute();
        return $db->rowCount();
    }

    public function GetCountFoods ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food");
        $db->execute();
        return $db->rowCount();
    }


    public function AddFoodAdmin ()
    {
        require("language.php");
        if(isset($_POST['ADD_FOOD']))
        {
            if(empty($_POST['name']) || empty($_POST['price']) || empty($_POST['balance']) || empty($_POST['cat_id']) || empty($_POST['active']))
            {
                return $str['error_message_empty'];
            }
            if(!is_numeric($_POST['cat_id']))
            {
                return $str['error_message_empty'];
            }
            else
            {
                $set = new Settings();
                $this->name = $set->Check_Param($_POST['name']);
                $this->price = $set->Check_Param($_POST['price']);
                $this->cat_id = $set->Check_Param($_POST['cat_id']);
                $this->balance = $set->Check_Param($_POST['balance']);
                $this->user_id = $_COOKIE['admin_id'];
                switch($_POST['active'])
                {
                    case 1:
                        $this->active = 1;
                        break;
                    case 2:
                        $this->active = 0;
                        break;
                }
                if($this->CheckDuplicateFoodNameAdmin($this->name))
                {
                    return $str['food_name_is_not_valid'];
                }
                $db1 = new Database();
                $db1->query("INSERT INTO tbl_food (name,price,balance,active,user_id,cat_id) VALUES (?,?,?,?,?,?)");
                $db1->bind(1,$this->name);
                $db1->bind(2,$this->price);
                $db1->bind(3,$this->balance);
                $db1->bind(4,$this->active);
                $db1->bind(5,$this->user_id);
                $db1->bind(6,$this->cat_id);
                $db1->execute();
                return $str['food_add_successfully'];
            }
        }
        else
            return null;
    }

    public function EditFoodAdmin ()
    {
        /*
         * return (type,result)
         */
        require("language.php");
        if(isset($_POST['EDIT_FOOD']))
        {
            if(isset($_GET['edit']))
            {
                $this->id = $_GET['edit'];
                if($this->IsNumberValid($this->id))
                {
                    if($this->FetchFood($this->id) != false)
                    {
                        if(empty($_POST['name']) || empty($_POST['price']) || empty($_POST['balance']) || empty($_POST['cat_id']) || empty($_POST['active']))
                        {
                            return array(true,$str['error_message_empty']);
                        }
                        if(!is_numeric($_POST['cat_id']))
                        {
                            return array(true,$str['error_message_empty']);
                        }

                        $set = new Settings();
                        $this->name = $set->Check_Param($_POST['name']);
                        $this->price = $set->Check_Param($_POST['price']);
                        $this->cat_id = $set->Check_Param($_POST['cat_id']);
                        $this->balance = $set->Check_Param($_POST['balance']);
                        $this->user_id = $_COOKIE['admin_id'];
                        switch ($_POST['active'])
                        {
                            case 1:
                                $this->active = 1;
                                break;
                            case 2:
                                $this->active = 0;
                                break;
                        }
                        if($this->CheckDuplicateFoodNameEditAdmin($this->name,$this->id))
                        {
                            return array(true,$str['food_name_is_not_valid']);
                        }
                        $db1 = new Database();
                        $db1->query("UPDATE tbl_food SET name = ? , price = ? , cat_id = ? , balance = ?   , user_id = ? , active = ? WHERE id = ? ");
                        $db1->bind(1,$this->name);
                        $db1->bind(2,$this->price);
                        $db1->bind(3,$this->cat_id);
                        $db1->bind(4,$this->balance);
                        $db1->bind(5,$this->user_id);
                        $db1->bind(6,$this->active);
                        $db1->bind(7,$this->id);
                        $db1->execute();
                        return array(true,$str['food_edit_is_successful']);
                    }
                    else
                    {
                        header("Location: foods.php");
                    }
                }
                else
                {
                    header("Location: foods.php");
                }

            }
            else
            {
                header("Location: foods.php");
            }
        }
        elseif(isset($_GET['edit']))
        {
            $this->id = $_GET['edit'];
            if($this->IsNumberValid($this->id))
            {
                if($this->FetchFood($this->id) != false)
                {
                    return array(false,$this->FetchFood($this->id));
                }
                else
                {
                    header("Location: foods.php");
                }

            }
            else
            {
                header("Location: foods.php");
            }
        }
        else
        {
            header("Location: foods.php");
        }
    }

    public function DeleteFoodAdmin()
    {
        if(isset($_POST['DELETE_FOOD']))
        {
            if(isset($_GET['delete']))
            {
                $id = $_GET['delete'];
                if(!$this->IsNumberValid($id))
                {
                    header("Location: foods.php");
                }
                else
                {
                    header("refresh:5;url=foods.php");
                    $db = new Database();
                    $db->query("DELETE FROM tbl_food WHERE id = ?");
                    $db->bind(1,$id);
                    $db->execute();
                    return array(null,true,false,false);
                }
            }
        }
        elseif(isset($_GET['delete']))
        {
            $id = $_GET['delete'];
            if(!$this->IsNumberValid($id))
            {
                header("Location: foods.php");
            }
            else
            {
                $db = new Database();
                $db->query("SELECT * FROM tbl_food WHERE id = ?");
                $db->bind(1,$id);
                $db->execute();
                if($db->rowCount() > 0)
                    return array($db->single(),false,true,true);
                else
                    return array(null,false,true,false);

            }
        }
    }

    public function FoodCounterByCategory ($cat_id)
    {
        $db1 = new Database();
        $db1->query("SELECT * FROM tbl_food WHERE cat_id = 0");
        $db1->bind(1,$cat_id);
        $db1->execute();
        return $db1->rowCount();
    }

    public function AddBalaceFoodAdmin()
    {
        require("language.php");
        /*
         * return(type[0=>nothing,1=>post_SEARCH,2=>post_ADD_BALANCE],result,IsNotFound?)
         */
        if(isset($_POST['SEARCH']))
        {
            if(!empty($_POST['SEARCH_VALUE']))
            {
                $set = new Settings();
                $search = $set->Check_Param(($_POST['SEARCH_VALUE']));
                $f1 = $this->FetchFood($search);
                $f2 = $this->FetchFoodName($search);
                if($f1 != false)
                    return array(1,$f1,false);
                elseif($f2 != false)
                    return array(1,$f2,false);
                else
                    return array(1,$str['not_found'],true);
            }
            else
            {
                return array(1,$str['error_message_empty'],true);
            }
        }
        elseif(isset($_POST['ADD_BALANCE']))
        {
            if(!empty($_POST['balance']))
            {
                if(!empty($_POST['id']) && !empty($_POST['name']))
                {
                    $db1 = new Database();
                    $db1->query("UPDATE tbl_food SET balance = ? WHERE id = ? AND name = ?");
                    $db1->bind(1,$_POST['balance']);
                    $db1->bind(2,$_POST['id']);
                    $db1->bind(3,$_POST['name']);
                    $db1->execute();
                    return array(2,null,false);
                }
                else
                {
                    die("ERROR!");
                }
            }
            else
            {
                return array(3,$str['error_message_empty'],true);
            }
        }
        else
        {
            return array(0,null,false);
        }
    }

    public function GetFoodByUserId ($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_food WHERE user_id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    public function BalanceIsLowerThanAdmin()
    {
        if(isset($_POST['SHOW']))
        {
            if(!empty($_POST['number']))
            {
                $number = $_POST['number'];
                if($this->IsNumberValid($number))
                {
                    $db2 = new Database();
                    $db2->query("SELECT * FROM tbl_food WHERE balance <= ?");
                    $db2->bind(1,$number);
                    $db2->execute();
                    if($db2->rowCount() > 0)
                    {
                        return $db2->resultset();
                    }
                    else
                    {
                        return 0;
                    }
                }
                else
                {
                    return 0;
                }
            }
            else
            {
                return 0;
            }
        }
        return 0;
    }

    public function ActiveFoods ()
    {
        if(isset($_POST['ACTIVATE_FOOD']))
        {
            if(!empty($_POST['check_list']))
            {
                foreach ($_POST['check_list'] as $result) {
                    $db1 = new Database();
                    $db1->query("UPDATE tbl_food SET active = '1' WHERE id = ?");
                    $db1->bind(1,$result);
                    $db1->execute();
                    $address = $_SERVER['PHP_SELF'];
                    header("Location: $address");
                }
            }
        }
        if($this->GetNonActiveFoodsAdmin() != false)
        {
            return array(true,$this->GetNonActiveFoodsAdmin());
        }
        else
        {
            return array(false, null);
        }
    }


    public function SearchFoodsAdmin ()
    {
        /*
         *  Menu is :                                                  code
         * $str['search_by_food_id']                                    1
            $str['search_by_food_name']                                 2
            $str['search_by_food_active']                               3
            $str['search_by_food_user_id']                              4
            $str['search_by_food_username']                             5
            $str['serach_by_food_category_name']                        6
            $str['search_by_food_category_id']                          7
            return (0[enter value] or 1 [found] or 2[not_found],result)
         *
         */
        if(isset($_POST['SEARCH_FOOD']))
        {
            if(!empty($_POST['INPUT_SEARCH']) && !empty($_POST['TYPE']))
            {
                $set = new Settings();
                $value = $set->Check_Param($_POST['INPUT_SEARCH']);
                $type = $set->Check_Param($_POST['TYPE']);
                switch ($type)
                {
                    case 1:
                        return array(1,$this->FetchFoodSearch($value));
                    case 2:
                        return array(1,$this->FetchFoodNameSearch($value));
                    case 3:
                        return array(1,$this->GetActiveFoodsAdmin());
                    case 4:
                        return array(1,$this->SearchFoodByUserIdAddedAdmin($value));
                    case 5:
                        return array(1,$this->SearchFoodByUserNameAddedAdmin($value));
                    case 6:
                        return array(1,$this->SearchFoodsByCatName($value));
                    case 7:
                        return array(1,$this->SearchFoodByCatId($value));
                }
            }
            else
            {
                return array(0,null);
            }
        }
        return array(-1,null);
    }

}
