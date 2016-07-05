<?php
require("../includes/functions.php");
$admin = new Admin();
$setting = new Settings();
$order = new Order();
$user = new User();
$category = new Category();
$admin->ValidateToAdminLogin();
$result = $setting->ReportName();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="template/css/admin.css" rel="stylesheet" type="text/css" />
    <script>
        function Print() {
            window.print();
        }
    </script>
    <title><?php echo $str['report_print'];?></title>
</head>
<body>
<div class="main_report">
    <h1 class="main_report"><?php echo $setting->GetSettings(1);?></h1>
<?php
/*
 * return result[1] => not found
 * return result[0] => type (1=>order,2=>allorders,3=>user,4=>order,5=>food_user,6=>alluser,credit_user,8=>credit_system,9=>credit)
 * return result[2] => RESULT
 */
if ($result[1] == 0)
    echo $str['not_found'];
else {
  switch($result[0])
  {
    case 1:
    $u_r = $user->FetchUserInfo($result[2]['user_id']);
  ?>

  <table width="100%" border="1">
      <tr>
          <td colspan="4"><?php echo $str['order_id']; ?>: <?php echo $_GET['id']; ?></td>
          <td colspan="2"><?php echo $result[2]['ordertime'];?></td>
      </tr>
    <tr>
        <td width="15%"><?php echo $str['id']?>: </td>
        <td colspan="2" width="15%"><?php echo $result[2]['user_id']?></td>
        <td  width="15%"><?php echo $str['username']?>: </td>
        <td colspan="2" width="55%"><?php echo $result[2]['user_name'];?> (<a href="print.php?type=user&id=<?php echo $result[2]['user_id']?>" target="_blank"><?php echo $str['link'];?></a>)</td>
    </tr>
      <tr>
          <td width="10%"><?php echo $str['food_id']?>: </td>
          <td width="10%"><?php echo $result[2]['food_id'];?></td>
          <td width="15%"><?php echo $str['food_name']?>: </td>
          <td width="35%"><?php echo $result[2]['food_name'];?> (<a href="print.php?type=food&id=<?php echo $result[2]['food_id'];?>" target="_blank"><?php echo $str['link'];?></a>)</td>
          <td width="10%"><?php echo $str['number']?>: </td>
          <td width="20%"><?php echo $result[2]['number'];?></td>
      </tr>
      <tr>
          <td width="25%"><?php echo $str['food_price'];?>:</td>
          <td colspan="2" width="25%"><?php echo $result[2]['price'];?></td>
          <td width="25%"><?php echo $str['total_price'];?>:</td>
          <td colspan="2" width="25%"><?php echo $result[2]['total_price'];?> <?php echo $str['curr'];?></td>
      </tr>
      <tr>
          <td width="15%"><?php echo $str['address'];?>:</td>
          <td colspan="5" width="85%"><?php echo $u_r['user_address'];?></td>
      </tr>
      <tr>
          <td width="15%"><?php echo $str['order_status'];?></td>
          <td colspan="4" width="60%"><?php echo $order->status($result[2]['status']); ?></td>
          <td width="25%"><?php echo $u_r['phone']; ?></td>
      </tr>
  </table>
  <?php
    break;
    case 2:
        $sum = 0;
        $u_r = $user->FetchUserInfo($_GET['id']);
      ?>
        <table width="100%" border="1">
            <tr><td width="15%"><?php echo $str['username']?>:</td><td width="65%" colspan="4"><a href="print.php?type=user&id=<?php echo $_GET['id'];?>" target="_blank"><?php echo $u_r['username'];?></a></td>
            <td width="20%"><?php echo $str['order_total_number'];?>:<?php echo $u_r['order_numbers'];?></td></tr>
            <tr>
                <td width="10%">#</td>
                <td width="15%"><?php echo $str['food_name']?></td>
                <td width="10%"><?php echo $str['number']?></td>
                <td width="15%"><?php echo $str['total_price']?></td>
                <td width="25%"><?php echo $str['order_time']?></td>
                <td width="25%"><?php echo $str['order_status']?></td>
            </tr>
            <?php
            foreach ($result[2] as $row) {
                if($row['status'] != 3)
                {
                    $sum = $row['total_price']+$sum;
                }
                ?>
                <tr>
                    <td width="10%"><?php echo $row['id'];?></td>
                    <td width="15%"><a href="print.php?type=food&id=<?php echo $row['food_id'];?>" target="_blank"><?php echo $row['food_name'];?></a></td>
                    <td width="10%"><?php echo $row['number'];?></td>
                    <td width="15%"><?php echo $row['total_price'];?></td>
                    <td width="25%"><?php echo $row['ordertime'];?></td>
                    <td width="25%"><a href="print.php?type=order&id=<?php echo $row['id'];?>" target="_blank"><?php echo $order->status($row['status']);?></a></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="6"><a href="print.php?type=credit_user&id=<?php echo $_GET['id'];?>" target="_blank"><?php echo $str['total_buys_user']?>: <?php echo $sum;?><?php echo $str['curr'] ?></a> </td>
            </tr>
        </table>
    <?php
    break;
    case 3:
        switch($result[2]['sex'])
        {
            case 0:
                $sex = $str['female'];
                break;
            case 1:
                $sex = $str['male'];
                break;
        }
        ?>
        <table width="100%" border="1">
        <tr>
            <td><?php echo $str['id'];?>:</td><td><?php echo $result[2]['id'];?></td><td><?php echo $str['username'];?>:</td><td colspan="3"><?php echo $result[2]['username'];?></td>
        </tr>
            <tr>
                <td width="15%"><?php echo $str['name'];?>: </td><td width="20%"><?php echo $result[2]['name'];?></td>
                <td width="10%"><?php echo $str['email'];?>: </td><td width="25%"><?php echo $result[2]['email'];?></td>
                <td width="10%"><?php echo $str['order_total_number'];?>: </td><td width="20%"><?php echo $result[2]['order_numbers'];?></td>
            </tr>
            <tr>
                <td width="10%"><?php echo $str['ip'];?>:</td>
                <td width="30%"><?php echo $result[2]['ip'];?></td>
                <td width="10%"><?php echo $str['gender'];?>:</td>
                <td width="10%"><?php echo $sex?></td>
                <td width="10%"><?php echo $str['credit'];?>:</td>
                <td width="30%"><a href="print.php?type=credit_user&id=<?php echo $_GET['id'];?>" target="_blank"><?php echo $result[2]['credit'];?> <?php echo $str['curr'];?></a> </td>
            </tr>
            <tr>
                <td width="10%"><?php echo $str['address'];?>:</td>
                <td width="50%" colspan="2"><?php echo $result[2]['user_address'];?></td>
                <td width="5%"><?php echo $result[2]['phone']; ?></td>
                <td width="5%"><?php echo $str['regtime'];?>:</td>
                <td width="30%"><?php echo $result[2]['regtime'];?></td>
            </tr>
        </table>
    <?php
    break;

      case 4:
          switch($result[2]['active'])
          {
              case 1:
                  $active = $str['yes'];
                  break;
              case 0:
                  $active = $str['no'];
                  break;
          }
          $u_r = $user->FetchUserInfo($result[2]['user_id']);
          ?>
          <table width="100%" border="1">
              <tr>
                  <td width="15%"><?php echo $str['food_id'];?></td>
                  <td width="10%"><?php echo $result[2]['id']; ?></td>
                  <td width="15%"><?php echo $str['food_name'];?></td>
                  <td colspan="3" width="60%"><?php echo $result[2]['name'];?></td>
              </tr>
              <tr>
                  <td width="15%"><?php echo $str['food_price'];?></td>
                  <td width="15%"><?php echo $result[2]['price'];?><?php echo $str['curr'] ?></td>
                  <td width="15%"><?php echo $str['food_balance'];?></td>
                  <td width="25%"><?php echo $result[2]['balance'];?></td>
                  <td width="15%"><?php echo $str['active'];?></td>
                  <td width="15%"><?php echo $active;?></td>
              </tr>
              <tr>
                  <td width="15%"><?php echo $str['category_name'];?></td>
                  <td colspan="2" width="30%"><?php echo $category->GetCatName($result[2]['cat_id']);?></td>
                  <td width="15%"><?php echo $str['username'];?></td>
                  <td colspan="2" width="30%"><?php echo $u_r['username'];?></td>
              </tr>
          </table>

<?php
          break;
      case 5:
        $id = $_GET['id'];
          $u_r = $user->FetchUserInfo($id);
          ?>
            <table width="100%" border="1">

                <tr><td colspan="6" width="100%"><?php echo $str['username'];?>: <a href="print.php?type=user&id=<?php echo $id;?>" target="_blank"><?php echo $u_r['username'];?></a> </td></tr>
                <tr>
                    <td width="10%">#</td>
                    <td width="30%"><?php echo $str['food_name']; ?></td>
                    <td width="20%"><?php echo $str['food_price']; ?></td>
                    <td width="15%"><?php echo $str['food_balance']; ?></td>
                    <td width="10%"><?php echo $str['active']; ?></td>
                    <td width="15%"><?php echo $str['more']; ?></td>
                </tr>
                <?php
                foreach ($result[2] as $row) {
                    switch($row['active'])
                    {
                        case 1:
                            $active = $str['yes'];
                            break;
                        case 2:
                            $active = $str['no'];
                            break;
                    }
                    ?>
                <tr>
                    <td width="10%"><?php echo $row['id'] ?></td>
                    <td width="30%"><?php echo $row['name'];?></td>
                    <td width="20%"><?php echo $row['price'];?> <?php echo $str['curr'];?></td>
                    <td width="15%"><?php echo $row['balance'];?></td>
                    <td width="10%"><?php echo $active;?></td>
                    <td width="15%"><a href="print.php?type=food&id=<?php echo $row['id'];?>" target="_blank"><?php echo $str['more'];?></a></td>
                </tr>
                    <?php
                    }

                ?>
            </table>
    <?php
      break;
      case 6:
          ?>
        <table width="100%" border="1">
            <tr>
                <td width="10%">#</td>
                <td width="20%"><?php echo $str['username'];?></td>
                <td width="10%"><?php echo $str['credit'];?></td>
                <td width="10%"><?php echo $str['order_total_number'];?></td>
                <td width="10%"><?php echo $str['gender'];?></td>
                <td width="10%"><?php echo $str['active'];?></td>
                <td width="20%"><?php echo $str['email'];?></td>
                <td width="10%"><?php echo $str['phone_number'];?></td>
            </tr>
        <?php
          foreach ($result[2] as $row) {
                switch($row['active'])
                {
                    case 1:
                        $active = $str['yes'];
                        break;
                    case 0:
                        $active = $str['no'];
                        break;
                }
                switch($row['sex'])
                {
                    case 1:
                        $sex = $str['male'];
                        break;
                    case 0:
                        $sex = $str['female'];
                        break;
                }
              ?>
              <tr>
                  <td width="10%"><?php echo $row['id']; ?></td>
                  <td width="20%"><a href="print.php?type=user&id=<?php echo $row['id'];?>" target="_blank"><?php echo $row['username']; ?></a> </td>
                  <td width="10%"><?php echo $row['credit']; ?></td>
                  <td width="10%"><?php echo $row['order_numbers']; ?></td>
                  <td width="10%"><?php echo $sex; ?></td>
                  <td width="10%"><?php echo $active; ?></td>
                  <td width="20%"><?php echo $row['email']; ?></td>
                  <td width="10%"><?php echo $row['phone']; ?></td>
              </tr>

              <?php
            }

          ?>
        </table>
          <?php
          break;
      case 7:
          $u_r = $user->FetchUserInfo($_GET['id']);
          ?>
            <table width="100%" border="1">
                <tr><td colspan="7"><?php echo $str['username'];?>: <?php echo $u_r['username'];?></td></tr>
                <tr>
                    <td width="10%">#</td>
                    <td width="15%"><?php echo $str['credit_type'] ?></td>
                    <td width="15%"><?php echo $str['credit'] ?></td>
                    <td width="15%"><?php echo $str['credit_now'] ?></td>
                    <td width="15%"><?php echo $str['credit_after'] ?></td>
                    <td width="10%"><?php echo $str['order_id'];?></td>
                    <td width="20%"><?php echo $str['time'] ?></td>
                </tr>
                <?php
                foreach ($result[2] as $row) {

                    ?>
                    <tr>
                        <td width="10%"><?php echo $row['id'];?></td>
                        <td width="15%"><?php echo $row['type'];?></td>
                        <td width="15%"><?php echo $row['credit_before'];?></td>
                        <td width="15%"><?php echo $row['credit_now'];?></td>
                        <td width="15%"><?php echo $row['credit_after'];?> <?php echo $str['curr'];?></td>
                        <td width="10%">
                            <?php if($row['order_id'] != 0)
                    {
                        ?>
                            <a href="print.php?type=order&id=<?php echo $row['order_id']?>" target="_blank"><?php echo $str['order_id'];?><?php $str['view_order'];?></a></td>
                        <?php
                        }
                        else
                        echo "-";
                        ?>
                        <td width="20%"><?php echo $row['time'];?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>

    <?php
          break;
      case 8:
          ?>
        <table width="100%" border="1">
            <tr><td colspan="3"><?php echo $str['credit_system'];?></td></tr>
            <tr><td>#</td><td><?php echo $str['link'];?></td><td><?php echo $str['price'];?></td></tr>
            <?php foreach ($result[2] as $row) {
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><a href="print.php?type=credit&id=<?php echo $row['credit_log_id'];?>" target="_blank"><?php echo $str['link'];?></a> </td>
                    <td><?php echo $row['total_price'];?> <?php echo $str['curr'] ?></td>
                </tr>
          <?php
            }
            ?>
            </table>
    <?php
          break;
      case 9:
          $u_r = $user->FetchUserInfo($result[2]['user_id']);
        ?>
    <table width="100%" border="1">
        <tr>
            <td><?php echo $str['credit_id']; ?>: <?php echo $result[2]['id'];?></td>
            <td><?php echo $str['time']; ?>: <?php echo $result[2]['time'];?></td>
        </tr>
        <tr>
            <td><?php echo $str['price']; ?>: <?php echo $result[2]['credit_now'];?> <?php echo $str['curr'];?></td>
            <td><?php echo $str['credit_after']; ?>: <?php echo $result[2]['credit_after'];?> <?php echo $str['curr'];?></td>
        </tr>
        <tr>
            <td><?php echo $str['ip']; ?>: <?php echo $result[2]['ip'];?></td>
            <td><?php echo $str['order_number']; ?>: <?php if($result[2]['order_id'] == 0)
                    echo "-";
                else
                {
                    ?>
                    <a href="print.php?type=order&id=<?php echo $result[2]['order_id'];?>" target="_blank"><?php echo $str['link'];?></a>
                    <?php
                }
                ?>
                </td>
        </tr>
        <tr>
            <td><?php echo $str['username']; ?>: <a href="print.php?type=user&id=<?php echo $u_r['id'];?>" target="_blank"><?php echo $u_r['username'];?></a> </td>
            <td><?php echo $str['credit_type']; ?>: <?php echo $result[2]['type'];?></td>
        </tr>
    </table>
    <?php
          break;
      case 10:

 ?>
          <table width="100%" border="1">
              <tr>
                  <td width="10%">#</td>
                  <td width="15%"><?php echo $str['username'] ?></td>
                  <td width="15%"><?php echo $str['credit'] ?></td>
                  <td width="15%"><?php echo $str['credit_now'] ?></td>
                  <td width="15%"><?php echo $str['credit_after'] ?></td>
                  <td width="10%"><?php echo $str['order_id'];?></td>
              </tr>
              <?php
              foreach ($result[2] as $row) {
                  $u_r = $user->FetchUserInfo($row['user_id']);
                  ?>
                  <tr>
                      <td width="10%"><?php echo $row['id'];?></td>
                      <td width="15%"><a href="print.php?type=user&id=<?php echo $u_r['id'];?>" target="_blank"><?php echo $u_r['username'];?></a> </td>
                      <td width="15%"><?php echo $row['credit_before'];?></td>
                      <td width="15%"><?php echo $row['credit_now'];?></td>
                      <td width="15%"><?php echo $row['credit_after'];?> <?php echo $str['curr'];?></td>
                      <td width="10%">
                          <?php if($row['order_id'] != 0)
                          {
                          ?>
                          <a href="print.php?type=order&id=<?php echo $row['order_id']?>" target="_blank"><?php echo $str['order_id'];?><?php $str['view_order'];?></a></td>
                      <?php
                      }
                      else
                          echo "-";
                      ?>
                  </tr>
                  <?php
              }
              ?>
          </table>
          <?php
        break;
  }
}
    ?>
<div class="print_none">
<button onclick="Print()"><?php echo $str['print'];echo " ";echo $str['report_print'];?></button>
    <br/>
    <a href="index.php"><?php echo $str['return_main_page'];?></a>
</div>
</div>

</body>
</html>
