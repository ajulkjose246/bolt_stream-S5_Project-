<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <h3 style="text-align: center;">Update User</h3>
    <form action="#" method="POST">
        <table>
            <tr>
                <th>User Type</th>
                <td><select class="form-control" name="user_type">
                    <option value="0">Normal</option>
                    <option value="1">Admin</option>
                </select></td>
            </tr>
            <tr>
                <td><input type="submit" class="form-control" name="sub" value="Submit"></td>
            </tr>
        </table>
    </form>
</body>
<?php
$val = $_GET['id'];
if (isset($_POST['sub'])) {
    $user_type = $_POST['user_type'];
        $con = mysqli_connect("localhost", "root", "", "db_bolt_stream");
        $mysql = "UPDATE `tbl_usr_details` SET `usr_type`='$user_type' WHERE usr_id=$val";
        mysqli_query($con, $mysql);
        echo ("<script>alert('Success')</script>");
        echo("<script>location.href='../admin_panel.php'</script>");
    
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</html>