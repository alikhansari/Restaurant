<div class="col-sm-4">
    <!-- Search -->
    <div class="well">
        <h4 class="margin-t-0"><?php echo $str['search']; ?></h4>
        <form action="search.php" method="POST">
            <div class="input-group">

                <input type="text" name="search_input" placeholder="<?php echo $str['search'];?>" class="form-control" id="search-form">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="search">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>


            </div>
        </form>
    </div>