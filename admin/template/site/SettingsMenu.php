
<form action="settings.php" method="POST">
    <table class="form_1" width="100%">
        <tr>
            <td width="25%"><?php echo $str['site_title']; ?></td>
            <td width="75%"><input type="text" value="<?php if(isset($_POST['site_title'])) echo $_POST['site_title']; else echo $set->GetSettings(1);?>" placeholder="<?php echo $str['site_title']; ?>" name="site_title" class="input_general"  /></td>
        </tr>
        <tr>
            <td width="25%"><?php echo $str['max_time_for_cancel_order']; ?></td>
            <td width="75%"><input type="number" min="0" step="1" value="<?php if(isset($_POST['max_time_for_cancel_order'])) echo $_POST['max_time_for_cancel_order']; else echo $set->GetSettings(3);?>" placeholder="<?php echo $str['max_time_for_cancel_order']; ?>" name="max_time_for_cancel_order" class="input_general"  /></td>
        </tr>
        <tr>
            <td width="25%"><?php echo $str['max_number_for_balance']; ?></td>
            <td width="75%"><input type="number" min="0" max="10000000" value="<?php if(isset($_POST['max_number_for_balance'])) echo $_POST['max_number_for_balance']; else echo $set->GetSettings(5)?>" placeholder="<?php echo $str['max_number_for_balance']; ?>" name="max_number_for_balance" class="input_general"  /></td>
        </tr>
        <tr>
            <td width="25%"><?php echo $str['max_order_users']; ?></td>
            <td width="75%"><input type="number" min="0" max="10000000" value="<?php if(isset($_POST['max_order_users'])) echo $_POST['max_order_users']; else echo $set->GetSettings(2)?>" placeholder="<?php echo $str['max_order_users']; ?>" name="max_order_users" class="input_general"  /></td>
        </tr>
        <tr>
            <td width="25%"><?php echo $str['site_email']; ?></td>
            <td width="75%"><input type="email" value="<?php if(isset($_POST['site_title'])) echo $_POST['site_email']; else echo $set->GetSettings(4);?>" placeholder="<?php echo $str['site_email']; ?>" name="site_email" class="input_general"  /></td>

        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="CHANGE_SITE_CONFIG" value="<?php echo $str['change_configuration_site'] ?>" class="input_general" />
            </td>
        </tr>
        <?php if($msg != null) { ?>
        <tr><td colspan="2"><span class="error"><?php echo $msg;?></span> </td></tr>
        <?php }?>
    </table>

</form>
