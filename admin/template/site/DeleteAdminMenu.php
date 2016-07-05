<form action="<?php echo $_SERVER['PHP_SELF'];?>?delete=<?php echo $admin_id;?>" method="POST">
    <?php
    echo $str['are_sure_to_delete_this_admin']; echo" "; echo $result['username'];
    ?>
    <input type="submit" name="delete_admin" value="<?php echo $str['yes'];?>" />
</form>