<?php
// signup.php - Registration Page with Full Name, Gmail, Contact No, Password, Confirm Password
$pageTitle = "Register Account - Digital Internship System";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirmPassword = trim($_POST['confirm_password'] ?? '');
    $role = trim($_POST['role'] ?? 'student');
    $companyName = trim($_POST['companyName'] ?? '');

    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        $error = "Please fill in all required fields.";
    } elseif ($password !== $confirmPassword) {
        $error = "Password and Confirm Password do not match.";
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
        
        header("Location: signin.php?registered=1&email=" . urlencode($email));
        exit();
    }
}
?>

<div class="container py-5 my-auto">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="master-card-black p-0 overflow-hidden shadow-sm">
        <div class="bg-primary text-white text-center py-4">
          <h4 class="mb-0 font-weight-black text-white"><i class="fas fa-user-plus me-2"></i> Register New Account</h4>
        </div>
        <div class="p-4 p-md-5">

          <p class="text-black small text-center font-weight-bold mb-4">
            Fill in your details below to register your account.
          </p>

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show font-weight-bold" role="alert">
              <i class="fas fa-exclamation-circle me-1"></i> <?php echo $error; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form action="signup.php" method="POST" onsubmit="return handleSignupJS(event)">
            
            <!-- 1. Full Name -->
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Full Name</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-user text-primary"></i></span>
                <input type="text" name="name" id="reg-name" class="form-control py-2" required placeholder="e.g. John Doe">
              </div>
            </div>

            <!-- 2. Gmail Address -->
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Gmail Address</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-envelope text-primary"></i></span>
                <input type="email" name="email" id="reg-email" class="form-control py-2" required placeholder="yourname@gmail.com">
              </div>
            </div>

            <!-- 3. Contact No -->
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Contact No</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-phone text-primary"></i></span>
                <input type="tel" name="phone" id="reg-phone" class="form-control py-2" placeholder="+92 300 1234567">
              </div>
            </div>

            <!-- 4. Password -->
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Password</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-lock text-primary"></i></span>
                <input type="password" name="password" id="reg-pass" class="form-control py-2" required placeholder="Enter password">
              </div>
            </div>

            <!-- 5. Confirm Password -->
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Confirm Password</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-lock text-primary"></i></span>
                <input type="password" name="confirm_password" id="reg-confirm-pass" class="form-control py-2" required placeholder="Re-enter password">
              </div>
            </div>

            <!-- 6. Account Role -->
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Account Role</label>
              <select name="role" id="reg-role" onchange="toggleCompanyFields()" class="form-select py-2">
                <option value="student">Student Account</option>
                <option value="company">Company HR / Manager Account</option>
              </select>
            </div>

            <!-- 7. Company Name (If HR) -->
            <div id="company-fields" class="d-none">
              <div class="mb-3">
                <label class="form-label font-weight-black text-black">Company Name</label>
                <div class="input-group">
                  <span class="input-group-text bg-light"><i class="fas fa-building text-primary"></i></span>
                  <input type="text" name="companyName" id="reg-company-name" class="form-control py-2" placeholder="e.g. TechCorp Solutions">
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-black-primary w-100 py-3 font-weight-black shadow-sm mt-3">
              <i class="fas fa-check-circle me-2"></i> Complete Registration
            </button>
          </form>

        </div>
        <div class="card-footer bg-light text-center py-3 border-top">
          <span class="text-black small font-weight-bold">Already registered?</span>
          <a href="signin.php" class="text-primary font-weight-black ms-1">Sign In Here</a>
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
  const phone = document.getElementById('reg-phone').value;
  const pass = document.getElementById('reg-pass').value;
  const confirmPass = document.getElementById('reg-confirm-pass').value;
  const role = document.getElementById('reg-role').value;
  const compName = document.getElementById('reg-company-name').value;

  if (pass !== confirmPass) {
    if (typeof DIS !== 'undefined') {
      DIS.showToast('Password and Confirm Password do not match!', 'warning');
    } else {
      alert('Password and Confirm Password do not match!');
    }
    return false;
  }

  const users = DIS.getUsers();
  users.push({
    id: 'usr_' + Date.now(),
    name,
    email,
    phone: phone || '',
    password: pass,
    role,
    companyName: compName || null,
    status: 'approved'
  });
  DIS.setUsers(users);
  return true;
}
</script>

<!-- Bootstrap 5 Bundle JS & App Engine -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
