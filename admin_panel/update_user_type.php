<?php

use function PHPSTORM_META\elementType;

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
            <form action="#" method="POST">
                <div class="sidenav d-flex flex-column flex-shrink-0 p-3 bg-light">

                    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <i class="fa fa-cogs fa-3x"></i>
                        <span class="fs-4 side_text"><b>Admin Panel</b></span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="../admin_panel.php" class="nav-link active" aria-current="page">
                                <i class="fa fa-home"></i>
                                <span class="side_text">Home</span>

                            </a>
                        </li>
                        <li>
                            <a href="../index.php" class="nav-link link-dark">
                                <i class="fa fa-chrome"></i>
                                <span class="side_text">Web Page</span>
                            </a>
                        </li>

                    </ul>
                    <hr>

                    <button class="btn btn-danger" name="log_out_btn">Logout</button>
                </div>
            </form>

            <div class="page_divider"></div>

            <div class="container sub_body">
                <div class="disp_mov my-5">
                    <form class="d-flex my-5" action="#" method="POST" role="search">
                        <input class="form-control me-2" name="search_val" type="search" placeholder="Search" aria-label="Search">
                        <!-- <button class="btn btn-outline-success" id="search_btn" name="search_btn" type="submit">Search</button> -->
                    </form>
                    <table class="table table-striped">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>User Type</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        if (isset($_POST['search_val'])) {
                            $search_user = $_POST['search_val'];
                        }
                        if (isset($_POST['reset_btn'])) {
                            $search_mov = "";
                        }
                        $sql_display_user = "SELECT * FROM `tbl_usr_details` WHERE usr_fname like '%$search_user%'";
                        $display_user_result = mysqli_query($con, $sql_display_user);
                        while ($display_user_row = mysqli_fetch_array($display_user_result)) {
                        ?>
                            <tr>
                                <td><?= $display_user_row['usr_fname'] ?></td>
                                <td><?= $display_user_row['usr_lname'] ?></td>
                                <td><?= $display_user_row['usr_email'] ?></td>
                                <td><?= $display_user_row['usr_username'] ?></td>
                                <td><?= $display_user_row['usr_type'] ?></td>
                                <?php
                                if ($user_id == $display_user_row['usr_id']) {?>
                                    <td><b>Current User</b></td>
                                    <?php }

                                elseif ($display_user_row['usr_type'] == 1) {
                                ?>
                                    <td><a class="btn btn-danger" href="../admin_panel/update_user_type_normal.php?id=<?= $display_user_row['usr_id'] ?>">Normal</a></td>
                                <?php
                                } elseif ($display_user_row['usr_type'] == 0) {
                                ?>
                                    <td><a class="btn btn-danger" href="../admin_panel/update_user_type_admin.php?id=<?= $display_user_row['usr_id'] ?>">Admin</a></td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <div class="my-5" style="text-align:center;">
                        <a href="../admin_panel.php" class="btn btn-success">Home</a>
                        <a href="../admin_panel/delete_user.php" name="reset_btn" class="btn btn-primary">Reset</a>
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
    if (isset($_POST['log_out_btn'])) {
        session_destroy();
        unset($_SESSION['usr_id']);
        $url = "../index.php";
        echo ("<script>location.href='$url'</script>");
    }
} else {
    echo ("<script>location.href='../index.php'</script>");
}
?>

</html>