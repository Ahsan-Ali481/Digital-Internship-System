<?php
// forgot-password.php - Corporate Password Recovery Page
$pageTitle = "Forgot Password - Digital Internship System";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $role = trim($_POST['role'] ?? '');
    $newPassword = trim($_POST['new_password'] ?? '');

    if ($role === 'admin' || strtolower($email) === 'admin123@gmail.com' || strpos(strtolower($email), 'admin') !== false) {
        $error = "Security Policy Notice: Password recovery is NOT allowed for Administrator accounts online. Administrator passwords can only be updated manually by system superuser.";
    } elseif (empty($email) || empty($newPassword)) {
        $error = "Please enter your registered Email address and new Password.";
    } else {
        if (isset($pdo)) {
            try {
                $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ? AND role != 'admin'");
                $stmt->execute([$newPassword, $email]);
            } catch (Exception $e) {}
        }
        
        header("Location: signin.php?password_reset=1");
        exit();
    }
}
?>

<div class="container py-5 my-auto">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="corp-card p-0 overflow-hidden shadow-sm">
        <div class="bg-primary text-white text-center py-4">
          <h4 class="mb-0 font-weight-bold text-white"><i class="fas fa-key me-2"></i> Password Recovery</h4>
        </div>
        <div class="p-4 p-md-5">

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show font-weight-semibold" role="alert">
              <i class="fas fa-shield-alt me-1"></i> <?php echo $error; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form action="forgot-password.php" method="POST">
            <div class="mb-3">
              <label class="form-label font-weight-semibold text-dark">Select Your Account Role</label>
              <select name="role" id="reset-role" class="form-select py-2" onchange="checkAdminPolicy()">
                <option value="student">Student Account</option>
                <option value="company">Company HR Account</option>
                <option value="supervisor">Workplace Supervisor Account</option>
                <option value="admin">System Admin Account (Disabled)</option>
              </select>
              <div id="admin-warning" class="form-text text-danger d-none mt-1 font-weight-semibold">
                <i class="fas fa-exclamation-triangle me-1"></i> Password reset is disabled for Admin accounts for security reasons.
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-semibold text-dark">Registered Gmail Address</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                <input type="email" name="email" id="reset-email" class="form-control py-2" required placeholder="user@gmail.com">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-semibold text-dark">New Password</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="new_password" id="reset-pass" class="form-control py-2" required placeholder="Enter new password">
              </div>
            </div>

            <button type="submit" id="reset-btn" class="btn btn-corp-primary w-100 py-3 font-weight-bold shadow-sm">
              <i class="fas fa-sync-alt me-2"></i> Reset Password & Sign In
            </button>
          </form>

        </div>
        <div class="card-footer bg-light text-center py-3 border-top">
          <a href="signin.php" class="text-secondary font-weight-bold text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Back to Sign In</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function checkAdminPolicy() {
  const role = document.getElementById('reset-role').value;
  const warning = document.getElementById('admin-warning');
  const btn = document.getElementById('reset-btn');

  if (role === 'admin') {
    warning.classList.remove('d-none');
    btn.disabled = true;
    btn.classList.add('btn-secondary');
    btn.classList.remove('btn-corp-primary');
  } else {
    warning.classList.add('d-none');
    btn.disabled = false;
    btn.classList.remove('btn-secondary');
    btn.classList.add('btn-corp-primary');
  }
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
