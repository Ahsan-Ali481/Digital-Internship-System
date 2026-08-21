<?php
// includes/navbar.php - Corporate Top Navigation Bar
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<nav class="navbar navbar-expand-lg bg-white sticky-top border-bottom py-3">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="index.php">
      <div class="bg-primary text-white rounded-2 p-2 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
        <i class="fas fa-graduation-cap"></i>
      </div>
      <span class="fs-5 text-dark fw-bold">Digital <span class="text-primary">Internship</span></span>
    </a>
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarMain">
      <!-- Clean Corporate Navigation Links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-semibold fs-6 ms-lg-4">
        <li class="nav-item">
          <a class="nav-link nav-link-corp px-3" href="index.php#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-corp px-3" href="index.php#browse-internships">Browse Internships</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-corp px-3" href="index.php#about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-corp px-3" href="index.php#contact">Contact Us</a>
        </li>
      </ul>
      
      <div class="d-flex align-items-center gap-2">
        <?php if ($user): ?>
          <span class="navbar-text text-dark me-3 font-weight-semibold small">
            <i class="fas fa-user-circle me-1 text-primary"></i> <?php echo htmlspecialchars($user['name']); ?> (<?php echo ucfirst($user['role']); ?>)
          </span>
          <a href="dashboard-<?php echo strtolower($user['role']); ?>.php" class="btn btn-corp-primary btn-sm px-3">
            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
          </a>
          <a href="logout.php" class="btn btn-corp-secondary btn-sm px-3">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
          </a>
        <?php else: ?>
          <a href="signin.php" class="btn btn-corp-secondary btn-sm px-3 me-1">
            <i class="fas fa-sign-in-alt me-1"></i> Sign In
          </a>
          <a href="signup.php" class="btn btn-corp-primary btn-sm px-3">
            <i class="fas fa-user-plus me-1"></i> Get Started
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
