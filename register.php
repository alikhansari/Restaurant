<?php
include('includes/functions.php');
$value = new Settings();
if($value->UserIsLogged())
    header("Location: index.php");
$x = $value->Menu();
$user = new User();
$msg = $user->RegisterUser();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $str['register'];?></title>
    <?php require('template/site/header.php'); ?>

    <h1><?php echo $str['register'];?></h1>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <p class="lead">
            <?php if(isset($_GET['result']))
            {
                if($_GET['result'] == "successfully")
                {
                    ?>
<div style="text-align: center;font-size:15px;color:#66512c;"><?php echo $str['register_successfully'];?></div>

                    <?php
                }
            }
            else
            {
            ?>
            <li><?php echo $str['notice'];?> ! <?php echo $str['expr_edit_register_page'];?></li>
            <form action="register.php" method="POST">
                <table width="100%">
                    <tr>
                        <td><label for="id1"><?php echo $str['your_username']; ?>:</label></td>
                        <td><input type="text" id="id1" class="edit_user" name="username2" placeholder="<?php echo $str['your_username'];?>" value="<?php if(isset($_POST['username2'])) echo $_POST['username2'] ?>"  /></td>
                    </tr>
                    <tr>
                        <td><label for="id2"><?php echo $str['email'];?>:</label></td>
                        <td><input type="email" id="id2" class="edit_user" name="email" placeholder="<?php echo $str['email'];?>" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>"  /></td>
                    </tr>
                    <tr>
                        <td><label for="id3"><?php echo $str['name'];?>:</label></td>
                        <td><input type="text" id="id3" class="edit_user" name="name" placeholder="<?php echo $str['name'];?>" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>"  /></td>
                    </tr>
                    <tr>
                        <td><label for="id7"><?php echo $str['phone_number'];?>:</label></td>
                        <td><input type="text" id="id7" maxlength="10" class="edit_user" name="phone" placeholder="<?php echo $str['phone_number'];?>(9131234567)" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'] ?>"  /></td>
                    </tr>
                    <tr>
                        <td><label for="id4"><?php echo $str['password'];?>:</label></td>
                        <td><input type="password" id="id4" class="edit_user" name="password2" placeholder="<?php echo $str['password'];?>" value="<?php if(isset($_POST['password2'])) echo $_POST['password2'] ?>"  /></td>
                    </tr>
                    <tr>
                        <td><label for="id5"><?php echo $str['re_password'];?>:</label></td>
                        <td><input type="password" id="id5" class="edit_user" name="re_password" placeholder="<?php echo $str['re_password'];?>" value="<?php if(isset($_POST['re_password'])) echo $_POST['re_password'] ?>"  /></td>
                    </tr>
                    <tr>
                        <td><label for="id6"><?php echo $str['gender'];?>:</label></td>
                        <td>
                            <select id="id6" class="edit_user" name="gender">
                                <option value="1" <?php if(isset($_POST['gender'])) if($_POST['gender'] == 1) echo "selected";?>><?php echo $str['male'];?></option>
                                <option value="2" <?php if(isset($_POST['gender'])) if($_POST['gender'] == 2) echo "selected";?>><?php echo $str['female'];?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="id7"><?php echo $str['address'];?></label></td>
                        <td>
                            <textarea id="id7" rows="5" class="edit_user" name="address" placeholder="<?php echo $str['address'];?>"><?php if(isset($_POST['address'])) echo $_POST['address'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;"><button type="submit" class="btn btn-default" name="register"><?php echo $str['register'];?></button></td>
                    </tr>
                    <?php
                        if($msg!=null)
                            echo '<tr><td colspan="2" style="text-align: center;font-size:18px;color:red;">'.$msg.'</td></tr>';
                    ?>
            </table>
            </form>
            <?php } ?>
            </p>
            <hr>

        </div>
        <?php require('template/site/search.php'); ?>
        <?php require('template/site/panel.php'); ?>
        <?php require('template/site/footer.php'); ?>

        </body>
</html>


