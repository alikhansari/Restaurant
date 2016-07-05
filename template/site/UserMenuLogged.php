<?php $user = new User(); $row = $user->FetchUserInfo($_COOKIE['id']);?>
<div class="active list-group-item">
    <li><?php echo $row['name'];?><?php echo $str['comma'];?> <?php echo $str['welcome'];?> </li>
    <li><?php echo $str['your_username'];?> , <a href="user.php"><?php echo $row['username'];?></a> </li>
    <li><?php echo $str['your_credit'];?> , <a href="credit.php"><?php echo $row['credit']; ?></a> <?php echo $str['curr'];?> </li>
    <li><?php echo $str['your_account_status'];?> : <?php if($row['active'] == 1) echo $str['active']; else echo $str['nonactive'];?> </li>
    <li><a href="<?php echo $_SERVER['PHP_SELF'];?>?logout=true"><?php echo $str['logout'];?></a>  </li>
</div>
