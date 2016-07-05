<?php
/* Class Order include
 * 23 Mehr 94 - Yazd University
 * 9130403 - Ali Khodabakhshian
 */
class Order
{
    /*
     * status contains => 1 => OK , 2 => Pending , 3 => Cancel
     */
    public $id;
    public $username;
    public $foodname;
    public $balance;
    public $price;
    public $total_price;
    public $ip;
    public $credit_before;
    public $credit_after;
    public $status;
    public $number;
    public $user_id;
    public $food_id;

    public function __construct()
    {
        if(isset($_COOKIE['id']) && isset($_COOKIE['username']))
        {
            $this->user_id = $_COOKIE['id'];
            $this->username = $_COOKIE['username'];
            $this->ip = $_SERVER['REMOTE_ADDR'];
            $credit = new Credits();
            $this->credit_before = $credit->CurrentCredit();
            $this->status = 3;
        }
        elseif(isset($_COOKIE['admin_id']) && isset($_COOKIE['admin_username']) && isset($_COOKIE['admin_password']))
        {
            $this->ip=$_SERVER['REMOTE_ADDR'];
        }
    }

    public function GetOrderType2 ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE status = 2");
        $db->execute();
        return $db->rowCount();
    }
    public function GetOrderType1 ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE status = 1");
        $db->execute();
        return $db->rowCount();
    }

    public function ReportStatusOrder($id,$type)
    {
        require("language.php");
        if($type != 100)
        {
            $db = new Database();
            $db->query("SELECT * FROM tbl_order WHERE id = ?");
            $db->bind(1,$id);
            $db->execute();
            $arr = $db->single();
            return $arr['status'];
        }
        if($type == 100)
        {
            $db = new Database();
            $db->query("SELECT * FROM tbl_order WHERE status = 2");
            $db->execute();
            return $db->rowCount();
        }
        else
        {
            $status = $id;
        }
        switch($status)
        {
            case 1:
                return $str['order_is_OK'];
                break;
            case 2:
                return $str['order_is_pending'];
                break;
            case 3:
                return $str['order_has_canceled'];
        }
        return false;
    }

    public function status ($status)
    {
        require("language.php");
        switch($status)
        {
            case 1:
                return $str['order_is_OK'];
                break;
            case 2:
                return $str['order_is_pending'];
                break;
            case 3:
                return $str['order_has_canceled'];
        }
        return false;
    }

    public function FetchUserOrder ($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE user_id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    public function SearchUserOrder($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE user_id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }
    public function SearchUsernameOrder($username)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE user_name = ?");
        $db->bind(1,$username);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    public function InsertOrder ($user_id,$food_id,$username,$foodname,$number,$price,$total_price,$credit_after,$status)
    {
        $db = new Database();
        $sql = "INSERT INTO tbl_order (user_name,food_name,number,price,total_price,ip,credit_before,credit_after,status,user_id,food_id) VALUES  (?,?,?,?,?,?,?,?,?,?,?)";
        $db->query($sql);
        $db->bind(1,$username);
        $db->bind(2,$foodname);
        $db->bind(3,$number);
        $db->bind(4,$price);
        $db->bind(5,$total_price);
        $db->bind(6,$this->ip);
        $db->bind(7,$this->credit_before);
        $db->bind(8,$credit_after);
        $db->bind(9,$status);
        $db->bind(10,$user_id);
        $db->bind(11,$food_id);
        if($db->execute())
            return $db->lastInsertId();
        else
            return false;

    }

    /*
     *
     * Here is Admin Area
     *
     */
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

    private function SearchOrderId($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    private function SearchFoodId($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE food_id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;

    }

    public function FetchOrders ()
    {
        $d = new Database();
        $d->query("SELECT * FROM tbl_order");
        $d->execute();
        if($d->rowCount() > 0)
            return $d->resultset();
        else
            return false;
    }

    private function FetchOrdersIsPending ()
    {
        $dada = new Database();
        $dada->query("SELECT * FROM tbl_order WHERE status = 2");
        $dada->execute();
        if($dada->rowCount() > 0)
            return $dada->resultset();
        else
            return false;
    }

    private function SearchFoodnameOrder($name)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE food_name LIKE ?");
        $db->bind(1,$name."%");
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;

    }

    public function FetchOrdersId ($id)
    {
        $ddd = new  Database();
        $ddd->query("SELECT * FROM tbl_order WHERE id = ?");
        $ddd->bind(1,$id);
        $ddd->execute();
        return $ddd->single();
    }

    private function ChangeOrderStatus ($id,$to)
    {
        $da = new Database();
        $da->query("UPDATE tbl_order SET status = ? WHERE id = ?");
        $da->bind(1,$to);
        $da->bind(2,$id);
        $da->execute();
    }

    private function CreditOrderStatus ($price,$op)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE total_price $op ?");
        $db->bind(1,$price);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;

    }

    public function GetCountOrders ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order");
        $db->execute();
        return $db->rowCount();
    }


    public function InsertOrderAdmin ()
    {
        if(isset($_POST['ADD_ORDER']))
        {
            require("language.php");
            if(!empty($_POST['username']) && !empty($_POST['food_name']) && !empty($_POST['number']))
            {
                $set = new Settings();
                $user = new User();
                $food = new Food();
                $credit = new Credits();
                $foodname = $set->Check_Param($_POST['food_name']);
                $username = $set->Check_Param($_POST['username']);
                $this->number = $set->Check_Param($_POST['number']);
                $result_food = $food->FetchFoodName($foodname);
                $result_user = $user->SearchUsernameAdmin_e($username);
                $this->price = $result_food['price'];
                $this->credit_before = $result_user['credit'];
                $this->total_price = $this->number * $this->price ;
                $this->credit_after = $this->credit_before - $this->total_price;
                #number is valid
                if(!$this->IsNumberValid($this->number))
                    return $str['you_should_write_a_number'];
                #food found
                if($result_food == false)
                    return $str['food_not_found'];
                #food is active now!
                if($result_food['active'] != 1)
                    return $str['food_is_not_active_yet'];
                #food balance is lower
                if($result_food['balance'] < $this->number)
                    return $str['food_balance_is_lower_than_you_typed'];
                #user not found
                if($result_user == false)
                    return $str['username_is_not_valid'];
                #user is not active
                if($result_user['active'] != 1)
                    return $str['user_is_not_active_yet'];
                #user credit is 0
                if($result_user['credit']  <= 0 || $this->credit_after < 0)
                    return $str['user_does_not_have_enough_credits'].$result_user['credit'].$str['curr'];
                /**************** Everything Looks Good ! :-) Go head for FINISHING... **********************/
                #add order
                $this->ip = $_SERVER['REMOTE_ADDR'];
                $this->username = $result_user['username'];
                $this->user_id = $result_user['id'];
                $this->foodname = $result_food['name'];
                $this->food_id = $result_food['id'];
                $food->user_id = $result_user['id'];
                $credit->user_id = $result_user['id'];
                $this->id = $this->InsertOrder($this->user_id,$this->food_id,$this->username,$this->foodname,$this->number,$this->price,$this->price,$this->credit_after,2);
                #food balance
                $credit->LowCredit($result_user['id'],$this->credit_after,$this->total_price,$this->credit_before,$this->id);
                #add orders number
                $food->UpdateFoodBalance ($result_food['id'],$this->number);
                #ordernumbers ++
                $user->UpdateOrderNumbersOfUser($result_user['id']);
                return $str['order_has_been_added'];
            }
            else
            {
                return $str['error_message_empty'];
            }
        }
        return null;
    }

    public function CompletedOrders ($id)
    {
        $data = new Database();

        if($id != 0)
        {
            $data->query("SELECT * FROM tbl_order WHERE status = 1 AND user_id = ?");
            $data->bind(1,$id);
            $data->execute();
            if($data->rowCount()> 0)
                return $data->single();
            else
                false;
        }
        else
        {
            $data->query("SELECT * FROM tbl_order WHERE status = 1");
            $data->execute();
            if($data->rowCount()> 0)
                return $data->resultset();
            else
                false;

        }
    }

    public function NewOrders ()
    {
        require("language.php");
        /*
         * return {[0,1]=>blank,has data,result}
         */
        if($this->FetchOrdersIsPending() != false)
        {
            if(isset($_POST['CHANGE_STATUS_NEW']))
            {
                if(isset($_POST['check_list']))
                {
                    foreach ($_POST['check_list'] as $result)
                    {
                        //change order status => 2
                        $this->ChangeOrderStatus($result,1);
                    }
                }
            }
        }
   }

    public function RefundOrders ()
    {
        require("language.php");
        /*
         * return {[0,1]=>blank,has data,result}
         */
        $r = $this->FetchOrdersIsPending();
        if($r != false)
        {
            if(isset($_POST['CHANGE_STATUS_REFUND']))
            {
                if(isset($_POST['check_list']))
                {
                    foreach ($_POST['check_list'] as $result)
                    {
                        $user = new User();
                        $food = new Food();
                        $credit = new Credits();
                        $r_o = $this->FetchOrdersId($result);
                        $r_u = $user->FetchUserInfo($r_o['user_id']);
                        $r_f = $food->FetchFood($r_o['food_id']);
                        # create user credit , change credit user ,
                        if($r_u != false)
                        {
                            #get user credit
                            //$current_user_credit = $r_u['credit'];
                            #0.9*total_price + user credit
                            $this->credit_before = $r_u['credit'];
                            $this->credit_after = $this->credit_before+(0.9*$r_o['total_price']);
                            #update credit user
                            $user->ChangeCreditUesr($r_u['id'],$this->credit_after);
                            #add a new credit => id,user_id,type,credit_before[user credit],credit_after ,credit_now [total_price*0.9],time,ip,order_id
                            $credit_id = $credit->InsertCredit($r_u['id'],$str['refund'],$this->credit_before,$this->credit_after,0.9*$r_o['total_price'],$result);
                            # $credit_id = last id for system credit
                            $refund = 0.9*$r_o['total_price']*-1;
                            $credit->AddMoneyToSystemCredit($credit_id,$refund);
                        }
                        # balance food increase
                        if($r_f != false)
                        {
                            #get balance food
                            $food->RefundFoodBalance($r_f['id'],$r_f['balance']+$r_o['number']);
                            #update food balance
                        }
                        #change status => 3
                        $this->ChangeOrderStatus($result,3);
                    }
                    $r = $this->FetchOrders();
                    if($r != false)
                    {
                        return array(1,$r);
                    }
                }
            }
        }
    }

    public function SearchOrders ()
    {
        require("language.php");
        /*
         *   $str['search_order_by_order_id']
         *   $str['search_order_by_user_id']
                $str['search_order_by_user_name']
                $str['search_order_by_food_id']
                $str['search_order_by_food_name']
                $str['search_order_is_more_than']
                $str['search_order_is_less_than']
                $str['search_order_is_equal']
        return array(5=>not found,2=>found , 3=>number , 4=>enter and result)
         */
        if(isset($_POST['SEARCH']))
        {
            if(isset($_POST['INPUT_VALUE']) && isset($_POST['TYPE']))
            {
                if(!empty($_POST['INPUT_VALUE']))
                {
                    $settings = new Settings();
                    $value = $settings->Check_Param($_POST['INPUT_VALUE']);
                    $choice = $settings->Check_Param($_POST['TYPE']);
                    if(!is_numeric($choice) || $choice <= 0)
                    {
                        return array(4,null);
                    }
                    switch($choice)
                    {
                        case 1:
                            if(is_numeric($value) && intval($value) > 0)
                            {
                                $result = $this->SearchOrderId($value);
                                if($result != false)
                                    return array(2,$result);
                                else
                                    return array(5,null);
                            }
                            else
                            {
                                return array(3,null);
                            }
                        break;
                        case 2:
                            if(is_numeric($value) && intval($value) > 0)
                            {
                                $result = $this->SearchUserOrder($value);
                                if($result != false)
                                    return array(2,$result);
                                else
                                    return array(5,null);
                            }
                            else
                            {
                                return array(3,null);
                            }
                        break;
                        case 3:
                            $result = $this->SearchUsernameOrder($value);
                            if($result != false)
                                return array(2,$result);
                            else
                                return array(5,null);
                        break;
                        case 4:
                            if(is_numeric($value) && intval($value) > 0)
                            {
                                $result = $this->SearchFoodId($value);
                                if($result != false)
                                    return array(2,$result);
                                else
                                    return array(5,null);
                            }
                            else
                            {
                                return array(3,null);
                            }
                        break;
                        case 5:
                            $result = $this->SearchFoodnameOrder($value);
                            if($result != false)
                                return array(2,$result);
                            else
                                return array(5,null);
                        break;
                        case 6:
                            if(is_numeric($value) && intval($value) > 0)
                            {
                                $result = $this->CreditOrderStatus($value,">");
                                if($result != false)
                                    return array(2,$result);
                                else
                                    return array(5,null);
                            }
                            else
                            {
                                return array(3, null);
                            }
                        break;
                        case 7:
                            if(is_numeric($value) && intval($value) > 0)
                            {
                                $result = $this->CreditOrderStatus($value,"<");
                                if($result != false)
                                    return array(2,$result);
                                else
                                    return array(5,null);
                            }
                            else
                            {
                                return array(3, null);
                            }
                        break;
                        case 8:
                            if(is_numeric($value) && intval($value) > 0)
                            {
                                $result = $this->CreditOrderStatus($value,"=");
                                if($result != false)
                                    return array(2,$result);
                                else
                                    return array(5,null);
                            }
                            else
                            {
                                return array(3, null);
                            }
                        break;



                    }
                }
                else
                {
                    return array(4,null);
                }
            }
            else
            {
                return array(4,null);
            }
        }
        return array(null,null);
    }

    private function FindOrderTime ($time,$type)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE ordertime $type ?");
        $db->bind(1,$time);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    private function FindOrderForFood ($food)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE food_name = ? ORDER BY id DESC LIMIT 20");
        $db->bind(1,$food);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    public function ReportOrderAdmin ()
    {
        /*
         * return (0=>nothing,1=>not found,2=> error , 4=> digits are valid, 3=> yes), result)
         */
        if(isset($_POST['SEARCH']))
        {
            if(!empty($_POST['INPUT_VALUE']) && !empty($_POST['TYPE']))
            {
                if(!is_numeric($_POST['TYPE']))
                {
                    return array(2,null);
                }
                $set = new Settings();
                $value = $set->Check_Param($_POST['INPUT_VALUE']);
                switch($_POST['TYPE'])
                {
                    case 1:
                        if(is_numeric($value))
                        {
                            $user = new User();
                            $result_uesr = $user->FetchUserInfo($value);
                            if( $result_uesr != false)
                            {
                                return array(3,$result_uesr);
                            }
                            else
                            {
                                return array(1,null);
                            }
                        }
                        else
                        {
                            return array(4,null);
                        }
                        break;
                    case 2:
                        $user = new User();
                        $result_user = $user->FetchUserInfoByUsername($value);
                        if($result_user!=false)
                        {
                            return array(3,$result_user);
                        }
                        else
                        {
                            return array(1,null);
                        }
                        break;
                    case 3:
                        $result = $this->FindOrderForFood($value);
                        if($result != false)
                        {
                            return array(5,$result);
                        }
                        else
                        {
                            return array(1,null);
                        }
                        break;
                }

            }
            else
            {
                return array(2,null);
            }
        }
        return array(0,null);
    }

    public function ReportOrderAdmin_2 ()
    {
        /*
         * return (0=>nothing,1=>not found,2=> error, 3=> yes), result)
         */
        if(isset($_POST['SEARCH_2']))
        {
            if(!empty($_POST['INPUT_VALUE_2']) && !empty($_POST['TYPE_2']))
            {
                if(!is_numeric($_POST['TYPE_2']))
                {
                    return array(2,null);
                }
                $set = new Settings();
                $time = $set->PickTime($_POST['INPUT_VALUE_2']);
                switch($_POST['TYPE_2'])
                {
                    case 1:
                        $result = $this->FindOrderTime($time,"<=");
                        if($result != false)
                            return array(3,$result);
                        else
                            return array(1,null);
                    break;
                    case 2:
                        $result = $this->FindOrderTime($time,">=");
                        if($result != false)
                            return array(3,$result);
                        else
                            return array(1,null);
                        break;
                }

            }
            else
            {
                return array(2,null);
            }
        }
        return array(0,null);
    }

    public function Order()
    {
        $set = new Settings();
        $user = new User();
        if(!$user->CheckUserIsActive())
        {
            header("location: index.php");
        }
        require("language.php");
        /*
         * return  (1 , 2 => isset or !isset) , (1,2 => pay or error) , ()
         */
        if(isset($_POST['order']))
        {
            if(!empty($_POST['food']) && !empty($_POST['number']))
            {
                if(isset($_POST['terms']))
                {
                    if($_POST['terms'] != "check")
                    {
                        return array(1,$str['you_should_read_notice_above'],null);
                    }
                }
                else
                {
                    return array(1,$str['you_should_read_notice_above'],null);
                }
                $this->food_id = $set->Check_Param($_POST['food']);
                $this->number = $set->Check_Param($_POST['number']);
                #check food_id and number are number
                if(!is_numeric($this->food_id) || intval($this->food_id) < 0 ||!is_numeric($this->number) || intval($this->number) < 0)
                {
                    return array(1,$str['you_should_write_a_number'],null);
                }
                $food = new Food();
                #check food is OK !
                if(!$food->CheckFoodIsAvaliable($this->food_id,$this->number))
                {
                    return array(1,$str['food_balance_is_lower_than_you_typed'],null);
                }
                #check user credit
                $food_result = $food->FetchFood($this->food_id);
                $this->price = $food_result['price'];
                $this->foodname = $food_result['name'];
                $this->total_price = $this->number*$this->price;
                $this->credit_after = $this->credit_before-$this->total_price;
                if($this->credit_after < 0)
                {
                    return array(1,$str['your_credit_balance_is_not_enough']." ".$str['you_need_x']." ".$this->credit_after." ".$str['curr'],null);
                }
                #add order
                $this->id = $this->InsertOrder($this->user_id,$this->food_id,$this->username,$this->foodname,$this->number,$this->price,$this->total_price,$this->credit_after,2);
                #add credit
                $credit = new Credits();
                $c_id = $credit->InsertCredit($this->user_id,$str['order_case'],$this->credit_before,$this->credit_after,$this->total_price,$this->id);
                #update balance food
                $food = new Food();
                $food->UpdateFoodBalance($this->food_id,$this->number);
                #update credit user
                $user = new User();
                #update user credit
                $credit->UpdateUserCredit($this->credit_after);
                #update order numbers
                $user->UpdateOrderNumbersOfUser($this->user_id);
                #insert credit system
                $credit->AddMoneyToSystemCredit($c_id,$this->total_price);
                return array(2,1,$this->FetchOrdersId($this->id));
            }
            else
            {
                return array(1,$str['error_message_empty'],null);
            }
        }
        return array(1,2,null);
}

    public function OneOrder ($user_id,$order_id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE id = ? AND user_id = ?");
        $db->bind(1,$order_id);
        $db->bind(2,$user_id);
        $db->execute();
        if($db->rowCount() == 1)
            return $db->single();
        else
            return false;
    }

    private function CheckUserAndOrder($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_order WHERE id = ? AND user_id = ?");
        $db->bind(1,$id);
        $db->bind(2,$this->user_id);
        $db->execute();
        if($db->rowCount() == 1)
            return $db->single();
        else
            return false;
    }

    public function CancelOrder ()
    {
        if(isset($_POST['cancel_order']))
        {
            if(isset($_GET['order']))
            {
                $id = $_GET['order'];
                if(is_numeric($id))
                {
                    $result = $this->CheckUserAndOrder($id);
                    if($result != false)
                    {
                        $set = new Settings();
                        if($set->CanUserCancel($result['ordertime']))
                        {
                            require("language.php");
                            #calculating
                            #insert credit
                            $credit = new Credits();
                            $credit->credit_now = $result['total_price']*0.9;
                            $credit->credit_before = $credit->CurrentCredit();
                            $this->number = $result['number'];
                            $credit->credit_after =$credit->credit_now+$credit->credit_before;
                            $c_id = $credit->InsertCredit($this->user_id,$str['refund'],$credit->credit_before,$credit->credit_after,$credit->credit_now,$result['id']);
                            #update balance
                            $food = new Food();
                            $result_food = $food->FetchFood($result['food_id']);
                            $number = $this->number+$result_food['balance'];
                            $food->RefundFoodBalance($result['food_id'],$number);
                            #update user credit
                            $credit->UpdateUserCredit($credit->credit_after);
                            #update order
                            $this->ChangeOrderStatus($id,3);
                            #insert system credit
                            $refund = $credit->credit_now*-1;
                            $credit->AddMoneyToSystemCredit($c_id,$refund);
                        }
                        else
                        {
                            header("location: index.php?3");
                        }
                    }
                    else
                    {
                        header("location: index.php?3");
                    }
                }
                else
                {
                    header("location: index.php?1");
                }
            }
            else
                header("location: index.php?10");
        }
        elseif(isset($_GET['order']))
        {
            $id = $_GET['order'];
            if(is_numeric($id))
            {
                $result = $this->CheckUserAndOrder($id);
                if($result != false)
                {
                    $set = new Settings();
                    if($set->CanUserCancel($result['ordertime']))
                    {
                        return $result;
                    }
                    else
                    {
                        header("location: index.php?3");
                    }
                }
                else
                {
                    header("location: index.php?3");
                }
            }
            else
            {
                header("location: index.php?31");
            }
        }
        else
            header("location: index.php?11");
    }
}