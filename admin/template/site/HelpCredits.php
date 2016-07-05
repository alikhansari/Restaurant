<ul><li><?php echo $str['search_credit'];?> ==> <?php echo $str['search_credit#'];?></li>
    <li><?php echo $str['add_credit'];?> ==> <?php echo $str['add_credit#'];?></li>
    <li><?php echo $str['system_credit'];?> ==> <?php echo $str['system_credit#'];?></li>
</ul>
<ul><li><?php echo $str['your_credit#_is'];?> <?php echo $credit->GetCreditCount()?> </li></ul>
<ul><li><?php echo $str['your_system_balance#_is'];?> <?php echo $credit->GetBalanceSystem();?> <?php echo $str['curr'];?></li></ul>

