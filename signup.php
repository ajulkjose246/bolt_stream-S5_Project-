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
    <title>Register</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="./css/signup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<?php
  $user_id = $_SESSION['usr_id'];
  if ($user_id== null) {
?>
<body>
    <section class="background-radial-gradient overflow-hidden">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">Welcome to<br />
                        <span style="color: hsl(218, 81%, 75%)">Bolt Stream</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        Enjoy tons of originals and a huge catalog of hit TV series and blockbuster movies.
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-outline error">
                                            <label class="form-label" id="Errors"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example1">First name</label>
                                            <input type="text" id="fname" name="fname" class="form-control" />
                                            <label class="form-label error" id="f_error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example2">Last name</label>
                                            <input type="text" id="lname" name="lname" class="form-control" />
                                            <label class="form-label error" id="l_error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label">Password</label>
                                            <input type="password" id="pwd" name="pwd" class="form-control" />
                                            <label class="form-label error" id="p_error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" id="cpwd" name="cpwd" class="form-control" />
                                            <label class="form-label error" id="cp_error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example3">Email address <label class="form-label error" id="e_errors"></label></label>
                                            <input type="email" id="email" name="email" class="form-control">
                                            <label class="form-label error" id="e_error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label">Profile Pic</label>
                                            <input type="file" id="files" name="files" onchange="return fileValidation()" class="form-control" accept="image/*">
                                            <label class="form-label error" id="file_er"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="signup_btns">
                                    <button type="submit" id="signup" name="sign" class="btn btn-primary">Sign
                                        Up</button>
                                    <a href="index.php" class="btn btn-primary">Cancel</a>
                                </div>
                                <div class="text-center"><br>
                                    <a href="signin.php">Already have an account?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./js/signup.js"></script>

<script>
    function fileValidation() {
        var fileInput =document.getElementById('files');

        var filePath = fileInput.value;

        var allowedExtensions =/(\.jpg|\.jpeg|\.png|\.gif)$/i;

        if (!allowedExtensions.exec(filePath)) {
            $("#file_er").text("Invalid file type")
            $("#signup").prop('disabled', true);

            fileInput.value = '';
            return false;
        }
    }
</script>
<?php
if (isset($_POST['sign'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];
    $files = $_FILES['files']['name'];
    if ($pwd == $cpwd) {
        $org_pwd = $pwd;
    }
    if($fname != null && $lname != null && $email != null && $org_pwd != null && $files != null) {
        $con = mysqli_connect("localhost", "root", "", "db_bolt_stream") or die("Connection error");

        $string = strtolower($fname . $lname . ".");
        $user_fullname = preg_replace('/\s+/', '', $string);

        $query1 = "SELECT * FROM `tbl_usr_details`";
        $result = mysqli_query($con, $query1);
        while ($row = mysqli_fetch_array($result)) {
            if ($email == $row['usr_email']) {
                $flag = 0;
                echo ("<script>$('#Errors').text('Email id already exists');</script>");
                exit();
            } else if ($email != $row['usr_email']) {
                $flags = 1;
            }
        }
        if ($flags = 1) {
            $query1 = "INSERT INTO `tbl_usr_login`(`usr_email`, `usr_pswd`) VALUES ('$email','$org_pwd')";
            mysqli_query($con, $query1);
            $usr_id = mysqli_insert_id($con);
            $username = $user_fullname . $usr_id;
            $query2 = "INSERT INTO `tbl_usr_details`(`usr_id`,`usr_fname`, `usr_lname`, `usr_email`, `usr_username`, `usr_pic`,`usr_type`) VALUES ('$usr_id','$fname','$lname','$email','$username','$files','0')";
            mysqli_query($con, $query2);
            $targetdir = "pro_pic/";
            $file_path = $targetdir . basename($files);
            move_uploaded_file($_FILES['files']['tmp_name'], $file_path);
            $yourURL = "signin.php";
            echo ("<script>location.href='$yourURL'</script>");
        }
    }
}
} else {
    $url = "index.php";
    echo ("<script>location.href='$url'</script>");
  }
?>
<script>
    var ajax = new XMLHttpRequest();
    ajax.open
</script>

</html>