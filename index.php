<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Bolt Stream</title>
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <section id="hero">

    <?php include("navbar.php") ?>

    <div class="hero-container" data-aos="zoom-in">
      <h1 class="mb-4 pb-0">Welcome to<br><span>Bolt</span> Stream</h1>
      <a href="signin.php" class="log-btn scrollto">Login</a>
    </div>
  </section>
  <main id="main">

    <!-- new movies -->

    <section id="new_mov" class="movie_card">
      <div class="section-header">
        <h2>New Movies</h2>
      </div>
      <div class="container mov_scroll" data-aos="fade-up">
        <div class="row">

          <?php
          $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");
          $query1 = "SELECT * FROM tbl_movies ORDER BY mov_id DESC LIMIT 10";
          
          $result = mysqli_query($con, $query1);
          while ($row = mysqli_fetch_array($result)) {

            $mov_img = $row['mov_poster'];
            $mov_name = $row['mov_name'];
            $mov_id = $row['mov_id'];
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

    <!-- Malayalam movies -->

    <section id="mal_mov" class="movie_card">
      <div class="section-header">
        <h2>Malayalam Movies</h2>
      </div>
      <div class="container mov_scroll" data-aos="fade-up">
        <div class="row">

          <?php
          $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");

          $query1 = "SELECT * FROM `tbl_movies` WHERE mov_language LIKE 'Malayalam%'";
          $result = mysqli_query($con, $query1);
          while ($row = mysqli_fetch_array($result)) {
            $mov_img = $row['mov_poster'];
            $mov_name = $row['mov_name'];
            $mov_id = $row['mov_id'];
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

    <!-- Tamil movies -->

    <section id="tam_mov" class="movie_card">
      <div class="section-header">
        <h2>Tamil Movies</h2>
      </div>
      <div class="container mov_scroll" data-aos="fade-up">
        <div class="row">

          <?php
          $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");

          $query1 = "SELECT * FROM `tbl_movies` WHERE mov_language LIKE 'Tamil%'";
          $result = mysqli_query($con, $query1);
          while ($row = mysqli_fetch_array($result)) {
            $mov_img = $row['mov_poster'];
            $mov_name = $row['mov_name'];
            $mov_id = $row['mov_id'];
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

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
<?php
$user_id = $_SESSION['usr_id'];
if ($user_id > 0) {
  echo ("<script>$('.log-btn').hide()</script>");

  $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");
  $query1 = "SELECT * FROM `tbl_usr_details` WHERE usr_id = '$user_id'";
  $result = mysqli_query($con, $query1);
  $row = mysqli_fetch_array($result);
  $_SESSION['user_type'] = $row['usr_type'];
  $pro_name = $row['usr_fname'] . ' ' . $row['usr_lname'];
  $pro_pic = $row['usr_pic'];
  $username = $row['usr_username'];

  echo ("<script>$('.usr_pro_pic').attr('src','./pro_pic/$pro_pic');</script>");
  echo ("<script>$('.user_name').text('$pro_name');</script>");
  echo ("<script>$('.username').text('@$username');</script>");
  if (isset($_POST['log_out'])) {
    session_destroy();
    unset($_SESSION['usr_id']);
    $url = "index.php";
    echo ("<script>location.href='$url'</script>");
  }
} else {
  echo ("<script>$('.profile-menu').hide()</script>");
}

// set movie id in section
?>

</html>