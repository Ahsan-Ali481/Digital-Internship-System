<?php
// signin.php - Unified Login Screen for All Roles
$pageTitle = "Sign In - Digital Internship System";
require_once __DIR__ . '/config/db.php';

$error = '';
$success = '';

if (isset($_GET['logged_out'])) {
    $success = "You have been logged out successfully.";
}
if (isset($_GET['registered'])) {
    $success = "Account created successfully! Please sign in below.";
}

// Handle PHP POST Login Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = trim($_POST['role'] ?? '');

    if (empty($email) || empty($password)) {
        $error = "Please enter both Email and Password.";
    } else {
        // Sample fallback users array if DB is offline, or query PDO
        $userFound = null;
        if (isset($pdo)) {
            try {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
                $stmt->execute([$email]);
                $userFound = $stmt->fetch();
            } catch (Exception $e) {
                // fallback
            }
        }

        if (!$userFound) {
            // Default demo users fallback for testing
            $demoUsers = [
                'student@dis.com' => ['id' => 'usr_std1', 'name' => 'Ahmed Hassan', 'email' => 'student@dis.com', 'role' => 'student'],
                'hr@techcorp.com' => ['id' => 'usr_hr1', 'name' => 'Sarah Jenkins', 'email' => 'hr@techcorp.com', 'role' => 'company'],
                'supervisor@techcorp.com' => ['id' => 'usr_sup1', 'name' => 'Dr. Robert Chen', 'email' => 'supervisor@techcorp.com', 'role' => 'supervisor'],
                'admin@dis.com' => ['id' => 'usr_adm1', 'name' => 'System Admin', 'email' => 'admin@dis.com', 'role' => 'admin']
            ];
            if (isset($demoUsers[$email])) {
                $userFound = $demoUsers[$email];
            } else {
                // Create user session from input
                $userFound = [
                    'id' => 'usr_' . time(),
                    'name' => explode('@', $email)[0],
                    'email' => $email,
                    'role' => $role ?: 'student'
                ];
            }
        }

        // Set PHP Session
        $_SESSION['user'] = $userFound;
        $targetDashboard = "dashboard-" . strtolower($userFound['role']) . ".php";
        header("Location: {$targetDashboard}");
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
    <div class="col-md-6 col-lg-5">
      <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center py-3 rounded-top-3">
          <h4 class="mb-0 font-weight-bold"><i class="fas fa-lock me-2"></i> Account Sign In</h4>
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
                <input type="email" name="email" id="login-email" class="form-control" required placeholder="user@example.com">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Password</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-key text-muted"></i></span>
                <input type="password" name="password" id="login-password" class="form-control" required placeholder="••••••••">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Select User Role</label>
              <select name="role" id="login-role" class="form-select">
                <option value="student">Student</option>
                <option value="company">Company HR</option>
                <option value="supervisor">Workplace Supervisor</option>
                <option value="admin">System Admin</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 font-weight-bold shadow-sm">
              <i class="fas fa-sign-in-alt me-1"></i> Sign In to Dashboard
            </button>
          </form>

          <hr class="my-4">

          <!-- 1-Click Demo Login Buttons for Testing -->
          <div class="text-center">
            <p class="text-muted small font-weight-bold mb-2"><i class="fas fa-bolt text-warning me-1"></i> 1-Click Quick Demo Login:</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center flex-wrap">
              <button onclick="fillDemo('student@dis.com', '123456', 'student')" class="btn btn-outline-primary btn-sm">Student</button>
              <button onclick="fillDemo('hr@techcorp.com', '123456', 'company')" class="btn btn-outline-info btn-sm">Company HR</button>
              <button onclick="fillDemo('supervisor@techcorp.com', '123456', 'supervisor')" class="btn btn-outline-success btn-sm">Supervisor</button>
              <button onclick="fillDemo('admin@dis.com', '123456', 'admin')" class="btn btn-outline-warning btn-sm">Admin</button>
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
