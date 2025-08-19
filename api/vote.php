<?php
session_start();
include('connect.php');

// Check if the user is logged in
if (!isset($_SESSION['userdata']['id'])) {
    echo '<script>alert("Error: User ID is missing from session!"); window.location.href="../Routes/dashboard.php";</script>';
    exit;
}

// Check if the group ID was submitted via the form
if (!isset($_POST['gid']) || empty($_POST['gid'])) {
    echo '<script>alert("Error: Group ID is missing from the form!"); window.location.href="../Routes/dashboard.php";</script>';
    exit;
}

$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];

// Sanitize the input to prevent SQL injection
$gid = mysqli_real_escape_string($connect, $gid);
$uid = mysqli_real_escape_string($connect, $uid);

// Begin a database transaction for safe updates
mysqli_begin_transaction($connect);

try {
    // Increment the vote count for the specific group
    $update_votes_query = "UPDATE user SET votes = votes + 1 WHERE id='$gid' AND role=2";
    $update_votes = mysqli_query($connect, $update_votes_query);

    // Update the user's status to 1
    $update_user_status_query = "UPDATE user SET status=1 WHERE id='$uid'";
    $update_user_status = mysqli_query($connect, $update_user_status_query);

    // Check if both queries were successful
    if ($update_votes && $update_user_status) {
        // Commit the transaction
        mysqli_commit($connect);

        // Fetch the FRESH user data and groups data from the database
        $user_check_query = "SELECT * FROM user WHERE id='$uid'";
        $user_check = mysqli_query($connect, $user_check_query);
        $userdata_fresh = mysqli_fetch_assoc($user_check);

        $groups_query = "SELECT * FROM user WHERE role=2";
        $groups = mysqli_query($connect, $groups_query);
        $groupsdata_fresh = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        // Update the session with the fresh data
        $_SESSION['userdata'] = $userdata_fresh;
        $_SESSION['groupsdata'] = $groupsdata_fresh;
        
        echo '<script>alert("VOTING SUCCESSFUL!");
         window.location.href="../Routes/dashbord.php";</script>';
        exit;
    } else {
        // Rollback the transaction on failure
        mysqli_rollback($connect);
        echo '<script>alert("SOME ERROR OCCURRED! PLEASE TRY AGAIN");
         window.location.href="../Routes/dashboard.php";</script>';
        exit;
    }
} catch (Exception $e) {
    // Rollback the transaction on a general error
    mysqli_rollback($connect);
    echo '<script>alert("Error: ' . $e->getMessage() . '"); window.location.href="../Routes/dashboard.php";</script>';
    exit;
}
?>