<?php
include("../includes/config.php");
include("../includes/admin_auth.php");

$user_id = $_GET['id'];
$sql = "SELECT * FROM users WHERE user_id=$user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Details</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/admin.css">
</head>

<body>

<?php include("../includes/admin_nav.php"); ?>

<div class="container mt-4">

    <h2 class="mb-4">User Details</h2>

    <div class="card shadow p-4">

        <table class="table table-bordered">

            <tr>
                <th>User ID</th>
                <td><?php echo $user['user_id']; ?></td>
            </tr>

            <tr>
                <th>Name</th>
                <td><?php echo $user['name']; ?></td>
            </tr>

            <tr>
                <th>Email</th>
                <td><?php echo $user['email']; ?></td>
            </tr>

            <tr>
                <th>Role</th>
                <td>
                    <span class="badge bg-<?php echo $user['role'] == 'admin' ? 'primary' : 'secondary'; ?>">
                        <?php echo $user['role']; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <th>Address</th>
                <td><?php echo $user['address']; ?></td>
            </tr>

        </table>

        <a href="users.php" class="btn btn-secondary mt-3">⬅ Back to Users</a>

    </div>

</div>

<?php include("../includes/admin_footer.php"); ?>

</body>
</html>