<a href="delete_request.php=<?php echo $row['id'];?>"
   class="deleteBtn"
   onclick="return confirm('Are you sure to delete this request ?');">
   Delete
</a>

<?php
include 'db.php'; 

if(isset($_GET['id'])){

    $id = $_GET['id'];
    
    $sql = "DELETE FROM relief_requests WHERE request_id = '$id'";

    if($conn->query($sql) === TRUE) {
        header("Location: view_requests.php?success=1");
        exit();
    }
    else {
        echo "Error: " . $conn->error;
    }

}
else {
    echo "Invalid request. ID not found.";
}

$conn->close();
?>
