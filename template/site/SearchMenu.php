<br />
<?php
if($search_result[0] == 1)
{
    echo $str['please_search_your_food_from_sidebar'];
}
elseif($search_result[0] == 2)
{
    echo $str['not_found'];
}
elseif($search_result[0] == 3)
{
    echo $str['not_found'];
}
elseif($search_result[0] == 4)
{
    ?>
<?php echo $str['result_is']; $i=1; ?>:
    <table width="100%">
    <tr>
        <td>#</td><td><?php echo $str['food_name'] ?></td><td><?php echo $str['price'] ?></td><td><?php echo $str['food_balance'] ?></td>
    </tr>
    <?php foreach ($search_result[1] as $row) {
    ?>
        <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['price'];?></td>
        <td><?php echo $row['balance'];?></td>
        </tr>
    <?php
        $i++;
    }
    ?>
    </table>
<?php } ?>