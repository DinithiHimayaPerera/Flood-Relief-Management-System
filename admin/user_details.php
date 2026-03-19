<?php
include("../includes/config.php");
include("../includes/admin_auth.php");

$user_id = $_GET['id'];
$sql = "SELECT * FROM users WHERE user_id=$user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
$sqlReq = "SELECT * FROM relief_requests WHERE user_id = $user_id";
$resultReq = mysqli_query($conn, $sqlReq);
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

        <h4 class="mt-5 mb-3">User Requests</h4>

<?php if(mysqli_num_rows($resultReq) > 0): ?>

<table class="table table-bordered table-hover">
    <thead class="table-primary">
        <tr>
            <th>Request ID</th>
            <th>Relief Type</th>
            <th>District</th>
            <th>Severity</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    <?php while($row = mysqli_fetch_assoc($resultReq)): ?>
        <tr>
            <td><?php echo $row['request_id']; ?></td>
            <td><?php echo $row['relief_type']; ?></td>
            <td><?php echo $row['district']; ?></td>
            <td><?php echo $row['severity']; ?></td>

            <td>
                <?php
                if($row['status'] == 'Accepted'){
                    echo "<span class='badge bg-success'>Accepted</span>";
                } elseif($row['status'] == 'Rejected'){
                    echo "<span class='badge bg-danger'>Rejected</span>";
                } else {
                    echo "<span class='badge bg-warning text-dark'>Pending</span>";
                }
                ?>
            </td>

            <td>
                <a href="request_details.php?id=<?php echo $row['request_id']; ?>" 
                   class="btn btn-sm btn-primary">
                   View
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<?php else: ?>
    <p class="text-muted">No requests submitted by this user.</p>
<?php endif; ?>

        <a href="users.php" class="btn btn-secondary mt-3">⬅ Back to Users</a>

    </div>

</div>

<?php include("../includes/admin_footer.php"); ?>

</body>
</html>