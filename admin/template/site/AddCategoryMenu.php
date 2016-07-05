<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <table width="100%">
        <tr><td><label for="id1"><?php echo $str['name'];?></label></td><td><input type="text" id="id1" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>" placeholder="<?php echo $str['cat_name'];?>" class="input_general" /> </td></tr>
        <tr><td colspan="2"><input type="submit" name="ADD_CATEGORY" value="<?php echo $str['add_category'];?>"> </td></tr>
        <?php if($result != null )
        {
            ?>
            <tr><td colspan="2"><span class="error"><?php echo $result; ?></span> </td></tr>
        <?php
        }?>
    </table>
</form>