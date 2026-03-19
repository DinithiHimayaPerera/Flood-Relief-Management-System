<?php
session_start();
include 'db.php'; 

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;


$request_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($request_id === 0) {
    echo "No request selected to edit.";
    exit();
}


$sql = "SELECT * FROM relief_requests WHERE request_id=$request_id AND user_id=$user_id";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    echo "Request not found or you don't have permission to edit.";
    exit();
}

$row = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $relief_type = $conn->real_escape_string($_POST['relief_type']);
    $district = $conn->real_escape_string($_POST['district']);
    $division = $conn->real_escape_string($_POST['division']);
    $gn_division = $conn->real_escape_string($_POST['gn_division']);
    $contact_person_name = $conn->real_escape_string($_POST['contact_person_name']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    $address = $conn->real_escape_string($_POST['address']);
    $family_members = intval($_POST['num_family_members']);
    $severity = $conn->real_escape_string($_POST['severity']);
    $description = $conn->real_escape_string($_POST['description']);
    $created_at = date('Y-m-d H:i:s');

    $update_sql = "UPDATE relief_requests SET
                    relief_type='$relief_type',
                    district='$district',
                    division='$division',
                    gn_division='$gn_division',
                    contact_person_name='$contact_person_name',
                    contact_number='$contact_number',
                    address='$address',
                    family_members='$family_members',
                    severity='$severity',
                    description='$description',
                    created_at='$created_at'
                   WHERE request_id=$request_id AND user_id=$user_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Request updated successfully!'); window.location='view_requests.php';</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Relief Request</title>
<style>
body {
    background: linear-gradient(to right, #0a0b0b, #004e92);
    font-family: Arial, sans-serif;
}
.form-container {
    width: 400px;
    margin: 50px auto;
    padding: 20px;
    background: white;
    border-radius: 10px;
}
input, textarea {
    width: 100%;
    padding: 8px;
    margin: 8px 0;
    box-sizing: border-box;
}
button {
    width: 100%;
    padding: 10px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
button:hover {
    background: #218838;
}
h2 {
    text-align: center;
    color: #004e92;
}
</style>
</head>
<body>

<div class="form-container">
<h2>Edit Relief Request</h2>

<form method="POST">
    <input type="text" name="relief_type" placeholder="Relief Type" value="<?php echo htmlspecialchars($row['relief_type']); ?>" required>
    <input type="text" name="district" placeholder="District" value="<?php echo htmlspecialchars($row['district']); ?>" required>
    <input type="text" name="division" placeholder="Division" value="<?php echo htmlspecialchars($row['division']); ?>" required>
    <input type="text" name="gn_division" placeholder="GN Division" value="<?php echo htmlspecialchars($row['gn_division']); ?>" required>
    <input type="text" name="contact_person_name" placeholder="Contact Name" value="<?php echo htmlspecialchars($row['contact_person_name']); ?>" required>
    <input type="text" name="contact_number" placeholder="Contact Number" value="<?php echo htmlspecialchars($row['contact_number']); ?>" required>
    <input type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($row['address']); ?>" required>
    <input type="number" name="num_family_members" placeholder="Family Members" value="<?php echo htmlspecialchars($row['family_members']); ?>" required>
    <input type="text" name="severity" placeholder="Severity" value="<?php echo htmlspecialchars($row['severity']); ?>" required>
    <textarea name="description" placeholder="Description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
    <button type="submit">Update Request</button>
</form>

</div>
</body>
</html>