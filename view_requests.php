<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flood_management_system";

$link = new mysqli($servername,$username,$password,$dbname);

if ($link -> connect_error)
    {
        die("Connection failed : ". $link ->connect_error);
    }
     $user_id = isset ($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

     $sql = "SELECT * FROM relief_requests WHERE user_id = '$user_id'";
     $result = $link->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
body {
        background: linear-gradient(to right, #0a0b0b, #004e92);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        padding: 20px;
     }

.container {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
         border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        width: 100%;
        max-width: 1000px;
        overflow-x: auto; /* Table එක ලොකු වැඩි වුණොත් scroll වෙන්න */
        }
 h1 {
    text-align: center;
    color: #004e92;
    margin-bottom: 25px;
    font-size: 28px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: white;
        }

        th, td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #004e92;
            color: white;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        tr:hover {
            background-color: #f1f5f9; 
        }
        .btn-edit {
            background-color: #28a745;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
            margin-right: 5px;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
        }
.btn-edit:hover { background-color: #218838; }
        .btn-delete:hover { background-color: #c82333; }

        .no-data {
            text-align: center;
            font-size: 18px;
            color: #666;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 1px dashed #ccc;
        }
 .btn-back {
            background-color: #6c757d; 
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
            margin-top: 20px; 
        }
 .btn-back:hover { 
            background-color: #5a6268; 
        }
        .btn-container {
            text-align: center; 
        }
 </style>
</head>
<body>
    <div class="container">
        <h1>My Relief Requests</h1>

        <?php if ($result->num_rows > 0): ?>
         <table>
            <thead>
                 <tr>
                    <th>Relief Type</th>
                    <th>District</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Severity</th>
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
                   <a href="update_request.php?id=<?php echo $row['request_id']; ?>" class="btn-edit">Edit</a>
                  <a href="delete_request.php?id=<?php echo $row['request_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this request?');">Delete</a>
                    </td>
                 </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">You have not submitted any relief requests yet.</p>
        <?php endif; ?>
       <div class="btn-container">
            <a href="dashboard.php" class="btn-back">Back to Dashboard</a>
        </div>
    </div>

</body>
</html>

<?php 
$link->close(); 
?>
</body>
</html>