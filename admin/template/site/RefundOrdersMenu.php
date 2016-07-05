<?php if($result[0] == 0)
{
    echo $result[1];
} elseif($result[0] == 1) {
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <table width="100%">
            <tr><td>#</td><td><?php echo $str['username'];?></td><td><?php echo $str['food_name'];?></td><td><?php echo $str['total_price'];?></td><td><?php echo $str['refund'];?>(<label for="checkAll"><?php echo $str['for_all']?></label><input type="checkbox" name="checkAll" id="checkAll" />)</td><td><?php echo $str['order_time'];?></td></tr>
            <?php
            foreach ($result[1] as $row) {
                if($row['status'] != 1 && $row['status'] != 3) {
                    ?>
                    <tr>
                        <td><label for="id<?php echo $row['id'];?>"><?php echo $row['id']; ?></label></td>
                        <td><a href="print.php?type=user&id=<?php echo $row['user_id'] ?>" target="_blank"><?php echo $row['user_name']; ?></a></td>
                        <td><a href="print.php?type=food&id=<?php echo $row['food_id'] ?>" target="_blank"><?php echo $row['food_name']; ?></a></td>
                        <td><label for="id<?php echo $row['id'];?>"><?php echo $row['total_price']; ?> <?php echo $str['curr'] ?></label></td>
                        <td><label for="id<?php echo $row['id'];?>"><?php echo $str['refund'];?></label><input type="checkbox" id="id<?php echo $row['id'];?>" name="check_list[]" value="<?php echo $row['id'];?>"/></td>
                        <td><?php echo $row['ordertime'];?></td>
                    </tr>
                    <?php
                }
            }
            ?>
            <tr><td colspan="6">
                    <input type="submit" name="CHANGE_STATUS_REFUND" value="<?php echo $str['orders_refund'];?>" /></td></tr>
        </table>
    </form>
<?php
}
?>