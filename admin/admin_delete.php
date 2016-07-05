<?php
require("../includes/functions.php");
$admin = new Admin();
$admin->ValidateToAdminLogin();
$set = new Settings();
$set->PermissionToAdmin ();
$result = $admin->DeleteAdmin();
$admin_id = $_GET['delete'];
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="template/css/admin.css" rel="stylesheet" type="text/css" />
    <title><?php echo $str['delete_admins'];?></title>
</head>
<body>
<table border="1" class="table_admin" width="100%">
    <tr><td colspan="2"><h1><?php echo $str['delete_admins']; ?></h1></td></tr>
    <tr><td width="20%"><a href="#"><?php echo $str['welcome'].$str['comma'].$_COOKIE['admin_username'];?></a></td><td rowspan="6" style="text-align: center;text-align-all: right;text-valign:middle;" width="80%">
            <?php
            if(!isset($_POST['delete_admin']) && isset($_GET['delete']))
            {
                include('template/site/DeleteAdminMenu.php');
            }
            else
            {
                echo $result;
                echo "<br/>";
                echo $str['delete_after_seconds'];
                echo "2";
                echo $str['delete_before_seconds'];
            }

            ?>

        </td></tr>
    <tr><td width="20%"><a href="index.php"><?php echo $str['return_main_page'];?></a></td></tr>
    <tr><td width="20%"><a href="admin_view.php"><?php echo $str['view_admins'];?></a></td></tr>
    <tr><td width="20%"><a href="admin_add.php"><?php echo $str['add_admins'];?></a></td></tr>
    <tr><td width="20%"><a href="admin_profile.php"><?php echo $str['edit_your_config'];?></a></td></tr>
    <tr><td width="20%"><a href="login.php?logout=true"><?php echo $str['logout'];?></a></td></tr>
    <tr><td colspan="2"><?php echo $str['copyright'];?> © <a href="../index.php" target="_blank"><?php echo $set->GetSettings(1);?></a> </td></tr>
</table>
</body>
</html>