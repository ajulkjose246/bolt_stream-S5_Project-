<?php
$val = $_GET['id'];
    $con = mysqli_connect("localhost", "root", "", "db_bolt_stream");
    $mysql = "UPDATE `tbl_usr_details` SET `usr_type`='1' WHERE usr_id=$val";
    mysqli_query($con, $mysql);
    echo("<script>location.href='../admin_panel/update_user_type.php'</script>");
?>