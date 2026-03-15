<?php



include("../includes/config.php");
include("../includes/admin_auth.php");
include("../includes/admin_nav.php");
$userCount = 0;

$sql = "SELECT COUNT(*) FROM users";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_row($result);
    $userCount = $row[0];
}
$requestCount= 0;
$sql2="SELECT COUNT(*) FROM relief_requests";
$result2=mysqli_query($conn,$sql2);
if($result2){
    $row2=mysqli_fetch_row($result2);
    $requestCount=$row2[0];
}

$severityCounts = [];

$sqlTypes = "
    SELECT severity, COUNT(*) AS total 
    FROM relief_requests 
    GROUP BY severity
";

$resultTypes = mysqli_query($conn, $sqlTypes);

if ($resultTypes) {
    while ($row3 = mysqli_fetch_assoc($resultTypes)) {
        $severityCounts[$row3['severity']] = $row3['total'];
    }
}

$reliefCounts = [];

$sqlTypes2 = "
    SELECT relief_type, COUNT(*) AS total 
    FROM relief_requests 
    GROUP BY relief_type
";

$resultTypes2 = mysqli_query($conn, $sqlTypes2);

if ($resultTypes2) {
    while ($row = mysqli_fetch_assoc($resultTypes2)) {
        $reliefCounts[$row['relief_type']] = $row['total'];
    }
}

?>

<h1>Welcome to Admin Dashboard</h1>
<p>Database connected successfully</p>
<h2>Admin Dashboard</h2>
<p>Total Registered Users: <?php echo $userCount; ?></p>
<p>Total Relief Requests:<?php echo $requestCount;?>
<p>High Severity Households:<?php echo $severityCounts['High'] ??0;?>
<p>Medium Severity  Households:<?php echo $severityCounts['Medium'] ??0;?>
<p>Low Severity Households:<?php echo $severityCounts['Low'] ??0;?>
<p>Food Requests: <?php echo $reliefCounts['Food'] ?? 0; ?></p>
<p>Water Requests: <?php echo $reliefCounts['Water'] ?? 0; ?></p>
<p>Medicine Requests: <?php echo $reliefCounts['Medicine'] ?? 0; ?></p>
<p>Shelter Requests: <?php echo $reliefCounts['Shelter'] ?? 0; ?></p>
</p>


