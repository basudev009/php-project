<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header("location: ../");
    exit;
}

$userdata = $_SESSION["userdata"];
$groupsdata = $_SESSION["groupsdata"];

$status = ($_SESSION['userdata']['status'] == 0) ? '<b style="color:red">Not Voted</b>' : '<b style="color:green">Voted</b>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheett.css">
</head>
<body>
    <div id="mainSection">
        <div id="headerSection">
            <a href="#" onclick="window.history.back()"><button id="backbtn">Back</button></a>
            <h1>online voting system</h1>
            <a href="../Routes/logout.php"><button id="logoutbtn">Logout</button></a>
        </div>
        <hr>
        <div id="mainpanel">
            <div id="Profile">
                <center><img id="pic" src="../uploads/<?php echo htmlspecialchars($userdata['photo']) ?>"></center> <br><br>
                <h3>
                    <b>Name:</b> <?php echo htmlspecialchars($userdata['name'])?><br><br>
                    <b>Mobile:</b> <?php echo htmlspecialchars($userdata['mobile'])?><br><br>
                    <b>Email:</b> <?php echo htmlspecialchars($userdata['email'])?><br><br>
                    <b>Address:</b> <?php echo htmlspecialchars($userdata['address'])?><br><br>
                    <b>Status:</b> <?php echo $status?><br><br>
                </h3>
            </div>
            <div id="Groups">
                <?php
                if (is_array($groupsdata) && count($groupsdata) > 0) {
                    foreach ($groupsdata as $group) {
                        if (!empty($group['id'])) {
                            ?>
                            <div>
                                <img id="picc" style="float: right" src="../uploads/<?php echo htmlspecialchars($group['photo']) ?>" alt="Group Photo"><br>
                                <b>Group Name:</b> <?php echo htmlspecialchars($group['name']) ?><br><br>
                                <form action="../api/vote.php" method="post">
                                    <input type="hidden" name="gid" value="<?php echo htmlspecialchars($group['id']) ?>">
                                    <?php
                                    if ($_SESSION['userdata']['status'] == 0) {
                                        echo '<button type="submit" name="votebtn" id="votebtn">Vote</button>';
                                    } else {
                                        echo '<button disabled type="button" name="votebtn" id="voted">Voted</button>';
                                    }
                                    ?>
                                </form><br><br>
                            </div>
                            <hr>
                            <?php
                        }
                    }
                } else {
                    echo '<b>No groups found.</b>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>