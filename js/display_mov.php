<?php
if(isset($_POST['text'])){
    $con = mysqli_connect("localhost", "root", "","db_bolt_stream");
    $text = $_POST['text'];
    $query = "SELECT* FROM `tbl_movies` WHERE mov_name like '%$text%'";
    
    $result = mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
        $values= $row['mov_id'];
        echo$values;
    
    // $count = mysqli_num_rows($result);
    // echo mysqli_num_rows($result);
}
?>