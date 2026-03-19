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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to right, #000428, #004e92);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

       .dashboard-container {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.3);
            width: 95%; 
            max-width: 1100px; 
            animation: fadeIn 0.8s ease-out forwards;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: #111;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .header h1 i {
            color: #007bff;
            margin-right: 10px;
        }

        .header p {
            color: #555;
            font-size: 17px;
            font-weight: 400;
        }

        .stats-row {
            display: flex;
            justify-content: space-between;
            gap: 25px;
            margin-bottom: 45px;
        }

        .stat-card {
            flex: 1;
            padding: 30px 20px;
            border-radius: 16px;
            text-align: center;
            color: white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease; 
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .stat-card.total { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stat-card.accepted { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
        .stat-card.rejected { background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%); }

        .stat-icon {
            font-size: 45px;
            margin-bottom: 15px;
            opacity: 0.8;
            transition: transform 0.3s ease;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1);
            opacity: 1;
        }

        .stat-card h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .stat-card .count {
            font-size: 48px;
            font-weight: 700;
            line-height: 1;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px; 
            flex-wrap: wrap; 
        }

        .btn {
            flex: 1;
            padding: 16px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            min-width: 220px; 
            max-width: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        .btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.2);
        }

        .btn-view {
            background-color: #0f2027;
            color: white;
            border: 2px solid #0f2027;
        }

        .btn-view:hover {
            background-color: transparent;
            color: #0f2027;
        }

        .btn-create {
            background-color: #11998e;
            color: white;
            border: 2px solid #11998e;
        }

        .btn-create:hover {
            background-color: transparent;
            color: #11998e;
        }

        .btn-logout {
            background-color: #ff416c;
            color: white;
            border: 2px solid #ff416c;
        }

        .btn-logout:hover {
            background-color: transparent;
            color: #ff416c;
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
            .dashboard-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <div class="header">
            <h1><i class="fas fa-user-shield"></i> Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
            <p>Your Relief Requests Overview & Management</p>
        </div>

        <div class="stats-row">
            <div class="stat-card total">
                <i class="fas fa-layer-group stat-icon"></i>
                <h3>Total Requests</h3>
                <div class="count"><?php echo $total_requests; ?></div>
            </div>
            <div class="stat-card accepted">
                <i class="fas fa-check-circle stat-icon"></i>
                <h3>Accepted</h3>
                <div class="count"><?php echo $accepted_requests; ?></div>
            </div>
            <div class="stat-card rejected">
                <i class="fas fa-times-circle stat-icon"></i>
                <h3>Rejected</h3>
                <div class="count"><?php echo $rejected_requests; ?></div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="view_requests.php" class="btn btn-view"><i class="fas fa-eye"></i> View My Requests</a>
            <a href="create_request.php" class="btn btn-create"><i class="fas fa-plus-circle"></i> Create New Request</a>
            <a href="logout.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

</body>
</html>