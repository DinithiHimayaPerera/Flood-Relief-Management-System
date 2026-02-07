<?php



include("../includes/config.php");
include("../includes/admin_auth.php");
include("../includes/admin_nav.php");
$sql="SELECT user_id,name,email,role,district FROM users";
$result=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    
    <h2>Registered Users</h2>
    <table id="usersTable" border="1" cellpadding="6" cellspacing="0">;
        <thead><tr><th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>District</th>
        <th>Action</th>
</tr>
</thead>
<?php
if($result){
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>
        <a href='user_details.php?id=".$row['user_id']."'>View</a> | 
        <a href='delete_user.php?id=".$row['user_id']."' 
           onclick=\"return confirm('Are you sure you want to delete this user?');\">
           Delete
        </a>
      </td>";

        echo "<td>".$row['name']."</td>";
        echo  "<td>".$row['email']."</td>";
        echo "<td>".$row['role']."</td>";
        echo "<td>".$row['district']."</td>";
echo"<td><a href='user_details.php?id=".$row['user_id']."'>View</a></td>";
echo "</tr>";
    }
}
?>
</tbody>
</table>
<script src="../js/users.js"></script>
</body>
</html>