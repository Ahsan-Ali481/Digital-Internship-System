<?php
// includes/footer.php - Global Footer Component with Uniform Matching Light Text
?>
<footer class="bg-dark text-white pt-4 pb-3 mt-auto border-top">
  <div class="container">
    <div class="row g-4 pb-3">
      <div class="col-md-4">
        <h5 class="font-weight-bold text-white mb-2">
          <i class="fas fa-graduation-cap text-primary me-2"></i> Digital Internship System
        </h5>
        <p class="small mb-3">
          An enterprise university web application designed to connect students with verified workplace internships and institution supervisors.
        </p>
        <div class="d-flex gap-2">
          <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center;"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center;"><i class="fab fa-twitter"></i></a>
          <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center;"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center;"><i class="fab fa-github"></i></a>
        </div>
      </div>

      <div class="col-md-3">
        <h6 class="font-weight-bold text-white mb-2">Quick Navigation</h6>
        <ul class="list-unstyled text-small small mb-0">
          <li class="mb-1"><a href="index.php#home" class="text-decoration-none"><i class="fas fa-chevron-right me-1 text-primary"></i> Home</a></li>
          <li class="mb-1"><a href="index.php#browse-internships" class="text-decoration-none"><i class="fas fa-chevron-right me-1 text-primary"></i> Browse Internships</a></li>
          <li class="mb-1"><a href="index.php#how-it-works" class="text-decoration-none"><i class="fas fa-chevron-right me-1 text-primary"></i> How It Works</a></li>
          <li class="mb-1"><a href="index.php#about" class="text-decoration-none"><i class="fas fa-chevron-right me-1 text-primary"></i> User Roles</a></li>
          <li class="mb-1"><a href="index.php#contact" class="text-decoration-none"><i class="fas fa-chevron-right me-1 text-primary"></i> Contact Us</a></li>
        </ul>
      </div>

      <div class="col-md-2">
        <h6 class="font-weight-bold text-white mb-2">Account Portals</h6>
        <ul class="list-unstyled text-small small mb-0">
          <li class="mb-1"><a href="signin.php" class="text-decoration-none"><i class="fas fa-sign-in-alt me-1 text-warning"></i> Sign In</a></li>
          <li class="mb-1"><a href="signup.php" class="text-decoration-none"><i class="fas fa-user-plus me-1 text-success"></i> Register Account</a></li>
          <li class="mb-1"><a href="forgot-password.php" class="text-decoration-none"><i class="fas fa-key me-1 text-info"></i> Password Recovery</a></li>
        </ul>
      </div>

      <div class="col-md-3">
        <h6 class="font-weight-bold text-white mb-2">Contact Info</h6>
        <ul class="list-unstyled text-small small mb-0">
          <li class="mb-1"><i class="fas fa-map-marker-alt text-primary me-2"></i> Silicon Avenue, Islamabad, PK</li>
          <li class="mb-1"><i class="fas fa-envelope text-primary me-2"></i> support@digitalinternship.com</li>
          <li class="mb-1"><i class="fas fa-phone text-primary me-2"></i> +92 (51) 111-222-333</li>
        </ul>
      </div>
    </div>

    <hr class="border-secondary my-2">

    <div class="text-center">
      <p class="mb-0 small">&copy; <?php echo date('Y'); ?> Digital Internship System. Built with PHP, MySQL & Bootstrap 5.</p>
    </div>
  </div>
</footer>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Main App JS Engine -->
<script src="assets/js/app.js"></script>
</body>
</html>
