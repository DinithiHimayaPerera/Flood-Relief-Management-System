<?php
include("../includes/config.php");
include("../includes/admin_auth.php");

$sql="SELECT user_id,name,email,role,address FROM users";
$result=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Users</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/admin.css">
</head>

<body>

<?php include("../includes/admin_nav.php"); ?>

<h2 class="mb-4">Registered Users</h2>

<table class="table table-bordered table-hover shadow bg-white">

<thead class="table-primary">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Address</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php
while($row=mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$row['user_id']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['role']."</td>";
    echo "<td>".$row['address']."</td>";
    echo "<td>
        <a class='btn btn-sm btn-primary' href='user_details.php?id=".$row['user_id']."'>View</a>
        <a class='btn btn-sm btn-danger' href='delete_user.php?id=".$row['user_id']."'>Delete</a>
    </td>";
    echo "</tr>";
}
?>

</tbody>
</table>

<?php include("../includes/admin_footer.php"); ?>

</body>
</html>