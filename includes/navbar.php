<?php
// includes/navbar.php - Top Navigation Bar for Landing Page with All System Modules
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand font-weight-bold d-flex align-items-center gap-2" href="index.php">
      <i class="fas fa-graduation-cap fa-lg"></i> Digital Internship System
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMain">
      <!-- System Modules links displayed directly in Top Navbar -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 font-weight-semibold">
        <li class="nav-item">
          <a class="nav-link text-white" href="index.php"><i class="fas fa-home me-1"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="index.php#student-module"><i class="fas fa-user-graduate me-1"></i> Student Module</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="index.php#company-module"><i class="fas fa-building me-1"></i> Company HR Module</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="index.php#supervisor-module"><i class="fas fa-user-tie me-1"></i> Supervisor Module</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="index.php#admin-module"><i class="fas fa-user-shield me-1"></i> Admin Module</a>
        </li>
      </ul>
      
      <div class="d-flex align-items-center gap-2">
        <?php if ($user): ?>
          <span class="navbar-text text-white me-3 font-weight-semibold">
            <i class="fas fa-user-circle me-1"></i> <?php echo htmlspecialchars($user['name']); ?> (<?php echo ucfirst($user['role']); ?>)
          </span>
          <a href="dashboard-<?php echo strtolower($user['role']); ?>.php" class="btn btn-warning btn-sm font-weight-bold me-2">
            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
          </a>
          <a href="logout.php" class="btn btn-outline-light btn-sm font-weight-bold">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
          </a>
        <?php else: ?>
          <a href="signin.php" class="btn btn-outline-light me-2 font-weight-bold"><i class="fas fa-sign-in-alt me-1"></i> Sign In</a>
          <a href="signup.php" class="btn btn-light text-primary font-weight-bold"><i class="fas fa-user-plus me-1"></i> Register</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
