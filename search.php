<?php
include('includes/functions.php');
$value = new Settings(); $x = $value->Menu();
$search_result = $value->SearchWebSite();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $str['search'];?></title>
    <?php require('template/site/header.php'); ?>

    <h1><?php echo $value->GetSettings(1);?></h1>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <p class="lead">
                <?php require("template/site/SearchMenu.php") ?>
            </p>

        </div>
        <?php require('template/site/search.php'); ?>
        <?php require('template/site/panel.php'); ?>
        <?php require('template/site/footer.php'); ?>

        </body>
</html>


