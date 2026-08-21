<?php
// includes/navbar.php - Classic Professional Top Navigation Bar
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<nav class="navbar navbar-expand-lg navbar-classic sticky-top py-3">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="index.php">
      <div class="bg-primary text-white rounded-2 p-2 d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
        <i class="fas fa-graduation-cap text-white fs-6"></i>
      </div>
      <span class="fs-4 text-black fw-bold">Digital <span class="text-primary">Internship</span></span>
    </a>
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarMain">
      <!-- Classic Professional Navigation Links with Comfortable Spacing -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold ms-lg-4 d-flex gap-2 gap-lg-3">
        <li class="nav-item">
          <a class="nav-link nav-link-classic text-black" href="index.php#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-classic text-black" href="index.php#browse-internships">Browse Internships</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-classic text-black" href="index.php#about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-classic text-black" href="index.php#contact">Contact Us</a>
        </li>
      </ul>
      
      <!-- Clean Action Buttons -->
      <div class="d-flex align-items-center gap-2 ms-lg-3">
        <?php if ($user): ?>
          <a href="logout.php" class="btn btn-black-secondary btn-sm px-4 font-weight-bold">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
          </a>
        <?php else: ?>
          <a href="signin.php" class="btn btn-black-secondary btn-sm px-4 font-weight-bold me-1">
            <i class="fas fa-sign-in-alt me-1"></i> Sign In
          </a>
          <a href="signup.php" class="btn btn-black-primary btn-sm px-4 font-weight-bold">
            <i class="fas fa-user-plus me-1"></i> Get Started
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
