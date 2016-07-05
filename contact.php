<?php
include('includes/functions.php');
$value = new Settings(); $x = $value->Menu();
$user = new User();
$result = $value->ContactUs();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $str['contact_us'];?></title>
    <?php require('template/site/header.php'); ?>

    <h1><?php echo $str['contact_us'];?></h1>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <p class="lead">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <table width="100%"class="table-responsive">
                    <tr>
                        <td><?php echo $str['name'];?>:</td>
                        <td><input type="text" name="name" class="input-lg" <?php if($value->UserIsLogged()) echo "readonly";?> placeholder="<?php echo $str['name'];?>" value="<?php if($value->UserIsLogged()) echo $user->name; elseif(isset($_POST['name'])) echo $_POST['name'];?>"/></td>
                    </tr>
                    <tr><td colspan="2"><hr/></td></tr>
                    <tr>
                        <td><?php echo $str['email'];?>:</td>
                        <td><input type="email" name="email" class="input-lg" <?php if($value->UserIsLogged()) echo "readonly";?> placeholder="<?php echo $str['email'];?>" value="<?php if($value->UserIsLogged()) echo $user->email; elseif(isset($_POST['email'])) echo $_POST['email'];?>"/></td>
                    </tr>
                    <tr><td colspan="2"><hr/></td></tr>
                    <tr>
                        <td><?php echo $str['subject'];?>:</td>
                        <td><input type="text" name="subject" class="input-lg" placeholder="<?php echo $str['subject'];?>" value="<?php if(isset($_POST['subject'])) echo $_POST['subject'];?>"/></td>
                    </tr>
                    <tr><td colspan="2"><hr/></td></tr>
                    <tr>
                        <td><?php echo $str['your_message'];?>:</td>
                        <td><textarea name="message" placeholder="<?php echo $str['your_message'];?>" cols="20" rows="6" class="input-lg"><?php if(isset($_POST['message'])) echo $_POST['message'];?></textarea></td>
                    </tr>
                    <tr><td colspan="2" style="text-align:center;"><input type="submit" name="send" class="input-lg btn btn-default" value="<?php echo $str['send_message'];?>" /> </td></tr>
                    <?php
                    if($result != null)
                    {
                        ?>
                        <tr>
                            <td colspan="2" style="text-align:center;"><span id="error_stmt"><?php echo $result;?></span> </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </form>
            </p>

        </div>
        <?php require('template/site/search.php'); ?>
        <?php require('template/site/panel.php'); ?>
        <?php require('template/site/footer.php'); ?>

        </body>
</html>


