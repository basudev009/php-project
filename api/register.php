<?php
include("connect.php");

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];
$email = $_POST['email'];

if ($password == $cpassword) {
    move_uploaded_file($tmp_name, "../uploads/$image");
    $insert = mysqli_query($connect, "INSERT INTO user(name, mobile, password, address, email, photo, role, status, votes) VALUES ('$name', '$mobile', '$password', '$address', '$email', '$image', '$role', 0, 0)");
    if ($insert) {
        echo '<script>alert("REGISTRATION SUCCESSFUL"); window.location.href="../";</script>';
    } else {
        echo '<script>alert("SOME ERROR OCCURRED! PLEASE TRY AGAIN"); window.location.href="../Routes/register.html";</script>';
    }
} else {
    echo '<script>alert("Password not match"); window.location.href="../Routes/register.html";</script>';
}
?>