<?php if(!$result[0])
{
    echo $str['users_not_found'];
}
elseif($result[0])
{
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <table width="100%">
            <tr><td>#</td><td><?php echo $str['username'];?></td><td><?php echo $str['credit'];?></td><td><?php echo $str['more'];?></td><td><?php echo $str['deactivate_user'];?></td></tr>
            <?php
            foreach ($result[1] as $row )
            {
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['credit'];?></td>
                    <td><a href="print.php?type=user&id=<?php echo $row['id'];?>" target="_blank"><?php echo $str['more'];?></a></td>
                    <td><label for="id<?php echo $row['id'];?>"><?php echo $str['deactive']; ?></label><input id="id<?php echo $row['id'];?>" type="checkbox" name="check_list[]" value="<?php echo $row['id'];?>" /></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <input type="submit" value="<?php echo $str['deactivate_user'];?>" name="DEACTIVATE_USER" />
    </form>

    <?php
}elseif ($result[2])
{
    ?>

    <?php
}
?>