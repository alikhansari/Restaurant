<?php
require("../includes/language.php");
if(file_exists("../includes/functions.php"))
{
    if(filesize("../includes/functions.php") != 0)
    {
        header("localtion: ../index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        @font-face {
            font-family: 'Yekan';
            src: url('../template/fonts/Yekan-modified.eot');
            src: url('../template/fonts/Yekan-modified.eot#iefix') format('embedded-opentype'),
            url('../template/fonts/Yekan-modified.woff') format('woff'),
            url('../template/fonts/Yekan-modified.ttf') format('truetype'),
            url('../template/fonts/Yekan-modified.svg#CartoGothicStdBook') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        *{font-family: 'Yekan'; }
        body{  direction: rtl; }
        input {height: 45px;width: 80%;text-align: center;}
        .container { text-align: center;}
        .error {
            color:red;
            font-weight: bold;
        }
    </style>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <title><?php echo $str['install_title']; ?></title>
</head>
<body>
<div class="container">
    <?php
    if(isset($_POST['install']))
    {

        if(!empty($_POST['hostname']) && !empty($_POST['database_user']) && !empty($_POST['database_name']))
        {

            $hostname = $_POST['hostname'];
            $database_user = $_POST['database_user'];
            $database_name = $_POST['database_name'];
            $database_password = $_POST['database_password'];
            $dsn = 'mysql:host=' . $hostname . ';dbname=' . $database_name. ';charset=utf8';
            $options = array(
                PDO::ATTR_PERSISTENT    => true,
                PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
            );
            try
            {
                $ex = new PDO($dsn, $database_user, $database_password, $options);
            }
            catch(PDOException $e)
            {
                echo '<div class="error">'.$e->__toString().'</div>';
                echo $str['back_button'];
            }
            function connection ($hostname,$database_name,$database_user,$database_password)
            {
                try {
                    $dsn = "mysql:host=" . $hostname . ";dbname=" . $database_name;
                    $connect = new  PDO($dsn, $database_user, $database_password);
                    $connect->exec("set names utf8");
                    return $connect;
                } catch (PDOException $err) {
                    $error = "Connection Error: ".$err->__toString();
                    return $error;
                }
            }
            echo '<div class="error">'.$str['connection_was_successful'].'</div>';
            /*
             * Add tables and running !
             */
            $sql = "CREATE TABLE IF NOT EXISTS `$database_name`.`tbl_settings` (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR(256) CHARACTER SET 'utf8mb4' NOT NULL,
                  PRIMARY KEY (`id`))
                ENGINE = InnoDB
                AUTO_INCREMENT = 1
                   DEFAULT CHARACTER SET = utf8mb4";
            $result = connection ($hostname,$database_name,$database_user,$database_password)-> prepare($sql);
            $result->execute();
            $sql = "INSERT INTO `$database_name`.`tbl_settings` (`id`, `name`) VALUES (NULL, 'رستوران'), (NULL, '100'), (NULL, '60'), (NULL, 'youremail@email.com'), (NULL, '10000')";
            $result = connection ($hostname,$database_name,$database_user,$database_password)-> prepare($sql);
            $result->execute();
            echo '<div class="error">'.$str['the_table_settings_were_made_successfully'].'</div>';
            /**************************************************************************/
            $sql = "CREATE TABLE IF NOT EXISTS `$database_name`.`tbl_admin` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `username` VARCHAR(256) CHARACTER SET 'utf8mb4' NOT NULL,
              `email` VARCHAR(256) CHARACTER SET 'utf8mb4' NOT NULL,
              `password` VARCHAR(256) CHARACTER SET 'utf8mb4' NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE INDEX `id` (`id` ASC))
            ENGINE = InnoDB
            AUTO_INCREMENT = 1
            DEFAULT CHARACTER SET = utf8mb4";
            $result = connection ($hostname,$database_name,$database_user,$database_password)-> prepare($sql);
            $result->execute();
            $sql = "INSERT INTO `$database_name`.`tbl_admin` (`id`, `username`, `email`, `password`) VALUES (NULL, 'admin', 'youremail@email.com', '21232f297a57a5a743894a0e4a801fc3')";
            $result = connection ($hostname,$database_name,$database_user,$database_password)-> prepare($sql);
            $result->execute();
            echo '<div class="error">'.$str['the_table_admin_were_made_successfully'].'</div>';
            /**************************************************************************/
            $sql = "CREATE TABLE IF NOT EXISTS `$database_name`.`tbl_user` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(200) CHARACTER SET 'utf8mb4' NOT NULL,
              `username` VARCHAR(256) CHARACTER SET 'utf8mb4' NOT NULL,
              `password` VARCHAR(256) CHARACTER SET 'utf8mb4' NOT NULL,
              `active` TINYINT(1) NOT NULL DEFAULT '0',
              `credit` INT(15) NOT NULL DEFAULT '0',
              `order_numbers` INT(11) NOT NULL DEFAULT '0',
              `email` VARCHAR(256) CHARACTER SET 'utf8mb4' NOT NULL,
              `sex` TINYINT(1) NOT NULL DEFAULT '0',
              `user_address` TEXT CHARACTER SET 'utf8mb4' NOT NULL,
              `ip` VARCHAR(16) CHARACTER SET 'utf8mb4' NOT NULL,
              `phone` VARCHAR(16) CHARACTER SET `utf8mb4` NOT NULL,
              `regtime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`),
              UNIQUE INDEX `id` (`id` ASC))
            ENGINE = InnoDB
            AUTO_INCREMENT = 1
            DEFAULT CHARACTER SET = utf8mb4";
            $result = connection ($hostname,$database_name,$database_user,$database_password)-> prepare($sql);
            $result->execute();

            echo '<div class="error">'.$str['the_table_user_were_made_successfully'].'</div>';
            /**************************************************************************/
            $sql = "CREATE TABLE IF NOT EXISTS `$database_name`.`tbl_category` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(256) CHARACTER SET 'utf8mb4' NOT NULL,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB
            AUTO_INCREMENT = 1
            DEFAULT CHARACTER SET = utf8mb4";
            $result = connection ($hostname,$database_name,$database_user,$database_password)-> prepare($sql);
            $result->execute();

            echo '<div class="error">'.$str['the_table_category_were_made_successfully'].'</div>';
            /**************************************************************************/
            $sql = "CREATE TABLE IF NOT EXISTS `$database_name`.`tbl_food` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(256) CHARACTER SET 'utf8mb4' NOT NULL,
              `price` INT(15) NOT NULL DEFAULT '0',
              `balance` INT(6) NOT NULL DEFAULT '0',
              `active` TINYINT(1) NOT NULL DEFAULT '0',
              `user_id` INT(11) NOT NULL,
              `cat_id` INT(11) NOT NULL,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB
            AUTO_INCREMENT = 1
            DEFAULT CHARACTER SET = utf8mb4";
            $result = connection ($hostname,$database_name,$database_user,$database_password)-> prepare($sql);
            $result->execute();

            echo '<div class="error">'.$str['the_table_food_were_made_successfully'].'</div>';
            /**************************************************************************/
            $sql = "CREATE TABLE IF NOT EXISTS `$database_name`.`tbl_credit_log` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `user_id` INT(11) NOT NULL,
              `type` VARCHAR(256) CHARACTER SET 'utf8mb4' NOT NULL,
              `credit_before` INT(15) NOT NULL,
              `credit_after` INT(15) NOT NULL,
              `credit_now` INT(15) NOT NULL,
              `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `ip` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
              `order_id` INT(11) NULL DEFAULT NULL,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB
            AUTO_INCREMENT = 1
            DEFAULT CHARACTER SET = utf8mb4";
            $result = connection ($hostname,$database_name,$database_user,$database_password)-> prepare($sql);
            $result->execute();

            echo '<div class="error">'.$str['the_table_credit_log_were_made_successfully'].'</div>';
            /**************************************************************************/
            $sql = "CREATE TABLE IF NOT EXISTS `$database_name`.`tbl_credit_system` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `credit_log_id` INT(11) NOT NULL,
              `total_price` INT(15) NOT NULL,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB
            AUTO_INCREMENT = 1
            DEFAULT CHARACTER SET = utf8mb4";
            $result = connection ($hostname,$database_name,$database_user,$database_password)-> prepare($sql);
            $result->execute();

            echo '<div class="error">'.$str['the_table_credit_system_were_made_successfully'].'</div>';
            /**************************************************************************/
            $sql = "CREATE TABLE IF NOT EXISTS `$database_name`.`tbl_order` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `user_id` INT(11) NOT NULL,
              `user_name` VARCHAR(400) CHARACTER SET 'utf8mb4' NOT NULL,
              `food_id` INT(11) NOT NULL,
              `food_name` VARCHAR(400) CHARACTER SET 'utf8mb4' NOT NULL,
              `number` INT(11) NOT NULL,
              `price` INT(15) NOT NULL,
              `total_price` INT(15) NOT NULL,
              `ordertime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `ip` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
              `credit_before` INT(15) NOT NULL,
              `credit_after` INT(15) NOT NULL,
              `status` INT(2) NOT NULL,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB
            AUTO_INCREMENT = 1
            DEFAULT CHARACTER SET = utf8mb4";
            $result = connection ($hostname,$database_name,$database_user,$database_password)-> prepare($sql);
            $result->execute();

            echo '<div class="error">'.$str['the_table_order_were_made_successfully'].'</div>';
            /**************************************************************************/
            echo '<br>'.$str['username'].': admin';
            echo '<br>'.$str['password'].': admin';
            echo '<div class="error">'.$str['please_change_username_and_password'].'</div>';
            echo '<a href="../index.php">'.$str['return_main_page'].'</a>';
            /*
             * Add function page
             */
            $file="<?php
            /*
             *                  :: Programmer :  Ali Khodabakhshian - 9130403 - Yazd University ::
             *
             */
                                    define('LOCALHOST',\"".$hostname."\"); // localhost
                                    define('DBNAME',\"".$database_name."\"); // project
                                    define('DBUSERNAME',\"".$database_user."\"); // root
                                    define('DBPASSWORD',\"".$database_password."\"); // Your Password
            /*
             * Classes In Use
             */
            date_default_timezone_set('Asia/Tehran');
            require('language.php');
            require('class.Admin.inc');
            require('class.Credits.inc');
            require('class.Database.inc');
            require('class.Food.inc');
            require('class.Orders.inc');
            require('class.Users.inc');
            require('class.Category.inc');
            require('class.Settings.inc');
            ?>";
            file_put_contents("../includes/functions.php",$file);
            unlink("install.php");
        }
        else
        {
            echo '<div class="error">'.$str['error_message_empty'].'</div>';
            echo $str['back_button'];
        }
    }
    else
    {
    ?>
    <h1><?php echo $str['install_title']; ?></h1>
    <form action="install.php" method="POST">
        <table width="90%">
            <tr>
                <td><label for="id1"><?php echo $str['hostname']; ?>:</label></td>
                <td><input type="text" id="id1" name="hostname" placeholder="<?php echo $str['hostname']; ?>" required/>
                </td>
            </tr>
            <tr>
                <td><label for="id12"><?php echo $str['database_user']; ?>:</label></td>
                <td><input type="text" id="id12" name="database_user" placeholder="<?php echo $str['database_user']; ?>" required/></td>
            </tr>
            <tr>
                <td><label for="id123"><?php echo $str['database_name']; ?>:</label></td>
                <td><input type="text" id="id123" name="database_name" placeholder="<?php echo $str['database_name']; ?>" required/></td>
            </tr>
            <tr>
                <td><label for="id1234"><?php echo $str['database_password']; ?>:</label></td>
                <td><input type="password" id="id1234" name="database_password" placeholder="<?php echo $str['database_password']; ?>" /></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="install" value="OK"></td>
            </tr>
        </table>
        <?php
        }
        ?>
    </form>
</div>
</body>
</html>

