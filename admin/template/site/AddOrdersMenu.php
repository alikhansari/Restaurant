<li><?php echo $str['notice']?>, <?php echo $str['you_can_type_just_one_char_to_appear_whole_of_the_food_name']; ?></li>

<form action="<?php echo $_SERVER['PHP_SELF']?>" name="form" method="POST">
    <table width="100%">
        <tr>
            <td width="30%"><label for="username"><?php echo $str['username']; ?></label></td>
            <td width="70%"><input type="text" id="username" name="username" class="input_general" placeholder="<?php echo $str['username'];?>" /> </td>
        </tr>
        <tr>
            <td width="30%"><label for="food_name"><?php echo $str['food_name']; ?></label></td>
            <td width="70%"><input type="text" id="food_name" name="food_name" value="<?php if(isset($_POST['food_name'])) echo $_POST['food_name']; ?>" class="input_general" placeholder="<?php echo $str['food_name'];?>" /> </td>
        </tr>
        <tr>
            <td width="30%"><label for="number"><?php echo $str['number']; ?></label></td>
            <td width="70%"><input type="number" id="number" min="1" max="<?php echo $set->GetSettings(2);?>" name="number" value="<?php if(isset($_POST['number'])) echo $_POST['number']; ?>" class="input_general" placeholder="<?php echo $str['number'];?>" /> </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="ADD_ORDER" value="<?php echo $str['add_order'];?>" /> </td>
        </tr>
        <?php
        if ($result != null)
        {
            ?>
            <tr>
                <td colspan="2">
                    <span class="error"><?php echo $result;?></span>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</form>