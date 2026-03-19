<?php
include("../includes/config.php");
include("../includes/admin_auth.php");

$sql = "SELECT * FROM relief_requests";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Relief Requests</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php include("../includes/admin_nav.php"); ?>

<div class="container mt-4">

    <h2 class="mb-4">Relief Requests</h2>

    <div class="card shadow p-4">

        <table class="table table-bordered table-hover">

            <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>District</th>
                <th>Severity</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

            <?php
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";

                echo "<td>".$row['request_id']."</td>";
                echo "<td>".$row['relief_type']."</td>";
                echo "<td>".$row['district']."</td>";
                echo "<td>".$row['severity']."</td>";

                
               echo "<td>";

    if($row['status'] == 'Accepted'){
        echo "<span class='badge bg-success'>Accepted</span>";
    }
    elseif($row['status'] == 'Rejected'){
        echo "<span class='badge bg-danger'>Rejected</span>";
    }
    else{
        echo "<span class='badge bg-warning text-dark'>Pending</span>";
    }

    echo "</td>";

    echo "<td>";

    echo "<a class='btn btn-sm btn-primary' 
            href='request_details.php?id=".$row['request_id']."'>
            View</a>";

    echo "</td>";

    echo "</tr>";
}
?>
            ?>

            </tbody>

        </table>

    </div>

</div>

<?php include("../includes/admin_footer.php"); ?>

</body>
</html>