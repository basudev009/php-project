<?php
session_start();
include("connect.php");

// Sanitize inputs to prevent SQL injection
$mobile = mysqli_real_escape_string($connect, $_POST["mobile"]);
$password = mysqli_real_escape_string($connect, $_POST["password"]);
$role = mysqli_real_escape_string($connect, $_POST["role"]);

// Check if the user exists
$check_query = "SELECT * FROM user WHERE mobile='$mobile' AND password='$password' AND role='$role'";
$check = mysqli_query($connect, $check_query);

if (mysqli_num_rows($check) > 0) {
    $userdata = mysqli_fetch_assoc($check);
    
    // Fetch all groups (users with role=2)
    $groups_query = "SELECT * FROM user WHERE role=2";
    $groups = mysqli_query($connect, $groups_query);
    
    // Check if the query was successful
    if ($groups) {
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    } else {
        // If the query failed, log the error and set groupsdata to an empty array
        error_log("Failed to fetch groups: " . mysqli_error($connect));
        $groupsdata = [];
    }
    
    // Store user and group data in the session
    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupsdata'] = $groupsdata;
    
    // Redirect to dashboard
    echo '<script>window.location.href="../Routes/dashbord.php";</script>';
    exit;
} else {
    // Invalid credentials
    echo '<script>alert("Invalid mobile number or password"); window.location.href="../";</script>';
    exit;
}
?>