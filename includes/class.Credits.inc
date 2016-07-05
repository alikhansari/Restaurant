<?php
/* Class Credits include
 * 23 Mehr 94 - Yazd University
 * 9130403 - Ali Khodabakhshian
 */
class Credits
{
    public $id;
    public $user_id;
    public $type;
    public $credit_before;
    public $credit_now;
    public $credit_after;
    public $time;
    public $ip;
    public $order_id;

    public function __construct()
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        if(isset($_COOKIE['id']))
            $this->user_id = $_COOKIE['id'];
        $this->credit_before = $this->CurrentCredit();
    }

    public function FetchCreditId($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_credit_log WHERE id = ?");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->single();
        else
            return false;
    }

    public function FetchCreditUserId ($user_id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_credit_log WHERE user_id = ?");
        $db->bind(1,$user_id);
        $db->execute();
        if($db->rowCount() >0 )
            return $db->resultset();
        else
            return false;
    }

    public function SystemCredit()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_credit_system");
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    public function UpdateUserCredit ($payment)
    {
        $dd = new Database();
        $dd->query("UPDATE tbl_user SET credit = ? WHERE id = ?");
        $dd->bind(1,$payment);
        $dd->bind(2,$this->user_id);
        $dd->execute();
    }

    public function InsertCredit($user_id,$type,$credit_before,$credit_after,$credit_now,$order_id)
    {
        $d2 = new Database();
        $d2->query("INSERT INTO tbl_credit_log (user_id,type,credit_before,credit_now,credit_after,ip,order_id) VALUES  (?,?,?,?,?,?,?)");
        $d2->bind(1,$user_id);
        $d2->bind(2,$type);
        $d2->bind(3,$credit_before);
        $d2->bind(4,$credit_now);
        $d2->bind(5,$credit_after);
        $d2->bind(6,$_SERVER['REMOTE_ADDR']);
        $d2->bind(7,$order_id);
        $d2->execute();
        return $d2->lastInsertId();
    }

    public function CurrentCredit ()
    {
        $db = new Database();
        $db->query("SELECT credit FROM tbl_user WHERE id = ?");
        $db->bind(1,$this->user_id);
        $db->execute();
        $row = $db->single();
        return $row['credit'];
    }


    public function AddMoneyToSystemCredit($credit_number,$total_price)
    {
        $dc = new Database();
        $dc->query("INSERT INTO tbl_credit_system (credit_log_id, total_price)  VALUES (?,?)");
        $dc->bind(1,$credit_number);
        $dc->bind(2,$total_price);
        $dc->execute();
    }

    public function LowCredit($user_id,$c_after,$c_now,$c_before,$order_id)
    {
        require("language.php");
        $ddc = new Database();
        $this->type = $str['order_case'];
        $sql = ("INSERT INTO tbl_credit_log (user_id,type,credit_before,credit_after,credit_now,ip,order_id) VALUES (?,?,?,?,?,?,?)");
        $ddc->query($sql);
        $ddc->bind(1,$user_id);
        $ddc->bind(2,$this->type);
        $ddc->bind(3,$c_before);
        $ddc->bind(4,$c_after);
        $ddc->bind(5,$c_now);
        $ddc->bind(6,$this->ip);
        $ddc->bind(7,$order_id);
        $ddc->execute();
        $id = $ddc->lastInsertId();
        $this->UpdateUserCredit($c_after);
        $this->AddMoneyToSystemCredit($id,$c_now);
        return true;
    }

    public function AddCredit ()
    {
        require("language.php");
        if(isset($_POST['buy']))
        {
            if(isset($_POST['payment_value']))
            {
                if(is_numeric($_POST['payment_value']) && intval($_POST['payment_value']) > 0)
                {
                    $this->order_id = 0;
                    $this->credit_now = $_POST['payment_value'];
                    $this->type = $str['increase_credit'];
                    $this->credit_after = $this->credit_now+$this->credit_before;
                    $db = new Database();
                    $db->query("INSERT INTO tbl_credit_log (user_id,type,credit_before,credit_after,credit_now,ip,order_id) VALUES (?,?,?,?,?,?,?)");
                    $db->bind(1,$this->user_id);
                    $db->bind(2,$this->type);
                    $db->bind(3,$this->credit_before);
                    $db->bind(4,$this->credit_after);
                    $db->bind(5,$this->credit_now);
                    $db->bind(6,$this->ip);
                    $db->bind(7,$this->order_id);
                    $db->execute();
                    $msg = $str['credit_added_successfully']." ".$str['credit_log_number']."( ".$this->credit_now." ) :".$db->lastInsertId();
                    $this->UpdateUserCredit($this->credit_after);
                    return $msg;
                }
            }
        }
        return false;

    }

    public function CreditReport ()
    {
        $limit = 5;
        if(isset($_POST['change']))
        {
            if(is_numeric($_POST['number']) && intval($_POST['number']) > 0)
            {
                $limit = $_POST['number'];
            }
        }
        $this->id = $_COOKIE['id'];
        $db = new Database();
        $db->query("SELECT * FROM tbl_credit_log WHERE user_id = ? ORDER BY id DESC LIMIT $limit");
        $db->bind(1,$this->id);
        $db->execute();
        $row = $db->resultset();
        return $row;
    }

    /*
     *
     * Here is Admin Area
     *
     */
    public function CreditReportAdmin ($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_credit_log WHERE user_id = ? ORDER BY id DESC");
        $db->bind(1,$id);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    public function GetCreditCount()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_credit_log");
        $db->execute();
        return $db->rowCount();

    }

    public function GetBalanceSystem ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_credit_system");
        $db->execute();
        if($db->rowCount()>0)
        {
            $sum = 0;
            foreach ($db->resultset() as $row) {
                $sum = $row['total_price'] + $sum;
            }
            return $sum;

        }
        else
        {
            return 0;
        }
    }

    public function SearchCreditType ($type)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_credit_log WHERE type = ?");
        $db->bind(1,$type);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    private function SearchCreditsDates($time,$type)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_credit_log WHERE time $type ?");
        $db->bind(1,$time);
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    public function SearchCredit()
    {
        /*
         * return (1 => credit , 2=> date), (1[empty],2[number]=> error , 3=> not_found , 4=> found) , (result);
         */
        if(isset($_POST['SEARCH_CREDIT']))
        {
            require("language.php");
            /*
             * return:
             * $str['report_credit_id'];
$str['report_credit_type_refund'];
$str['report_credit_type_buy'];
$str['report_credit_type_credit'];
$str['report_credit_user_id'];
$str['report_credit_user_name'];
             */
            if(!empty($_POST['TYPE']))
            {
                if(!is_numeric($_POST['TYPE']))
                {
                    return array(1,1,null);
                }
                $set = new Settings();
                if(isset($_POST['INPUT_SEARCH']))
                    $value = $set->Check_Param($_POST['INPUT_SEARCH']);
                else
                    $value = null;
                switch($_POST['TYPE'])
                {
                    case 1:
                        if(!is_numeric($value))
                        {
                            return array(1,2,null);
                        }
                        $result = $this->FetchCreditId($value);
                        if($result != false)
                        {
                            $msg = '<a href="print.php?type=credit&id='.$result['id'].'" target="_blank">'.$result['type'].": ".$result['credit_now'].$str['curr'].'</a>';
                            return array(1,4,$msg);
                        }
                        else
                        {
                            return array(1,3,null);
                        }
                        break;
                    case 2:
                        if($this->SearchCreditType($str['refund']) != false)
                        {
                            $msg = '<a href="print.php?type=credit_type&id=1" target="_blank">'.$str['report_credit_type_refund'].'</a>';
                            return array(1,4,$msg);
                        }
                        else
                        {
                            return array(1,3,null);
                        }
                        break;
                    case 3:
                        if($this->SearchCreditType($str['order_case']) != false)
                        {
                            $msg = '<a href="print.php?type=credit_type&id=2" target="_blank">'.$str['report_credit_type_buy'].'</a>';
                            return array(1,4,$msg);
                        }
                        else
                        {
                            return array(1,3,null);
                        }
                        break;
                    case 4:
                        if($this->SearchCreditType($str['increase_credit']) != false)
                        {
                            $msg = '<a href="print.php?type=credit_type&id=3" target="_blank">'.$str['report_credit_type_credit'].'</a>';
                            return array(1,4,$msg);
                        }
                        else
                        {
                            return array(1,3,null);
                        }
                        break;
                    case 5:
                        if(!is_numeric($value))
                        {
                            return array(1,2,null);
                        }
                        $result = $this->CreditReportAdmin($value);
                        if($result != false)
                        {
                            $msg = '<a href="print.php?type=credit_user&id='.$value.'" target="_blank">'.$str['report_credit_user_id']." ".$value.'</a>';
                            return array(1,4,$msg);
                        }
                        else
                        {
                            return array(1,3,null);
                        }
                        break;
                    case 6:
                        $user = new User();
                        $u_r = $user->FetchUserInfoByUsername($value);
                        if($u_r != false)
                        {
                            $result = $this->CreditReportAdmin($u_r['id']);
                            if($result != false)
                            {
                                $msg = '<a href="print.php?type=credit_user&id='.$u_r['id'].'" target="_blank">'.$str['report_credit_user_name']." ".$value.'</a>';
                                return array(1,4,$msg);
                            }
                            else
                            {
                                return array(1,3,null);
                            }
                        }
                        else
                        {
                            return array(1,3,null);
                        }
                        break;
                }
            }
            else
            {
                return array(1,1,null);
            }

        }
        /*
 * return (1 => credit , 2=> date), (1[empty]=>error,2=>not_found , 3=> found) , (result);
 */
        elseif(isset($_POST['SEARCH_2']))
        {
/*
 * $str['report_credit_before_date'];
$str['report_credit_before_after']
            */
            if(!empty($_POST['TYPE_2']) && !empty($_POST['INPUT_VALUE_2']))
            {
                if(!is_numeric($_POST['TYPE_2']))
                {
                    return array(2,1,null);
                }
                $set = new Settings();
                $time = $set->PickTime($_POST['INPUT_VALUE_2']);
                switch($_POST['TYPE_2'])
                {
                    case 1:
                        $result = $this->SearchCreditsDates($time,"<=");
                        //die(var_dump($result));
                        if($result != false)
                        {
                            return array(2,3,$result);
                        }
                        else
                        {
                            return array(2,2,null);
                        }
                        break;
                    case 2:
                        $result = $this->SearchCreditsDates($time,">=");
                        if($result != false)
                        {
                            return array(2,3,$result);
                        }
                        else
                        {
                            return array(2,2,null);
                        }
                        break;
                }
            }
            else
            {
                return array(2,1,null);
            }
        }
    }

    /**
     * @return int
     */
    public function AddCreditAdmin ()
    {
        if(isset($_POST['ADD_CREDIT']))
        {
            if(!empty($_POST['username']) && !empty($_POST['price']))
            {
                $set = new Settings();
                $username = $set->Check_Param($_POST['username']);
                $this->credit_now = $set->Check_Param($_POST['price']);
                if(!is_numeric($this->credit_now))
                {
                    return 3;
                }
                $user = new User();
                $u_r = $user->FetchUserInfoByUsername($username);
                if($u_r != false)
                {
                    require("language.php");
                    $this->user_id = $u_r['id'];
                    $this->credit_before = $u_r['credit'];
                    $this->order_id = 0;
                    $this->type = $str['increase_credit'];
                    $this->ip = $_SERVER['REMOTE_ADDR'];
                    $this->credit_after = $this->credit_before + $this->credit_now;
                    # update user Credit
                    $this->UpdateUserCredit($this->credit_after);
                    #add a new credit
                    $data = new Database();
                    $data->query("INSERT INTO tbl_credit_log (user_id,type,credit_before,credit_after,credit_now,ip,order_id) VALUES (?,?,?,?,?,?,?)");
                    $data->bind(1,$this->user_id);
                    $data->bind(2,$this->type);
                    $data->bind(3,$this->credit_before);
                    $data->bind(4,$this->credit_after);
                    $data->bind(5,$this->credit_now);
                    $data->bind(6,$this->ip);
                    $data->bind(7,$this->order_id);
                    $data->execute();
                    return 6;
                }
                else
                {
                    return 4;
                }
            }
            else
            {
                return 2;
            }
        }
        return 5;
    }

}