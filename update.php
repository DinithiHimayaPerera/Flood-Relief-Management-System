<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$request_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($request_id === 0) {
    echo "Invalid request.";
    exit();
}

$sql = "SELECT * FROM relief_requests WHERE request_id=$request_id AND user_id=$user_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Request not found.";
    exit();
}

$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $relief_type = $_POST['relief_type'];
    $district = $_POST['district'];
    $division = $_POST['division'];
    $gn_division = $_POST['gn_division'];
    $contact_person_name = $_POST['contact_person_name'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $family_members = $_POST['family_members'];
    $severity = $_POST['severity'];
    $description = $_POST['description'];

    $sql = "UPDATE relief_requests SET
            relief_type='$relief_type',
            district='$district',
            division='$division',
            gn_division='$gn_division',
            contact_person_name='$contact_person_name',
            contact_number='$contact_number',
            address='$address',
            family_members='$family_members',
            severity='$severity',
            description='$description'
            WHERE request_id=$request_id AND user_id=$user_id";

    if ($conn->query($sql) == TRUE) {
        header("Location: view_requests.php?updated=true");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Relief Request</title>

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
    padding: 18px 24px;
    margin-bottom: 28px;
    border-radius: 16px;
    background: rgba(255,255,255,0.08);
}

.nav-links {
    display: flex;
    gap: 14px;
}

.btn-nav {
    text-decoration: none;
    color: white;
    border: 2px solid rgba(255,255,255,0.75);
    padding: 10px 18px;
    border-radius: 6px;
    font-weight: bold;
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

.panel-section {
    background: rgba(255,255,255,0.1);
    padding: 25px;
    border-radius: 12px;
}

form label {
    display: block;
    margin-top: 12px;
    margin-bottom: 6px;
    font-weight: bold;
}

form input,
form select {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: none;
    background: white;
    color: black;
}


select option {
    background: white;
    color: black;
}

form input::placeholder {
    color: #888;
}

.btn-submit {
    width: 100%;
    margin-top: 20px;
    padding: 12px;
    background: #4facfe;
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.btn-submit:hover {
    background: #2c82f6;
}
</style>
</head>

<body>

<div class="dashboard-container">

    <div class="navbar">
        <h2>Aqua Aid</h2>
        

        <div class="nav-links">
            <a href="dashboard.php" class="btn-nav">Dashboard</a>
            <a href="view_requests.php" class="btn-nav">View Requests</a>
            <a href="create_request.php" class="btn-nav">Create Request</a>
            <a href="logout.php" class="btn-nav btn-logout">Logout</a>
        </div>
    </div>

    <div class="panel-section">
        <h3>Update Relief Request</h3>


        <form method="POST">

            <label>Type of Relief</label>
            <select name="relief_type" required>
                <option value="Food" <?php if($row['relief_type']=="Food") echo "selected"; ?>>Food</option>
                <option value="Water" <?php if($row['relief_type']=="Water") echo "selected"; ?>>Water</option>
                <option value="Medicine" <?php if($row['relief_type']=="Medicine") echo "selected"; ?>>Medicine</option>
                <option value="Shelter" <?php if($row['relief_type']=="Shelter") echo "selected"; ?>>Shelter</option>
            </select>

            <label>District</label>
            <select name="district" required>
                <?php
                $districts = ["Colombo","Gampaha","Kalutara","Kandy","Matale","Nuwara Eliya","Galle","Matara","Hambantota","Jaffna","Kurunegala","Anuradhapura","Polonnaruwa","Badulla","Monaragala","Ratnapura","Kegalle","Trincomalee","Batticaloa","Ampara","Mannar","Vavuniya","Kilinochchi","Mullaitivu"];
                foreach($districts as $d){
                    $selected = ($row['district'] == $d) ? "selected" : "";
                    echo "<option value='$d' $selected>$d</option>";
                }
                ?>
            </select>

            <label>Divisional Secretariat</label>
            <input type="text" name="division" value="<?php echo $row['division']; ?>" required>

            <label>GN Division</label>
            <input type="text" name="gn_division" value="<?php echo $row['gn_division']; ?>" required>

            <label>Contact Person Name</label>
            <input type="text" name="contact_person_name" value="<?php echo $row['contact_person_name']; ?>" required>

            <label>Contact Number</label>
            <input type="tel" name="contact_number"
                   value="<?php echo $row['contact_number']; ?>"
                   pattern="[0-9]{10}"
                   placeholder="e.g.0771234567" required>

            <label>Address</label>
            <input type="text" name="address" value="<?php echo $row['address']; ?>">

            <label>Number of Family Members</label>
            <input type="number" name="family_members"
                   value="<?php echo $row['family_members']; ?>"
                   min="1" max="20" required>

            <label>Flood Severity Level</label>
            <select name="severity" required>
                <option value="Low" <?php if($row['severity']=="Low") echo "selected"; ?>>Low</option>
                <option value="Medium" <?php if($row['severity']=="Medium") echo "selected"; ?>>Medium</option>
                <option value="High" <?php if($row['severity']=="High") echo "selected"; ?>>High</option>
            </select>

            <label>Description</label>
            <input type="text" name="description" value="<?php echo $row['description']; ?>">

            <button type="submit" class="btn-submit">Update Request</button>

        </form>
    </div>

</div>

</body>
</html>