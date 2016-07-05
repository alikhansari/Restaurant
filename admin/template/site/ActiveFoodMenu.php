<?php if(!$result[0])
{
    echo $str['foods_not_found'];
}
elseif($result[0])
{
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <table width="100%">
            <tr><td>#</td><td><?php echo $str['food_name'];?></td><td><?php echo $str['food_balance'];?></td><td><?php echo $str['more'];?></td><td><?php echo $str['activate_user'];?></td></tr>
            <?php
            foreach ($result[1] as $row )
            {
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['balance'];?></td>
                    <td><a href="foods_edit.php?edit=<?php echo $row['id'];?>" target="_blank"><?php echo $str['more'];?></a></td>
                    <td><label for="id<?php echo $row['id'];?>"><?php echo $str['active']; ?></label><input id="id<?php echo $row['id'];?>" type="checkbox" name="check_list[]" value="<?php echo $row['id'];?>" /></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <input type="submit" value="<?php echo $str['activate_food'];?>" name="ACTIVATE_FOOD" />
    </form>
    <?php } ?>