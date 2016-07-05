<?php
switch($result[0])
{
    case 0:
        echo $str['not_found'];
        break;
    case 1:
?>
        <table width="100%" class="table_order" border="1">
            <tr>
                <td colspan="2" width="50%"><?php echo $str['order_id'] ?>: </td>
                <td colspan="2" width="50%"><?php echo $result[1]['id'] ?></td>
            </tr>
            <tr>
                <td colspan="2" width="50%"><?php echo $str['food_name'] ?>: </td>
                <td colspan="2" width="50"><?php echo $result[1]['food_name'] ?> </td>
            </tr>
            <tr>
                <td width="25%"><?php echo $str['number'] ?>: </td>
                <td width="25%"><?php echo $result[1]['number'] ?></td>
                <td width="25%"><?php echo $str['price']?>: </td>
                <td width="25%"><?php echo $result[1]['price'] ?> <?php echo $str['curr'] ?> </td>
            </tr>
            <tr>
                <td colspan="2" width="50%"><?php echo $str['total_price'] ?>: </td>
                <td colspan="2" width="50%"><?php echo $result[1]['total_price'] ?> <?php echo $str['curr'] ?> </td>
            </tr>
            <tr>
                <td colspan="2" width="50%"><?php echo $str['order_time'];?> : </td>
                <td colspan="2" width="50%"><?php echo $result[1]['ordertime'] ?> </td>
            </tr>
            <tr>
                <td colspan="2" width="25%"><?php echo $str['order_status'];?> : </td>
                <td colspan="2" width="50%"><?php echo $order->status($result[1]['status']);?> </td>
            </tr>
            <tr>
                <td colspan="2" width="50%"><?php echo $str['username'] ?> : </td>
                <td colspan="2" width="50%"><?php echo $result[1]['user_name'] ?>
                </td>
            </tr>
        </table>
<?php
        break;
    case 2:
?>
    <table width="100%" border="1" class="table">
        <tr><td>#</td><td><?php echo $str['food_name'];?></td><td><?php echo $str['total_price'];?></td><td><?php echo $str['order_status'];?></td><td><?php echo $str['more'];?></td></tr>
        <?php
        foreach ($result[1] as $row) {
            ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['food_name'];?></td>
                <td><?php echo $row['total_price'];?> <?php echo $str['curr'];?></td>
                <td>
                    <?php echo $order->status($row['status']);?>
                    <?php if($row['status'] == 2)
                    {
                        if($value->CanUserCancel($row['ordertime']))
                        {
                            ?>
                            (<a href="cancel.php?order=<?php echo $row['id'];?>" target="_blank"><?php echo $str['cancel'] ?></a>)
                    <?php
                        }
                    }
                    ?>
                </td>
                <td><a href="view.php?type=order&id=<?php echo $row['id'];?>" target="_blank"><?php echo $str['more'];?></a> </td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
        break;
    case 3:
?>
        <table width="100%" class="table_order" border="1">
            <tr>
                <td colspan="2" width="50%"><?php echo $str['credit_id'] ?>: </td>
                <td colspan="2" width="50%"><?php echo $result[1]['id'] ?></td>
            </tr>
            <tr>
                <td colspan="2" width="50%"><?php echo $str['credit_type'] ?>: </td>
                <td colspan="2" width="50"><?php echo $result[1]['type'] ?> </td>
            </tr>
            <tr>
                <td width="25%"><?php echo $str['credit'] ?>: </td>
                <td width="25%"><?php echo $result[1]['credit_before'] ?></td>
                <td width="25%"><?php echo $str['credit_now']?>: </td>
                <td width="25%"><?php echo $result[1]['credit_now'] ?> <?php echo $str['curr'] ?> </td>
            </tr>
            <tr>
                <td colspan="2" width="50%"><?php echo $str['credit_after'] ?>: </td>
                <td colspan="2" width="50%"><?php echo $result[1]['credit_after'] ?> <?php echo $str['curr'] ?> </td>
            </tr>
            <tr>
                <td colspan="2" width="50%"><?php echo $str['time'];?> : </td>
                <td colspan="2" width="50%"><?php echo $result[1]['time'] ?> </td>
            </tr>
            <tr>
                <td colspan="2" width="50%"><?php echo $str['order_id'];?> : </td>
                <td colspan="2" width="50%"><?php if ($result[1]['order_id'] == 0) echo "-"; else { ?> <a href="view.php?type=order&id=<?php echo $result[1]['order_id'];?>" target="_blank"><?php echo $str['more']; ?></a> <?php } ?> </td>
            </tr>
        </table>
<?php
        break;
    case 4:
        ?>
        <table width="100%" border="1" class="table">
            <tr><td>#</td><td><?php echo $str['credit_type'];?></td><td><?php echo $str['credit_now'];?></td><td><?php echo $str['credit_after'];?></td><td><?php echo $str['time'];?></td><td><?php echo $str['more'];?></td></tr>
            <?php
            foreach ($result[1] as $row) {
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['type'];?></td>
                    <td><?php echo $row['credit_now'];?> <?php echo $str['curr'];?></td>
                    <td><?php echo $row['credit_after'];?> <?php echo $str['curr'];?></td>
                    <td><?php echo $row['time'];?></td>
                    <td><a href="view.php?type=credit&id=<?php echo $row['id'];?>" target="_blank"><?php echo $str['more'];?></a> </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
        break;
        ?>
<?php
}
?>


