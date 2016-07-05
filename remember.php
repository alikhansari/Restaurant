<?php
if(file_exists("includes/functions.php"))
{
    if(filesize("includes/functions.php") == 0)
    {
        header("location: admin/install.php");
    }
}

require('includes/functions.php');
$value = new Settings();
$x = $value->Menu();
if($value->UserIsLogged())
    header("Location: index.php");
$user = new User();
$msg = $user->RememberPassword();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $str['remember_password']; ?></title>
    <?php require('template/site/header.php'); ?>
    <h1><?php echo $str['remember_password'];?></h1>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <p class="lead">
                <?php
                if(isset($_GET['password']) && isset($_GET['name']) && isset($_GET['id']))
                {
                    echo $msg;
                }
                else
                {
                    ?>
            <form action="remember.php" method="POST">
                <table width="100%">
                    <tr>
                        <td><label for="id1"><?php echo $str['your_username']; ?>:</label></td>
                        <td><input type="text" id="id1" class="edit_user" name="username" placeholder="<?php echo $str['your_username'];?>" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>"  /></td>
                    </tr>
                    <tr>
                        <td><label for="id2"><?php echo $str['email'];?>:</label></td>
                        <td><input type="email" id="id2" class="edit_user" name="email" placeholder="<?php echo $str['email'];?>" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>"  /></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;"><button type="submit" class="btn btn-default" name="remember"><?php echo $str['remember'];?></button></td>
                    </tr>
                    <?php
                    if($msg!=null)
                        echo '<tr><td colspan="2" style="text-align: center;font-size:18px;color:red;">'.$msg.'</td></tr>';
                    ?>
                </table>
            </form>
            <?php
            }
            ?>

            </p>
            <hr>

        </div>
        <?php require('template/site/search.php'); ?>
        <?php require('template/site/panel.php'); ?>
        <?php require('template/site/footer.php'); ?>

        </body>
</html>


