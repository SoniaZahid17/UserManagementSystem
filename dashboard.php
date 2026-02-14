<?php
session_start();

// Protect page
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Read users from file
$users = [];
if (file_exists("users.txt")) {
    $lines = file("users.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($uname, $email, $pass) = explode(",", $line);
        $users[] = ['username' => $uname, 'email' => $email];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }
body {
    min-height:100vh;
    background: linear-gradient(135deg,#667eea,#764ba2);
    display:flex;
    justify-content:center;
    align-items:flex-start;
    padding-top:50px;
}

/* Dashboard container */
.dashboard-container {
    width: 90%;
    max-width: 1000px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(15px);
    border-radius: 15px;
    padding: 30px;
    color: #fff;
}

/* Header */
.dashboard-header {
    display:flex;
    justify-content: space-between;
    align-items:center;
    margin-bottom: 25px;
    flex-wrap:wrap;
}
.dashboard-header h2 {
    font-weight:600;
    margin-bottom:10px;
}
.dashboard-header a {
    padding:10px 20px;
    background:white;
    color:#764ba2;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
    margin-left:10px;
}
.dashboard-header a:hover { transform:scale(1.05); background:#f1f1f1; }

/* User stats card */
.stats-card {
    background: rgba(255,255,255,0.1);
    padding:20px;
    border-radius:10px;
    margin-bottom:20px;
    display:flex;
    justify-content:space-between;
}
.stats-card div {
    text-align:center;
}
.stats-card h3 { margin-bottom:5px; font-size:20px; }

/* Users table */
table {
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}
table th, table td {
    padding:12px;
    text-align:left;
    border-bottom:1px solid rgba(255,255,255,0.3);
}
table th {
    background: rgba(255,255,255,0.2);
    border-radius:5px;
}

/* Footer / small note */
.footer-text {
    margin-top:20px;
    font-size:13px;
    text-align:center;
}
.footer-text a {
    color:#fff;
    text-decoration:underline;
}

@media(max-width:768px){
    .stats-card { flex-direction:column; gap:15px; }
    .dashboard-header { flex-direction:column; align-items:flex-start; }
    .dashboard-header a { margin-left:0; margin-top:10px; }
}
</style>
</head>
<body>

<div class="dashboard-container">

    <div class="dashboard-header">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['user']) ?> 🎉</h2>
        <div>
            <a href="register_user.php">Register New User</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="stats-card">
        <div>
            <h3>Total Users</h3>
            <p><?= count($users) ?></p>
        </div>
        <div>
            <h3>Active Users</h3>
            <p>1</p>
        </div>
    </div>

    <h3>Registered Users</h3>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
            </tr>
            <?php endforeach; ?>
            <?php if(count($users) == 0): ?>
            <tr><td colspan="2" style="text-align:center;">No users registered yet</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer-text">
        User Management System Dashboard
    </div>

</div>

</body>
</html>
