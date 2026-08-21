<?php
// index.php - Digital Internship System Landing Page
$pageTitle = "Digital Internship System - Home";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- Hero Banner Section -->
<section class="bg-primary text-white py-5">
  <div class="container text-center py-4">
    <h1 class="display-5 font-weight-bold mb-3">Digital Internship Management System</h1>
    <p class="lead mb-4 max-w-3xl mx-auto">
      A centralized web platform connecting Students, Verified Companies, Workplace Supervisors, and Administrators for seamless internship management.
    </p>
    <div class="d-flex justify-content-center gap-3">
      <a href="signup.php" class="btn btn-warning btn-lg font-weight-bold px-4 shadow-sm"><i class="fas fa-user-plus me-2"></i> Register Account</a>
      <a href="signin.php" class="btn btn-outline-light btn-lg font-weight-bold px-4"><i class="fas fa-sign-in-alt me-2"></i> Sign In to Portal</a>
    </div>
  </div>
</section>

<!-- System Modules Section (Linked directly from Top Navbar) -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="h2 font-weight-bold text-dark">System Modules & Capabilities</h2>
      <p class="text-muted">Structured tools designed for each participant role in the internship lifecycle.</p>
    </div>

    <div class="row g-4">
      <!-- Student Module Card -->
      <div class="col-md-6 col-lg-3" id="student-module">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <div class="bg-primary text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-user-graduate fa-2x"></i>
            </div>
            <h5 class="card-title font-weight-bold">Student Module</h5>
            <p class="card-text text-muted small">Browse internships, submit CV applications, view onsite interview schedules with date/time & physical venue address, and log weekly reports.</p>
          </div>
          <div class="card-footer bg-white border-0 text-center pb-3">
            <a href="signin.php" class="btn btn-outline-primary btn-sm w-100 font-weight-bold">Student Sign In</a>
          </div>
        </div>
      </div>

      <!-- Company HR Module Card -->
      <div class="col-md-6 col-lg-3" id="company-module">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <div class="bg-info text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-building fa-2x"></i>
            </div>
            <h5 class="card-title font-weight-bold">Company HR Module</h5>
            <p class="card-text text-muted small">Post new internships, review applicant resumes, schedule physical onsite interviews, and assign workplace supervisors.</p>
          </div>
          <div class="card-footer bg-white border-0 text-center pb-3">
            <a href="signin.php" class="btn btn-outline-info btn-sm w-100 font-weight-bold">Company HR Sign In</a>
          </div>
        </div>
      </div>

      <!-- Supervisor Module Card -->
      <div class="col-md-6 col-lg-3" id="supervisor-module">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <div class="bg-success text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-user-tie fa-2x"></i>
            </div>
            <h5 class="card-title font-weight-bold">Supervisor Module</h5>
            <p class="card-text text-muted small">Issue workplace tasks with deadlines, review weekly intern learning logs, and grade performance with 1-5 star ratings.</p>
          </div>
          <div class="card-footer bg-white border-0 text-center pb-3">
            <a href="signin.php" class="btn btn-outline-success btn-sm w-100 font-weight-bold">Supervisor Sign In</a>
          </div>
        </div>
      </div>

      <!-- Admin Module Card -->
      <div class="col-md-6 col-lg-3" id="admin-module">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <div class="bg-warning text-dark rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-user-shield fa-2x"></i>
            </div>
            <h5 class="card-title font-weight-bold">Admin Module</h5>
            <p class="card-text text-muted small">Manage user accounts, verify company certificates, audit internship completions, and export CSV reports.</p>
          </div>
          <div class="card-footer bg-white border-0 text-center pb-3">
            <a href="signin.php" class="btn btn-outline-warning btn-sm w-100 font-weight-bold text-dark">Admin Sign In</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Demo Credentials Section -->
<section class="bg-white py-5 border-top border-bottom">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h3 class="h3 font-weight-bold mb-3">Pre-Configured System Credentials</h3>
        <p class="text-muted">Use these exact credentials to test each portal role:</p>
        <div class="table-responsive">
          <table class="table table-bordered table-sm align-middle">
            <thead class="table-light">
              <tr>
                <th>User Role</th>
                <th>Email Address</th>
                <th>Password</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><span class="badge bg-primary">Student</span></td>
                <td><code>ahmed123@gmail.com</code></td>
                <td><code>123456789</code></td>
              </tr>
              <tr>
                <td><span class="badge bg-info">Company HR</span></td>
                <td><code>hr123@gmail.com</code></td>
                <td><code>123456789</code></td>
              </tr>
              <tr>
                <td><span class="badge bg-success">Supervisor</span></td>
                <td><code>supervisor123@gmail.com</code></td>
                <td><code>123456789</code></td>
              </tr>
              <tr>
                <td><span class="badge bg-warning text-dark">Admin</span></td>
                <td><code>admin123@gmail.com</code></td>
                <td><code>12345678</code></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card shadow-sm border-0 bg-primary text-white p-4">
          <h4 class="card-title font-weight-bold mb-3"><i class="fas fa-key me-2"></i> Password Recovery Policy</h4>
          <p class="card-text">Students, Companies, and Supervisors can reset forgotten passwords using the <strong>Forgot Password</strong> feature. Admin accounts cannot reset passwords online for security reasons.</p>
          <a href="signin.php" class="btn btn-light text-primary font-weight-bold"><i class="fas fa-arrow-right me-1"></i> Proceed to Sign In</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
