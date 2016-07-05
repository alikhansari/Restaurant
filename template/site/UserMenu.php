<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<input type="text" name="username" class="form-control" <?php if(empty($_POST['username'])) echo "autofocus";?> autocomplete="off" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" id="search-form" placeholder="نام کاربری" />
<br />
<input type="password" name="password" <?php if(!empty($_POST['username'])) echo "autofocus";?> class="form-control" id="search-form" placeholder="رمز عبور" />
<br />

<button type="submit" name="login" class="btn btn-default" value="<?php echo $str['login'] ?>"><?php echo $str['login'] ?></button>
    <button type="reset" class="btn btn-default" ><?php echo $str['reset'] ?></button>

</form>
<br/>
<div style="text-align: center;">
<a href="register.php" style="background:#d58512;" ><?php echo $str['register'];?></a>
<a href="remember.php" style="background:#d58512;" ><?php echo $str['remember'];?></a>
</div>