<?php
include('includes/functions.php');
$value = new Settings(); $value->Redirect(); $x = $value->Menu();
$user = new User();
$row = $user->FetchUserInfo($_COOKIE['id']);
$msg = $user->EditUser();

?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $str['user_title_page'];?></title>
    <?php require('template/site/header.php'); ?>

    <h1><?php echo $str['user_title_page'];?></h1>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <li><?php echo $str['notice'];?> ! <?php echo $str['expr_edit_user_page'];?></li>
            <p class="lead">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <table width="100%">
                   <tr> <td><label for="id1"><?php echo $str['name']; ?> </label></td><td><input id="id1" class="edit_user" required type="text" name="name" placeholder="<?php echo $str['name'];?>" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $row['name'];?>" /></td> </tr>
                    <tr><td><label for="id2"><?php echo $str['gender'];?></label></td><td><select id="id2" class="edit_user" required name="gender"><option <?php
                                if(isset($_POST['gender']))
                                {
                                    if($_POST['gender'] == "1")
                                    {
                                        echo "selected";
                                    }
                                }
                                elseif ($row['sex'] == 1)
                                {
                                    echo "selected";
                                } ?> value="1">
                                    <?php echo $str['male'];?>
                                </option>
                                <option <?php if(isset($_POST['gender']))
                                {
                                    if($_POST['gender'] == "2")
                                    {
                                        echo "selected";
                                    }
                                }
                                elseif ($row['sex'] == 0)
                                {
                                    echo "selected";
                                } ?> value="2"><?php echo $str['female'];?></option></select></td></tr>
                    <tr><td><label for="id6"><?php echo $str['address'];?> </label></td><td><textarea name="address" required id="id6" rows="6" class="edit_user" placeholder="<?php echo $str['address'];?>" id="id6"><?php if(isset($_POST['address'])) echo $_POST['address']; else echo $row['user_address'];?></textarea></td></tr>
                    <tr><td><label for="id7"><?php echo $str['phone_number'];?></label></td> <td><input type="text" maxlength="10" required class="edit_user" name="phone" placeholder="<?php echo $str['phone_number']?>(9131234567)" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; else echo $row['phone']?>" id="id7" /></td></tr>
                    <tr><td><label for="id5"><?php echo $str['email'];?></label></td> <td><input type="email" required class="edit_user" name="email" placeholder="<?php echo $str['email']?>" value="<?php if(isset($_POST['email'])) echo $_POST['email']; else echo $row['email']?>" id="id5" /></td></tr>
                    <tr><td><label for="id3"><?php echo $str['password'];?></label></td> <td><input type="password" class="edit_user" name="password" placeholder="<?php echo $str['password']?>" id="id3" /></td></tr>
                    <tr><td><label for="id4"><?php echo $str['new_password'];?></label></td> <td><input type="password" class="edit_user" name="new_password" placeholder="<?php echo $str['new_password']?>" id="id4" /></td></tr>
                    <tr><td style="text-align: center;" colspan="2"><button type="submit" name="edit" ><?php echo $str['save']; ?></button><button type="reset" ><?php echo $str['reset'];?></button></td></tr>
                    <?php
                    if($msg != null)
                    echo  '  <tr><td style="text-align: center;" colspan="2">'.$msg.'</td></tr>';
                    ?>
                </table>
                </form>
                </p>
            <hr>

        </div>
        <?php require('template/site/search.php'); ?>
        <?php require('template/site/panel.php'); ?>
        <?php require('template/site/footer.php'); ?>

        </body>
</html>


