<?php

include("../includes/config.php");
include("../includes/admin_auth.php");
include("../includes/admin_nav.php");


$userCount = 0;
$sql = "SELECT COUNT(*) FROM users";
$result = mysqli_query($conn,$sql);

if($result){
    $row = mysqli_fetch_row($result);
    $userCount = $row[0];
}


$requestCount = 0;
$sql2 = "SELECT COUNT(*) FROM relief_requests";
$result2 = mysqli_query($conn,$sql2);

if($result2){
    $row2 = mysqli_fetch_row($result2);
    $requestCount = $row2[0];
}


$severityCounts = [];

$sql3 = "
SELECT severity, COUNT(*) as total
FROM relief_requests
GROUP BY severity
";

$result3 = mysqli_query($conn,$sql3);

if($result3){
    while($row3 = mysqli_fetch_assoc($result3)){
        $severityCounts[$row3['severity']] = $row3['total'];
    }
}


$reliefCounts = [];

$sql4 = "
SELECT relief_type, COUNT(*) as total
FROM relief_requests
GROUP BY relief_type
";

$result4 = mysqli_query($conn,$sql4);

if($result4){
    while($row4 = mysqli_fetch_assoc($result4)){
        $reliefCounts[$row4['relief_type']] = $row4['total'];
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/admin.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<div class="dashboard-container">

<h1>Admin Dashboard</h1>

<div class="stat-cards">

<div class="card">
Total Users
<strong><?php echo $userCount; ?></strong>
</div>

<div class="card">
Total Requests
<strong><?php echo $requestCount; ?></strong>
</div>

<div class="card">
High Severity
<strong><?php echo $severityCounts['High'] ?? 0; ?></strong>
</div>

<div class="card">
Medium Severity
<strong><?php echo $severityCounts['Medium'] ?? 0; ?></strong>
</div>

<div class="card">
Low Severity
<strong><?php echo $severityCounts['Low'] ?? 0; ?></strong>
</div>

</div>


<h2>Severity Distribution</h2>
<canvas id="severityChart"></canvas>


<h2>Relief Requests</h2>
<canvas id="reliefChart"></canvas>


</div>


<script>



const severityChart = document.getElementById('severityChart');

new Chart(severityChart, {
    type: 'bar',
    data: {
        labels: ['High','Medium','Low'],
        datasets: [{
            label: 'Severity Households',
            data: [
                <?php echo $severityCounts['High'] ?? 0; ?>,
                <?php echo $severityCounts['Medium'] ?? 0; ?>,
                <?php echo $severityCounts['Low'] ?? 0; ?>
            ],
            backgroundColor:[
                '#e74c3c',
                '#f1c40f',
                '#2ecc71'
            ]
        }]
    }
});




const reliefChart = document.getElementById('reliefChart');

new Chart(reliefChart,{
    type:'bar',
    data:{
        labels:['Food','Water','Medicine','Shelter'],
        datasets:[{
            label:'Relief Requests',
            data:[
                <?php echo $reliefCounts['Food'] ?? 0; ?>,
                <?php echo $reliefCounts['Water'] ?? 0; ?>,
                <?php echo $reliefCounts['Medicine'] ?? 0; ?>,
                <?php echo $reliefCounts['Shelter'] ?? 0; ?>
            ],
            backgroundColor:'#1E5A8A'
        }]
    }
});

</script>

</body>
</html>