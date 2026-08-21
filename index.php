<?php
// index.php - Student Level Project Landing Page
$pageTitle = "Digital Internship System - Home";
require_once __DIR__ . '/config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

<?php require_once __DIR__ . '/includes/navbar.php'; ?>

<!-- Hero Section -->
<section class="bg-primary text-white py-5">
  <div class="container text-center py-4">
    <h1 class="display-4 font-weight-bold mb-3">Digital Internship Management System</h1>
    <p class="lead mb-4 max-w-2xl mx-auto">
      An intermediate web application connecting Students, Companies, Workplace Supervisors, and System Administrators for streamlined internship workflows.
    </p>
    <div class="d-flex justify-content-center gap-3">
      <a href="signup.php" class="btn btn-warning btn-lg font-weight-bold px-4"><i class="fas fa-user-plus me-2"></i> Get Started</a>
      <a href="signin.php" class="btn btn-outline-light btn-lg font-weight-bold px-4"><i class="fas fa-sign-in-alt me-2"></i> Demo Login</a>
    </div>
  </div>
</section>

<!-- System Modules Section -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="h2 font-weight-bold text-dark">System Modules & User Roles</h2>
      <p class="text-muted">Explore the four primary user roles supported in the system.</p>
    </div>

    <div class="row g-4">
      <!-- Student Module -->
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <div class="bg-primary-subtle text-primary rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-user-graduate fa-2x"></i>
            </div>
            <h5 class="card-title font-weight-bold">Student Module</h5>
            <p class="card-text text-muted small">Browse internships, submit CV applications, view onsite interview schedules, and log weekly reports.</p>
          </div>
          <div class="card-footer bg-white border-0 text-center pb-3">
            <a href="signin.php" class="btn btn-outline-primary btn-sm w-100">Student Login</a>
          </div>
        </div>
      </div>

      <!-- Company HR Module -->
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <div class="bg-info-subtle text-info rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-building fa-2x"></i>
            </div>
            <h5 class="card-title font-weight-bold">Company HR Module</h5>
            <p class="card-text text-muted small">Post new internships, review candidate CVs, schedule physical onsite interviews, and assign supervisors.</p>
          </div>
          <div class="card-footer bg-white border-0 text-center pb-3">
            <a href="signin.php" class="btn btn-outline-info btn-sm w-100">HR Login</a>
          </div>
        </div>
      </div>

      <!-- Supervisor Module -->
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <div class="bg-success-subtle text-success rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-user-tie fa-2x"></i>
            </div>
            <h5 class="card-title font-weight-bold">Supervisor Module</h5>
            <p class="card-text text-muted small">Monitor assigned interns, assign workplace tasks, review weekly learning logs, and submit ratings.</p>
          </div>
          <div class="card-footer bg-white border-0 text-center pb-3">
            <a href="signin.php" class="btn btn-outline-success btn-sm w-100">Supervisor Login</a>
          </div>
        </div>
      </div>

      <!-- Admin Module -->
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <div class="bg-warning-subtle text-warning rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-user-shield fa-2x"></i>
            </div>
            <h5 class="card-title font-weight-bold">Admin Module</h5>
            <p class="card-text text-muted small">Manage user accounts, verify company certificates, review internship completions, and export CSV reports.</p>
          </div>
          <div class="card-footer bg-white border-0 text-center pb-3">
            <a href="signin.php" class="btn btn-outline-warning btn-sm w-100">Admin Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- System Features Section -->
<section class="bg-white py-5 border-top border-bottom">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h3 class="h3 font-weight-bold mb-3">Project Features & Architecture</h3>
        <p class="text-muted">This intermediate student project implements standard web development practices with PHP and MySQL.</p>
        <ul class="list-group list-group-flush mb-3">
          <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-success me-2"></i> Clean PHP session-based user authentication</li>
          <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-success me-2"></i> Relational MySQL Database with PDO queries</li>
          <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-success me-2"></i> Bootstrap 5 responsive layouts and components</li>
          <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-success me-2"></i> Onsite physical interview scheduler with venue address</li>
          <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-success me-2"></i> Student profile manager with Email/Gmail editing</li>
        </ul>
      </div>
      <div class="col-lg-6">
        <div class="card shadow-sm border-0 bg-primary text-white p-4">
          <h4 class="card-title mb-3"><i class="fas fa-info-circle me-2"></i> Quick Demo Access</h4>
          <p class="card-text">You can test all 4 role dashboards directly using the 1-Click Demo Login options on the Sign In page.</p>
          <a href="signin.php" class="btn btn-light text-primary font-weight-bold"><i class="fas fa-arrow-right me-1"></i> Go to Sign In Page</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
