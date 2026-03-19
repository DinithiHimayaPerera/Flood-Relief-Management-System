<style>
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    box-sizing: border-box; 
    background: rgba(15, 32, 39, 0.95);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
}
.nav-brand {
    color: #fff;
    font-size: 22px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
    letter-spacing: 1px;
}
.nav-brand i { color: #11998e; }
.nav-links {
    list-style: none;
    display: flex;
    gap: 25px;
    margin: 0;
}
.nav-links li a {
    color: #ddd;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}
.nav-links li a:hover { color: #11998e; }
.logout-btn {
    background: #ff416c;
    color: white;
    padding: 8px 18px;
    text-decoration: none;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}
.logout-btn:hover {
    background: #ff4b2b;
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(255, 65, 108, 0.3);
}
@media (max-width: 768px) {
    .navbar { flex-direction: column; padding: 15px; gap: 15px; }
    .nav-links { gap: 15px; flex-wrap: wrap; justify-content: center; }
}
</style>

<nav class="navbar">
    <div class="nav-brand">
        <i class="fas fa-water"></i> Flood Relief
    </div>
    <ul class="nav-links">
        <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="view_requests.php"><i class="fas fa-list"></i> My Requests</a></li>
        <li><a href="create_request.php"><i class="fas fa-plus-circle"></i> New Request</a></li>
    </ul>
    <div class="nav-logout">
        <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</nav>