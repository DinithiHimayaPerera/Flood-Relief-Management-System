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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    
   <div class="dashboard-container">

<h2>User Details</h2>

<table class="details-table">

<tr>
<td><strong>User ID</strong></td>
<td><?php echo $user['user_id']; ?></td>
</tr>

<tr>
<td><strong>Name</strong></td>
<td><?php echo $user['name']; ?></td>
</tr>

<tr>
<td><strong>Email</strong></td>
<td><?php echo $user['email']; ?></td>
</tr>

<tr>
<td><strong>Role</strong></td>
<td><?php echo $user['role']; ?></td>
</tr>

<tr>
<td><strong>Contact</strong></td>
<td><?php echo $user['contact_number']; ?></td>
</tr>

<tr>
<td><strong>Address</strong></td>
<td><?php echo $user['address']; ?></td>
</tr>

<tr>
<td><strong>District</strong></td>
<td><?php echo $user['district']; ?></td>
</tr>

</table>

<a href="users.php">Back to Users</a>

</div>

</body>
</html>