<form action="<?php echo $_SERVER['PHP_SELF'];?>?delete=<?php echo $food_id;?>" method="POST">
    <?php
    echo $str['are_sure_to_delete_this_food']; echo" "; echo $result[0]['name'];
    ?>
    <input type="submit" name="DELETE_FOOD" value="<?php echo $str['yes'];?>" />
</form>