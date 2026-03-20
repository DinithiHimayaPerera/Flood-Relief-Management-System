<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: userlogin.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flood_management_system";

$link = new mysqli($servername, $username, $password, $dbname);

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];


$sql_total = "SELECT COUNT(*) as total FROM relief_requests WHERE user_id = '$user_id'";
$res_total = $link->query($sql_total);
$total_requests = $res_total->fetch_assoc()['total'];

$sql_accepted = "SELECT COUNT(*) as accepted FROM relief_requests WHERE user_id = '$user_id' AND status = 'Accepted'";
$res_accepted = $link->query($sql_accepted);
$accepted_requests = $res_accepted->fetch_assoc()['accepted'];

$sql_rejected = "SELECT COUNT(*) as rejected FROM relief_requests WHERE user_id = '$user_id' AND status = 'Rejected'";
$res_rejected = $link->query($sql_rejected);
$rejected_requests = $res_rejected->fetch_assoc()['rejected'];

$pending_requests = $total_requests - ($accepted_requests + $rejected_requests);

$link->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard - Aqua Aid</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    min-height: 100vh;
    background: linear-gradient(to right, #0a0b0b, #004e92);
    color: white;
}

.dashboard-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 30px 20px 40px;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    padding: 18px 24px;
    margin-bottom: 28px;
    border: 1px solid rgba(255,255,255,0.16);
    border-radius: 16px;
    background: rgba(255,255,255,0.08);
}

.brand-section h2 {
    font-size: 28px;
    font-weight: bold;
}

.brand-section p {
    font-size: 13px;
    color: rgba(255,255,255,0.78);
    margin-top: 4px;
}

.nav-links {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    align-items: center;
}

.btn-nav {
    text-decoration: none;
    color: white;
    border: 2px solid rgba(255,255,255,0.75);
    padding: 10px 18px;
    border-radius: 6px;
    font-weight: bold;
    font-size: 14px;
    transition: 0.3s;
    background: transparent;
}

.btn-nav:hover {
    background: white;
    color: #004e92;
}

.btn-logout {
    border-color: #ff5c5c;
    color: #ffb3b3;
}

.btn-logout:hover {
    background: #ff5c5c;
    color: white;
}

.welcome-section {
    padding: 35px 30px;
    border-radius: 16px;
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.16);
    margin-bottom: 28px;
    text-align: center;
}

.welcome-section h1 {
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 10px;
}

.welcome-section p {
    font-size: 16px;
    color: rgba(255,255,255,0.86);
    line-height: 1.8;
    max-width: 800px;
    margin: 0 auto;
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 28px;
}

.stats-card {
    padding: 25px 20px;
    text-align: center;
    border-radius: 16px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.16);
}

.stats-card h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.stats-count {
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 8px;
}

.stats-description {
    font-size: 13px;
    color: rgba(255,255,255,0.78);
}

.stats-total { border-bottom: 4px solid #7fb3ff; }
.stats-accepted { border-bottom: 4px solid #4ade80; }
.stats-rejected { border-bottom: 4px solid #fb7185; }
.stats-pending { border-bottom: 4px solid #facc15; }

.panel-section {
    padding: 28px;
    border-radius: 16px;
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.16);
    margin-bottom: 20px;
}

.panel-section h3 {
    font-size: 22px;
    margin-bottom: 16px;
}

.panel-section p {
    font-size: 15px;
    color: rgba(255,255,255,0.85);
    line-height: 1.8;
}

.support-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-top: 18px;
}

.support-item {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 12px;
    padding: 18px 16px;
    text-align: center;
}

.support-item h4 {
    font-size: 16px;
    margin-bottom: 6px;
}

.support-item p {
    font-size: 13px;
    line-height: 1.6;
    color: rgba(255,255,255,0.75);
}

.reminder-list {
    list-style: none;
    margin-top: 14px;
}

.reminder-list li {
    padding: 12px 0;
    border-bottom: 1px solid rgba(255,255,255,0.12);
    color: rgba(255,255,255,0.86);
    font-size: 14px;
    line-height: 1.7;
}

.reminder-list li:last-child {
    border-bottom: none;
}

.footer-text {
    text-align: center;
    margin-top: 24px;
    font-size: 14px;
    color: rgba(255,255,255,0.74);
}

@media (max-width: 992px) {
    .stats-container { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
    .stats-container { grid-template-columns: 1fr; }
    .support-grid { grid-template-columns: 1fr; }
    .navbar { flex-direction: column; align-items: flex-start; }
    .nav-links { width: 100%; }
    .btn-nav { width: 100%; text-align: center; }
    .welcome-section h1 { font-size: 30px; }
}
</style>
</head>
<body>

<div class="dashboard-container">

    <div class="navbar">
        <div class="brand-section">
            <h2>Aqua Aid</h2>
            <p>Flood Relief Management System</p>
        </div>

        <div class="nav-links">
           <a href="dashboard.php" class="btn-nav">Dashboard</a>
            <a href="view_requests.php" class="btn-nav">View Requests</a>
            <a href="create_request.php" class="btn-nav">Create Request</a>
            <a href="logout.php" class="btn-nav btn-logout">Logout</a>
        </div>
    </div>

    <div class="welcome-section">
        <h1>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
        
    </div>

    <div class="stats-container">
        <div class="stats-card stats-total">
            <h3>Total Requests</h3>
            <div class="stats-count"><?php echo $total_requests; ?></div>
            <div class="stats-description">All submitted requests</div>
        </div>

        <div class="stats-card stats-accepted">
            <h3>Accepted</h3>
            <div class="stats-count"><?php echo $accepted_requests; ?></div>
            <div class="stats-description">Approved by admin</div>
        </div>

        <div class="stats-card stats-rejected">
            <h3>Rejected</h3>
            <div class="stats-count"><?php echo $rejected_requests; ?></div>
            <div class="stats-description">Not approved</div>
        </div>

        <div class="stats-card stats-pending">
            <h3>Pending</h3>
            <div class="stats-count"><?php echo $pending_requests; ?></div>
            <div class="stats-description">Waiting for review</div>
        </div>
    </div>

    <div class="panel-section">
        <h3>Available Relief Support</h3>
        <p>Aqua Aid allows flood-affected users to request essential support services during emergency situations.</p>

        <div class="support-grid">
            <div class="support-item">
                <h4>Food</h4>
                <p>Emergency food supplies for affected households.</p>
            </div>
            <div class="support-item">
                <h4>Water</h4>
                <p>Clean drinking water and basic daily water needs.</p>
            </div>
            <div class="support-item">
                <h4>Medicine</h4>
                <p>Medical assistance and health-related support.</p>
            </div>
            <div class="support-item">
                <h4>Shelter</h4>
                <p>Temporary shelter for displaced individuals and families.</p>
            </div>
        </div>
    </div>

    <div class="panel-section">
        <h3>Quick Reminders</h3>
        <p>Keep your request details accurate and updated so the admin can review them clearly.</p>

        <ul class="reminder-list">
            <li>Review your submitted requests regularly.</li>
            <li>Update incorrect contact or address details when needed.</li>
            <li>Create a new request only when essential support is required.</li>
            <li>Check request status to see whether it is pending, accepted, or rejected.</li>
        </ul>
    </div>

    <div class="footer-text">
        Aqua Aid Dashboard • User Relief Overview
    </div>

</div>
</body>
</html>