<?php
require("../includes/functions.php");
$admin = new Admin();
$admin->ValidateToAdminLogin();
$set = new Settings();
$credit = new Credits();
$result = $credit->SearchCredit();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="template/css/admin.css" rel="stylesheet" type="text/css" />
    <script src="template/js/datetimepicker.js"></script>
    <title><?php echo $str['search_credit'];?></title>
</head>
<body>
<table border="1" class="table_admin" width="100%">
    <tr><td colspan="2"><h1><?php echo $str['search_credit']; ?></h1></td></tr>
    <tr><td width="20%"><a href="#"><?php echo $str['welcome'].$str['comma'].$_COOKIE['admin_username'];?></a></td><td rowspan="7" style="text-align: center;text-align-all: center;text-valign:middle;" width="80%">
            <?php require("template/site/SearchCreditMenu.php"); ?>
        </td></tr>
    <tr><td width="20%"><a href="index.php"><?php echo $str['return_main_page'];?></a></td></tr>
    <tr><td width="20%"><a href="credits.php"><?php echo $str['credit_manage'];?></a></td></tr>
    <tr><td width="20%"><a href="credits_add.php"><?php echo $str['add_credit'];?></a></td></tr>
    <tr><td width="20%"><a href="print.php?type=credit_system&id=1" target="_blank"><?php echo $str['system_credit'];?></a></td></tr>
    <tr><td width="20%"><a href="login.php?logout=true"><?php echo $str['logout'];?></a></td></tr>
    <tr><td colspan="2"><?php echo $str['copyright'];?> © <a href="../index.php" target="_blank"><?php echo $set->GetSettings(1);?></a> </td></tr>
</table>
</body>
</html>