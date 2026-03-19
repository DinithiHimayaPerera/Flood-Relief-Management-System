<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="nav-links">

    <a href="dashboard.php" class="btn-nav <?php if($current_page=='dashboard.php') echo 'active'; ?>">Dashboard</a>

    <a href="view_requests.php" class="btn-nav <?php if($current_page=='view_requests.php') echo 'active'; ?>">View Requests</a>

    <a href="create_request.php" class="btn-nav <?php if($current_page=='create_request.php') echo 'active'; ?>">Create Request</a>

    <a href="logout.php" class="btn-nav btn-logout">Logout</a>

</div>