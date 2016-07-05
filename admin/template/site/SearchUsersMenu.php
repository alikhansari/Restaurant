<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <table width="100%">
        <tr>
            <td>
    <select name="TYPE" id="1" class="input_search">
        <option value="1" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="1") echo "selected";?>><?php echo $str['search_by_username'];?></option>
        <option value="2" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="2") echo "selected";?>><?php echo $str['search_by_id'];?></option>
        <option value="3" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="3") echo "selected";?>><?php echo $str['search_by_email'];?></option>
        <option value="4" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="4") echo "selected";?>><?php echo $str['search_by_name'];?></option>
        <option value="6" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="6") echo "selected";?>><?php echo $str['search_by_address'];?></option>
        <option value="7" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="7") echo "selected";?>><?php echo $str['search_by_credit_more_than'];?></option>
        <option value="8" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="8") echo "selected";?>><?php echo $str['search_by_credit_less_than'];?></option>
        <option value="9" <?php if(isset($_POST['TYPE'])) if ($_POST['TYPE']=="9") echo "selected";?>><?php echo $str['search_by_credit_equal'];?></option>
    </select>
            </td>
            <td>
    <input type="text" name="INPUT_SEARCH" value="<?php if(isset($_POST['INPUT_SEARCH'])) echo $_POST['INPUT_SEARCH'];?>" class="input_search" placeholder="<?php echo $str['please_enter_your_value'];?>" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <input type="submit" name="SEARCH_USER" value="<?php echo $str['search'];?>"/>
            </td>
        </tr>
    </table>
</form>


<?php if($result[1] != null) {
    if ($result[1] == $str['error_message_empty']) {
        ?>
        <br/>
        <div style="text-align: center;"><?php echo $str['error_message_empty']; ?></div>
        <?php
    } elseif ($result[1] == $str['not_found']) {
        ?>
        <br/>
        <div style="text-align: center;"><?php echo $str['not_found']; ?></div>
        <?php
    } else {
        ?>
        <?php echo $str['result_is']; ?>:
        <table width="100%" border="1">
            <tr><td>#</td><td><?php echo $str['username'];?></td><td><?php echo $str['more'];?></td></tr>
        <?php
        $i=1;
        foreach ($result[0] as $row) {
            ?>
                <tr><td><?php echo $i;?></td><td><?php echo $row['username'];?></td><td><a href="users_edit.php?edit=<?php echo $row['id'];?>" target="_blank"><?php echo $str['more'];?></a></td></tr>
            <?php
            $i++;
        }
            ?>
        </table>
                <?php
    }
}
        ?>
