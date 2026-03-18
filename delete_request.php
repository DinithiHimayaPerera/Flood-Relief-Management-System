<a href="delete_request.php=<?php echo $row['id'];?>"
   class="deleteBtn"
   onclick="return confirm('Are you sure to delete this request ?');">
   Delete
</a>

<?php

include 'db.php';

if(isset($_GET['user_id'])){

    $user_id = $_GET['user_id'];
    $sql = "DELETE FROM relief_requests WHERE user_id = '$user_id";

    if($conn->query($sql)==TRUE) {
        header("Location: view_request.php?success=1");
        exit();
    }
    else{
        echo "Error: ".$conn->error;
    }

}
else{
    echo "Invalid request";
}

$conn->close();

if(isset($_GET['success']) && $_GET['success']==1){
    echo "<script>alert('Request deleted successfully1');</scrpt>";
    
}

?>


