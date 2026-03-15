<?php


include("../includes/config.php");
include("../includes/admin_auth.php");
include("../includes/admin_nav.php");

$user_id=$_GET['id'];
$sql="DELETE FROM users WHERE user_id=$user_id";
mysqli_query($conn,$sql);
header("Location: users.php");
exit();

?>