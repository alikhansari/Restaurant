    <?php
    if($result[0] == "1")
    {
        echo $str['you_should_edit_food_categories_to']." ".$result[1]."-".$str['category_code_is']." ".$id;
        echo "<br />";
        echo '<a href="category.php">'.$str['return_main_page'].'</a>';
    }
    elseif($result[0] == "2")
    {
        ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>?delete=<?php echo $id;?>" method="POST">
    <?php
    echo $str['are_sure_to_delete_this_category'];
    echo " ";
    echo $result[1];
    ?>
    <input type="submit" name="DELETE_CATEGORY" value="<?php echo $str['yes']; ?>"/>
<?php
} elseif ($result[0] == "3")
{
    echo $str['category_has_been_deleted'];
    echo "<br />";
    echo '<a href="category.php">'.$str['return_main_page'].'</a>';

}
?>
</form>