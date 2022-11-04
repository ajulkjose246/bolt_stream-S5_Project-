<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/movie_search.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
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
    <section id="new_mov" class="movie_card">
        <div class="section-header">
            <form class="d-flex mx-5 search_bar" action="#" method="POST" role="search">
                <input class="form-control me-2" name="search_val" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" id="search_btn" name="search_btn" type="submit">Search</button>
            </form>
        </div>
        <div class="container mov_scroll" data-aos="fade-up">
            <div class="row">

                <?php
                $search_mov = "";
                if (isset($_POST['search_btn'])) {
                    $search_mov = $_POST['search_val'];
                }
                if (isset($_POST['reset_btn'])) {
                    $search_mov = "";
                }
                $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");
                $sql_display_movie = "SELECT * FROM `tbl_movies` WHERE mov_name like '%$search_mov%'";
                $display_movie_result = mysqli_query($con, $sql_display_movie);
                while ($display_movie_row = mysqli_fetch_array($display_movie_result)) {
                    $mov_img = $display_movie_row['mov_poster'];
                    $mov_name = $display_movie_row['mov_name'];
                    $mov_id = $display_movie_row['mov_id'];
                    echo ("<div class='$mov_id col-lg-2 mov_data col-md-6'>");
                    echo ("<div class='movie' data-aos='fade-up' data-aos-delay='100'>");
                    echo ("<a href='movie_details.php?$mov_name'><img src='$mov_img' class='img-fluid'></a>");
                    echo ("</div>");
                    echo ("<div class='details'>");
                    echo ("<h3><a href='movie_details.php?$mov_name'>$mov_name</a></h3>");
                    echo ("</div>");
                    echo ("</div>");
                ?>
                    <script>
                        $(".<?= $mov_id ?>").click(function() {
                            localStorage.setItem("abc", "<?= $mov_id ?>");
                            document.cookie = "mov_id=<?= $mov_id ?>";
                        })
                    </script>
                <?php
                }
                ?>
            </div>
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
        $url = "movie_search.php";
        echo ("<script>location.href='$url'</script>");
    }
} else {
    echo ("<script>$('.profile-menu').hide()</script>");
}

?>
<script src="js/main.js"></script>

</html>