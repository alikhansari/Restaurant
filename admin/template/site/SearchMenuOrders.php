<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <table width="100%">
        <tr>
            <td width="30%">
                <select name="TYPE" class="input_search">
                    <option value="1" <?php if(isset($_POST['TYPE'])) if($_POST['TYPE'] == 1) echo "selected";?>><?php echo $str['search_order_by_id'];?></option>
                    <option value="2" <?php if(isset($_POST['TYPE'])) if($_POST['TYPE'] == 2) echo "selected";?>><?php echo $str['search_order_by_user_id'];?></option>
                    <option value="3" <?php if(isset($_POST['TYPE'])) if($_POST['TYPE'] == 3) echo "selected";?>><?php echo $str['search_order_by_user_name'];?></option>
                    <option value="4" <?php if(isset($_POST['TYPE'])) if($_POST['TYPE'] == 4) echo "selected";?>><?php echo $str['search_order_by_food_id'];?></option>
                    <option value="5" <?php if(isset($_POST['TYPE'])) if($_POST['TYPE'] == 5) echo "selected";?>><?php echo $str['search_order_by_food_name'];?></option>
                    <option value="6" <?php if(isset($_POST['TYPE'])) if($_POST['TYPE'] == 6) echo "selected";?>><?php echo $str['search_order_is_more_than'];?></option>
                    <option value="7" <?php if(isset($_POST['TYPE'])) if($_POST['TYPE'] == 7) echo "selected";?>><?php echo $str['search_order_is_less_than'];?></option>
                    <option value="8" <?php if(isset($_POST['TYPE'])) if($_POST['TYPE'] == 8) echo "selected";?>><?php echo $str['search_order_is_equal'];?></option>
                </select>
            </td>
            <td width="60%"><input type="text" class="input_search" name="INPUT_VALUE" value="<?php if(isset($_POST['INPUT_VALUE'])) echo $_POST['INPUT_VALUE'];?>" placeholder="<?php echo $str['please_enter_your_value'];?>"</td>
            <td width="10%"><input type="submit" value="<?php echo $str['search'];?>" name="SEARCH" /> </td>
        </tr>

    </table>
</form>
    <?php
    if($result[0] == 3)
    {
        echo $str['you_should_write_a_number'];
    }
    elseif($result[0] == 4)
    {
        echo $str['please_enter_your_value'];
    }
    elseif($result[0] == 5)
    {
        echo $str['not_found'];
    }
    elseif($result[0] == 2)
    {
        ?>
        <table width="100%">
            <tr><td>#</td><td><?php echo $str['username'];?></td><td><?php echo $str['food_name'];?></td><td><?php echo $str['number']; ?><td><?php echo $str['total_price'] ?></td><td><?php echo $str['order_status'];?></td></tr>
            <?php
            $i = 1;
            foreach ($result[1] as $row) {
                if($i <= 7) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><a href="print.php?type=user&id=<?php echo $row['user_id']; ?>"
                               target="_blank"><?php echo $row['user_name']; ?></a></td>
                        <td><a href="print.php?type=food&id=<?php echo $row['food_id']; ?>"
                               target="_blank"><?php echo $row['food_name']; ?></a></td>
                        <td><?php echo $row['number']; ?></td>
                        <td><?php echo $row['total_price']; ?><?php echo $str['curr']; ?></td>
                        <td><a href="print.php?type=order&id=<?php echo $row['id']; ?>"
                               target="_blank"><?php echo $order->status($row['status']) ?></a></td>
                    </tr>
                    <?php
                }
                $i++;
            }

            ?>
        </table>
    <?php
    }
    ?>