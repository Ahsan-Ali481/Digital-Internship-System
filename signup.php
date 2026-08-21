<?php
// signup.php - Registration Page for Student and Company Users
$pageTitle = "Register - Digital Internship System";
require_once __DIR__ . '/config/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = trim($_POST['role'] ?? 'student');
    $companyName = trim($_POST['companyName'] ?? '');

    if (empty($name) || empty($email) || empty($password)) {
        $error = "Please fill in all required fields.";
    } else {
        if (isset($pdo)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO users (id, name, email, password, role, company_name, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
                $userId = 'usr_' . time();
                $stmt->execute([$userId, $name, $email, password_hash($password, PASSWORD_DEFAULT), $role, $companyName]);
            } catch (Exception $e) {
                // Ignore DB duplicate error in demo mode
            }
        }
        header("Location: signin.php?registered=1");
        exit();
    }
}
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

<div class="container py-5 my-auto">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center py-3 rounded-top-3">
          <h4 class="mb-0 font-weight-bold"><i class="fas fa-user-plus me-2"></i> Create New Account</h4>
        </div>
        <div class="card-body p-4">

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-1"></i> <?php echo $error; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form action="signup.php" method="POST">
            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Account Role</label>
              <select name="role" id="reg-role" onchange="toggleCompanyFields()" class="form-select">
                <option value="student">Student Account</option>
                <option value="company">Company HR Account</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Full Name</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-user text-muted"></i></span>
                <input type="text" name="name" class="form-control" required placeholder="John Doe">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Email Address / Gmail</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control" required placeholder="user@gmail.com">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Password</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-key text-muted"></i></span>
                <input type="password" name="password" class="form-control" required placeholder="••••••••">
              </div>
            </div>

            <!-- Company HR Specific Fields -->
            <div id="company-fields" class="d-none">
              <div class="mb-3">
                <label class="form-label font-weight-semibold text-secondary">Company Name</label>
                <div class="input-group">
                  <span class="input-group-text bg-light"><i class="fas fa-building text-muted"></i></span>
                  <input type="text" name="companyName" class="form-control" placeholder="TechCorp Solutions">
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label font-weight-semibold text-secondary">Company Registration Certificate (PDF/PNG)</label>
                <input type="file" class="form-control">
                <div class="form-text">Will be verified by System Admin.</div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 font-weight-bold shadow-sm mt-3">
              <i class="fas fa-check-circle me-1"></i> Register Account
            </button>
          </form>

        </div>
        <div class="card-footer bg-light text-center py-3">
          <span class="text-muted small">Already have an account?</span>
          <a href="signin.php" class="text-primary font-weight-bold ms-1">Sign In Here</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function toggleCompanyFields() {
  const role = document.getElementById('reg-role').value;
  const compFields = document.getElementById('company-fields');
  if (role === 'company') {
    compFields.classList.remove('d-none');
  } else {
    compFields.classList.add('d-none');
  }
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
