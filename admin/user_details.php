<?php



include("../includes/config.php");
include("../includes/admin_auth.php");
include("../includes/admin_nav.php");

$user_id=$_GET['id'];
$sql="SELECT * FROM users WHERE user_id=$user_id";
$result=mysqli_query($conn,$sql);
$user=mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h2>User Details</h2>
    <p><strong>User ID:</strong><?php echo $user['user_id'];?></p>
        <p><strong>Name:</strong><?php echo $user['name'];?></p>
            <p><strong>Email:</strong><?php echo $user['email'];?></p>

                <p><strong>Role:</strong><?php echo $user['role'];?></p>

                    <p><strong>Contact Number:</strong><?php echo $user['contact_number'];?></p>
<p><strong>Address:</strong><?php echo $user['address'];?></p>
    <p><strong>District:</strong><?php echo $user['district'];?></p>

    <a href="users.php">Back to Users</a>


</body>
</html>