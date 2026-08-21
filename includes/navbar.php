<?php
// includes/navbar.php - Top Navigation Bar (Solid Black Text)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<nav class="navbar navbar-expand-lg bg-white sticky-top border-bottom border-2 border-slate-200 py-3 shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-black d-flex align-items-center gap-2" href="index.php">
      <div class="bg-primary text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;">
        <i class="fas fa-graduation-cap text-white"></i>
      </div>
      <span class="fs-4 text-black fw-black">Digital <span class="text-primary">Internship</span></span>
    </a>
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-black fs-6 ms-lg-4">
        <li class="nav-item">
          <a class="nav-link text-black px-3" href="index.php#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-black px-3" href="index.php#browse-internships">Browse Internships</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-black px-3" href="index.php#about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-black px-3" href="index.php#contact">Contact Us</a>
        </li>
      </ul>
      
      <div class="d-flex align-items-center gap-2">
        <?php if ($user): ?>
          <span class="navbar-text text-black me-3 font-weight-black">
            <i class="fas fa-user-circle me-1 text-primary"></i> <?php echo htmlspecialchars($user['name']); ?> (<?php echo ucfirst($user['role']); ?>)
          </span>
          <a href="dashboard-<?php echo strtolower($user['role']); ?>.php" class="btn btn-black-primary btn-sm px-4">
            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
          </a>
          <a href="logout.php" class="btn btn-black-secondary btn-sm px-3">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
          </a>
        <?php else: ?>
          <a href="signin.php" class="btn btn-black-secondary btn-sm px-4 me-1">
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
