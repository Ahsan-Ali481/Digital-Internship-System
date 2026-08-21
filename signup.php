<?php
// signup.php - Registration Page for Students and Company Managers
$pageTitle = "Register Account - Digital Internship System";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

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
                $stmt = $pdo->prepare("INSERT INTO users (user_uid, role, name, email, password, company_name, status) VALUES (?, ?, ?, ?, ?, ?, 'approved')");
                $userId = 'usr_' . time();
                $stmt->execute([$userId, $role, $name, $email, $password, $companyName]);
            } catch (Exception $e) {
                // Ignore DB duplicate error
            }
        }
        
        // Redirect to Sign In with success parameter
        header("Location: signin.php?registered=1&email=" . urlencode($email));
        exit();
    }
}
?>

<div class="container py-5 my-auto">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center py-3">
          <h4 class="mb-0 font-weight-bold"><i class="fas fa-user-plus me-2"></i> Register New Account</h4>
        </div>
        <div class="card-body p-4">

          <p class="text-muted small text-center mb-4">
            Students and Company Managers register here using their own custom Gmail address and password.
          </p>

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-1"></i> <?php echo $error; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form action="signup.php" method="POST" onsubmit="handleSignupJS(event)">
            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Account Role</label>
              <select name="role" id="reg-role" onchange="toggleCompanyFields()" class="form-select">
                <option value="student">Student Account</option>
                <option value="company">Company HR / Manager Account</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Full Name</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-user text-muted"></i></span>
                <input type="text" name="name" id="reg-name" class="form-control" required placeholder="John Doe">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Gmail / Email Address</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                <input type="email" name="email" id="reg-email" class="form-control" required placeholder="yourname@gmail.com">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-semibold text-secondary">Password</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password" id="reg-pass" class="form-control" required placeholder="Choose your password">
              </div>
            </div>

            <!-- Company HR Specific Fields -->
            <div id="company-fields" class="d-none">
              <div class="mb-3">
                <label class="form-label font-weight-semibold text-secondary">Company Name</label>
                <div class="input-group">
                  <span class="input-group-text bg-light"><i class="fas fa-building text-muted"></i></span>
                  <input type="text" name="companyName" id="reg-company-name" class="form-control" placeholder="e.g. TechCorp Solutions">
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 font-weight-bold shadow-sm mt-3">
              <i class="fas fa-check-circle me-1"></i> Complete Registration
            </button>
          </form>

        </div>
        <div class="card-footer bg-light text-center py-3">
          <span class="text-muted small">Already registered?</span>
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

function handleSignupJS(e) {
  const name = document.getElementById('reg-name').value;
  const email = document.getElementById('reg-email').value;
  const pass = document.getElementById('reg-pass').value;
  const role = document.getElementById('reg-role').value;
  const compName = document.getElementById('reg-company-name').value;

  const users = DIS.getUsers();
  users.push({
    id: 'usr_' + Date.now(),
    name,
    email,
    password: pass,
    role,
    companyName: compName || null,
    status: 'approved'
  });
  DIS.setUsers(users);
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
