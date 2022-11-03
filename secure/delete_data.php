<?php
$val = $_GET['id'];
    $con = mysqli_connect("localhost", "root", "", "db_bolt_stream");
    $mysql = "DELETE FROM `tbl_usr_details` WHERE usr_id=$val";
    $mysql1 = "DELETE FROM `tbl_usr_login` WHERE id=$val";
    mysqli_query($con, $mysql);
    mysqli_query($con, $mysql1);
    echo("<script>alert('Success')</script>");
    echo("<script>location.href='../admin_panel.php'</script>");
?>