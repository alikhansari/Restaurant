<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<table width="100%">
    <tr><td><?php echo $str['username'];?></td><td><input type="text" name="username" placeholder="<?php echo $str['username'];?>" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>" class="input_general"/> </td></tr>
    <tr><td><?php echo $str['password'];?></td><td><input type="password" name="password" placeholder="<?php echo $str['password'];?>" class="input_general"/> </td></tr>
    <tr><td><?php echo $str['email'];?></td><td><input type="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" placeholder="<?php echo $str['email'];?>" class="input_general"/> </td></tr>
    <tr><td colspan="2"><input type="submit" name="register_admin" value="<?php echo $str['save'];?>" class="input_general" /> </td></tr>
    <?php if($msg != null)
{
    ?>
    <tr><td colspan="2"><?php echo $msg;?></td></tr>
<?php
}
?>
</table>
</form>