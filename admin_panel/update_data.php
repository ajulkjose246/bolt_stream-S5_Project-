<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bolt Stream</title>
    <!-- CSS only -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap-grid.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <link rel="stylesheet" href="../css/admin_panel.css">
    </style>
</head>
<?php
$user_id = $_SESSION['usr_id'];
if ($user_id > 0) {
    $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");
    // total user count
    $sql_count = "SELECT COUNT(*) AS users FROM `tbl_usr_details`";
    $count_result = mysqli_query($con, $sql_count);
    $count_row = mysqli_fetch_array($count_result);
    // total movies count
    $sql_mov_count = "SELECT COUNT(*) AS movies FROM `tbl_movies`";
    $count_mov_result = mysqli_query($con, $sql_mov_count);
    $count_mov_row = mysqli_fetch_array($count_mov_result);
?>

    <body>

        <main class="d-flex flex-nowrap">
            <!-- <section> -->
            <!-- <h1 class="visually-hidden">Sidebars examples</h1> -->
            <div class="sidenav d-flex flex-column flex-shrink-0 p-3 bg-light">
                <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <i class="fa fa-cogs fa-3x"></i>
                    <span class="fs-4 side_text"><b>Admin Panel</b></span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" aria-current="page">
                            <i class="fa fa-home"></i>
                            <span class="side_text">Home</span>

                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <i class="fa fa-users"></i>
                            <span class="side_text">User Details</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <i class="fa fa-film"></i>
                            <span class="side_text">Movie Details</span>
                        </a>
                    </li>

                </ul>
                <hr>
                <button class="btn btn-danger">Logout</button>
            </div>

            <div class="page_divider"></div>

            <div class="container sub_body">

                <div class="upld_movies">
                    <div class="row my-5 justify-content-center">
                        <h3>Update Movie</h3>
                        <?php
                        $val = $_GET['id'];
                        $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");
                        $sql = "SELECT * FROM tbl_movies WHERE mov_id='$val'";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        ?>
                        <div class="cre-acc col-12 col-sm-12 col-lg-6">
                            <form class="row g-3 needs-validation" action="#" method="POST" novalidate>
                                <div class="col-md-12">
                                    <label class="form-label">Movie Name</label>
                                    <input type="text" class="form-control" value="<?= $row['mov_name'] ?>" name="mov_name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Director</label>
                                    <input type="text" class="form-control" value="<?= $row['mov_director'] ?>" name="mov_dir">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Language</label>
                                    <!-- <input type="text" class="form-control" name="mov_language"> -->
                                    <select class="form-control" value="<?= $row['mov_language'] ?>" name="mov_language">
                                        <option value="english">English</option>
                                        <option value="malayalam">Malayalam</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="hindi">Hindi</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Release Date</label>
                                    <input type="date" class="form-control" value="<?= $row['mov_date'] ?>" name="mov_date">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Server Id</label>
                                    <input type="text" class="form-control" value="<?= $row['mov_server'] ?>" name="mov_ser_id">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Genre</label>
                                    <input type="text" class="form-control" value="<?= $row['mov_genre'] ?>" name="mov_genre">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">IMDB Rating</label>
                                    <input type="number" class="form-control" value="<?= $row['mov_imdb'] ?>" name="mov_imdb">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Bio</label>
                                    <textarea class="form-control" name="mov_bio"><?= $row['mov_bio'] ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Image Url</label>
                                    <textarea class="form-control" name="mov_img"><?= $row['mov_poster'] ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Trailer</label>
                                    <textarea class="form-control" name="mov_trailer"><?= $row['mov_trailer'] ?></textarea>
                                </div>
                                <div class="col-12">
                                    <button name="update_btn" class="btn btn-success">Update</button>
                                    <a href="../admin_panel.php" class="btn btn-primary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> -->
        <script src="../js/jquery-3.6.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="./js/admin_panel.js"></script>

    </body>
<?php
    // movie update php start
    if (isset($_POST['update_btn'])) {
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
            $sql = "UPDATE `tbl_movies` SET `mov_name`='$mov_name',`mov_director`='$mov_dir',`mov_language`='$mov_language',`mov_date`='$mov_date',`mov_server`='$mov_ser_id',`mov_genre`='$mov_genre',`mov_imdb`='$mov_imdb',`mov_bio`='$mov_bio',`mov_poster`='$mov_img',`mov_trailer`='$mov_trailer' WHERE mov_id='$val'";
            mysqli_query($con, $sql);
            echo ("<script>location.href='../admin_panel/update_movie.php'</script>");
        }else{
            echo ("<script>alert('Enter full details')</script>");
        }
    }
    // movie update php end
}
?>

</html>