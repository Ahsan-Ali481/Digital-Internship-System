<?php
// includes/footer.php - Global Footer Component with Navigation Links
?>
<footer class="bg-dark text-white pt-4 pb-3 mt-auto border-top">
  <div class="container">
    <div class="row g-4 pb-3">
      <div class="col-md-5">
        <h5 class="font-weight-bold text-white mb-2">
          <i class="fas fa-graduation-cap text-primary me-2"></i> Digital Internship System
        </h5>
        <p class="text-white-50 small mb-0">
          An intermediate university web application designed to connect students with verified workplace internships and institution supervisors.
        </p>
      </div>

      <div class="col-md-3">
        <h6 class="font-weight-bold text-white mb-2">Quick Navigation</h6>
        <ul class="list-unstyled text-small small mb-0">
          <li class="mb-1"><a href="index.php#home" class="text-white-50 text-decoration-none"><i class="fas fa-chevron-right me-1 text-primary"></i> Home</a></li>
          <li class="mb-1"><a href="index.php#browse-internships" class="text-white-50 text-decoration-none"><i class="fas fa-chevron-right me-1 text-primary"></i> Browse Internships</a></li>
          <li class="mb-1"><a href="index.php#about" class="text-white-50 text-decoration-none"><i class="fas fa-chevron-right me-1 text-primary"></i> About Us</a></li>
          <li class="mb-1"><a href="index.php#contact" class="text-white-50 text-decoration-none"><i class="fas fa-chevron-right me-1 text-primary"></i> Contact Us</a></li>
        </ul>
      </div>

      <div class="col-md-4">
        <h6 class="font-weight-bold text-white mb-2">Account Portals</h6>
        <ul class="list-unstyled text-small small mb-0">
          <li class="mb-1"><a href="signin.php" class="text-white-50 text-decoration-none"><i class="fas fa-sign-in-alt me-1 text-warning"></i> Portal Sign In</a></li>
          <li class="mb-1"><a href="signup.php" class="text-white-50 text-decoration-none"><i class="fas fa-user-plus me-1 text-success"></i> Account Registration</a></li>
          <li class="mb-1"><a href="forgot-password.php" class="text-white-50 text-decoration-none"><i class="fas fa-key me-1 text-info"></i> Password Recovery</a></li>
        </ul>
      </div>
    </div>

    <hr class="border-secondary my-2">

    <div class="text-center">
      <p class="mb-0 text-white-50 small">&copy; <?php echo date('Y'); ?> Digital Internship System. Built with PHP, MySQL & Bootstrap 5.</p>
    </div>
  </div>
</footer>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Main App JS Engine -->
<script src="assets/js/app.js"></script>
</body>
</html>
