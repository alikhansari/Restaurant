<?php
/* Class Category include
 * 23 Mehr 94 - Yazd University
 * 9130403 - Ali Khodabakhshian
 */
class Category
{
    public $id;
    public $name;

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

    private function CheckDuplicateNameEdit ($id,$name)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_category WHERE id != ? AND name = ?");
        $db->bind (1,$id);
        $db->bind(2,$name);
        $db->execute();
        if($db->rowCount() > 0)
            return true;
        else
            return false;
    }

    private function CheckDuplicateName ($name)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_category WHERE name = ?");
        $db->bind(1,$name);
        $db->execute();
        if($db->rowCount() > 0)
        {
            return true;
        }
        else
            return false;
    }

    private function SearchCatName ($type,$value)
    {
        $d = new Database();
        $d->query("SELECT * FROM tbl_category WHERE $type = ?");
        $d->bind(1,$value);
        $d->execute();
        if($d->rowCount() > 0)
        {
            return $d->resultset();
        }
        else
        {
            return false;
        }
    }

    public function GetCatCount ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_category");
        $db->execute();
        return $db->rowCount();
    }

    public function SearchCategoryMenu ()
    {
        /*
         * return(type[1=>fill,2,4=>number,3=>result,4=>not found],result)
         * 1: search for category id
         * 2: search for category name
         * 3: search category of food name
         */
        if(isset($_POST['SEARCH_CATEGORY']))
        {
            if(!empty($_POST['INPUT_SEARCH']) && !empty($_POST['TYPE']))
            {
                if(!$this->IsNumberValid($_POST['TYPE']))
                {
                    return array("2",null);
                }
                else
                {
                    $set = new Settings();
                    $value = $set->Check_Param($_POST['INPUT_SEARCH']);
                    switch($_POST['TYPE'])
                    {
                        case 1:
                            if(!$this->IsNumberValid($value))
                            {
                                return array("4",null);
                            }
                            $result = $this->SearchCatName("id",$value);
                            if($result != false)
                            {
                                return array("3",$result);
                            }
                            else
                            {
                                return array("5",null);
                            }
                            break;
                        case 2:
                            $result = $this->SearchCatName("name",$value);
                            if($result != false)
                            {
                                return array("3",$result);
                            }
                            else
                            {
                                return array("5",null);
                            }
                            break;
                        case 3:
                            $food = new Food();
                            $result1 = $food->FetchFoodName($value);
                            $result = $this->SearchCatName("id",$result1['cat_id']);
                            if($result != false)
                            {
                                return array("3",$result);
                            }
                            else
                            {
                                return array("5",null);
                            }
                            break;
                    }
                }
            }
            else
            {
                return array("1",null);
            }
        }
        return array(null,null);
    }

    public function GetCatName($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_category WHERE id = ?");
        $db->bind(1, $id);
        $db->execute();
        if ($db->rowCount() == 1)
        {
            $result = $db->single();
            return $result['name'];
        }
        else
        {
            return false;
        }
    }

    public function GetCatIdByNameAdmin ($name)
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_category WHERE name = ?");
        $db->bind(1,$name);
        $db->execute();
        if($db->rowCount() > 0)
        {
            return $db->single();
        }
        else
            return false;
    }

    public function CategoryList ()
    {
        $db = new Database();
        $db->query("SELECT * FROM tbl_category ");
        $db->execute();
        if($db->rowCount() > 0)
            return $db->resultset();
        else
            return false;
    }

    public function AddCategory ()
    {
        require("language.php");
        if(isset($_POST['ADD_CATEGORY']))
        {
            if(!empty($_POST['name']))
            {
                $set = new Settings();
                if($this->CheckDuplicateName($set->Check_Param($_POST['name'])))
                {
                    return $str['catname_is_duplicate'];
                }
                else
                {
                    $db1 = new Database();
                    $db1->query("INSERT INTO tbl_category (name) VALUES (?)");
                    $db1->bind(1,$set->Check_Param($_POST['name']));
                    $db1->execute();
                    return $str['cat_has_been_created'];
                }

            }
            else
            {
                return $str['error_message_empty'];
            }
        }
        else
            return null;
    }

    public function DeleteCategory()
    {
        if(isset($_POST['DELETE_CATEGORY']))
        {
            if(isset($_GET['delete']))
            {
                $id = $_GET['delete'];
                if(!$this->IsNumberValid($id))
                {
                    header("Location: category.php");
                }
                else
                {
                    $id = $_GET['delete'];
                    $result = $this->GetCatName($id);
                    if ($result == false)
                    {
                        header("Location: category.php?2");
                    }
                    $food = new Food();
                    if($food->FoodCounterByCategory($id) > 0)
                    {
                        return array("1",$food->FoodCounterByCategory($id));
                    }
                    $d = new Database();
                    $d->query("DELETE FROM tbl_category WHERE id = ?");
                    $d->bind(1,$id);
                    $d->execute();
                    return array("3",null);
                }
            }
        }
        elseif(isset($_GET['delete']))
        {
            $id = $_GET['delete'];
            if(!$this->IsNumberValid($id))
            {
                header("Location: category.php");
            }
            else
            {
                $id = $_GET['delete'];
                $result = $this->GetCatName($id);
                if ($result == false)
                {
                    header("Location: category.php?2");
                }
                $food = new Food();
                if($food->FoodCounterByCategory($id) > 0)
                {
                    return array("1",$food->FoodCounterByCategory($id));
                }
                else
                {
                    return array("2",$result);
                }
            }
        }
        else
        {
            header("Location: category.php?2");
        }
    }

    public function EditCategory ()
    {
        if(isset($_POST['EDIT_CATEGORY']))
        {
            if(isset($_GET['edit']))
            {
                if ($this->IsNumberValid($_GET['edit']))
                {
                    if (isset($_POST['name']))
                    {
                        if(!empty($_POST['name']))
                        {
                            $set = new Settings();
                            if ($this->CheckDuplicateNameEdit($_GET['edit'],$set->Check_Param($_POST['name'])))
                            {
                                return 4;
                            }
                            else
                            {
                                $db1 = new Database();
                                $db1->query("UPDATE tbl_category SET name = ? WHERE id = ?");
                                $db1->bind(1,$set->Check_Param($_POST['name']));
                                $db1->bind(2,$_GET['edit']);
                                $db1->execute();
                                return 3;
                            }
                        }
                        else
                        {
                            header("Location: category.php?2");
                        }
                    }
                    else
                    {
                        header("Location: category.php?3");
                    }
                }
                else
                {
                    header("Location: category.php?4");
                }
            }
            else
            {
                header("Location: category.php?5");
            }
        }
        elseif(isset($_GET['edit']))
        {
            if($this->IsNumberValid($_GET['edit']))
            {
                $id = $_GET['edit'];
                if ($this->GetCatName($id)!=false)
                {
                    return $this->GetCatName($id);
                }
                else
                {
                    header("Location: category.php?9");
                }
            }
            else
            {
                header("Location: category.php?6");
            }
        }
        else
        {
            header("Location: category.php?7");
        }
    }
}