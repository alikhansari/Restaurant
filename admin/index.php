<?php
require("../includes/functions.php");
$admin = new Admin();
$admin->ValidateToAdminLogin();
$set = new Settings();
$order = new Order();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="template/css/admin.css" rel="stylesheet" type="text/css" />
    <title><?php echo $str['admin_page'];?></title>
</head>
<body>
<table border="1" class="table_admin" width="100%">
    <tr><td colspan="2"><h1><?php echo $str['admin_page']; ?></h1></td></tr>
    <tr><td width="20%"><a href="#"><?php echo $str['welcome'].$str['comma'].$_COOKIE['admin_username'];?></a></td><td rowspan="9" style="text-align: right;text-valign:middle;" width="80%">
            <?php require("template/site/HelpIndex.php") ?>
        </td></tr>
    <tr><td width="20%"><a href="admin.php"><?php echo $str['admin_manage'];?></a></td></tr>
    <tr><td width="20%"><a href="users.php"><?php echo $str['customer_manage'];?></a></td></tr>
    <tr><td width="20%"><a href="foods.php"><?php echo $str['food_manage'];?></a></td></tr>
    <tr><td width="20%"><a href="category.php"><?php echo $str['category_manage'];?></a></td></tr>
    <tr><td width="20%"><a href="orders.php"><?php echo $str['order_manage'];?></a>(<?php echo $order->ReportStatusOrder(0,100);?>)</td></tr>
    <tr><td width="20%"><a href="credits.php"><?php echo $str['credit_manage'];?></a></td></tr>
    <tr><td width="20%"><a href="settings.php"><?php echo $str['settings'];?></a></td></tr>
    <tr><td width="20%"><a href="login.php?logout=true"><?php echo $str['logout'];?></a></td></tr>
    <tr><td colspan="2"><?php echo $str['copyright'];?> © <a href="../index.php" target="_blank"><?php echo $set->GetSettings(1)?></a> </td></tr>
</table>
</body>
</html>