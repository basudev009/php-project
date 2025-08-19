<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}
include("../api/connect.php");

// Fetch all groups (role=2)
$result = mysqli_query($connect, "SELECT * FROM user WHERE role=2");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Groups Data</title>
    <style>
        /* General Body and Layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 2em;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        /* Table Styling */
        table {
            width: 90%;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9f2ff;
        }

        /* Image Styling */
        img {
            border-radius: 50%;
            border: 2px solid #3498db;
            transition: transform 0.3s ease;
        }

        img:hover {
            transform: scale(1.1);
        }

        /* Log-out Link */
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        a:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
    </style>
</head>
<body>
    <h2>Groups Data</h2>
    <table border="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Group Name</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Votes</th>
                <th>Party Logo</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['votes']); ?></td>
                <td>
                    <?php if (!empty($row['photo'])): ?>
                        <img src="../uploads/<?php echo htmlspecialchars($row['photo']); ?>" width="70" height="70" alt="Party Logo">
                    <?php endif; ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <a href="../admin/admin_logout.php">Log Out</a>
</body>
</html>