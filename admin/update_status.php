<?php

include("../includes/config.php");

$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE relief_requests 
        SET status='$status' 
        WHERE request_id=$id";

mysqli_query($conn, $sql);


header("Location: requests.php");
exit();

?>