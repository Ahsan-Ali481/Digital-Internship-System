<?php
// dashboard-admin.php - High Contrast Administrator Portal with Flat Classic Vertical Sidebar Panel
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

<!-- High Contrast Top Header Bar with Menu Toggle -->
<header class="bg-white border-bottom border-2 border-slate-200 py-3 sticky-top shadow-sm">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <!-- Menu Toggle Button -->
      <button onclick="toggleSidebarMenu()" class="btn btn-black-secondary btn-sm px-3 font-weight-black d-flex align-items-center gap-2" id="btn-toggle-menu">
        <i class="fas fa-bars text-primary" id="menu-icon"></i> <span>Menu</span>
      </button>

      <a href="index.php" class="navbar-brand fw-black text-black mb-0 d-flex align-items-center gap-2">
        <div class="bg-warning text-dark rounded-3 p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
          <i class="fas fa-user-shield"></i>
        </div>
        <span class="fs-4 text-black fw-black">Digital <span class="text-primary">Internship</span></span>
      </a>
      <span class="badge badge-black-pill badge-amber px-3 py-2">Administrator Portal</span>
    </div>
    
    <div class="d-flex align-items-center gap-3">
      <button onclick="toggleNotificationModal()" class="btn btn-black-secondary btn-sm position-relative px-3">
        <i class="fas fa-bell me-1 text-warning"></i> Notifications
        <span id="notif-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
      </button>
    </div>
  </div>
</header>

