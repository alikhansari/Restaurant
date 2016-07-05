<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <table width="100%">
        <tr><td width="30%"><label for="id1"><?php echo $str['username']; ?></label></td> <td width="70%"><input type="text" name="username" placeholder="<?php echo $str['username']; ?>" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" class="input_general" id="id1" /></td></tr>
        <tr><td width="30%"><label for="id2"><?php echo $str['password']; ?></label></td> <td width="70%"><input type="password" name="password" placeholder="<?php echo $str['password']; ?>" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" class="input_general" id="id2" /></td></tr>
        <tr><td width="30%"><label for="id6"><?php echo $str['name']; ?></label></td> <td width="70%"><input type="text" name="name" placeholder="<?php echo $str['name']; ?>" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" class="input_general" id="id6" /></td></tr>
        <tr><td width="30%"><label for="id3"><?php echo $str['email']; ?></label></td> <td width="70%"><input type="email" name="email" placeholder="<?php echo $str['email']; ?>" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" class="input_general" id="id3" /></td></tr>
        <tr><td width="30%"><label for="id7"><?php echo $str['phone_number']; ?></label></td> <td width="70%"><input type="text" name="phone" placeholder="<?php echo $str['phone_number']; ?>(9138981430)" maxlength="10" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>" class="input_general" id="id7" /></td></tr>
        <tr><td width="30%"><label for="id4"><?php echo $str['gender']; ?></label></td> <td width="70%">
                <select name="gender" id="id4" class="input_general">
                    <option value="1" <?php if(isset($_POST['gender'])) if($_POST['gender'] == 1) echo "selected";?>><?php echo $str['male'];?></option>
                    <option value="2" <?php if(isset($_POST['gender'])) if($_POST['gender'] == 2) echo "selected";?>><?php echo $str['female'];?></option>

                </select></td></tr>
        <tr><td width="30%"><label for="id5"><?php echo $str['address']; ?></label></td> <td width="70%"><textarea name="address" rows="6" placeholder="<?php echo $str['address']; ?>" class="input_general" id="id5"><?php if(isset($_POST['address'])) echo $_POST['address']; ?></textarea></td></tr>
        <tr><td colspan="2"><input type="submit" class="input_general" name="ADD_USER" value="<?php echo $str['add_user']; ?>" />
                            <input type="reset" class="input_general" value="<?php echo $str['reset'];?>" />
            </td></tr>
        <?php
        if($msg != null)
        {
            ?>
            <tr><td colspan="2"><?php echo $msg;?></td></tr>
            <?php
        }
        ?>
    </table>

</form>