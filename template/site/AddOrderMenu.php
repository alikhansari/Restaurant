<?php
if($result[0] == 2)
{
    $u_r = $user->FetchUserInfo($user->id);
?>
    <table width="100%" class="table_order" border="1">
        <tr>
            <td colspan="2" width="50%"><?php echo $str['order_id'] ?>: </td>
            <td colspan="2" width="50%"><?php echo $result[2]['id'] ?></td>
        </tr>
        <tr>
            <td colspan="2" width="50%"><?php echo $str['food_name'] ?>: </td>
            <td colspan="2" width="50"><?php echo $result[2]['food_name'] ?> </td>
        </tr>
        <tr>
            <td width="25%"><?php echo $str['number'] ?>: </td>
            <td width="25%"><?php echo $result[2]['number'] ?></td>
            <td width="25%"><?php echo $str['price']?>: </td>
            <td width="25%"><?php echo $result[2]['price'] ?> <?php echo $str['curr'] ?> </td>
        </tr>
        <tr>
            <td colspan="2" width="50%"><?php echo $str['total_price'] ?>: </td>
            <td colspan="2" width="50%"><?php echo $result[2]['total_price'] ?> <?php echo $str['curr'] ?> </td>
        </tr>
        <tr>
            <td colspan="2" width="50%"><?php echo $str['order_time'];?> : </td>
            <td colspan="2" width="50%"><?php echo $result[2]['ordertime'] ?> </td>
        </tr>
        <tr>
            <td colspan="2" width="25%"><?php echo $str['address'];?> : </td>
            <td colspan="2" width="50%"><?php echo $u_r['user_address'] ?> </td>
        </tr>
        <tr>
            <td colspan="2" width="50%"><?php echo $str['username'] ?> : </td>
            <td colspan="2" width="50%"><?php echo $result[2]['user_name'] ?></td>
        </tr>
        <tr>
            <td colspan="4"><?php echo $str['payment_was_successful'] ?> - <?php echo $str['cancelation_order']?></td>
        </tr>
    </table>
    <?php
}elseif($result_food != false || $result[0] == 1)
{
?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<table width="100%" class="table_order">
    <tr>
        <td colspan="2">
            <div style="font-size:18px;color:blue;"><?php echo $str['notice'];?> ! <?php echo $str['expr_order_page_1'];?> <?php echo $value->GetSettings(3);?> <?php echo $str['expr_order_page_2']; ?></div>
        </td>
    </tr>
    <tr><td colspan="2"><hr/></td></tr>
    <tr>
        <td><?php echo $str['please_select_your_food']; ?>:</td>
        <td>
            <select name="food" class="input_order">
                <?php foreach ($result_food as $row) {
                    ?>
                    <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?> --> <?php echo $row['price'] ?> <?php echo $str['curr']; ?> , #<?php echo $row['balance'];?> </option>
                <?php
                }
                ?>
            </select>
        </td>
    </tr>
    <tr><td colspan="2"><hr/></td></tr>
    <tr>
        <td><?php echo $str['number'];?>:</td>
        <td>
            <select name="number" class="input_order"><?php for($i=1;$i<=$value->GetSettings(2);$i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?></select>
        </td>
    </tr>
    <tr><td colspan="2"><hr/></td></tr>
    <tr>
        <td colspan="2"><label for="check"><?php echo $str['i_read_the_notice_above']; ?></label><input type="checkbox" name="terms" value="check" id="check">
            <input type="submit" name="order" value="<?php echo $str['order'];?>" /></td>
    </tr>
    <?php if($result[1] != null && $result[1] != 2)  { ?>
        <tr><td colspan="2"><hr/></td></tr>
        <tr>
        <td>
            <span class="error"><?php echo $result[1];?></span>
        </td>
    </tr>
    <?php } ?>
</table>
    </form>
<?php
}
else {
    echo $str['food_is_not_available'];
}
    ?>

