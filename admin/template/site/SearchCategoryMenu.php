<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <table width="100%">
        <tr>
            <td>
    <select name="TYPE" id="1" class="input_search">
        <option value="1" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="1") echo "selected";?>><?php echo $str['search_category_by_id'];?></option>
        <option value="2" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="2") echo "selected";?>><?php echo $str['search_category_by_name'];?></option>
        <option value="3" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="3") echo "selected";?>><?php echo $str['search_category_by_food_name'];?></option>
    </select>
            </td>
            <td>
    <input type="text" name="INPUT_SEARCH" value="<?php if(isset($_POST['INPUT_SEARCH'])) echo $_POST['INPUT_SEARCH'];?>" class="input_search" placeholder="<?php echo $str['please_enter_your_value'];?>" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="SEARCH_CATEGORY" value="<?php echo $str['search'];?>"/>
            </td>
        </tr>
    </table>
</form>

<?php
if($result[0] == "1")
{
    echo $str['error_message_empty'];
}
elseif($result[0] == "2" || $result[0] == "4")
{
    echo $str['you_should_write_a_number'];
}
elseif ($result[0] == "5")
{
    echo $str['not_found'];
}
elseif($result[0] == "3")
{
    ?>
    <table width="100%">
        <tr><td>#</td><td><?php echo $str['cat_name'];?></td><td><?php echo $str['edit'];?></td><td><?php echo $str['delete'];?></td></tr>
    <?php
    foreach ($result[1] as $row) {
        ?>
        <tr><td><?php echo $row['id'];?></td><td><?php echo $row['name'];?></td>
            <td><a href="category_edit.php?edit=<?php echo $row['id'];?>"><?php echo $str['delete'];?></a></td><td><a href="category_delete.php?delete=<?php echo $row['id'];?>"><?php echo $str['delete'];?></a></td></tr>
        <?php
        }
    ?>
    </table>
<?php
}
?>