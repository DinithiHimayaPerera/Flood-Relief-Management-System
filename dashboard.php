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

$link->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(to right, #0a0b0b, #004e92);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

       .dashboard-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            width: 95%; 
            max-width: 1400px; 
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #004e92;
            font-size: 32px;
        }

        .header p {
            color: #555;
            font-size: 16px;
            margin-top: 5px;
        }

        .stats-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: #fff;
            flex: 1;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-bottom: 5px solid #ccc;
        }

        .stat-card.total { border-color: #007bff; }
        .stat-card.accepted { border-color: #28a745; }
        .stat-card.rejected { border-color: #dc3545; }

        .stat-card h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .stat-card .count {
            font-size: 36px;
            font-weight: bold;
        }
        
        .stat-card.total .count { color: #007bff; }
        .stat-card.accepted .count { color: #28a745; }
        .stat-card.rejected .count { color: #dc3545; }

        /* Buttons  */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px; 
            flex-wrap: wrap; 
        }

        .btn {
            flex: 1;
            padding: 15px 20px;
            text-align: center;
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease;
            min-width: 200px; 
            max-width: 300px;
        }

        .btn-view {
            background-color: #004e92;
            border: 2px solid #004e92;
        }

        .btn-view:hover {
            background-color: transparent;
            color: #004e92;
        }

        .btn-create {
            background-color: #28a745;
            border: 2px solid #28a745;
        }

        .btn-create:hover {
            background-color: transparent;
            color: #28a745;
        }

        .btn-logout {
            background-color: #dc3545;
            border: 2px solid #dc3545;
        }

        .btn-logout:hover {
            background-color: transparent;
            color: #dc3545;
        }

        @media (max-width: 768px) {
            .stats-row {
                flex-direction: column;
            }
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            .btn {
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <div class="header">
            <h1>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
            <p>Your Relief Requests Overview</p>
        </div>

        <div class="stats-row">
            <div class="stat-card total">
                <h3>Total Requests</h3>
                <div class="count"><?php echo $total_requests; ?></div>
            </div>
            <div class="stat-card accepted">
                <h3>Accepted</h3>
                <div class="count"><?php echo $accepted_requests; ?></div>
            </div>
            <div class="stat-card rejected">
                <h3>Rejected</h3>
                <div class="count"><?php echo $rejected_requests; ?></div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="view_requests.php" class="btn btn-view">View My Requests</a>
            <a href="create_request.php" class="btn btn-create">Create New Request</a>
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </div>
    </div>

</body>
</html>