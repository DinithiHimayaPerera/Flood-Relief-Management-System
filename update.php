<?php

include 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;//So 1 is just a placeholder (default user id).

    $relief_type = $POST['relief_type'];
    $district = $POST['user_id'];
    $division = $POST['user_id'];
    $gn_division = $POST['user_id'];
    $contact_person_name = $POST['contact_person_name'];
    $contact_number = $POST['contact_number'];
    $address = $POST['address'];
    $num_family_members = $POST['num_family_members'];
    $serverity = $POST['serverity'];
    $description = $POST['description'];

    $sql = "INSERT INTO relief_requests 
    (user_id, relief_type, district, division , gn_division , contact_person_name, contact_number, family_members , severity, description , created_at, address)
    
    VALUES
    ('$user_id', '$relief_type', '$district', '$division' , '$gn_division' , '$contact_person_name','$contact_number', '$family_members' , '$severity', '$description' , '$created_at', '$address')";
    
    if ($link->query($sql) == TRUE){
        header("Location: view_requests.php?success=true");
        exit();
    }
    else{
        echo "Error :" .$link->error;
    }

}
$link->close();
?>