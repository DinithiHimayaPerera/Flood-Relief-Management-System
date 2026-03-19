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
if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $user_id = isset ($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

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
                VALUES  ('$user_id' , '$relief_type' , '$district' , '$division' , '$gn_division' ,' $contact_person_name','$contact_number', '$address' ,'$family_members' , '$severity' , '$description'   ) " ;
       if ($link -> query ($sql) == TRUE){
        header ("Location: view_requests.php? success = true");
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
body {
    background: linear-gradient(to right, #0a0b0b, #004e92);
    color: white;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center; 
    align-items: center;     
    margin: 0;
    padding: 20px;
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


    </style>
</head>
<body>
    <div class = "topic">
        <h1> Flood Relief Request </h1>

        <form action = "" method = "POST">

        <label> Type of Relief :  </label>
        <select name="relief_type" aria-label="Default select example">
            <option selected>Select an option</option>
            <option value="Food ">Food</option>
            <option value="Water">Water</option>
            <option value="Medicine">Medicine</option>
            <option value="Shelter">Shelter</option>
        </select>

        <label>distric:</label>
        <input type="text" name="district" placeholder="e.g. Colombo" required>

        <label>Divisional Secretariat:</label>
        <input type="text" name="division" required>

        <label>GN Division :</label>
        <input type="text" name="gn_division" required>

        <label>Contact person name:</label>
        <input type="text" name="contact_person_name" required>

        <label>Contact number:</label>
        <input type="text" name="contact_number" required>

        <label>Address:</label>
        <input type="text" name="address" required>

        <label>Number of family members:</label>
        <input type="text" name="family_members" required>

        <lable> Flood severity level :  </lable>
        <select name="severity" aria-label="Default select example">
            <option selected>Select an option</option>
            <option value="Low ">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>

        </select>
        

        <label>Descriptions:</label>
        <input type="text" name="description" required>

        <!--<button type="submit">Submit Request</button> -->
        <div class="btn-container">
            <a href="view_requests.php" class="btn-back">Submit Request</a>
        </div>

        </form>
    </div>
</body>
</html>