<div class="container-fluid px-0">
  <div class="row g-0">
    
    <!-- Flat Classic Vertical Sidebar Panel (NO CARD BOX, NO BLINK) -->
    <div class="col-md-3 col-lg-2" id="sidebar-wrapper">
      <div class="vertical-sidebar-panel">
        
        <div class="text-center pb-3 mb-3 border-bottom">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-2 shadow-sm" style="width: 52px; height: 52px; background-color: #fef3c7;">
            <i class="fas fa-user-shield fa-lg text-warning"></i>
          </div>
          <h6 class="fw-black mb-0 text-black"><?php echo htmlspecialchars($currentAdmin['name']); ?></h6>
          <small class="text-black font-weight-black extra-small d-block text-break"><?php echo htmlspecialchars($currentAdmin['email']); ?></small>
        </div>

        <!-- Vertical Scroller Container -->
        <div class="vertical-sidebar-scroll d-flex flex-column gap-1">
          <button onclick="switchAdminTab('users')" class="sidebar-link-flat active" id="link-adm-users">
            <i class="fas fa-users me-2 text-primary"></i> <span>Users Management</span>
          </button>
          <button onclick="switchAdminTab('companies')" class="sidebar-link-flat" id="link-adm-companies">
            <i class="fas fa-certificate me-2 text-primary"></i> <span>Certificates</span>
          </button>
          <button onclick="switchAdminTab('reports')" class="sidebar-link-flat" id="link-adm-reports">
            <i class="fas fa-file-export me-2 text-primary"></i> <span>Export Reports</span>
          </button>
          <a href="logout.php" class="sidebar-link-flat text-danger text-decoration-none mt-2">
            <i class="fas fa-sign-out-alt me-2 text-danger"></i> <span>Logout</span>
          </a>
        </div>

      </div>
    </div>

    <!-- Main Content Area -->
    <div class="col-md-9 col-lg-10 p-4" id="main-content-col">
      
      <!-- Stats Header Widgets -->
      <div class="row g-4 mb-4">
        <div class="col-md-3">
          <div class="master-card-black p-4 text-center">
            <h3 class="font-weight-black mb-1 text-primary fs-1" id="adm-stat-users">0</h3>
            <p class="text-black font-weight-black mb-0 small">Total Users</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="master-card-black p-4 text-center">
            <h3 class="font-weight-black mb-1 text-info fs-1" id="adm-stat-companies">0</h3>
            <p class="text-black font-weight-black mb-0 small">Companies</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="master-card-black p-4 text-center">
            <h3 class="font-weight-black mb-1 text-success fs-1" id="adm-stat-internships">0</h3>
            <p class="text-black font-weight-black mb-0 small">Internships</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="master-card-black p-4 text-center">
            <h3 class="font-weight-black mb-1 text-warning fs-1" id="adm-stat-apps">0</h3>
            <p class="text-black font-weight-black mb-0 small">Applications</p>
          </div>
        </div>
      </div>

      <!-- TAB 1: USER MANAGEMENT -->
      <div id="tab-adm-users" class="tab-content">
        <h3 class="fw-black text-black mb-3">Registered Users Directory</h3>
        <div class="master-card-black p-0 overflow-hidden">
          <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
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
        <h3 class="fw-black text-black mb-3">Company Certificate Verification</h3>
        <div id="company-cert-list" class="space-y-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 3: CSV REPORTS GENERATOR -->
      <div id="tab-adm-reports" class="tab-content d-none">
        <div class="master-card-black p-4">
          <h4 class="fw-black text-black mb-2">
            <i class="fas fa-file-csv text-success me-2"></i> Export System Audit Reports (CSV Format)
          </h4>
          <p class="text-black font-weight-bold small mb-4">Export structured CSV data for university audit and evaluation records.</p>
          <div class="row g-3">
            <div class="col-md-4">
              <div class="master-card-black p-3 text-center">
                <h5 class="fw-black text-black mb-1">Users Directory</h5>
                <p class="extra-small text-black font-weight-bold mb-3">Export all registered users.</p>
                <button onclick="DIS.exportCSV('users')" class="btn btn-black-secondary btn-sm w-100 font-weight-black"><i class="fas fa-download me-1"></i> Export Users CSV</button>
              </div>
            </div>
            <div class="col-md-4">
              <div class="master-card-black p-3 text-center">
                <h5 class="fw-black text-black mb-1">Internship Postings</h5>
                <p class="extra-small text-black font-weight-bold mb-3">Export all posted opportunities.</p>
                <button onclick="DIS.exportCSV('internships')" class="btn btn-black-secondary btn-sm w-100 font-weight-black"><i class="fas fa-download me-1"></i> Export Postings CSV</button>
              </div>
            </div>
            <div class="col-md-4">
              <div class="master-card-black p-3 text-center">
                <h5 class="fw-black text-black mb-1">Applications Log</h5>
                <p class="extra-small text-black font-weight-bold mb-3">Export application statuses.</p>
                <button onclick="DIS.exportCSV('applications')" class="btn btn-black-secondary btn-sm w-100 font-weight-black"><i class="fas fa-download me-1"></i> Export Applications CSV</button>
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
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-white border-bottom border-2 py-3">
        <h5 class="modal-title font-weight-black text-black"><i class="fas fa-bell text-warning me-2"></i> Notifications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div id="notif-list-container" class="space-y-2"></div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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

  function toggleSidebarMenu() {
    const sidebarWrapper = document.getElementById('sidebar-wrapper');
    const mainContentCol = document.getElementById('main-content-col');
    const menuIcon = document.getElementById('menu-icon');

    if (sidebarWrapper) {
      sidebarWrapper.classList.toggle('d-none');
      if (sidebarWrapper.classList.contains('d-none')) {
        if (mainContentCol) {
          mainContentCol.classList.remove('col-md-9', 'col-lg-10');
          mainContentCol.classList.add('col-12');
        }
        if (menuIcon) menuIcon.className = 'fas fa-bars text-primary';
      } else {
        if (mainContentCol) {
          mainContentCol.classList.remove('col-12');
          mainContentCol.classList.add('col-md-9', 'col-lg-10');
        }
        if (menuIcon) menuIcon.className = 'fas fa-times text-danger';
      }
    }
  }

  function switchAdminTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('d-none'));
    document.querySelectorAll('.sidebar-link-flat').forEach(el => el.classList.remove('active'));

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
      let roleBadge = 'badge-indigo';
      if (u.role === 'company') roleBadge = 'badge-sky';
      if (u.role === 'supervisor') roleBadge = 'badge-emerald';
      if (u.role === 'admin') roleBadge = 'badge-amber';

      const isBlocked = u.status === 'blocked';
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><div class="fw-black text-black">${u.name}</div></td>
        <td class="small text-black font-weight-bold">${u.email}</td>
        <td><span class="badge badge-black-pill ${roleBadge}">${u.role}</span></td>
        <td><span class="badge badge-black-pill ${isBlocked ? 'badge-danger' : 'badge-emerald'}">${isBlocked ? 'Blocked' : 'Active'}</span></td>
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
      container.innerHTML = '<div class="text-center py-4 text-black font-weight-black">No companies registered.</div>';
      return;
    }

    companies.forEach(c => {
      const isVerified = c.verified === true;
      const card = document.createElement('div');
      card.className = 'master-card-black p-4 mb-3 d-flex justify-content-between align-items-center';
      card.innerHTML = `
        <div>
          <h5 class="fw-black mb-1 text-black">${c.companyName || c.name}</h5>
          <small class="text-primary font-weight-bold"><i class="fas fa-envelope me-1"></i> ${c.email}</small>
        </div>
        <div>
          ${isVerified ? `
            <span class="badge badge-black-pill badge-emerald"><i class="fas fa-check-circle me-1"></i> Verified Certificate</span>
          ` : `
            <button onclick="verifyCompany('${c.id}')" class="btn btn-black-primary btn-sm font-weight-black">
              <i class="fas fa-certificate me-1"></i> Verify Certificate
            </button>
          `}
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
    container.innerHTML = notifs.length ? '' : '<div class="text-center text-black font-weight-black small py-3">No notifications</div>';
    notifs.forEach(n => {
      container.innerHTML += `<div class="p-3 border rounded-3 small bg-light mb-2 text-black font-weight-bold"><strong>${n.title}</strong><br>${n.message}</div>`;
    });
  }

  function toggleNotificationModal() {
    const bsModal = new bootstrap.Modal(document.getElementById('notifModal'));
    bsModal.show();
  }
</script>
</body>
</html>
