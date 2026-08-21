<?php
// dashboard-admin.php - System Administrator Portal
$pageTitle = "Admin Portal - Digital Internship System";
require_once __DIR__ . '/includes/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['user'] = [
        'id' => 'usr_adm1',
        'name' => 'System Admin',
        'email' => 'admin123@gmail.com',
        'role' => 'admin'
    ];
}
$currentAdmin = $_SESSION['user'];
?>

<!-- Top Header Bar -->
<header class="bg-white border-bottom py-2 sticky-top shadow-sm">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <a href="index.php" class="navbar-brand font-weight-bold text-primary mb-0">
        <i class="fas fa-graduation-cap me-1"></i> Digital Internship System
      </a>
      <span class="badge bg-warning text-dark font-weight-bold">Administrator Portal</span>
    </div>
    
    <div class="d-flex align-items-center gap-3">
      <button onclick="toggleNotificationModal()" class="btn btn-outline-primary btn-sm position-relative">
        <i class="fas fa-bell"></i>
        <span id="notif-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
      </button>
    </div>
  </div>
</header>

<div class="container-fluid px-4 py-4">
  <div class="row g-4">
    <!-- Left Sidebar Navigation -->
    <div class="col-md-3 col-lg-2">
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center p-3">
          <div class="bg-warning text-dark rounded-circle mx-auto d-flex align-items-center justify-center mb-2" style="width: 50px; height: 50px;">
            <i class="fas fa-user-shield fa-lg"></i>
          </div>
          <h6 class="font-weight-bold mb-0"><?php echo htmlspecialchars($currentAdmin['name']); ?></h6>
          <small class="text-muted extra-small d-block text-break"><?php echo htmlspecialchars($currentAdmin['email']); ?></small>
        </div>
        
        <div class="list-group list-group-flush border-top">
          <button onclick="switchAdminTab('users')" class="list-group-item list-group-item-action active text-start font-weight-semibold" id="link-adm-users">
            <i class="fas fa-users me-2 text-primary"></i> User Management
          </button>
          <button onclick="switchAdminTab('companies')" class="list-group-item list-group-item-action text-start font-weight-semibold" id="link-adm-companies">
            <i class="fas fa-certificate me-2 text-info"></i> Company Certificates
          </button>
          <button onclick="switchAdminTab('reports')" class="list-group-item list-group-item-action text-start font-weight-semibold" id="link-adm-reports">
            <i class="fas fa-file-export me-2 text-success"></i> Export CSV Reports
          </button>
          <a href="logout.php" class="list-group-item list-group-item-action text-danger text-start font-weight-semibold">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
          </a>
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="col-md-9 col-lg-10">
      
      <!-- Stats Header -->
      <div class="row g-3 mb-4">
        <div class="col-md-3">
          <div class="card border-0 shadow-sm bg-primary text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <small class="text-white-50">Total Users</small>
                <h3 class="mb-0 font-weight-bold" id="adm-stat-users">0</h3>
              </div>
              <i class="fas fa-users fa-2x opacity-50"></i>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card border-0 shadow-sm bg-info text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <small class="text-white-50">Companies</small>
                <h3 class="mb-0 font-weight-bold" id="adm-stat-companies">0</h3>
              </div>
              <i class="fas fa-building fa-2x opacity-50"></i>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card border-0 shadow-sm bg-success text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <small class="text-white-50">Internships</small>
                <h3 class="mb-0 font-weight-bold" id="adm-stat-internships">0</h3>
              </div>
              <i class="fas fa-briefcase fa-2x opacity-50"></i>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card border-0 shadow-sm bg-warning text-dark p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <small class="text-dark-50">Applications</small>
                <h3 class="mb-0 font-weight-bold" id="adm-stat-apps">0</h3>
              </div>
              <i class="fas fa-file-alt fa-2x opacity-50"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- TAB 1: USER MANAGEMENT -->
      <div id="tab-adm-users" class="tab-content">
        <h4 class="font-weight-bold mb-3">Registered Users Management</h4>
        <div class="card shadow-sm border-0">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>User Name</th>
                  <th>Email Address</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="admin-users-table-body">
                <!-- Dynamically populated -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- TAB 2: COMPANY CERTIFICATES -->
      <div id="tab-adm-companies" class="tab-content d-none">
        <h4 class="font-weight-bold mb-3">Company Certificate Verification</h4>
        <div id="company-cert-list" class="space-y-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 3: CSV REPORTS GENERATOR -->
      <div id="tab-adm-reports" class="tab-content d-none">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-white font-weight-bold">
            <i class="fas fa-file-csv text-success me-2"></i> Export System Audit Reports (CSV Format)
          </div>
          <div class="card-body">
            <p class="text-muted small mb-4">Export structured CSV data for university audit and evaluation records.</p>
            <div class="row g-3">
              <div class="col-md-4">
                <div class="p-3 border rounded text-center bg-light">
                  <h6 class="font-weight-bold">Users Directory</h6>
                  <p class="extra-small text-muted mb-3">Export all registered users.</p>
                  <button onclick="DIS.exportCSV('users')" class="btn btn-outline-primary btn-sm w-100 font-weight-bold"><i class="fas fa-download me-1"></i> Export Users CSV</button>
                </div>
              </div>
              <div class="col-md-4">
                <div class="p-3 border rounded text-center bg-light">
                  <h6 class="font-weight-bold">Internship Postings</h6>
                  <p class="extra-small text-muted mb-3">Export all posted opportunities.</p>
                  <button onclick="DIS.exportCSV('internships')" class="btn btn-outline-success btn-sm w-100 font-weight-bold"><i class="fas fa-download me-1"></i> Export Postings CSV</button>
                </div>
              </div>
              <div class="col-md-4">
                <div class="p-3 border rounded text-center bg-light">
                  <h6 class="font-weight-bold">Applications Log</h6>
                  <p class="extra-small text-muted mb-3">Export application statuses.</p>
                  <button onclick="DIS.exportCSV('applications')" class="btn btn-outline-warning btn-sm w-100 font-weight-bold"><i class="fas fa-download me-1"></i> Export Applications CSV</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- NOTIFICATIONS MODAL -->
