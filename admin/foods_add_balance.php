<?php
require("../includes/functions.php");
$admin = new Admin();
$admin->ValidateToAdminLogin();
$set = new Settings();
$food = new Food();
$result = $food->AddBalaceFoodAdmin();

?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="template/css/admin.css" rel="stylesheet" type="text/css" />
    <title><?php echo $str['food_add_balance'];?></title>
</head>
<body>
<table border="1" class="table_admin" width="100%">
    <tr><td colspan="2"><h1><?php echo $str['food_add_balance']; ?></h1></td></tr>
    <tr><td width="20%"><a href="#"><?php echo $str['welcome'].$str['comma'].$_COOKIE['admin_username'];?></a></td><td rowspan="9" style="text-align: center;text-align-all: center;text-valign:middle;" width="80%">
    <?php require("template/site/AddbalanceFoodMenu.php") ?>
        </td></tr>
    <tr><td width="20%"><a href="index.php"><?php echo $str['return_main_page'];?></a></td></tr>
    <tr><td width="20%"><a href="foods_view.php"><?php echo $str['view_food'];?></a></td></tr>
    <tr><td width="20%"><a href="foods_add.php"><?php echo $str['add_food'];?></a></td></tr>
    <tr><td width="20%"><a href="foods.php"><?php echo $str['food_manage'];?></a></td></tr>
    <tr><td width="20%"><a href="foods_finished.php"><?php echo $str['food_finished'];?></a></td></tr>
    <tr><td width="20%"><a href="foods_notactive.php"><?php echo $str['food_nonactivate'];?></a></td></tr>
    <tr><td width="20%"><a href="foods_search.php"><?php echo $str['food_search'];?></a></td></tr>
    <tr><td width="20%"><a href="login.php?logout=true"><?php echo $str['logout'];?></a></td></tr>
    <tr><td colspan="2"><?php echo $str['copyright'];?> © <a href="../index.php" target="_blank"><?php echo $set->GetSettings(1);?></a> </td></tr>
</table>
</body>
</html>