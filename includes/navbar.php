<?php
// includes/navbar.php - Student Project Navbar with Bootstrap 5
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand font-weight-bold flex items-center gap-2" href="index.php">
      <i class="fas fa-graduation-cap"></i> Digital Internship System
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white" href="index.php"><i class="fas fa-home me-1"></i> Home</a>
        </li>
        <?php if ($user): ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="dashboard-<?php echo strtolower($user['role']); ?>.php">
              <i class="fas fa-tachometer-alt me-1"></i> My Dashboard
            </a>
          </li>
        <?php endif; ?>
      </ul>
      <div class="d-flex items-center gap-2">
        <?php if ($user): ?>
          <span class="navbar-text text-white me-3 font-medium">
            <i class="fas fa-user-circle me-1"></i> <?php echo htmlspecialchars($user['name']); ?> (<?php echo ucfirst($user['role']); ?>)
          </span>
          <a href="logout.php" class="btn btn-outline-light btn-sm font-weight-bold">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
          </a>
        <?php else: ?>
          <a href="signin.php" class="btn btn-outline-light me-2"><i class="fas fa-sign-in-alt me-1"></i> Sign In</a>
          <a href="signup.php" class="btn btn-light text-primary font-weight-bold"><i class="fas fa-user-plus me-1"></i> Register</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
