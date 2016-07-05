<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <table width="100%">
        <tr>
            <td><label for="username"><?php echo $str['username'];?></label></td>
            <td><input type="text"  name="username" id="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" placeholder="<?php echo $str['username']; ?>" class="input_general" /> </td>
        </tr>
        <tr>
            <td><label for="id2"><?php echo $str['price'] ?></label></td>
            <td><input type="number" min="1" id="id2" max="1000000" name="price" value="<?php if(isset($_POST['price'])) echo $_POST['price']; ?>" class="input_general" placeholder="<?php echo $str['price']; ?>" /> </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="<?php echo $str['save']; ?>" name="ADD_CREDIT" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <?php if ($result == 2)
            {
                echo $str['error_message_empty'];
            }
            elseif($result == 3)
            {
                echo $str['you_should_write_a_number'];
            }
            elseif($result == 4)
            {
                echo $str['user_does_not_exist'];

            }
            elseif($result == 6)
            {
                echo $str['credit_has_been_created'];
            }
?>
            </td>
        </tr>

    </table>
</form>