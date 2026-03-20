<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flood_management_system";

$link = new mysqli($servername,$username,$password,$dbname);

if ($link -> connect_error)
    {
        die("Connection failed : ". $link ->connect_error);
    }
    $user_id=$_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $relief_type =$_POST ['relief_type'];
        $district =$_POST ['district'];
        $division =$_POST ['division'];
        $gn_division =$_POST ['gn_division'];
        $contact_person_name =$_POST ['contact_person_name'];
        $contact_number =$_POST ['contact_number'];
        $address =$_POST ['address'];
        $family_members =$_POST ['family_members'];
        $severity =$_POST ['severity'];
        $description =$_POST ['description'];

        $sql = "INSERT INTO relief_requests (user_id, relief_type, district, division, gn_division, contact_person_name,contact_number, address , family_members, severity, description   )
                VALUES  ('$user_id' , '$relief_type' , '$district' , '$division' , '$gn_division' ,'$contact_person_name','$contact_number', '$address' ,'$family_members' , '$severity' , '$description'   ) " ;
       if ($link -> query ($sql) == TRUE){
        header ("Location: view_requests.php?success = true");
        exit();
       } 
       else {
        echo "Error :" . $link ->error;
       }
    }
    $link -> close();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Relief Request</title>
    <style >
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
 .topic {
    background: rgba(255, 255, 255, 0.95); 
    padding: 30px 40px;
    border-radius: 12px; 
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); 
    width: 100%;
    max-width: 500px; 
    color: #333;
        }

.topic h1 {
    text-align: center;
    color: #004e92;
    margin-bottom: 25px;
    font-size: 24px;
}
form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    font-size: 14px;
}
form input[type="text"],
form input[type="tel"],
form input[type="number"],
form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box; 
    font-size: 14px;
}
form input:focus, form select:focus {
    outline: none;
    border-color: #004e92;
    box-shadow: 0 0 5px rgba(0, 78, 146, 0.4);
}
form button {
    width: 100%;
    padding: 12px;
    background-color: #004e92;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s; 
}
form button:hover {
    background-color: #003666;
}
form {
    margin-top: 20px;
}

form label {
    display: block;
    margin-top: 12px;
    margin-bottom: 6px;
    font-size: 14px;
}

form input,
form select {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid rgba(255,255,255,0.2);
    background:white;
    color:black;
}

form input::placeholder {
    color:#888;
}

.btn-submit {
    width: 100%;
    margin-top: 20px;
    padding: 12px;
    background: #4facfe;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.btn-submit:hover {
    background: #2c82f6;
}
.dashboard-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 30px 20px 40px;
}


.panel-section {
    background: rgba(255,255,255,0.1);
    padding: 25px;
    border-radius: 12px;
}
.nav-links {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    align-items: center;
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

    
    <div class="panel-section">

        <h3>Create Relief Request</h3>

        <form method="POST">

        <label> Type of Relief :  </label>
        <select name="relief_type" required aria-label="Default select example">
            <option value="">Select an option</option>
            <option value="Food">Food</option>
            <option value="Water">Water</option>
            <option value="Medicine">Medicine</option>
            <option value="Shelter">Shelter</option>
        </select>

        <label>Distric:</label>
<select name="district" required>
    <option value="">Select District</option>
    <option value="Colombo">Colombo</option>
    <option value="Gampaha">Gampaha</option>
    <option value="Kalutara">Kalutara</option>
    <option value="Kandy">Kandy</option>
    <option value="Matale">Matale</option>
    <option value="Nuwara Eliya">Nuwara Eliya</option>
    <option value="Galle">Galle</option>
    <option value="Matara">Matara</option>
    <option value="Hambantota">Hambantota</option>
    <option value="Jaffna">Jaffna</option>
    <option value="Kurunegala">Kurunegala</option>
    <option value="Anuradhapura">Anuradhapura</option>
    <option value="Polonnaruwa">Polonnaruwa</option>
    <option value="Badulla">Badulla</option>
    <option value="Monaragala">Monaragala</option>
    <option value="Ratnapura">Ratnapura</option>
    <option value="Kegalle">Kegalle</option>
    <option value="Trincomalee">Trincomalee</option>
    <option value="Batticaloa">Batticaloa</option>
    <option value="Ampara">Ampara</option>
    <option value="Mannar">Mannar</option>
    <option value="Vavuniya">Vavuniya</option>
    <option value="Kilinochchi">Kilinochchi</option>
    <option value="Mullaitivu">Mullaitivu</option>
</select>
        <label>Divisional Secretariat:</label>
        <input type="text" name="division" required>

        <label>GN Division :</label>
        <input type="text" name="gn_division" required>

        <label>Contact person name:</label>
        <input type="text" name="contact_person_name" required>

        <label>Contact number:</label>
        <input type="tel" name="contact_number" required pattern="[0-9]{10}"placeholder="e.g.0771234567">

        <label>Address:</label>
        <input type="text" name="address" >

        <label>Number of family members:</label>
        <input type="number" name="family_members" required min="1" max="20">

        <label> Flood severity level :  </label>
        <select name="severity" required aria-label="Default select example">
            <option value="">Select an option</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>

        </select>
        

        <label>Descriptions:</label>
        <input type="text" name="description" >

        <button type="submit" class="btn-submit">Submit Request</button>
        
        </form>
    </div>
</body>
</html>