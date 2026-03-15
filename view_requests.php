<?php
session_start();

// Database සම්බන්ධතාවය
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flood_relief_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ලොග් වී සිටින පරිශීලකයාගේ ID එක (දැනට 1 ලෙස සලකමු. Login හැදුවාම $_SESSION['user_id'] ලෙස වෙනස් කරන්න)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 

// තමන්ගේ ඉල්ලුම්පත් පමණක් ලබා ගැනීමේ SQL Query එක
$sql = "SELECT * FROM relief_requests WHERE user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Relief Requests</title>
    <style>
        /* Table එක ලස්සනට පෙන්වීමට CSS (UI Quality එකට ලකුණු තියෙන නිසා) */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { background-color: white; max-width: 900px; margin: auto; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px 0px gray; }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        
        /* Edit සහ Delete බොත්තම් වල පෙනුම */
        .btn-edit { background-color: #ffc107; color: black; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .btn-delete { background-color: #dc3545; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .btn-edit:hover { background-color: #e0a800; }
        .btn-delete:hover { background-color: #c82333; }
        .add-new { display: inline-block; margin-bottom: 15px; background-color: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>

<div class="container">
    <h2>My Relief Requests</h2>
    
    <a href="create_request.php" class="add-new">+ Create New Request</a>

    <table>
        <tr>
            <th>Relief Type</th>
            <th>District</th>
            <th>Contact Name</th>
            <th>Contact Number</th>
            <th>Severity Level</th>
            <th>Actions</th> </tr>

        <?php
        if ($result->num_rows > 0) {
            // දත්ත එකින් එක ගෙන Table එකට ඇතුළත් කිරීම
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['relief_type'] . "</td>";
                echo "<td>" . $row['district'] . "</td>";
                echo "<td>" . $row['contact_name'] . "</td>";
                echo "<td>" . $row['contact_number'] . "</td>";
                echo "<td>" . $row['severity_level'] . "</td>";
                
                // Update සහ Delete කිරීම සඳහා Links (මෙතනින් id එක අදාළ පිටුවට යවනවා)
                echo "<td>
                        <a href='edit_request.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a> 
                        <a href='delete_request.php?id=" . $row['id'] . "' class='btn-delete' onclick=\"return confirm('Are you sure you want to delete this request?');\">Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            // ඉල්ලුම්පත් කිසිවක් නොමැති නම්
            echo "<tr><td colspan='6' style='text-align: center;'>You have not submitted any relief requests yet.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>

<script src="request.js"></script>

</body>
</html>