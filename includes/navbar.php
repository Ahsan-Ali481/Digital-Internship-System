<?php
// includes/navbar.php - Hyper-Modern Top Navigation Bar (No user name text, generous spacing, hover lift)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<nav class="navbar navbar-expand-lg navbar-stylish sticky-top py-3">
  <div class="container">
    <a class="navbar-brand fw-black d-flex align-items-center gap-2" href="index.php">
      <div class="bg-primary text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 44px; height: 44px;">
        <i class="fas fa-graduation-cap text-white fs-5"></i>
      </div>
      <span class="fs-4 text-black fw-black">Digital <span class="text-primary">Internship</span></span>
    </a>
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarMain">
      <!-- Modern Navigation Links with High Padding & Distance -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-black ms-lg-5 d-flex gap-3 gap-lg-5">
        <li class="nav-item">
          <a class="nav-link nav-link-modern-hover text-black" href="index.php#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-modern-hover text-black" href="index.php#browse-internships">Browse Internships</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-modern-hover text-black" href="index.php#about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-modern-hover text-black" href="index.php#contact">Contact Us</a>
        </li>
      </ul>
      
      <!-- Clean Action Buttons (User name completely removed) -->
      <div class="d-flex align-items-center gap-3 ms-lg-4">
        <?php if ($user): ?>
          <a href="logout.php" class="btn btn-black-secondary btn-sm px-4">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
          </a>
        <?php else: ?>
          <a href="signin.php" class="btn btn-black-secondary btn-sm px-4">
            <i class="fas fa-sign-in-alt me-1"></i> Sign In
          </a>
          <a href="signup.php" class="btn btn-black-primary btn-sm px-4">
            <i class="fas fa-user-plus me-1"></i> Get Started
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
