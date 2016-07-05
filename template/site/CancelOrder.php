<?php if(isset($_POST['cancel_order']))
{
    echo $str['your_order_has_been_canceled'];
}
else {
?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>?order=<?php echo $_GET['order'];?>" method="POST">
        <table width="100%" class="table">
            <tr><td><h4><?php echo $str['Cancellation'] ?></h4></td></tr>
            <tr><td><?php echo $str['Im_sure_want_to_canel_order_number'];?> <?php echo $str['order_id'];?>  <?php echo $result['id'];?> <?php echo $str['comma'];?> <?php echo $str['total_price_is'];?>, <?php echo $result['total_price'];?> <?php echo $str['curr'];?></td></tr>
            <tr><td><input type="submit" value="<?php echo $str['cancel'];?>" name="cancel_order"></td></tr>
        </table>
    </form>
<?php }
?>