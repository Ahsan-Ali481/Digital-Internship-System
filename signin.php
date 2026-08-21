<?php
// signin.php - User Sign In Page
$pageTitle = "Sign In - Digital Internship System";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$error = '';
$success = '';

if (isset($_GET['logged_out'])) {
    $success = "You have been logged out successfully.";
}
if (isset($_GET['registered'])) {
    $success = "Account registered successfully! Please sign in below.";
}
if (isset($_GET['password_reset'])) {
    $success = "Password reset successfully! Please sign in with your new password.";
}

// Handle Login Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = trim($_POST['role'] ?? '');

    if (empty($email) || empty($password)) {
        $error = "Please enter both Email and Password.";
    } else {
        $userFound = null;

        // Credentials mapping for exact requested defaults
        $demoUsers = [
            'admin123@gmail.com' => ['id' => 'usr_adm1', 'name' => 'System Admin', 'email' => 'admin123@gmail.com', 'role' => 'admin', 'password' => '12345678'],
            'ahmed123@gmail.com' => ['id' => 'usr_std1', 'name' => 'Ahmed Hassan', 'email' => 'ahmed123@gmail.com', 'role' => 'student', 'password' => '123456789'],
            'hr123@gmail.com' => ['id' => 'usr_hr1', 'name' => 'Sarah Jenkins', 'email' => 'hr123@gmail.com', 'role' => 'company', 'password' => '123456789'],
            'supervisor123@gmail.com' => ['id' => 'usr_sup1', 'name' => 'Dr. Robert Chen', 'email' => 'supervisor123@gmail.com', 'role' => 'supervisor', 'password' => '123456789']
        ];

        if (isset($demoUsers[$email])) {
            $userFound = $demoUsers[$email];
        } else {
            if (isset($pdo)) {
                try {
                    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
                    $stmt->execute([$email]);
                    $row = $stmt->fetch();
                    if ($row) {
                        $userFound = [
                            'id' => $row['user_uid'],
                            'name' => $row['name'],
                            'email' => $row['email'],
                            'role' => $row['role']
                        ];
                    }
                } catch (Exception $e) {}
            }
        }

        if (!$userFound) {
            $userFound = [
                'id' => 'usr_' . time(),
                'name' => explode('@', $email)[0],
                'email' => $email,
                'role' => $role ?: 'student'
            ];
        }

        $_SESSION['user'] = $userFound;
        header("Location: dashboard-" . strtolower($userFound['role']) . ".php");
        exit();
    }
}
?>

<div class="container py-5 my-auto">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center py-3">
          <h4 class="mb-0 font-weight-bold"><i class="fas fa-lock me-2"></i> User Sign In</h4>
        </div>
        <div class="card-body p-4">

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-1"></i> <?php echo $error; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <?php if (!empty($success)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle me-1"></i> <?php echo $success; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form action="signin.php" method="POST">
            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Email Address</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                <input type="email" name="email" id="login-email" class="form-control" required placeholder="user@gmail.com">
              </div>
            </div>

            <div class="mb-3">
              <div class="d-flex justify-content-between align-items-center">
                <label class="form-label font-weight-semibold text-secondary mb-0">Password</label>
                <!-- Forgot Password Link for Student, Company, Supervisor -->
                <a href="forgot-password.php" class="small text-primary font-weight-semibold text-decoration-none">
                  <i class="fas fa-key me-1"></i> Forgot Password?
                </a>
              </div>
              <div class="input-group mt-1">
                <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password" id="login-password" class="form-control" required placeholder="••••••••">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Account Role</label>
              <select name="role" id="login-role" class="form-select">
                <option value="student">Student</option>
                <option value="company">Company HR</option>
                <option value="supervisor">Workplace Supervisor</option>
                <option value="admin">System Admin</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 font-weight-bold shadow-sm">
              <i class="fas fa-sign-in-alt me-1"></i> Sign In
            </button>
          </form>

          <hr class="my-4">

          <!-- 1-Click Quick Demo Login Shortcuts -->
          <div class="text-center">
            <p class="text-muted small font-weight-bold mb-2"><i class="fas fa-bolt text-warning me-1"></i> 1-Click Quick Demo Access:</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center flex-wrap">
              <button onclick="fillDemo('ahmed123@gmail.com', '123456789', 'student')" class="btn btn-outline-primary btn-sm font-weight-bold">Student</button>
              <button onclick="fillDemo('hr123@gmail.com', '123456789', 'company')" class="btn btn-outline-info btn-sm font-weight-bold">Company HR</button>
              <button onclick="fillDemo('supervisor123@gmail.com', '123456789', 'supervisor')" class="btn btn-outline-success btn-sm font-weight-bold">Supervisor</button>
              <button onclick="fillDemo('admin123@gmail.com', '12345678', 'admin')" class="btn btn-outline-warning btn-sm text-dark font-weight-bold">Admin</button>
            </div>
          </div>

        </div>
        <div class="card-footer bg-light text-center py-3">
          <span class="text-muted small">Don't have an account?</span>
          <a href="signup.php" class="text-primary font-weight-bold ms-1">Register Here</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function fillDemo(email, pass, role) {
  document.getElementById('login-email').value = email;
  document.getElementById('login-password').value = pass;
  document.getElementById('login-role').value = role;
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
