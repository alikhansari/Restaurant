<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <table width="100%">
        <tr>
            <td>
    <select name="TYPE" id="1" class="input_search">
        <option value="1" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="1") echo "selected";?>><?php echo $str['report_credit_id'];?></option>
        <option value="2" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="2") echo "selected";?>><?php echo $str['report_credit_type_refund'];?></option>
        <option value="3" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="3") echo "selected";?>><?php echo $str['report_credit_type_buy'];?></option>
        <option value="4" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="4") echo "selected";?>><?php echo $str['report_credit_type_credit'];?></option>
        <option value="5" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="5") echo "selected";?>><?php echo $str['report_credit_user_id'];?></option>
        <option value="6" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="6") echo "selected";?>><?php echo $str['report_credit_user_name'];?></option>
    </select>
            </td>
            <td>
            <input type="text" name="INPUT_SEARCH" value="<?php if(isset($_POST['INPUT_SEARCH'])) echo $_POST['INPUT_SEARCH'];?>" class="input_search" placeholder="<?php echo $str['please_enter_your_value'];?>" />
            </td>
            <td>
            <input type="submit" name="SEARCH_CREDIT" value="<?php echo $str['search'];?>"/>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?php
                if($result[0] == 1)
                {
                    if($result[1] == 1)
                    {
                        $msg = $str['error_message_empty'];
                    }
                    elseif($result[1] == 2)
                    {
                        $msg = $str['you_should_write_a_number'];
                    }
                    elseif($result[1] == 3)
                    {
                        $msg = $str['not_found'];
                    }
                    elseif($result[1] == 4)
                    {
                        $msg = $result[2];
                    }

                    echo $msg;
                }
                /* return (1 => credit , 2=> date), (1,2=> error , 3=> not_found , 4=> found) , (result);
                1,4,RESULT

                */
                ?>

            </td>
        </tr>
    </table>
</form>
<hr />
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="form_datetime">
    <table width="100%">
        <tr>
            <td width="30%">
                <select name="TYPE_2">
                    <option value="1" <?php if(isset($_POST['TYPE_2'])) if($_POST['TYPE_2'] == 1) echo "selected";?>><?php echo $str['report_credit_before_date'];?></option>
                    <option value="2" <?php if(isset($_POST['TYPE_2'])) if($_POST['TYPE_2'] == 2) echo "selected";?>><?php echo $str['report_credit_after_date'];?></option>
                </select>
            </td>
            <td>
                <input type="text" class="input_search" readonly id="demo1" name="INPUT_VALUE_2" placeholder="<?php echo $str['pick_time'];?>" maxlength="25">
            <td>  <a href="javascript:NewCal('demo1','ddmmyyyy',true,24)"><?php echo $str['pick_time'];?></a> </td>
            <td width="10%"><input type="submit" value="<?php echo $str['rept'];?>" name="SEARCH_2" /> </td>
        </tr>
        <tr>
            <td colspan="3">
            <?php
            if ($result[0] == 2) {
                if ($result[1] == 1 || $result[1] == 2) {
                    switch ($result[1]) {
                        case 1:
                            echo $str['error_message_empty'];
                            break;
                        case 2:
                            echo $str['not_found'];
                            break;
                    }
                } elseif ($result[1] == 3) {
                    ?>
                    <table width="100%">
                        <tr>
                            <td>#</td><td><?php echo $str['username'];?></td><td><?php echo $str['credit_now'];?></td><td><?php echo $str['order_number'];?></td><td><?php echo $str['more'];?></td>
                        </tr>
                            <?php
                            $user = new User();
                            foreach ($result[2] as $row) {
                                $u_r = $user->FetchUserInfo($row['user_id']);
                                ?>
                            <tr>
                                <td><?php echo $row['id'];?></td>
                                <td><a href="print.php?type=user&id=<?php echo $row['user_id'];?>" target="_blank"><?php echo $u_r['username']; ?></a> </td>
                                <td><?php echo $row['credit_now'];?></td>
                                <td><?php if($row['order_id'] == 0) echo "-"; else {
                                        ?>
                                        <a href="print.php?type=order&id=<?php echo $row['order_id'];?>" target="_blank"><?php echo $str['order_number'];?></a>
                                    <?php
                                    }
                                    ?></td>
                                <td><a href="print.php?type=credit&id=<?php echo $row['id']; ?>" target="_blank"><?php echo $str['more'];?></a> </td>
                            </tr>
                                <?php
                            }
                            ?>
                    </table>
                    <?php
                }
            }
            ?>
            </td>
        </tr>
    </table>
</form>