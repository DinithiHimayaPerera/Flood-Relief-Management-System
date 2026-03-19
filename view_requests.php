<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flood_management_system";

$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn -> connect_error)
    {
        die("Connection failed : ". $conn ->connect_error);
    }
     $user_id = isset ($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

     $sql = "SELECT * FROM relief_requests WHERE user_id = '$user_id'";
     $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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


.container {
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
}


.btn-nav:hover {
    background: white;
    color: #004e92;
}


.btn-nav.active {
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


.panel-section {
    background: rgba(255,255,255,0.10);
    padding: 25px;
    border-radius: 16px;
    margin-bottom: 20px;
}


.panel-section h2 {
    margin-bottom: 20px;
}


table {
    width: 100%;
    border-collapse: collapse;
    background: rgba(255,255,255,0.08);
    border-radius: 12px;
    overflow: hidden;
}


th {
    padding: 14px;
    text-align: left;
    background: rgba(255,255,255,0.15);
    color: white;
}


td {
    padding: 14px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}


tr:hover {
    background: rgba(255,255,255,0.1);
}


.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.badge-success {
    background: #22c55e;
    color: white;
}

.badge-danger {
    background: #ef4444;
    color: white;
}

.badge-warning {
    background: #facc15;
    color: black;
}


.btn-edit {
    background-color: #28a745;
    color: white;
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 6px;
    font-size: 13px;
    margin-right: 5px;
    transition: 0.3s;
}

.btn-delete {
    background-color: #dc3545;
    color: white;
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 6px;
    font-size: 13px;
    transition: 0.3s;
}


.btn-edit:hover {
    background-color: #218838;
    transform: scale(1.05);
}

.btn-delete:hover {
    background-color: #c82333;
    transform: scale(1.05);
}


.btn-back {
    background-color: #6c757d;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 6px;
    display: inline-block;
    margin-top: 20px;
}

.btn-back:hover {
    background-color: #5a6268;
}


.btn-container {
    text-align: center;
}


.no-data {
    text-align: center;
    padding: 20px;
    color: rgba(255,255,255,0.7);
}


@media (max-width: 768px) {
    .navbar {
        flex-direction: column;
        align-items: flex-start;
    }

    .nav-links {
        width: 100%;
    }

    .btn-nav {
        width: 100%;
        text-align: center;
    }
}
 </style>
</head>
<body>
    <div class="container">

    <div class="navbar">
        <div class="brand-section">
            <h2>Aqua Aid</h2>
            <p>Flood Relief Management System</p>
        </div>

        <div class="nav-links">
            <a href="dashboard.php" class="btn-nav">Dashboard</a>
            <a href="create_request.php" class="btn-nav">Create Request</a>
            <a href="logout.php" class="btn-nav btn-logout">Logout</a>
        </div>
    </div>
    <div class="panel-section">
        <h2>My Relief Requests</h2></div>

        <?php if ($result->num_rows > 0): ?>
         <table>
            <thead>
                 <tr>
                    <th>Relief Type</th>
                    <th>District</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Severity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
                <tbody>
            <?php 
                while($row = $result->fetch_assoc()): 
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['relief_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['district']); ?></td>
                    <td><?php echo htmlspecialchars($row['contact_person_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['contact_number']); ?></td>
                    <td><strong><?php echo htmlspecialchars($row['severity']); ?></strong></td>
<td>
<?php
$status = $row['status'];

if($status == 'Accepted'){
    echo "<span class='badge badge-success'>Accepted</span>";
}
elseif($status == 'Rejected'){
    echo "<span class='badge badge-danger'>Rejected</span>";
}
else{
    echo "<span class='badge badge-warning'>Pending</span>";
}
?>
</td>
                    <td>
                   <a href="update.php?id=<?php echo $row['request_id']; ?>" class="btn-edit">✏️ Edit</a>
                  <a href="delete_request.php?id=<?php echo $row['request_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this request?');">🗑 Delete</a>
                    </td>
                 </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">You have not submitted any relief requests yet.</p>
        <?php endif; ?>
       
    </div>

</body>
</html>

