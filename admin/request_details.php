<?php
include("../includes/config.php");
include("../includes/admin_auth.php");


$request_id = $_GET['id'];


$sql = "SELECT * FROM relief_requests WHERE request_id = $request_id";
$result = mysqli_query($conn, $sql);
$request = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Request Details</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php include("../includes/admin_nav.php"); ?>

<div class="container mt-4">

<h2 class="mb-4">Request Details</h2>

<div class="card shadow p-4">

<table class="table table-bordered">

<tr><th>Request ID</th><td><?php echo $request['request_id']; ?></td></tr>
<tr><th>Relief Type</th><td><?php echo $request['relief_type']; ?></td></tr>
<tr><th>District</th><td><?php echo $request['district']; ?></td></tr>
<tr><th>Division</th><td><?php echo $request['division']; ?></td></tr>
<tr><th>GN Division</th><td><?php echo $request['gn_division']; ?></td></tr>
<tr><th>Contact Person</th><td><?php echo $request['contact_person_name']; ?></td></tr>
<tr><th>Contact Number</th><td><?php echo $request['contact_number']; ?></td></tr>
<tr><th>Address</th><td><?php echo $request['address']; ?></td></tr>
<tr><th>Family Members</th><td><?php echo $request['family_members']; ?></td></tr>
<tr><th>Severity</th><td><?php echo $request['severity']; ?></td></tr>
<tr><th>Description</th><td><?php echo $request['description']; ?></td></tr>

<tr>
<th>Status</th>
<td>
<?php
if($request['status'] == 'Accepted'){
    echo "<span class='badge bg-success'>Accepted</span>";
}
elseif($request['status'] == 'Rejected'){
    echo "<span class='badge bg-danger'>Rejected</span>";
}
else{
    echo "<span class='badge bg-warning text-dark'>Pending</span>";
}
?>
</td>
</tr>

</table>



<?php if($request['status'] == 'Pending' || $request['status'] == NULL){ ?>

<a class="btn btn-success me-2"
href="update_status.php?id=<?php echo $request['request_id']; ?>&status=Accepted">
Approve</a>

<a class="btn btn-danger"
href="update_status.php?id=<?php echo $request['request_id']; ?>&status=Rejected">
Reject</a>

<?php } else { ?>

<p class="text-muted">No further action available</p>

<?php } ?>

<br><br>

<a href="requests.php" class="btn btn-secondary">⬅ Back</a>

</div>

</div>

</body>
</html>