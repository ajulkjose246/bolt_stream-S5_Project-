<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="shortcut icon" href="./img/favicon.svg" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<?php
$user_type = $_SESSION['user_type'];
if ($user_type==1) {
?>
<body>
    <section class="register-sec">
        <div class="register-div">
            <div class="container">

                <div class="row my-5 justify-content-center">
                    <div class="cre-acc col-12 col-sm-12 col-lg-6">
                        <form class="row g-3 needs-validation" action="#" method="POST" novalidate>
                            <div class="col-md-12">
                                <label class="form-label">Movie Name</label>
                                <input type="text" class="form-control" name="mov_name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Director</label>
                                <input type="text" class="form-control" name="mov_dir">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Language</label>
                                <input type="text" class="form-control" name="mov_language">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Release Date</label>
                                <input type="text" class="form-control" name="mov_date">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Server Id</label>
                                <input type="text" class="form-control" name="mov_ser_id">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Genre</label>
                                <input type="text" class="form-control" name="mov_genre">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">IMDB Rating</label>
                                <input type="text" class="form-control" name="mov_imdb">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" name="mov_bio"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Image Url</label>
                                <textarea class="form-control" name="mov_img"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Trailer</label>
                                <textarea class="form-control" name="mov_trailer"></textarea>
                            </div>
                            <div class="col-12">
                                <button name="upload_btn" class="btn btn-primary">Upload</button>
                                <input type="reset" value="Reset" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
if (isset($_POST['upload_btn'])) {
    $mov_name = $_POST['mov_name'];
    $mov_dir = $_POST['mov_dir'];
    $mov_language = $_POST['mov_language'];
    $mov_date = $_POST['mov_date'];
    $mov_ser_id = $_POST['mov_ser_id'];
    $mov_genre = $_POST['mov_genre'];
    $mov_imdb = $_POST['mov_imdb'];
    $mov_bio = $_POST['mov_bio'];
    $mov_img = $_POST['mov_img'];
    $mov_trailer = $_POST['mov_trailer'];
    if ($mov_name != null && $mov_dir != null && $mov_language != null && $mov_date != null && $mov_ser_id != null && $mov_genre != null && $mov_bio != null && $mov_img != null && $mov_trailer != null && $mov_imdb != null) {
        $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");
        $sql="INSERT INTO `tbl_movies`(`mov_name`, `mov_director`, `mov_language`, `mov_date`, `mov_server`, `mov_genre`, `mov_imdb`, `mov_bio`, `mov_poster`, `mov_trailer`) 
        VALUES ('$mov_name','$mov_dir','$mov_language','$mov_date','$mov_ser_id','$mov_genre','$mov_imdb','$mov_bio','$mov_img','$mov_trailer')";
        mysqli_query($con,$sql);
    }
}
}else{
  echo ("<script>location.href='index.php'</script>");

}
?>

</html>