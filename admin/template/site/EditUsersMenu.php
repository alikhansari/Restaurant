<form action="<?php echo $_SERVER['PHP_SELF'];?>?edit=<?php echo $user_id ?>" method="POST">
    <table width="100%">
        <tr><td width="30%"><label for="id1"><?php echo $str['username']; ?>*</label></td> <td width="70%"><input type="text" name="username" placeholder="<?php echo $str['username']; ?>" value="<?php if(isset($_POST['username'])) echo $_POST['username']; else echo $result['username']; ?>" class="input_general" id="id1" /></td></tr>
        <tr><td width="30%"><label for="id2"><?php echo $str['password']; ?></label></td> <td width="70%"><input type="password" name="password" placeholder="<?php echo $str['password']; ?>" value="<?php if(isset($_POST['password'])) echo $_POST['password'];  ?>" class="input_general" id="id2" /></td></tr>
        <tr><td width="30%"><label for="id6"><?php echo $str['name']; ?>*</label></td> <td width="70%"><input type="text" name="name" placeholder="<?php echo $str['name']; ?>" value="<?php if(isset($_POST['name'])) echo $_POST['name'];  else echo $result['name']; ?>" class="input_general" id="id6" /></td></tr>
        <tr><td width="30%"><label for="id3"><?php echo $str['email']; ?>*</label></td> <td width="70%"><input type="email" name="email" placeholder="<?php echo $str['email']; ?>" value="<?php if(isset($_POST['email'])) echo $_POST['email']; else echo $result['email']; ?>" class="input_general" id="id3" /></td></tr>
        <tr><td width="30%"><label for="id8"><?php echo $str['phone_number']; ?>*</label></td> <td width="70%"><input type="text" name="phone" placeholder="<?php echo $str['phone_number']; ?>" maxlength="10" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; else echo $result['phone']; ?>" class="input_general" id="id3" /></td></tr>
        <tr><td width="30%"><?php echo $str['ip']; ?>*</td> <td width="70%"><input type="text" name="ip" readonly value="<?php if(isset($_POST['ip'])) echo $_POST['ip']; else echo $result['ip']; ?>" class="input_disable" /></td></tr>
        <tr><td width="30%"><?php echo $str['number_order']; ?>*</td> <td width="70%"><input type="number" name="order_numbers" readonly value="<?php if(isset($_POST['order_numbers'])) echo $_POST['order_numbers']; else echo $result['order_numbers']; ?>" class="input_disable" /></td></tr>
        <tr><td width="30%"><?php echo $str['credit']; ?>*</td> <td width="70%"><input type="number" name="credit" readonly value="<?php if(isset($_POST['credit'])) echo $_POST['credit']; else echo $result['credit']; ?>" class="input_disable" /></td></tr>
        <tr><td width="30%"><?php echo $str['regtime']; ?>*</td> <td width="70%"><input type="text" name="regtime" readonly value="<?php if(isset($_POST['regtime'])) echo $_POST['regtime']; else echo $result['regtime']; ?>" class="input_disable" /></td></tr>
        <tr><td width="30%"><label for="id7"><?php echo $str['active']; ?>*</label></td> <td width="70%">
                <select name="active" id="id7" class="input_general">
                    <option value="1"
                        <?php if(isset($_POST['active'])) {
                            if ($_POST['active'] == 1) {
                                echo "selected";
                            }
                        }
                        elseif($result['active'] == 1)
                        {
                            echo "selected";
                        }?>
                        ><?php echo $str['yes'];?></option>
                    <option value="2"
                        <?php if(isset($_POST['active'])) {
                            if ($_POST['active'] == 2) {
                                echo "selected";
                            }
                        }
                        elseif($result['active'] == 0)
                        {
                            echo "selected";
                        }?>
                        ><?php echo $str['no'];?></option>

                </select></td></tr>
        <tr><td width="30%"><label for="id4"><?php echo $str['gender']; ?>*</label></td> <td width="70%">
                <select name="gender" id="id4" class="input_general">
                    <option value="1"
                        <?php if(isset($_POST['gender'])) {
                            if ($_POST['gender'] == 1) {
                                echo "selected";
                            }
                        }
                            elseif($result['sex'] == 1)
                            {
                                echo "selected";
                        }?>
                        ><?php echo $str['male'];?></option>
                    <option value="2"
                        <?php if(isset($_POST['gender'])) {
                            if ($_POST['gender'] == 2) {
                                echo "selected";
                            }
                        }
                        elseif($result['sex'] == 0)
                        {
                            echo "selected";
                        }?>
                        ><?php echo $str['female'];?></option>

                </select></td></tr>
        <tr><td width="30%"><label for="id5"><?php echo $str['address']; ?></label></td> <td width="70%"><textarea name="user_address" rows="4" placeholder="<?php echo $str['address']; ?>" class="input_general" id="id5"><?php if(isset($_POST['user_address'])) echo $_POST['user_address'];  else echo $result['user_address'];?></textarea></td></tr>
        <tr><td colspan="2"><input type="submit" class="input_general" name="EDIT_USER" value="<?php echo $str['edit_user']; ?>" />
                <input type="reset" class="input_general" value="<?php echo $str['reset'];?>" />
            </td></tr>
        <?php
        if(isset($_POST['EDIT_USER']))
        {
            ?>
            <tr><td colspan="2"><?php echo $result['message'];?></td></tr>
            <?php
        }
        ?>
    </table>

</form>