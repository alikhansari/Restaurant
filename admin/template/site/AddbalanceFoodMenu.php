<?php if($result[2] && $result[2] != 3 || $result[0]==0) { ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <label for="id1"><?php echo $str['foodid_foodname'];?></label>
        <input type="text" name="SEARCH_VALUE" value="<?php if (isset($_POST['name'])) echo $_POST['name'];?>" class="input_search" placeholder="<?php echo $str['foodid_foodname'];?>" />
        <input type="submit" name="SEARCH" value="<?php echo $str['search'];?>"/>
    </form>
<?php } ?>
<?php if($result[0]== 1 && $result[2])
{
    echo $result[1];
    echo '<a href="foods_add_balance.php">'.$str['return_main_page'].'</a>';

} elseif($result[0] == 1 && !$result[2] || $result[0] == 3)
{
?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <input type="hidden" value="<?php echo $result[1]['id'];?>" name="id"/>
        <label for="id1"><?php  echo $str['food_name'] ?>: <input type="text" name="name" value="<?php echo $result[1]['name'];?>" readonly/> <?php echo $str['food_balance'];?></label>
        <input type="number" name="balance" autofocus required min="1" value="<?php if (isset($_POST['name'])) echo $_POST['name']; else echo $result[1]['balance'];?>" class="input_search" placeholder="<?php echo $str['food_balance'];?>" />
        <input type="submit" name="ADD_BALANCE" value="<?php echo $str['save'];?>"/>
    </form>
<?php
}
elseif ($result[0] == 2 && !$result[2])
{
    echo $str['balance_has_been_changed'];
}
?>