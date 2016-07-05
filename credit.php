<?php
include('includes/functions.php');
$value = new Settings(); $value->Redirect(); $x = $value->Menu(); $user = new User();
$credit = new Credits();
$msg = $credit->AddCredit();
$result = $credit->CreditReport();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $str['credit_page'];?></title>
    <?php require('template/site/header.php'); ?>

    <h1><?php echo $str['credit_page'];?></h1>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <p class="lead">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <label for="id1"><?php echo $str['number_for_show'];?>: </label>
                <input id="id1" type="number" name="number" min="1" max="50" />
                <input type="submit" name="change" value="<?php echo $str['save'];?>" />
            </form>
            </p>
            <p>
            <table border="1" wdith="100%">
                <tr style="font-weight: bold;font-size:15px;color:#c9302c;">
                    <td style="text-align:center;" width="5%">#</td>
                    <td style="text-align:center;" width="20%"><?php echo $str['credit_type']; ?></td>
                    <td style="text-align:center;" width="15%"><?php echo $str['credit_now']; ?></td>
                    <td style="text-align:center;" width="15%"><?php echo $str['credit_after']; ?></td>
                    <td style="text-align:center;" width="40%"><?php echo $str['time']; ?></td>
                    <td style="text-align:center;" width="5"><?php echo $str['order_id']; ?></td>
                </tr>
                <?php foreach ($result as $row )
                { ?>
                    <tr style="height:30px;">
                        <td style="text-align:center;" width="5%"><?php echo $row['id']; ?></td>
                        <td style="text-align:center;" width="20%"><a href="view.php?type=credit&id=<?php echo $row['id'];?>" target="_blank"><?php echo $row['type']; ?></a> </td>
                        <td style="text-align:center;" width="15%"><?php echo $row['credit_now']; ?></td>
                        <td style="text-align:center;" width="15%"><?php echo $row['credit_after']; ?></td>
                        <td style="text-align:center;direction: ltr;" width="40%"><?php echo $row['time']; ?></td>
                        <td style="text-align:center;" width="5%"><?php if ($row['order_id'] == 0) echo "-";
                            else
                            {
                                ?>
                                <a href="view.php?type=order&id=<?php echo $row['order_id'];?>" target="_blank"><?php echo $str['more']; ?></a>
                            <?php
                            }?></td>
                    </tr>
                <?php
                } ?>
                </table>
            </p>
    <hr/>
            <p style="text-align: center;">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>?add=payment" method="POST">
                <label for="id2"><?php echo $str['increase_credit'];?></label>: <input type="number" id="id2" name="payment_value" value="<?php if(isset($_POST['payment_value'])) echo $_POST['payment_value'];?>" min="0" max="1000000" />
                <input type="submit" name="buy" value="<?php echo $str['increase_credit'];?>" />
            </form>

            </p>
            <p><?php echo $msg;?></p>

        </div>
        <?php require('template/site/search.php'); ?>
        <?php require('template/site/panel.php'); ?>
        <?php require('template/site/footer.php'); ?>

        </body>
</html>


