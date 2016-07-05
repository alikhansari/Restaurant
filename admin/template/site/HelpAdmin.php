<ul>
    <li><?php echo $str['attention'];?> ==> <?php echo $str['attention_expr'];?> <?php echo $str['so_you_X_permissions'];?>
        <?php
    if($_COOKIE['admin_id'] == 1)
    {
        echo $str['have'];
    }
    else
    {
        echo $str['have_not'];
    }
        ?>
    </li>
    <li><?php echo $str['add_admins'];?> ==> <?php echo $str['add_admins_expr'];?></li>
    <li><?php echo $str['view_admins'];?> ==> <?php echo $str['view_admins_expr'];?></li>
    <li><?php echo $str['edit_your_config'];?> ==> <?php echo $str['edit_your_config_expr'];?></li>
</ul>
<ul><li><?php echo $str['your_admin_#_is'];?> <?php echo $admin->GetAdminCount(); ?> </li></ul>