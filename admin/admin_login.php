<?php

session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Hardcoded admin credentials
    $admin_user = 'admin';
    $admin_pass = 'admin123';

    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
        $_SESSION['admin'] = true;
        header('Location: admin_panel.php');
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

</head>
<body>
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Admin Username" required><br><br>
        <input type="password" name="password" placeholder="Admin Password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>