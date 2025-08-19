<?php
// Database connection
$connect  = mysqli_connect("localhost","root","","voting")or die("Connection failed: ");


if ($connect) {
    echo "Connected successfully";

} else {
    echo "Connection failed";
}
?>