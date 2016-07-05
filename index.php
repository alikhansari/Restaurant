<?php
if(file_exists("includes/functions.php"))
{
    if(filesize("includes/functions.php") == 0)
    {
        header("location: admin/install.php");
    }
}
require('includes/functions.php');
$value = new Settings(); $x = $value->Menu();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $value->GetSettings(1)?></title>
    <?php require('template/site/header.php'); ?>

    <h1><?php echo $value->GetSettings(1);?></h1>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <p class="lead"></p>
            <hr>

        </div>
        <?php require('template/site/search.php'); ?>
        <?php require('template/site/panel.php'); ?>
        <?php require('template/site/footer.php'); ?>

        </body>
</html>

