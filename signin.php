<?php
// signin.php - Unified User Sign In Page (NO FOOTER AS REQUESTED)
$pageTitle = "Sign In - Digital Internship System";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$error = '';
$success = '';

if (isset($_GET['logged_out'])) {
    $success = "You have been logged out successfully.";
}
if (isset($_GET['registered'])) {
    $registeredEmail = htmlspecialchars($_GET['email'] ?? '');
    $success = "Account registered successfully! Please sign in with your Gmail (" . $registeredEmail . ") and password.";
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

        $preconfiguredUsers = [
            'admin123@gmail.com' => ['id' => 'usr_adm1', 'name' => 'System Admin', 'email' => 'admin123@gmail.com', 'role' => 'admin'],
            'supervisor123@gmail.com' => ['id' => 'usr_sup1', 'name' => 'Workplace Supervisor', 'email' => 'supervisor123@gmail.com', 'role' => 'supervisor']
        ];

        if (isset($preconfiguredUsers[$email])) {
            $userFound = $preconfiguredUsers[$email];
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
                            'role' => $row['role'],
                            'companyName' => $row['company_name'] ?? null
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
      <div class="master-card-black p-0 overflow-hidden shadow-sm">
        <div class="bg-primary text-white text-center py-4">
          <h4 class="mb-0 font-weight-black text-white"><i class="fas fa-lock me-2"></i> User Sign In</h4>
        </div>
        <div class="p-4 p-md-5">

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show font-weight-bold" role="alert">
              <i class="fas fa-exclamation-circle me-1"></i> <?php echo $error; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <?php if (!empty($success)): ?>
            <div class="alert alert-success alert-dismissible fade show font-weight-bold" role="alert">
              <i class="fas fa-check-circle me-1"></i> <?php echo $success; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form action="signin.php" method="POST" onsubmit="handleSigninJS(event)">
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Gmail / Email Address</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-envelope text-primary"></i></span>
                <input type="email" name="email" id="login-email" class="form-control py-2" required placeholder="yourname@gmail.com">
              </div>
            </div>

            <div class="mb-3">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <label class="form-label font-weight-black text-black mb-0">Password</label>
                <a href="forgot-password.php" class="small text-primary font-weight-black text-decoration-none">
                  Forgot Password?
                </a>
              </div>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-lock text-primary"></i></span>
                <input type="password" name="password" id="login-password" class="form-control py-2" required placeholder="••••••••">
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label font-weight-black text-black">Account Role</label>
              <select name="role" id="login-role" class="form-select py-2">
                <option value="student">Student Account</option>
                <option value="company">Company HR / Manager</option>
                <option value="supervisor">Workplace Supervisor</option>
                <option value="admin">System Admin</option>
              </select>
            </div>

            <button type="submit" class="btn btn-black-primary w-100 py-3 font-weight-black shadow-sm">
              <i class="fas fa-sign-in-alt me-2"></i> Sign In to Portal
            </button>
          </form>

          <hr class="my-4">

          <div class="text-center">
            <p class="text-black small font-weight-black mb-2">Pre-Configured Demo Accounts:</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
              <button onclick="fillDemo('supervisor123@gmail.com', '123456789', 'supervisor')" class="btn btn-outline-success btn-sm font-weight-black">
                Supervisor Demo
              </button>
              <button onclick="fillDemo('admin123@gmail.com', '12345678', 'admin')" class="btn btn-outline-warning btn-sm text-black font-weight-black">
                Admin Demo
              </button>
            </div>
          </div>

        </div>
        <div class="card-footer bg-light text-center py-3 border-top">
          <span class="text-black small font-weight-bold">Don't have an account yet?</span>
          <a href="signup.php" class="text-primary font-weight-black ms-1">Register Account</a>
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

function handleSigninJS(e) {
  const email = document.getElementById('login-email').value;
  const pass = document.getElementById('login-password').value;
  const role = document.getElementById('login-role').value;

  const users = DIS.getUsers();
  let user = users.find(u => u.email === email);
  if (!user) {
    user = {
      id: 'usr_' + Date.now(),
      name: email.split('@')[0],
      email: email,
      role: role,
      status: 'approved'
    };
    users.push(user);
    DIS.setUsers(users);
  }
  DIS.setCurrentUser(user);
}
</script>

<!-- Bootstrap 5 Bundle JS & App Engine -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
