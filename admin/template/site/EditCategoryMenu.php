<form action="<?php echo $_SERVER['PHP_SELF'];?>?edit=<?php echo $id ?>" method="POST">
    <table width="100%">
        <tr><td><label for="id1"><?php echo $str['name'];?></label></td>
            <td><input type="text" id="id1" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $result;?>" placeholder="<?php echo $str['cat_name'];?>" class="input_general" /> </td></tr>
        <tr><td colspan="2"><input type="submit" name="EDIT_CATEGORY" value="<?php echo $str['edit_category'];?>"> </td></tr>
        <?php if($result == 3)
        {
            ?>
            <tr><td colspan="2"><span class="error"><?php echo $str['category_has_been_edited']; ?></span> </td></tr>
            <?php
        }?>
        <?php if($result == 4)
        {
            ?>
            <tr><td colspan="2"><span class="error"><?php echo $str['catname_is_duplicate']; ?></span> </td></tr>
            <?php
        }?>
    </table>
</form>