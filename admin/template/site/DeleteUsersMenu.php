<form action="<?php echo $_SERVER['PHP_SELF'];?>?delete=<?php echo $user_id;?>" method="POST">
    <?php
    echo $str['are_sure_to_delete_this_user']; echo" "; echo $result[0]['username'];
    ?>
    <input type="submit" name="DELETE_USER" value="<?php echo $str['yes'];?>" />
</form>