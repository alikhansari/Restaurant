<?php if($x == 1)
{
    ?>
    <div class="list-group margin-b-3">
        <a href="index.php" class="<?php if(basename($_SERVER['PHP_SELF'])== "index.php") echo "active ";?>list-group-item"><?php echo $str['index_title'];?></a>
        <a href="user.php" class="<?php if(basename($_SERVER['PHP_SELF'])== "user.php") echo "active ";?>list-group-item"><?php echo $str['user_title_page'];?></a>
        <a href="credit.php" class="<?php if(basename($_SERVER['PHP_SELF'])== "credit.php") echo "active ";?>list-group-item"><?php echo $str['credit_page'];?></a>
        <a href="order.php" class="<?php if(basename($_SERVER['PHP_SELF'])== "order.php") echo "active ";?>list-group-item"><?php echo $str['order'];?></a>
        <a href="search.php" class="<?php if(basename($_SERVER['PHP_SELF'])== "search.php") echo "active ";?>list-group-item"><?php echo $str['search'];?></a>
        <a href="contact.php" class="<?php if(basename($_SERVER['PHP_SELF'])== "contact.php") echo "active ";?>list-group-item"><?php echo $str['contact_us'];?></a>
        <a href="view.php?type=orders&id=<?php echo $_COOKIE['id'];?>" class="<?php if(basename($_SERVER['PHP_SELF'])== "view.php") echo "active ";?>list-group-item"><?php echo $str['view_order'];?></a>
    </div>
    <?php
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title"><?php echo $str['user_menu'];?></h4>
    </div>
    <div class="panel-body">
        <p>
            <?php
            /*
             * 1: user is logged
             * 2: admin is logged
             * 3: login menu
             */
            switch($x)
            {
                case 1:
                    require('template/site/UserMenuLogged.php');
                    break;
                case 2:
                    include('template/site/AdminMenuLogged.php');
                    break;
                case 3:
                    require('template/site/UserMenu.php');
                    echo ' </p><div id="error_stmt">' . $value->msg . '</div>';
                    break;
                default:
                    require('template/site/UserMenu.php');
                    echo ' </p><div id="error_stmt">' . $value->msg . '</div>';
                    break;
            }
            ?>
            </p>

</div>
</div>

<div class="panel panel-default">
<div class="panel-heading">
    <h4 class="panel-title"><?php echo $str['category_list'];?></h4>
</div>
<div class="panel-body">
<div class="list-group margin-b-3">
    <?php
    $category = new Category();
    $food = new Food();
    $result = $category->CategoryList();
    if($result != false) {
        foreach ($result as $row) {
            if($food->SearchFoodByCatId($row['id']) != false) {
                ?>
                <a href="category.php?id=<?php echo $row['id']; ?>" class="list-group-item"><?php echo $row['name']; ?></a>
                <?php
            }
        }
    }
    ?>

</div>

</div>
</div>


</div>
</div>