<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <label for="id1"><?php echo $str['username_id'];?></label>:
    <input type="text" id="INPUT_SEARCH" name="INPUT_SEARCH" value="<?php if(isset($_POST['INPUT_SEARCH'])) echo $_POST['INPUT_SEARCH'];?>" placeholder="<?php echo $str['username_id'];?>" class="input_general" />
    <input type="submit" name="SEARCH" value="<?php echo $str['search'];?>" />
</form>

<?php if($result[0] == null) {
    ?>
    <br/>
    <div style="text-align: center;"><?php echo $result[1];?></div>
<?php
} elseif($result[1] == true) {
    ?>
    <br />
    <table width="100%">
        <tr>
            <td width="12.5%"><?php echo $str['id']?>:</td>
            <td width="12.5%"><?php echo $result[0]['id'];?></td>
            <td width="12.5%"><?php echo $str['username']?>: </td>
            <td width="12.5%"><?php echo $result[0]['username'];?></td>
            <td width="12.5%"><?php echo $str['active']?>: </td>
            <td width="12.5%"><?php if($result[0]['active'] == 1) echo $str['yes']; else echo $str['no'];?></td>
            <td width="12.5%"><?php echo $str['gender']?>: </td>
            <td width="12.5%"><?php if($result[0]['sex'] == 1) echo $str['male']; else echo $str['female'];?></td>
        </tr>
        <tr>
            <td colspan="3" width="33%"><a href="print.php?type=credit_user&id=<?php echo $result[0]['id'];?>" target="_blank"><?php echo $str['credits_user_report'];?></a> </td>
            <td colspan="3" width="33%"><a href="print.php?type=food_user&id=<?php echo $result[0]['id'];?>" target="_blank"><?php echo $str['orders_user_report'];?></a> </td>
            <td colspan="2" width="33%"><a href="print.php?type=user&id=<?php echo $result[0]['id'];?>" target="_blank"><?php echo $str['orders_user'];?></a> </td>
        </tr>
    </table>
<?php
}
?>