<div class="modal fade" id="notifModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold"><i class="fas fa-bell text-warning me-2"></i> Notifications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="notif-list-container" class="space-y-2"></div>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/app.js"></script>
<script>
  const currentAdmin = DIS.checkAuth(['admin']);

  document.addEventListener('DOMContentLoaded', () => {
    if (!currentAdmin) return;
    renderAdminStats();
    renderUsersTable();
    renderCompanyCertificates();
    loadNotifications();
  });

  function switchAdminTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('d-none'));
    document.querySelectorAll('.list-group-item').forEach(el => el.classList.remove('active'));

    document.getElementById(`tab-adm-${tabId}`).classList.remove('d-none');
    document.getElementById(`link-adm-${tabId}`).classList.add('active');
  }

  function renderAdminStats() {
    const users = DIS.getUsers();
    const internships = DIS.getInternships();
    const apps = DIS.getApplications();
    const companies = users.filter(u => u.role === 'company');

    document.getElementById('adm-stat-users').innerText = users.length;
    document.getElementById('adm-stat-companies').innerText = companies.length;
    document.getElementById('adm-stat-internships').innerText = internships.length;
    document.getElementById('adm-stat-apps').innerText = apps.length;
  }

  function renderUsersTable() {
    const users = DIS.getUsers();
    const tbody = document.getElementById('admin-users-table-body');
    tbody.innerHTML = '';

    users.forEach(u => {
      let roleBadge = 'bg-primary';
      if (u.role === 'company') roleBadge = 'bg-info';
      if (u.role === 'supervisor') roleBadge = 'bg-success';
      if (u.role === 'admin') roleBadge = 'bg-warning text-dark';

      const isBlocked = u.status === 'blocked';
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><div class="font-weight-bold">${u.name}</div></td>
        <td class="small">${u.email}</td>
        <td><span class="badge ${roleBadge}">${u.role}</span></td>
        <td><span class="badge ${isBlocked ? 'bg-danger' : 'bg-success'}">${isBlocked ? 'Blocked' : 'Active'}</span></td>
        <td>
          <div class="btn-group btn-group-sm">
            <button onclick="toggleUserStatus('${u.id}')" class="btn btn-outline-${isBlocked ? 'success' : 'warning'}" title="${isBlocked ? 'Unblock' : 'Block'}">
              <i class="fas ${isBlocked ? 'fa-check-circle' : 'fa-ban'}"></i>
            </button>
            <button onclick="deleteUser('${u.id}')" class="btn btn-outline-danger" title="Delete User"><i class="fas fa-trash-alt"></i></button>
          </div>
        </td>
      `;
      tbody.appendChild(tr);
    });
  }

  function toggleUserStatus(userId) {
    const users = DIS.getUsers();
    const u = users.find(x => x.id === userId);
    if (u) {
      u.status = u.status === 'blocked' ? 'active' : 'blocked';
      DIS.setUsers(users);
      DIS.showToast(`User status updated to ${u.status}`, 'success');
      renderUsersTable();
    }
  }

  function deleteUser(userId) {
    if (confirm('Delete this user account?')) {
      let users = DIS.getUsers();
      users = users.filter(u => u.id !== userId);
      DIS.setUsers(users);
      DIS.showToast('User deleted!', 'info');
      renderUsersTable();
      renderAdminStats();
    }
  }

  function renderCompanyCertificates() {
    const companies = DIS.getUsers().filter(u => u.role === 'company');
    const container = document.getElementById('company-cert-list');
    container.innerHTML = '';

    if (companies.length === 0) {
      container.innerHTML = '<div class="text-center py-4 text-muted">No companies registered.</div>';
      return;
    }

    companies.forEach(c => {
      const isVerified = c.verified === true;
      const card = document.createElement('div');
      card.className = 'card shadow-sm border-0 mb-3';
      card.innerHTML = `
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h6 class="font-weight-bold mb-1">${c.companyName || c.name}</h6>
            <small class="text-muted"><i class="fas fa-envelope me-1"></i> ${c.email}</small>
          </div>
          <div>
            ${isVerified ? `
              <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Verified</span>
            ` : `
              <button onclick="verifyCompany('${c.id}')" class="btn btn-success btn-sm font-weight-bold">
                <i class="fas fa-certificate me-1"></i> Verify Certificate
              </button>
            `}
          </div>
        </div>
      `;
      container.appendChild(card);
    });
  }

  function verifyCompany(compId) {
    const users = DIS.getUsers();
    const comp = users.find(u => u.id === compId);
    if (comp) {
      comp.verified = true;
      DIS.setUsers(users);
      DIS.showToast('Company verified!', 'success');
      renderCompanyCertificates();
    }
  }

  function loadNotifications() {
    const notifs = DIS.getNotifications(currentAdmin.id);
    const container = document.getElementById('notif-list-container');
    if (!container) return;
    container.innerHTML = notifs.length ? '' : '<div class="text-center text-muted small py-3">No notifications</div>';
    notifs.forEach(n => {
      container.innerHTML += `<div class="p-2 border rounded small bg-light mb-2"><strong>${n.title}</strong><br>${n.message}</div>`;
    });
  }

  function toggleNotificationModal() {
    const bsModal = new bootstrap.Modal(document.getElementById('notifModal'));
    bsModal.show();
  }
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
