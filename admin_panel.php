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

  <link rel="stylesheet" href="./css/admin_panel.css">
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
        <div class="home_div">
          <div class="row my-5">
            <div class="col-sm-6 col-md-6 col-lg-3 ">
              <div class="card-counter info">
                <i class="fa fa-users"></i>
                <span class="count-numbers"><?= $count_row['users'] ?></span>
                <span class="count-name">Users</span>
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
              <div class="card-counter primary">
                <i class="fa fa-film"></i>
                <span class="count-numbers"><?= $count_mov_row['movies'] ?></span>
                <span class="count-name">Movies</span>
              </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-3">
              <div class="card-counter danger">
                <i class="fa fa-eye"></i>
                <span class="count-numbers">599</span>
                <span class="count-name">Viwers</span>
              </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-3">
              <div class="card-counter success">
                <i class="fa fa-bug"></i>
                <span class="count-numbers">10</span>
                <span class="count-name">Error Report</span>
              </div>
            </div>
          </div>
          <div class="row">
            <h4 class="d-flex justify-content-start my-2"><b>Movie</b></h4>
            <div class="col-sm-6 col-md-6 col-lg-3 upld_movies_btn">
              <div class="card-counter btns primary">
                <i class="fa fa-cloud-upload"></i>
                <span class="count-name">Upload Movies</span>
              </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-3 disp_movies_btn">
              <div class="card-counter btns info">
                <i class="fa fa-television"></i>
                <span class="count-name">Display Movies</span>
              </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-3 delete_movies_btn">
              <div class="card-counter btns danger">
                <i class="fa fa-trash-o"></i>
                <span class="count-name">Delete Movies</span>
              </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-3 update_movies_btn">
              <div class="card-counter btns success">
                <i class="fa fa-wrench"></i>
                <span class="count-name">Update Movies</span>
              </div>
            </div>
          </div>
          <div class="row my-5">
            <h4 class="d-flex justify-content-start my-2"><b>User</b></h4>
            <div class="col-sm-6 col-md-6 col-lg-3">
              <div class="card-counter btns primary">
                <i class="fa fa-television"></i>
                <span class="count-name">Display Users</span>
              </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-3">
              <div class="card-counter btns danger">
                <i class="fa fa-trash-o"></i>
                <span class="count-name">Delete User</span>
              </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-3">
              <div class="card-counter btns success">
                <i class="fa fa-wrench"></i>
                <span class="count-name">Update User</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./js/admin_panel.js"></script>

  </body>
<?php
}
?>

</html>