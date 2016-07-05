<?php
require("../includes/functions.php");
$admin = new Admin();
$admin->ValidateToAdminLogin();
$set = new Settings();
$order = new Order();
$report_result = $order->ReportOrderAdmin();
$date_result = $order->ReportOrderAdmin_2();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="template/css/admin.css" rel="stylesheet" type="text/css" />
    <title><?php echo $str['order_report'];?></title>

</head>
<body>
<table border="1" class="table_admin" width="100%">
    <tr><td colspan="2"><h1><?php echo $str['order_report']; ?></h1></td></tr>
    <tr><td width="20%"><a href="#"><?php echo $str['welcome'].$str['comma'].$_COOKIE['admin_username'];?></a></td><td rowspan="11" style="text-align: center;text-align-all: center;text-valign:middle;" width="80%">
        <?php require("template/site/ReportOrdesMenu.php"); ?>
        </td></tr>
    <tr><td width="20%"><a href="index.php"><?php echo $str['return_main_page'];?></a></td></tr>
    <tr><td width="20%"><a href="orders_view.php"><?php echo $str['view_order'];?></a></td></tr>
    <tr><td width="20%"><a href="orders_add.php"><?php echo $str['add_order'];?></a></td></tr>
    <tr><td width="20%"><a href="orders_completed.php"><?php echo $str['completed_order'];?></a></td></tr>
    <tr><td width="20%"><a href="orders_new.php"><?php echo $str['new_order'];?></a>(<?php echo $order->ReportStatusOrder(0,100);?>)</td></tr>
    <tr><td width="20%"><a href="orders_refunds.php"><?php echo $str['orders_refund'];?></a></td></tr>
    <tr><td width="20%"><a href="orders_search.php"><?php echo $str['order_search'];?></a></td></tr>
    <tr><td width="20%"><a href="orders.php"><?php echo $str['order_manage'];?></a></td></tr>
    <tr><td width="20%"><a href="login.php?logout=true"><?php echo $str['logout'];?></a></td></tr>
    <tr><td colspan="2"><?php echo $str['copyright'];?> © <a href="../index.php" target="_blank"><?php echo $set->GetSettings(1);?></a> </td></tr>
</table>
<script src="template/js/datetimepicker.js"></script>
</body>
</html>