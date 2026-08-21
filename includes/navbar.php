<?php
// includes/navbar.php - Top Navigation Bar with Contextual Emojis
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top border-bottom border-2 border-slate-200 py-3">
  <div class="container">
    <a class="navbar-brand fw-extrabold d-flex align-items-center gap-2" href="index.php">
      <div class="bg-gradient-primary text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 44px; height: 44px;">
        <span class="fs-4">🎓</span>
      </div>
      <span class="fs-4 text-dark fw-black">Digital <span class="gradient-text-mask">Internship</span></span>
    </a>
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarMain">
      <!-- Navbar Modules with Contextual Emojis -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-extrabold fs-6 ms-lg-4">
        <li class="nav-item">
          <a class="nav-link text-dark hover-indigo px-3" href="index.php#home">
            <span class="emoji-icon me-1">🏠</span> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark hover-indigo px-3" href="index.php#browse-internships">
            <span class="emoji-icon me-1">🔍</span> Browse Internships
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark hover-indigo px-3" href="index.php#about">
            <span class="emoji-icon me-1">ℹ️</span> About Us
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark hover-indigo px-3" href="index.php#contact">
            <span class="emoji-icon me-1">✉️</span> Contact Us
          </a>
        </li>
      </ul>
      
      <div class="d-flex align-items-center gap-2">
        <?php if ($user): ?>
          <span class="navbar-text text-dark me-3 font-weight-bold">
            <span class="emoji-icon me-1">👤</span> <?php echo htmlspecialchars($user['name']); ?> (<?php echo ucfirst($user['role']); ?>)
          </span>
          <a href="dashboard-<?php echo strtolower($user['role']); ?>.php" class="btn btn-premium-primary btn-sm px-4">
            <span class="emoji-icon me-1">📊</span> Dashboard
          </a>
          <a href="logout.php" class="btn btn-premium-secondary btn-sm px-3">
            <span class="emoji-icon me-1">🚪</span> Logout
          </a>
        <?php else: ?>
          <a href="signin.php" class="btn btn-premium-secondary btn-sm px-4 me-1">
            <span class="emoji-icon me-1">🔑</span> Sign In
          </a>
          <a href="signup.php" class="btn btn-premium-primary btn-sm px-4">
            <span class="emoji-icon me-1">🚀</span> Get Started
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
