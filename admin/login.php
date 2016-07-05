<?php
require("../includes/functions.php");
$admin = new Admin();
$msg = $admin->LoginToAdminArea();
$set = new Settings();

?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="template/css/login_page.css" rel="stylesheet" type="text/css" />
<title><?php echo $str['login_page'];?></title>
    </head>
<body>
<div id="header">
    <h1><?php echo $str['login_page'];?></h1>
</div>

<center>

    <h1><?php echo $str['login'];?></h1>
        <!-- form -->
    <div id="login">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
           <table class="table_login">
            <tr><td><label for="id1"><?php echo $str['your_username'];?>: </label></td><td><input type="text" class="input_username" placeholder="<?php echo $str['your_username'];?>" name="username" <?php if (isset($_POST['username'])) if(empty($_POST['username'])) echo "autofocus";?> value="<?php if (isset($_POST['username'])) echo $_POST['username'];?>" id="id1"/></td></tr>
            <tr><td><label for="id2"><?php echo $str['password'];?>: </label></td><td><input type="password" class="input_username" placeholder="<?php echo $str['password'];?>" name="password" <?php if (isset($_POST['username'])) if(!empty($_POST['username'])) echo "autofocus";?> id="id2"/></td></tr>
            <tr><td colspan="2"><input type="submit" name="login" value="<?php echo $str['login'];?>" class="input_login" /></td></tr>
           </table>

    </form>
    </div>


    <!-- form end -->
    <?php if ($msg != null)
        echo '<p class="error">'.$msg.'</p>';
        ?>

</center>
<br/>
<div id="footer">
    <?php echo $str['copyright'];?> © <?php echo $set->GetSettings(1);?>
</div>

</body>
</html>