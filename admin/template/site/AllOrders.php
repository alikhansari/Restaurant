
<?php
//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    include("../../../includes/functions.php");  //include config file
    $db = new Database();
    $set = new Settings();
    $order = new Order();
    $item_per_page = 5;
    //Get page number from Ajax POST
    if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

    //get total number of records from database for pagination
    $get_total_rows = $order->GetCountOrders(); //hold total records in variable
    //break records into pages
    $total_pages = ceil($get_total_rows/$item_per_page);
    //get starting position to fetch the records
    $page_position = (($page_number-1) * $item_per_page);
    //Limit our results within a specified range.
    $results = $db->query("SELECT * FROM tbl_order ORDER BY id DESC LIMIT $page_position,$item_per_page");
    $db->execute(); //Execute prepared Query
    $re = $db->resultset();
    //Display records fetched from database.
    ?>
    <table width="100%">
        <thead>
        <tr><td>#</td><td><?php echo $str['username'];?></td><td><?php echo $str['food_name'];?></td><td><?php echo $str['number'];?></td><td><?php echo $str['total_price'];?></td><td><?php echo $str['order_status'];?></td><td><?php echo $str['order_time'];?></td><td><?php echo $str['more'];?></td></tr>
        </thead>
        <tbody>
        <?php
        foreach($re as $row){ ?>
        <tr>
        <td><?php echo $row['id'];?></td>
        <td><a href="print.php?type=user&id=<?php echo $row['user_id'];?>" target="_blank"><?php echo $row['user_name'];?></a></td>
        <td><a href="print.php?type=food&id=<?php echo $row['food_id'];?>" target="_blank"><?php echo $row['food_name'];?></a></td>
        <td><?php echo $row['number'];?></td>
        <td><?php echo $row['total_price'];?> <?php echo $str['curr'] ?></td>
        <td><?php echo $order->status($row['status']);?></td>
        <td><?php echo $row['ordertime'];?></td>
        <td><a href="print.php?type=order&id=<?php echo $row['id'] ?>" target="_blank"><?php echo $str['more'];?></a></td>
                </tr>
                <?php
        }
        ?>
        </tbody>
    </table>
    <?php
    echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us.
    As you can see I have passed several parameters to the function. */
    echo paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
    echo '</div>';
    exit;
}
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';

        $right_links    = $current_page + 3;
        $previous       = $current_page - 3; //previous link
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link

        if($current_page > 1){
            $previous_link = ($previous==0)? 1: $previous;
            $pagination .= '<span class=""><a href="#" data-page="1" title="اولین">&laquo;</a></span>'; //first link
            for($i = ($current_page-2); $i < $current_page; $i++){
                //Create left-hand side links
                if($i > 0){
                    $pagination .= '<span><a href="#" data-page="'.$i.'" title="صفحه'.$i.'">'.$i.'</a></span>';
                }
            }
            $first_link = false; //set first link to false
        }
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<span><a href="#" data-page="'.$i.'" title="صفحه '.$i.'">'.$i.'</a></span>';
            }
        }
        if($current_page < $total_pages){
            $next_link = ($i > $total_pages) ? $total_pages : $i;
            $pagination .= '<span class=""><a href="#" data-page="'.$total_pages.'" title="آخرین">&raquo;</a></span>'; //last link
        }

        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}

?>