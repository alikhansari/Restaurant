<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <table width="100%">
        <tr>
            <td>
    <select name="TYPE" id="1" class="input_search">
        <option value="1" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="1") echo "selected";?>><?php echo $str['search_by_food_id'];?></option>
        <option value="2" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="2") echo "selected";?>><?php echo $str['search_by_food_name'];?></option>
        <option value="3" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="3") echo "selected";?>><?php echo $str['search_by_food_active'];?></option>
        <option value="4" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="4") echo "selected";?>><?php echo $str['search_by_food_user_id'];?></option>
        <option value="5" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="5") echo "selected";?>><?php echo $str['search_by_food_username'];?></option>
        <option value="6" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="6") echo "selected";?>><?php echo $str['serach_by_food_category_name'];?></option>
        <option value="7" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="7") echo "selected";?>><?php echo $str['search_by_food_category_id'];?></option>
    </select>
            </td>
            <td>
    <input type="text" name="INPUT_SEARCH" value="<?php if(isset($_POST['INPUT_SEARCH'])) echo $_POST['INPUT_SEARCH'];?>" class="input_search" placeholder="<?php echo $str['please_enter_your_value'];?>" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="SEARCH_FOOD" value="<?php echo $str['search'];?>"/>
            </td>
        </tr>
    </table>
</form>

<?php if($result[0] == 0  && $result[1] == null)
{
    echo $str['error_message_empty'];
} else if($result[0] == 1 && $result [1] == false) {
    echo $str['not_found'];
} else if ($result[0] == 1 && $result[1] != false )
{
    ?>
    <table width="100%">
        <tr><td>#</td><td><?php echo $str['name'];?></td><td><?php echo $str['food_balance'];?></td><td><?php echo $str['category_name'];?></td><td><?php echo $str['edit'];?></td></tr>
        <?php foreach ($result[1] as $row) {
            $catname = $cat->GetCatName($row['cat_id']);
    ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['balance'];?></td>
                <td><?php echo $catname;?></td>
                <td><a href="foods_edit.php?edit=<?php echo $row['id'];?>" target="_blank"><?php echo $str['edit'];?></a> </td>
            </tr>

    <?php
        }
    ?>
    </table>
<?php
}
   ?>