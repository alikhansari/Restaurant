<?php if ($result == null)
{
    ?>
    <span class="error"><?php echo $str['not_found'];?></span>
    <?php
}
else {
    ?>
    <table width="100%">
        <tr><td>#</td><td><?php echo $str['name'];?></td><td><?php echo $str['edit'];?></td><td><?php echo $str['delete']; ?></td></tr>
        <?php foreach ($result as $row) {
        ?>
        <tr><td><?php echo $row['id'];?></td>
            <td><?php echo $row['name'];?></td>
            <td><a href="category_edit.php?edit=<?php echo $row['id'];?>" target="_blank"><?php echo $str['edit'];?></a> </td>
            <td><a href="category_delete.php?delete=<?php echo $row['id'];?>" target="_blank"><?php echo $str['delete'];?></a></td>
        </tr>

        <?php } ?>
    </table>
<?php
}
?>