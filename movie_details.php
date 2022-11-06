<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>

<head>
    <link rel="shortcut icon" href="./img/favicon.svg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/mov_main.css">

</head>

<body>

    <section class="movie-stream-sec">
        <?php
        $user_id = $_SESSION['usr_id'];
        $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");

        $query1 = "SELECT * FROM `tbl_usr_details` WHERE usr_id = '$user_id'";
        $result = mysqli_query($con, $query1);
        $row = mysqli_fetch_array($result);
        $pro_name = $row['usr_fname'] . ' ' . $row['usr_lname'];
        ?>
        <nav class="navbar navbar-expand-lg bg-color">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="./img/logo.png"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./movie_watch_later.php">Watch Later</a>
                        </li>
                    </ul>
                    <form action="#" method="POST">
                        <a href="signin.php" class="log-btn scrollto">Login</a>

                        <div class="profile-menu">
                            <div class="action">
                                <img class="usr_pro_pic" src="./pro_pic/<?= $row['usr_pic'] ?>" />
                            </div>
                            <div class="menu">
                                <div class="profile">
                                    <img class="usr_pro_pic" src="./pro_pic/<?= $row['usr_pic'] ?>" />
                                    <div class="info">
                                        <h2 class="user_name"><?= $pro_name ?></h2>
                                        <p class="username">@<?= $row['usr_username'] ?></p>
                                    </div>
                                </div>
                                <ul>
                                    <li>
                                        <i class="bi bi-person"></i>
                                        <a href="user_profile.php"> Account</a>
                                    </li>
                                    <li>
                                        <i class="bi bi-box-arrow-in-right"></i>
                                        <button class="log_out" name="log_out"> Log out</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <?php
        $movie_id = $_COOKIE['mov_id'];
        $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");

        $query1 = "SELECT * FROM `tbl_movies` WHERE mov_id = '$movie_id'";
        $result = mysqli_query($con, $query1);
        $row = mysqli_fetch_array($result);

        ?>
        <div class="movie-stream-div">
            <iframe id="movie_url" src="<?= $row['mov_server'] ?>" width="100%" height="490px" allowfullscreen="allowfullscreen"></iframe>
        </div>
        <div class="container">

            <form action="#" method="POST">
                <div class="row movie-details-row">
                    <div class="col-4 col-sm-2">
                        <div class="movie-img">
                            <img id="image-1" src="<?= $row['mov_poster'] ?>" alt="">
                        </div>
                    </div>
                    <div class="col-8 col-sm-10">
                        <div class="movie-details">
                            <span class="movie-name" id="movie_names"><?= $row['mov_name'] ?> <?= $row['mov_language'] ?></span>
                            <button class="btn btn-outline-primary" name="watch_later_btn"><i class="bi bi-clock"></i> Watch Later</button><br>
                            <a id="movie_trailer" href="<?= $row['mov_trailer'] ?>" target="_blank">
                                <i class="bi bi-camera-video-fill"></i> Trailer </a>
                            <i class="bi bi-star-fill"></i><span class="imdb_rating">IMDB <?= $row['mov_imdb'] ?></span><br>

                            <br><span id="movie_bio"><?= $row['mov_bio'] ?></span><br><br>
                            <span>
                                <table>
                                    <tr>
                                        <th>Director : </th>
                                        <td id="movie_director"><?= $row['mov_director'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Genre : </th>
                                        <td id="movie_Genre"><?= $row['mov_genre'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Release : </th>
                                        <td id="movie_Release"><?= $row['mov_date'] ?></td>
                                    </tr>
                                </table>
                                <?php
                                if (isset($_POST['watch_later_btn'])) {
                                    $values = $_SESSION['watch_later_id'];
                                    $movie_ids = explode(" ", $values);
                                    foreach ($movie_ids as $mov_id) {
                                        if ($row['mov_id'] == $mov_id) {
                                            $temp = 1;
                                        }
                                    }
                                    if ($temp == 1) {
                                        echo ("<script>alert('Already added')</script>");
                                    } else {
                                        $_SESSION['watch_later_id'] = $_SESSION['watch_later_id'] . " " . $row['mov_id'];
                                        echo ("<script>alert('successfully added')</script>");
                                    }
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

<?php
$user_id = $_SESSION['usr_id'];
// echo ("<script>$('.profile-menu').hide()</script>");

if ($user_id > 0) {
    echo ("<script>$('.log-btn').hide()</script>");

    if (isset($_POST['log_out'])) {
        session_destroy();
        unset($_SESSION['usr_id']);
        $url = "movie_details.php";
        echo ("<script>location.href='$url'</script>");
    }
} else {
    echo ("<script>$('.profile-menu').hide()</script>");
}

?>

<!-- JavaScript -->
<script src="./js/main.js"></script>




</html>