<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <table width="100%">
        <tr>
            <td width="30%">
                <select name="TYPE" class="input_search">
                    <option value="1" <?php if(isset($_POST['TYPE'])) if($_POST['TYPE'] == 1) echo "selected";?>><?php echo $str['report_order_user_id'];?></option>
                    <option value="2" <?php if(isset($_POST['TYPE'])) if($_POST['TYPE'] == 2) echo "selected";?>><?php echo $str['report_order_user_name'];?></option>
                    <option value="3" <?php if(isset($_POST['TYPE'])) if($_POST['TYPE'] == 3) echo "selected";?>><?php echo $str['report_order_food_name'];?></option>
                </select>
            </td>
            <td width="60%"><input type="text" class="input_search" name="INPUT_VALUE" value="<?php if(isset($_POST['INPUT_VALUE'])) echo $_POST['INPUT_VALUE'];?>" placeholder="<?php echo $str['please_enter_your_value'];?>"</td>
            <td width="10%"><input type="submit" value="<?php echo $str['rept'];?>" name="SEARCH" /> </td>
        </tr>
        <?php
        if($report_result[0] == 1 || $report_result[0] == 2 ||$report_result[0] == 4)
        {
            switch($report_result[0])
            {
                case 1:
                    $result = $str['error_report_not_found'];
                    break;
                case 2:
                    $result = $str['error_message_empty'];
                    break;
                case 4:
                    $result = $str['you_should_write_a_number'];
                    break;
            }
            ?>
            <tr>
                <td colspan="3">
                    <?php echo $result;?>
                </td>
            </tr>
            <?php
        }
        elseif($report_result[0] == 3)
        {
            ?>
            <tr>
                <td colspan="3">
                    <a href="print.php?type=allorder&id=<?php echo $report_result[1]['id'];?>" target="_blank"><?php echo $str['link'] ?> <?php echo $str['order_report'];?></a>
                    |||||
                    <a href="print.php?type=user&id=<?php echo $report_result[1]['id'];?>" target="_blank"><?php echo $str['link'] ?> <?php echo $str['user_logs'];?></a>
                    |||||
                    <a href="print.php?type=food_user&id=<?php echo $report_result[1]['id'];?>" target="_blank"><?php echo $str['link'] ?> <?php echo $str['report_order_food_name'];?></a>
                </td>
            </tr>
            <?php
        } else if($report_result[0] == 5)
        {
            $food = new Food();
            ?>
            <tr>
                <td colspan="3">
                    <table width="100%">
                        <tr><td>#</td><td><?php echo $str['food_name'];?></td><td><?php echo $str['total_price'];?></td><td><?php echo $str['rept'];?></td></tr>
                        <?php foreach ($report_result[1] as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row['id'];?></td>
                                <td><?php echo $row['food_name'];?></td>
                                <td><?php echo $row['total_price'];?></td>
                                <td><a href="print.php?type=order&id=<?php echo $row['id'];?>" target="_blank"><?php echo $str['report'];?></a> </td>
                                <td><?php echo $row['id'];?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <hr/>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="form_datetime">
        <table width="100%">
            <tr>
                <td width="30%">
                    <select name="TYPE_2" class="input_search">
                        <option value="1" <?php if(isset($_POST['TYPE_2'])) if($_POST['TYPE_2'] == 1) echo "selected";?>><?php echo $str['report_order_date_before'];?></option>
                        <option value="2" <?php if(isset($_POST['TYPE_2'])) if($_POST['TYPE_2'] == 2) echo "selected";?>><?php echo $str['report_order_date_after'];?></option>
                    </select>
                </td>
                <td>
                <input type="text" class="input_search" readonly id="demo1" name="INPUT_VALUE_2" placeholder="<?php echo $str['pick_time'];?>" maxlength="25">
                <td>  <a href="javascript:NewCal('demo1','ddmmyyyy',true,24)"><?php echo $str['pick_time'];?></a> </td>
                <td width="10%"><input type="submit" value="<?php echo $str['rept'];?>" name="SEARCH_2" /> </td>
            </tr>
            <?php
            if($date_result[0] == 1 || $date_result[0] == 2)
            {
                switch($date_result[0])
                {
                    case 1:
                        $result = $str['error_report_not_found'];
                        break;
                    case 2:
                        $result = $str['error_message_empty'];
                        break;
                }
                ?>
            <tr>
                <td colspan="4">
                <?php echo $result;?>
                </td>
            </tr>
            <?php
            }
            elseif($date_result[0] == 3)
            {
                ?>
            <tr>
                <td colspan="4">
                    <table width="100%">
                        <tr><td>#</td><td><?php echo $str['food_name'];?></td><td><?php echo $str['total_price'];?></td><td><?php echo $str['rept'];?></td></tr>
                        <?php foreach ($date_result[1] as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row['id'];?></td>
                                <td><?php echo $row['food_name'];?></td>
                                <td><?php echo $row['total_price'];?></td>
                                <td><a href="print.php?type=order&id=<?php echo $row['id'];?>" target="_blank"><?php echo $str['report'];?></a> </td>
                                <td><?php echo $row['id'];?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </td>
            </tr>
                <?php
            }
            ?>
        </table>
