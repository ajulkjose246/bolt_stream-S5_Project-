<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Profile</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./css/user_profile.css">
</head>
<?php
$user_id = $_SESSION['usr_id'];
if ($user_id > 0) {
?>

  <body>
    <section>
      <form action="#" method="POST" enctype="multipart/form-data">

        <div class="container">
          <div class="main-body">
            <nav aria-label="breadcrumb" class="main-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
              </ol>
            </nav>
            <div class="row gutters-sm">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="usr_pro_pic upd_img" width="150">
                      <div class="mt-3">
                        <h4 class="user_name"></h4>
                        <p class="text-muted font-size-sm user_email"></p>
                        <button class="btn btn-danger logout_btn" name="logout_btn">Logout</button>
                      </div>


                      <i class="bi bi-camera-fill edit_img upd_img"></i>
                      <input type="file" id="imgupload" name="upld_file" accept="image/*" style="display:none">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">First Name</h6>
                      </div>
                      <input class="col-sm-9 text-secondary user_fname form-control" id="fname" name="fname" type="text" disabled>
                      <label class="form-label error" id="f_error"></label>

                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Last Name</h6>
                      </div>
                      <input class="col-sm-9 text-secondary user_lname form-control" id="lname" name="lname" type="text" disabled>
                      <label class="form-label error" id="l_error"></label>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email<label class="form-label error" id="e_errors"></label></h6>
                      </div>
                      <input class="col-sm-9 text-secondary user_email form-control" id="email" name="email" type="text" disabled>
                      <label class="form-label error" id="e_error"></label>

                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Username<label class="form-label error" id="e_errorss"></label></h6>
                      </div>
                      <input class="col-sm-9 text-secondary user_username form-control" id="username" name="username" type="text" disabled>
                      <label class="form-label error" id="u_error"></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info edit_data" href="#">Edit</a>
                      <a class="btn btn-info admin_panel" href="./admin_panel.php">Admin Panel</a>
                      <button class="btn btn-info update_data" name="update_data" href="#">Update</button>
                      <button class="btn btn-info cancel_btn" href="user_profile.php">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
        </div>
      </form>
    </section>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/user_profile.js"></script>
  </body>
<?php

  $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");
  $query1 = "SELECT * FROM `tbl_usr_details` WHERE usr_id = '$user_id'";
  $result = mysqli_query($con, $query1);
  $row = mysqli_fetch_array($result);
  $usr_type = $_SESSION['user_type'];
  if ($usr_type == 1) {
    echo ("<script>$('.admin_panel').show();</script>");
  }else{
    echo ("<script>$('.admin_panel').hide();</script>");
  }
  $pro_fname = $row['usr_fname'];
  $pro_lname = $row['usr_lname'];
  $user_email = $row['usr_email'];
  $user_username = $row['usr_username'];
  $pro_pic = $row['usr_pic'];

  $pro_name = $row['usr_fname'] . ' ' . $row['usr_lname'];
  echo ("<script>$('.user_name').text('$pro_name')</script>");
  echo ("<script>$('.user_email').text('$user_email')</script>");

  echo ("<script>$('.usr_pro_pic').attr('src','./pro_pic/$pro_pic');</script>");
  echo ("<script>$('.user_fname').attr('value','$pro_fname');</script>");
  echo ("<script>$('.user_lname').attr('value','$pro_lname');</script>");
  echo ("<script>$('.user_email').attr('value','$user_email');</script>");
  echo ("<script>$('.user_username').attr('value','$user_username');</script>");
} else {
  $url = "index.php";
  echo ("<script>location.href='$url'</script>");
}
?>
<?php
if (isset($_POST['update_data'])) {
  $usr_fname = $_POST['fname'];
  $usr_lname = $_POST['lname'];
  $usr_email = $_POST['email'];
  $usr_username = $_POST['username'];
  $files_img = $_FILES['upld_file']['name'];
  if ($files_img == null) {
    $files_img = $row['usr_pic'];
  }
  if($usr_fname !="" && $usr_lname !="" && $usr_email!="" && $usr_username != ""){
    $query2 = "UPDATE `tbl_usr_details` SET `usr_fname`='$usr_fname',`usr_lname`='$usr_lname',`usr_email`='$usr_email',`usr_username`='$usr_username',`usr_pic`='$files_img' WHERE usr_id =$user_id";
    $query3 = "UPDATE `tbl_usr_login` SET `usr_email`='$usr_email' WHERE id =$user_id";
    mysqli_query($con, $query2);
    mysqli_query($con, $query3);
    $targetdir = "pro_pic/";
    $file_path = $targetdir . $files_img;
    move_uploaded_file($_FILES['upld_file']['tmp_name'], $file_path);
    echo ("<script>location.href='user_profile.php'</script>");
  }
}
if (isset($_POST['logout_btn'])) {
  session_destroy();
  unset($_SESSION['usr_id']);
  $url = "index.php";
  echo ("<script>location.href='$url'</script>");
}
?>
<script>
  $(document).ready(function(){

    $(".update_data").hide();
    $(".edit_img").hide();
    $(".cancel_btn").hide();
    $(".usr_pro_pic").removeClass("upd_img");
    $(".edit_data").click(function() {
      $(".user_fname").prop("disabled", false);
      $(".user_lname").prop("disabled", false);
      $(".user_email").prop("disabled", false);
      $(".user_username").prop("disabled", false);
      $(".update_data").show();
      $(".edit_data").hide();
      $(".usr_pro_pic").addClass("upd_img");
      $(".edit_img").show();
      $(".cancel_btn").show();
      $(".admin_panel").hide();
      $(".logout_btn").hide();
  
      $('.upd_img').click(function() {
        $('#imgupload').trigger('click');
      });
    })
  })
</script>


</html>