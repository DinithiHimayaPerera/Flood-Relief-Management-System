<?php
include("../includes/config.php");
include("../includes/admin_auth.php");


$sql = "SELECT COUNT(*) FROM users";
$result = mysqli_query($conn, $sql);
$userCount = mysqli_fetch_row($result)[0];


$sql2 = "SELECT COUNT(*) FROM relief_requests";
$result2 = mysqli_query($conn, $sql2);
$requestCount = mysqli_fetch_row($result2)[0];


$sqlPending = "SELECT COUNT(*) FROM relief_requests 
               WHERE status='Pending' OR status IS NULL";
$resultPending = mysqli_query($conn, $sqlPending);
$pendingCount = mysqli_fetch_row($resultPending)[0];


$severityCounts = ['High'=>0,'Medium'=>0,'Low'=>0];

$sql3 = "SELECT severity, COUNT(*) as total 
         FROM relief_requests GROUP BY severity";

$res3 = mysqli_query($conn, $sql3);

while($row = mysqli_fetch_assoc($res3)){
    $severityCounts[$row['severity']] = $row['total'];
}


$reliefCounts = ['Food'=>0,'Water'=>0,'Medicine'=>0,'Shelter'=>0];

$sqlTypes = "SELECT relief_type, COUNT(*) AS total 
             FROM relief_requests 
             GROUP BY relief_type";

$resultTypes = mysqli_query($conn, $sqlTypes);

while ($row = mysqli_fetch_assoc($resultTypes)) {
    $reliefCounts[$row['relief_type']] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="css/admin.css">
</head>

<body>

<?php include("../includes/admin_nav.php"); ?>

<h2 class="mb-4">Dashboard</h2>


<div class="row mb-4">

    <div class="col-md-4">
        <div class="card shadow p-3">
            <h6>Total Users</h6>
            <h3><?php echo $userCount; ?></h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow p-3">
            <h6>Total Requests</h6>
            <h3>
                <?php echo $requestCount; ?>
                <br>
                <span class="badge bg-danger">
                    Pending: <?php echo $pendingCount; ?>
                </span>
            </h3>
        </div>
    </div>

</div>


<div class="row">

    
    <div class="col-md-6">
        <div class="card shadow p-4">
            <h5>Severity Overview</h5>
            <canvas id="severityChart"></canvas>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="card shadow p-4">
            <h5>Relief Type Distribution</h5>
            <canvas id="typeChart"></canvas>
        </div>
    </div>

</div>


<script>
window.onload = function() {

    
    new Chart(document.getElementById("severityChart"), {
        type: 'bar',
        data: {
            labels: ['High','Medium','Low'],
            datasets: [{
                label: 'Requests',
                data: [
                    <?php echo $severityCounts['High']; ?>,
                    <?php echo $severityCounts['Medium']; ?>,
                    <?php echo $severityCounts['Low']; ?>
                ],
                backgroundColor: ['#dc3545','#ffc107','#28a745']
            }]
        }
    });

    
    new Chart(document.getElementById("typeChart"), {
        type: 'doughnut',
        data: {
            labels: ['Food','Water','Medicine','Shelter'],
            datasets: [{
                data: [
                    <?php echo $reliefCounts['Food']; ?>,
                    <?php echo $reliefCounts['Water']; ?>,
                    <?php echo $reliefCounts['Medicine']; ?>,
                    <?php echo $reliefCounts['Shelter']; ?>
                ],
                backgroundColor: ['#0d6efd','#17a2b8','#ffc107','#28a745']
            }]
        }
    });

};
</script>

<?php include("../includes/admin_footer.php"); ?>

</body>
</html>