<?php
include('includes/functions.php');
$value = new Settings(); $value->Redirect(); $x = $value->Menu();
$user = new User();
$order = new Order();
$credit = new Credits();
$food = new Food();
$result_food = $food->FoodList();
$result = $order->Order();

?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php
    if($result[0] == 2 && $result[1] == 1)
    {
        echo '<script type="text/javascript"> window.onbeforeunload = function() { return "'.$str['refresh_page_cause_re_order'].'"; }; </script>';
    }
    ?>
    <title><?php echo $str['order'];?></title>
    <?php require('template/site/header.php'); ?>

    <h1><?php echo $str['order'];?></h1>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <?php require("template/site/AddOrderMenu.php") ?>

        </div>
        <?php require('template/site/search.php'); ?>
        <?php require('template/site/panel.php'); ?>
        <?php require('template/site/footer.php'); ?>

        </body>
</html>


