<div class="active list-group-item">
    <li><?php echo $str['welcome'];?> <?php echo $str['comma'];?> <?php echo $_COOKIE['admin_username'];?> </li>
    <li><a href="admin/index.php"><?php echo $str['control_panel'];?> , <?php echo $_COOKIE['admin_username'];?></a> </li>
    <li><a href="admin/settings.php"><?php echo $str['settings'];?></a> </li>
    <li><a href="admin/admin_profile.php"><?php echo $str['edit_your_config'];?></a> </li>
    <li><a href="admin/login.php?logout=true"><?php echo $str['logout'];?></a>  </li>
</div>
