<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flood_relief_db";

$link = new mysqli($servername,$username,$password,$dbname);

if ($link -> connect_error)
    {
        die("Connection failed : ". $link ->connect_error);
    }
if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $user_id = isset ($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

        $relief_type =$_POST ['relife_type'];
        $distric =$_POST ['distric'];
        $division =$_POST ['division'];
        $gn_division =$_POST ['gn_division'];
        $contact_person =$_POST ['contact_person'];
        $contact_number =$_POST ['contact_number'];
        $address =$_POST ['address']
        $family_members =$_POST ['family_members'];
        $severity =$_POST ['severity'];
        $description =$_POST ['description'];

        $sql = "INSERT INTO relief_requests (user_id, relief_type, distric, division, gn_division, contact_person,contact_number, address , family_members, severity, description   )
                VALUES  ('$user_id' , '$relief_type' , '$distric' , '$division' , '$gn_division' ,' $contact_person','$contact_number', '$address' ,'$family_members' , '$severity' , '$description'   ) " ;
       if ($link -> query ($sql) == TRUE){
        header ("Location: submit_request.php? success = true");
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
    <style>

    </style>
</head>
<body>
    <div class = "topic">
        <h1> Submit a Flood Relief Request </h1>

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
        <input type="text" name="distric" placeholder="e.g. Colombo" required>

        <label>Divisional Secretariat:</label>
        <input type="text" name="division" required>

        <label>GN Division :</label>
        <input type="text" name="gn_division" required>

        <label>Contact person namet:</label>
        <input type="text" name="person_name" required>

        <label>Contact number:</label>
        <input type="text" name="contact_number" required>

        <label>Address:</label>
        <input type="text" name="address" required>

        <label>Number of family members:</label>
        <input type="text" name="family_members" required>

        <lable> Flood severity level :  </lable>
        <select class="form-select" aria-label="Default select example">
            <option selected>Select an option</option>
            <option value="Low ">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>

        </select>

        <label>Description s:</label>
        <input type="text" name="description" required>

        <button type="submit">Submit Request</button>

        </form>
    </div>
</body>
</html>