<?php
require("../includes/functions.php");
$admin = new Admin();
$admin->ValidateToAdminLogin();
$set = new Settings();
$set->PermissionToAdmin ();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="template/css/admin.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../template/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#results" ).load( "template/site/AllAdmins.php"); //load initial records

            //executes code below when user click on pagination links
            $("#results").on( "click", ".pagination a", function (e){
                e.preventDefault();
                $(".loading-div").show(); //show loading element
                var page = $(this).attr("data-page"); //get page number from link
                $("#results").load("template/site/AllAdmins.php",{"page":page}, function(){ //get content from PHP page
                    $(".loading-div").hide(); //once done, hide loading element
                });

            });
        });
    </script>
    <title><?php echo $str['view_admins'];?></title>
</head>
<body>
<table border="1" class="table_admin" width="100%">
    <tr><td colspan="2"><h1><?php echo $str['view_admins']; ?></h1></td></tr>
    <tr><td width="20%"><a href="#"><?php echo $str['welcome'].$str['comma'].$_COOKIE['admin_username'];?></a></td><td rowspan="6" style="text-align: center;text-align-all: center;text-valign:middle;" width="80%">
            <div id="results"></div>
        </td></tr>
    <tr><td width="20%"><a href="index.php"><?php echo $str['return_main_page'];?></a></td></tr>
    <tr><td width="20%"><a href="admin.php"><?php echo $str['admin_manage'];?></a></td></tr>
    <tr><td width="20%"><a href="admin_add.php"><?php echo $str['add_admins'];?></a></td></tr>
    <tr><td width="20%"><a href="admin_profile.php"><?php echo $str['edit_your_config'];?></a></td></tr>
    <tr><td width="20%"><a href="login.php?logout=true"><?php echo $str['logout'];?></a></td></tr>
    <tr><td colspan="2"><?php echo $str['copyright'];?> © <a href="../index.php" target="_blank"><?php echo $set->GetSettings(1);?></a> </td></tr>
</table>
</body>
</html>