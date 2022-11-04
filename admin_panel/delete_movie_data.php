<?php
$val = $_GET['id'];
    $con = mysqli_connect("localhost", "root", "", "db_bolt_stream");
    $mysql = "DELETE FROM `tbl_movies` WHERE mov_id=$val";
    mysqli_query($con, $mysql);
    echo("<script>alert('Success')</script>");
    echo("<script>location.href='../admin_panel/delete_movie.php'</script>");
?>