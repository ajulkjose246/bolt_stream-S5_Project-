<?php
$val = $_GET['id'];
    $con = mysqli_connect("localhost", "root", "", "db_bolt_stream");
    $mysql1 = "DELETE FROM `tbl_usr_details` WHERE usr_id=$val";
    $mysql2 = "DELETE FROM `tbl_usr_login` WHERE id=$val";
    mysqli_query($con, $mysql1);
    mysqli_query($con, $mysql2);
    echo("<script>alert('Success')</script>");
    echo("<script>location.href='../admin_panel/delete_user.php'</script>");
?>