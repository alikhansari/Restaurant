<?php
include('includes/functions.php');
$value = new Settings(); $x = $value->Menu();
$food = new Food(); $result =  $food->FoodOfCategory(); if($result == false) header("Location: index.php");
$cat = new Category(); $cat_name = $cat->GetCatName($_GET['id']);
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $str['category_page_title'];?></title>
    <?php require('template/site/header.php'); ?>

    <h1><?php echo $str['category_page_title'];?>"( <?php echo $cat_name; ?> )"</h1>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <p class="lead">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $_GET['id'];?>" method="POST">
                <label for="id1"><?php echo $str['number_for_show'];?>: </label>
                <input id="id1" type="number" name="change" min="1" max="50" />
                <input type="submit" name="number" value="<?php echo $str['save'];?>" />
            </form>
            </p>
            <p>
                <table border="1" width="100%">
                <tr style="text-align:center;font-size:18px;font-weight: bold;color:#c9302c;">
                    <td width="5%%">#</td>
                    <td width="55%"><?php echo $str['food_name'];?></td>
                    <td width="20%"><?php echo $str['food_price'];?></td>
                    <td width="20%"><?php echo $str['food_balance'];?></td>
                </tr>
                <?php foreach ($result as $row) {
                    if($row['active']==1) {
                        ?>
                        <tr style="text-align:center;">
                            <td width="5%%"><?php echo $row['id'];?></td>
                            <td width="55%%"><?php echo $row['name']; ?></td>
                            <td width="20%%"><?php echo $row['price']; ?></td>
                            <td width="20%%"><?php echo $row['balance']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>

            </table>

            </p>
            <hr>

        </div>
        <?php require('template/site/search.php'); ?>
        <?php require('template/site/panel.php'); ?>
        <?php require('template/site/footer.php'); ?>

        </body>
</html>


