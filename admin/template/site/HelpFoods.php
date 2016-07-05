<ul><li><?php echo $str['view_food'];?> ==> <?php echo $str['view_food_'];?></li>
    <li><?php echo $str['add_food'];?> ==> <?php echo $str['add_food_'];?></li>
    <li><?php echo $str['food_add_balance'];?> ==> <?php echo $str['food_add_balance_'];?></li>
    <li><?php echo $str['food_finished'];?> ==> <?php echo $str['food_finished_'];?></li>
    <li><?php echo $str['food_nonactivate'];?> ==> <?php echo $str['food_nonactivate_'];?></li>
    <li><?php echo $str['food_search'];?> ==> <?php echo $str['food_search_'];?></li>
</ul>
<ul><li><?php echo $str['your_food_#_is'];?> <?php echo $food->GetCountFoods();?> </li></ul>
<ul><li><?php echo $str['your_property_amount_is'];?> <?php echo $food->Property(); ?> <?php echo $str['curr'];?> </li></ul>