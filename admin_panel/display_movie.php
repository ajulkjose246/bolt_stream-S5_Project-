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
    <link rel="stylesheet" href="./bootstrap/css/bootstrap-grid.min.css">

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
                <div class="disp_mov my-5">
                    <form class="d-flex my-5" action="#" method="POST" role="search">
                        <input class="form-control me-2" name="search_val" type="search" placeholder="Search" aria-label="Search">
                        <!-- <button class="btn btn-outline-success" id="search_btn" name="search_btn" type="submit">Search</button> -->
                    </form>
                    <table class="table table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Director</th>
                            <th>Language</th>
                            <th>Date</th>
                            <th>Genre</th>
                            <th>IMDB</th>
                            <th>Server</th>
                            <th>Poster</th>
                            <th>Trailer</th>
                        </tr>
                        <?php
                        if (isset($_POST['search_val'])) {
                            $search_mov = $_POST['search_val'];
                        }
                        if (isset($_POST['reset_btn'])) {
                            $search_mov = "";
                        }
                            $sql_display_movie = "SELECT * FROM `tbl_movies` WHERE mov_name like '%$search_mov%'";
                            $display_movie_result = mysqli_query($con, $sql_display_movie);
                            while ($display_movie_row = mysqli_fetch_array($display_movie_result)) {
                        ?>
                                <tr>
                                    <td><?= $display_movie_row['mov_id'] ?></td>
                                    <td><?= $display_movie_row['mov_name'] ?></td>
                                    <td><?= $display_movie_row['mov_director'] ?></td>
                                    <td><?= $display_movie_row['mov_language'] ?></td>
                                    <td><?= $display_movie_row['mov_date'] ?></td>
                                    <td><?= $display_movie_row['mov_genre'] ?></td>
                                    <td><?= $display_movie_row['mov_imdb'] ?></td>
                                    <td><a class="btn btn-primary" href="<?= $display_movie_row['mov_server'] ?>" target="_blank">Load</a></td>
                                    <td><a class="btn btn-primary" href="<?= $display_movie_row['mov_poster'] ?>" target="_blank">Load</a></td>
                                    <td><a class="btn btn-primary" href="<?= $display_movie_row['mov_trailer'] ?>" target="_blank">Load</a></td>
                                </tr>
                        <?php }
                        
                        ?>
                    </table>
                    <div class="my-5" style="text-align:center;">
                        <a href="../admin_panel.php" class="btn btn-success">Home</a>
                        <a href="../admin_panel/display_movie.php" name="reset_btn" class="btn btn-primary">Reset</a>
                    </div>
                </div>

            </div>
        </main>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> -->
        <script src="../js/jquery-3.6.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../js/admin_panel.js"></script>

    </body>
<?php
}
?>
<!-- <script>
    $("#search_btn").click(function () {
        var text = $("#search_val").val();
        $.ajax({
            url: '../js/display_mov.php',
            type: 'post',
            data: {
                text: text
            },
            success: function(data) {
                var x =data;
                alert(x);
            }
        });
    })
</script> -->

</html>