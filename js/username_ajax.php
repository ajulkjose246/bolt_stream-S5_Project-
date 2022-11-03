<?php
if(isset($_POST['u_name'])){
    $con = mysqli_connect("localhost", "root", "","db_bolt_stream");
    $u_name = $_POST['u_name'];
    $query = "select * from tbl_usr_details  where usr_username='".$u_name."'";
    
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);
    echo mysqli_num_rows($result);
}
?>