<?php
// includes/navbar.php - Top Navbar with Home, Browse Internships, About, Contact
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand font-weight-bold d-flex align-items-center gap-2" href="index.php">
      <div class="bg-white text-primary rounded-3 p-1 d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
        <i class="fas fa-graduation-cap"></i>
      </div>
      <span>Digital <span class="fw-light">Internship</span></span>
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarMain">
      <!-- Navbar Modules: Home, Browse Internships, About, Contact -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 font-weight-semibold">
        <li class="nav-item">
          <a class="nav-link text-white nav-link-custom px-3" href="index.php#home">
            <i class="fas fa-home me-1 opacity-75"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white nav-link-custom px-3" href="index.php#browse-internships">
            <i class="fas fa-search me-1 opacity-75"></i> Browse Internships
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white nav-link-custom px-3" href="index.php#about">
            <i class="fas fa-info-circle me-1 opacity-75"></i> About Us
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white nav-link-custom px-3" href="index.php#contact">
            <i class="fas fa-envelope me-1 opacity-75"></i> Contact Us
          </a>
        </li>
      </ul>
      
      <div class="d-flex align-items-center gap-2">
        <?php if ($user): ?>
          <span class="navbar-text text-white me-3 font-weight-semibold small">
            <i class="fas fa-user-circle me-1"></i> <?php echo htmlspecialchars($user['name']); ?> (<?php echo ucfirst($user['role']); ?>)
          </span>
          <a href="dashboard-<?php echo strtolower($user['role']); ?>.php" class="btn btn-warning btn-sm font-weight-bold shadow-sm me-2">
            <i class="fas fa-tachometer-alt me-1"></i> My Dashboard
          </a>
          <a href="logout.php" class="btn btn-outline-light btn-sm font-weight-bold">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
          </a>
        <?php else: ?>
          <a href="signin.php" class="btn btn-outline-light btn-sm font-weight-bold me-1 px-3">
            <i class="fas fa-sign-in-alt me-1"></i> Sign In
          </a>
          <a href="signup.php" class="btn btn-light text-primary btn-sm font-weight-bold px-3 shadow-sm">
            <i class="fas fa-user-plus me-1"></i> Get Started
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
