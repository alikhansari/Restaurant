<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <label for="id1"><?php echo $str['foods_less_than_x'];?></label>
    <input type="number" name="number" value="<?php if(isset($_POST['number'])) echo $_POST['number'];?>" placeholder="<?php echo $str['number'];?>" min="0" class="input_general" id="id1" />
    <input type="submit" name="SHOW" value="<?php echo $str['view'] ?>" />
</form>
<?php
if ($result != 0)
{
    ?>
    <table width="100%">
        <tr><td>#</td><td><?php echo $str['food_name'];?></td><td><?php echo $str['food_balance'];?></td><td><?php echo $str['active'] ?></td><td><?php echo $str['food_add_balance'] ?></td><td><?php echo $str['edit'];?></td></tr>
    <?php
    foreach ($result as $row) {
        ?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['balance'];?></td>
            <td><?php if($row['active'] == 1) echo $str['yes']; else echo $str['no'];?></td>
            <td><a href="foods_add_balance.php" target="_blank"><?php echo $str['food_add_balance'] ?></a></td>
            <td><a href="foods_edit.php?edit=<?php echo $row['edit'];?>" target="_blank"> <?php echo $str['edit'];?></a> </td>
        </tr>
        <?php } ?>
    </table>
<?php
}
?>