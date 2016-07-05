<?php
require("../includes/functions.php");
$admin = new Admin();
$user= new User();
$admin->ValidateToAdminLogin();
$set = new Settings();
$msg = $user->AddUserAdmin();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="template/css/admin.css" rel="stylesheet" type="text/css" />
    <title><?php echo $str['add_user'];?></title>
</head>
<body>
<table border="1" class="table_admin" width="100%">
    <tr><td colspan="2"><h1><?php echo $str['add_user']; ?></h1></td></tr>
    <tr><td width="20%"><a href="#"><?php echo $str['welcome'].$str['comma'].$_COOKIE['admin_username'];?></a></td><td rowspan="9" style="text-align: center;text-align-all: center;text-valign:middle;" width="80%">
            <?php require("template/site/AddUsersMenu.php"); ?>
        </td></tr>
    <tr><td width="20%"><a href="index.php"><?php echo $str['return_main_page'];?></a></td></tr>
    <tr><td width="20%"><a href="users.php"><?php echo $str['customer_manage'];?></a></td></tr>
    <tr><td width="20%"><a href="users_view.php"><?php echo $str['view_user'];?></a></td></tr>
    <tr><td width="20%"><a href="users_search.php"><?php echo $str['search_user'];?></a></td></tr>
    <tr><td width="20%"><a href="users_logs.php"><?php echo $str['user_logs'];?></a></td></tr>
    <tr><td width="20%"><a href="users_activate.php"><?php echo $str['activate_user'];?></a></td></tr>
    <tr><td width="20%"><a href="users_deactivate.php"><?php echo $str['deactivate_user'];?></a></td></tr>
    <tr><td width="20%"><a href="login.php?logout=true"><?php echo $str['logout'];?></a></td></tr>
    <tr><td colspan="2"><?php echo $str['copyright'];?> © <a href="../index.php" target="_blank"><?php echo $set->GetSettings(1);?></a> </td></tr>
</table>
</body>
</html>