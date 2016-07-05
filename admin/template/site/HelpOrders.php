<ul><li><?php echo $str['view_order'];?> ==> <?php echo $str['view_order#'];?></li>
    <li><?php echo $str['add_order'];?> ==> <?php echo $str['add_order#'];?></li>
    <li><?php echo $str['completed_order'];?> ==> <?php echo $str['completed_order#'];?></li>
    <li><?php echo $str['new_order'];?> ==> <?php echo $str['new_order#'];?></li>
    <li><?php echo $str['orders_refund'];?> ==> <?php echo $str['orders_refund#'];?></li>
    <li><?php echo $str['order_search'];?> ==> <?php echo $str['order_search#'];?></li>
    <li><?php echo $str['order_report'];?> ==> <?php echo $str['order_report#'];?></li>
</ul>
<ul><li><?php echo $str['your_order#_is'];?> <?php echo $order->GetCountOrders();?> </li></ul>
<ul><li><?php echo $str['your_order_1#_is'];?> <?php echo $order->GetOrderType1();?> </li></ul>
<ul><li><?php echo $str['your_order_2#_is'];?> <?php echo $order->GetOrderType2();?> </li></ul>
