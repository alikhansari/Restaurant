<ul><li><?php echo $str['notice']; ?>: <?php echo $str['food_name_must_uniqe'];?></li></ul>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <table width="100%">
        <tr>
            <td><label for="id1"><?php echo $str['food_name'];?></label></td>
            <td><input type="text" name="name" placeholder="<?php echo $str['food_name'];?>" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" id="id1" class="input_general"/></td>
        </tr>
        <tr>
            <td><label for="id2"><?php echo $str['food_price'];?></label></td>
            <td><input type="number" min="1" max="1000000" name="price" placeholder="<?php echo $str['food_price'];?>" value="<?php if(isset($_POST['price'])) echo $_POST['price']; ?>" id="id2" class="input_general"/></td>
        </tr>
        <tr>
        <td><label for="id3"><?php echo $str['food_balance'];?></label></td>
            <td><input type="number" min="1" max="<?php echo $set->GetSettings(5)?>" name="balance" placeholder="<?php echo $str['food_balance'];?>" value="<?php if(isset($_POST['balance'])) echo $_POST['balance']; ?>" id="id3" class="input_general"/></td>
        </tr>
        <tr>
        <td><label for="id4"><?php echo $str['cat_name'];?></label></td>
            <td><select id="id4" class="input_general" name="cat_id">
                <?php foreach ($r_cat as $row) { ?>
                    <option value="<?php echo $row['id'];?>" <?php if(isset($_POST['cat_id']))
                    {
                        if($_POST['cat_id'] == $row['id'])
                        {
                            echo "selected";
                        }
                    }
                    ?>><?php echo $row['name'];?></option>
                <?php } ?>
                </select></td>
        </tr>
        <tr>
            <td><label for="id5"><?php echo $str['active'];?></label></td>
            <td><select name="active" id="id5" class="input_general">
                    <option value="1"
                        <?php if(isset($_POST['active']))
                        {
                            if($_POST['active'] == 1)
                            {
                                echo "selected";
                            }
                        }?>
                        ><?php echo $str['yes'];?></option>
                    <option value="2"
                        <?php if(isset($_POST['active']))
                        {
                            if($_POST['active'] == 2)
                            {
                                echo "selected";
                            }
                        }?>
                        ><?php echo $str['no'];?></option>
            </select></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="ADD_FOOD" value="<?php echo $str['add_food'];?>" /> </td>
        </tr>
        <?php if ($result != null)  { ?>
        <tr><td colspan="2"><?php echo $result;?></td></tr>
        <?php }?>
    </table>
</form>