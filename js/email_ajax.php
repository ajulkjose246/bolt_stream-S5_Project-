<?php
if(isset($_POST['email'])){
    $con = mysqli_connect("localhost", "root", "","db_bolt_stream");
    $email = $_POST['email'];
    $query = "select * from tbl_usr_details  where usr_email='".$email."'";
    
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);
    echo mysqli_num_rows($result);
}
?>