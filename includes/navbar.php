<?php
// includes/navbar.php - 100% Mathematically Balanced & Proportionate Navbar
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<nav class="navbar navbar-expand-lg navbar-classic sticky-top py-3">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2 me-lg-4 me-xl-5" href="index.php">
      <div class="bg-primary text-white rounded-2 p-2 d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
        <i class="fas fa-graduation-cap text-white fs-6"></i>
      </div>
      <span class="fs-4 text-black fw-bold">Digital <span class="text-primary">Internship</span></span>
    </a>
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarMain">
      <!-- 100% Perfectly Proportional Navigation Links & Action Button Grid -->
      <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-lg-between w-100 mt-3 mt-lg-0">
        
        <ul class="navbar-nav mb-2 mb-lg-0 fw-bold d-flex align-items-lg-center justify-content-start gap-3 gap-lg-4 gap-xl-5 mx-lg-auto">
          <li class="nav-item">
            <a class="nav-link nav-link-equal text-black" href="index.php#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-equal text-black" href="index.php#browse-internships">Browse Internships</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-equal text-black" href="index.php#about">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-equal text-black" href="index.php#contact">Contact Us</a>
          </li>
        </ul>
        
        <!-- Clean Balanced Action Button -->
        <div class="d-flex align-items-center ms-lg-3 mt-2 mt-lg-0">
          <?php if ($user): ?>
            <a href="logout.php" class="btn btn-black-secondary btn-sm px-4 font-weight-bold">
              <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
          <?php else: ?>
            <a href="signin.php" class="btn btn-black-primary btn-sm px-4 font-weight-bold">
              <i class="fas fa-sign-in-alt me-1"></i> Sign In
            </a>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
</nav>
