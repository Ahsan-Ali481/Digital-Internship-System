<?php
// dashboard-company.php - High Contrast Company HR Portal
$pageTitle = "Company HR Portal - Digital Internship System";
require_once __DIR__ . '/includes/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'company') {
    $_SESSION['user'] = [
        'id' => 'usr_hr1',
        'name' => 'Sarah Jenkins',
        'email' => 'hr123@gmail.com',
        'role' => 'company',
        'companyName' => 'TechCorp Solutions'
    ];
}
$currentCompany = $_SESSION['user'];
?>

<!-- High Contrast Header Bar -->
<header class="bg-white border-bottom border-2 border-slate-200 py-3 sticky-top shadow-sm">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <a href="index.php" class="navbar-brand fw-black text-black mb-0 d-flex align-items-center gap-2">
        <div class="bg-primary text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
          <i class="fas fa-building text-white"></i>
        </div>
        <span class="fs-4 text-black fw-black">Digital <span class="text-primary">Internship</span></span>
      </a>
      <span class="badge badge-black-pill badge-sky px-3 py-2">Company HR Portal</span>
    </div>
    
    <div class="d-flex align-items-center gap-3">
      <button onclick="toggleNotificationModal()" class="btn btn-black-secondary btn-sm position-relative px-3">
        <i class="fas fa-bell me-1 text-warning"></i> Notifications
        <span id="notif-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
      </button>
    </div>
  </div>
</header>

<div class="container-fluid px-4 py-4">
  <div class="row g-4">
    <!-- Left Sidebar Navigation -->
    <div class="col-md-3 col-lg-2">
      <div class="master-card-black mb-4 p-3 text-center">
        <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-2 shadow-sm" style="width: 56px; height: 56px; background-color: #e0f2fe;">
          <i class="fas fa-building fa-lg text-info"></i>
        </div>
        <h6 class="fw-black mb-0 text-black"><?php echo htmlspecialchars($currentCompany['companyName'] ?? $currentCompany['name']); ?></h6>
        <small class="text-black font-weight-black extra-small d-block text-break"><?php echo htmlspecialchars($currentCompany['email']); ?></small>

        <div class="pt-3 mt-3 border-top d-flex flex-column gap-2">
          <button onclick="switchCompanyTab('post')" class="sidebar-link active w-100 text-start border-0" id="link-hr-post">
            <i class="fas fa-plus-circle me-2"></i> Post Opportunity
          </button>
          <button onclick="switchCompanyTab('apps')" class="sidebar-link w-100 text-start border-0" id="link-hr-apps">
            <i class="fas fa-users me-2"></i> Applicants Log
          </button>
          <button onclick="switchCompanyTab('supervisors')" class="sidebar-link w-100 text-start border-0" id="link-hr-supervisors">
            <i class="fas fa-user-tie me-2"></i> Supervisors
          </button>
          <a href="logout.php" class="sidebar-link text-danger w-100 text-start text-decoration-none">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
          </a>
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="col-md-9 col-lg-10">
      
      <!-- TAB 1: POST NEW INTERNSHIP -->
      <div id="tab-hr-post" class="tab-content">
        <div class="master-card-black p-4 mb-4">
          <h4 class="fw-black text-black mb-3">
            <i class="fas fa-plus-circle text-primary me-2"></i> Post New Internship Opportunity
          </h4>
          <form onsubmit="postNewInternship(event)">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Internship Title</label>
                <input type="text" id="post-title" required class="form-control py-2" placeholder="e.g. Full Stack Web Developer Intern">
              </div>
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Category</label>
                <select id="post-category" required class="form-select py-2">
                  <option value="Software Development">Software Development</option>
                  <option value="UI/UX Design">UI/UX Design</option>
                  <option value="Data Science">Data Science</option>
                  <option value="Cyber Security">Cyber Security</option>
                </select>
              </div>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label font-weight-black text-black">Monthly Stipend</label>
                <input type="text" id="post-stipend" required class="form-control py-2" placeholder="e.g. PKR 35,000 / month">
              </div>
              <div class="col-md-4">
                <label class="form-label font-weight-black text-black">Workplace Location</label>
                <input type="text" id="post-location" required class="form-control py-2" placeholder="e.g. Islamabad (Onsite)">
              </div>
              <div class="col-md-4">
                <label class="form-label font-weight-black text-black">Application Deadline</label>
                <input type="date" id="post-deadline" required class="form-control py-2">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Job Description & Responsibilities</label>
              <textarea id="post-desc" required rows="3" class="form-control py-2" placeholder="Describe the role responsibilities..."></textarea>
            </div>
            <button type="submit" class="btn btn-black-primary font-weight-black">
              <i class="fas fa-paper-plane me-1"></i> Publish Opportunity
            </button>
          </form>
        </div>

        <h3 class="fw-black text-black mb-3">Active Internship Listings</h3>
        <div id="company-postings-grid" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 2: APPLICANTS LOG -->
      <div id="tab-hr-apps" class="tab-content d-none">
        <h3 class="fw-black text-black mb-3">Applicants Directory & Onsite Scheduling</h3>
        <div class="master-card-black p-0 overflow-hidden">
          <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
              <thead class="table-light">
                <tr>
                  <th>Student Name</th>
                  <th>Gmail / Contact</th>
                  <th>CV Document</th>
                  <th>Status</th>
                  <th>Actions & Onsite Interview</th>
                </tr>
              </thead>
              <tbody id="company-apps-table-body">
                <!-- Dynamically populated -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- TAB 3: REGISTER SUPERVISORS -->
      <div id="tab-hr-supervisors" class="tab-content d-none">
        <div class="master-card-black p-4 mb-4">
          <h4 class="fw-black text-black mb-3">
            <i class="fas fa-user-plus text-primary me-2"></i> Register Workplace Supervisor
          </h4>
          <form onsubmit="registerCompanySupervisor(event)">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Supervisor Full Name</label>
                <input type="text" id="sup-name" required class="form-control py-2" placeholder="Workplace Supervisor">
              </div>
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Supervisor Email / Gmail</label>
                <input type="email" id="sup-email" required class="form-control py-2" placeholder="supervisor@gmail.com">
              </div>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Password</label>
                <input type="password" id="sup-pass" required class="form-control py-2" placeholder="123456789">
              </div>
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Designation / Department</label>
                <input type="text" id="sup-dept" required class="form-control py-2" placeholder="Engineering & AI Labs">
              </div>
            </div>
            <button type="submit" class="btn btn-black-primary font-weight-black">
              <i class="fas fa-user-shield me-1"></i> Register Supervisor Account
            </button>
          </form>
        </div>

        <h3 class="fw-black text-black mb-3">Registered Workplace Supervisors</h3>
        <div id="registered-supervisors-grid" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

    </div>
  </div>
</div>

<!-- ONSITE INTERVIEW MODAL -->
<div class="modal fade" id="interviewModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-primary text-white border-0 py-3">
        <h5 class="modal-title font-weight-black text-white">Schedule Physical Onsite Interview</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveOnsiteInterview(event)">
        <div class="modal-body p-4">
          <input type="hidden" id="int-app-id">
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label font-weight-black text-black">Interview Date</label>
              <input type="date" id="int-date" required class="form-control py-2">
            </div>
            <div class="col-md-6">
              <label class="form-label font-weight-black text-black">Interview Time</label>
              <input type="time" id="int-time" required class="form-control py-2">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Onsite Physical Address / Venue</label>
            <textarea id="int-address" required rows="2" class="form-control py-2" placeholder="Enter physical office address..."></textarea>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-black-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-black-primary btn-sm px-4 font-weight-black">Confirm Schedule</button>
        </div>
      </form>
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

<script src="assets/js/app.js"></script>
<script>
  const currentCompany = DIS.checkAuth(['company']);

  document.addEventListener('DOMContentLoaded', () => {
    if (!currentCompany) return;
    renderCompanyPostings();
    renderCompanyApplications();
    renderCompanySupervisors();
    loadNotifications();
  });

  function switchCompanyTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('d-none'));
    document.querySelectorAll('.sidebar-link').forEach(el => el.classList.remove('active'));

    document.getElementById(`tab-hr-${tabId}`).classList.remove('d-none');
    document.getElementById(`link-hr-${tabId}`).classList.add('active');
  }

  function postNewInternship(e) {
    e.preventDefault();
    const title = document.getElementById('post-title').value;
    const category = document.getElementById('post-category').value;
    const stipend = document.getElementById('post-stipend').value;
    const location = document.getElementById('post-location').value;
    const deadline = document.getElementById('post-deadline').value;
    const description = document.getElementById('post-desc').value;

    if (!DIS.validateFutureDate(deadline)) {
      DIS.showToast('Deadline must be a future date!', 'warning');
      return;
    }

    const items = DIS.getInternships();
    const newItem = {
      id: 'int_' + Date.now(),
      companyId: currentCompany.id,
      companyName: currentCompany.companyName || currentCompany.name,
      title,
      category,
      stipend,
      location,
      deadline,
      description,
      status: 'active',
      createdAt: new Date().toISOString().split('T')[0]
    };

    items.unshift(newItem);
    DIS.setInternships(items);
    DIS.showToast('Internship opportunity posted!', 'success');
    e.target.reset();
    renderCompanyPostings();
  }

  function renderCompanyPostings() {
    const items = DIS.getInternships().filter(i => i.companyId === currentCompany.id);
    const grid = document.getElementById('company-postings-grid');
    grid.innerHTML = '';

    if (items.length === 0) {
      grid.innerHTML = '<div class="col-12 text-center py-4 text-black font-weight-black">No listings posted yet.</div>';
      return;
    }

    items.forEach(item => {
      const col = document.createElement('div');
      col.className = 'col-md-6';
      col.innerHTML = `
        <div class="master-card-black p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge badge-black-pill badge-indigo">${item.category}</span>
              <small class="text-black font-weight-black">${item.deadline}</small>
            </div>
            <h5 class="font-weight-black text-black mb-1">${item.title}</h5>
            <p class="small text-black font-weight-bold mb-3">${item.description}</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-black extra-small">${item.stipend}</span>
            <button onclick="deletePosting('${item.id}')" class="btn btn-outline-danger btn-sm font-weight-black"><i class="fas fa-trash-alt"></i></button>
          </div>
        </div>
      `;
      grid.appendChild(col);
    });
  }

  function deletePosting(id) {
    if (confirm('Delete this internship posting?')) {
      let items = DIS.getInternships();
      items = items.filter(i => i.id !== id);
      DIS.setInternships(items);
      DIS.showToast('Posting deleted!', 'info');
      renderCompanyPostings();
    }
  }

  function renderCompanyApplications() {
    const apps = DIS.getApplications();
    const tbody = document.getElementById('company-apps-table-body');
    tbody.innerHTML = '';

    if (apps.length === 0) {
      tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-black font-weight-black">No applicant records found.</td></tr>';
      return;
    }

    apps.forEach(a => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><div class="fw-black text-black">${a.studentName}</div></td>
        <td class="small text-black font-weight-bold">${a.studentEmail}</td>
        <td><a href="#" class="small text-primary font-weight-black"><i class="fas fa-file-pdf me-1"></i> ${a.cvName}</a></td>
        <td><span class="badge badge-black-pill badge-sky">${a.status}</span></td>
        <td>
          <div class="btn-group btn-group-sm">
            <button onclick="openInterviewModal('${a.id}')" class="btn btn-black-primary btn-sm font-weight-black">
              <i class="fas fa-calendar-plus me-1"></i> Schedule Onsite
            </button>
            <button onclick="updateAppStatus('${a.id}', 'Selected')" class="btn btn-outline-success font-weight-black">Select</button>
          </div>
        </td>
      `;
      tbody.appendChild(tr);
    });
  }

  function openInterviewModal(appId) {
    document.getElementById('int-app-id').value = appId;
    const bsModal = new bootstrap.Modal(document.getElementById('interviewModal'));
    bsModal.show();
  }

  function saveOnsiteInterview(e) {
    e.preventDefault();
    const appId = document.getElementById('int-app-id').value;
    const date = document.getElementById('int-date').value;
    const time = document.getElementById('int-time').value;
    const address = document.getElementById('int-address').value;

    if (!DIS.validateFutureDate(date)) {
      DIS.showToast('Interview date must be in the future!', 'warning');
      return;
    }

    const apps = DIS.getApplications();
    const app = apps.find(a => a.id === appId);
    if (app) {
      app.status = 'Shortlisted';
      app.interview = { date, time, mode: 'Onsite', address };
      DIS.setApplications(apps);

      DIS.addNotification(app.studentId, 'Onsite Interview Scheduled', `Onsite interview scheduled on ${date} at ${address}`, 'success');
      DIS.showToast('Onsite interview scheduled!', 'success');

      const modalEl = document.getElementById('interviewModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();

      renderCompanyApplications();
    }
  }

  function updateAppStatus(appId, status) {
    const apps = DIS.getApplications();
    const app = apps.find(a => a.id === appId);
    if (app) {
      app.status = status;
      DIS.setApplications(apps);
      DIS.showToast(`Application status updated to ${status}`, 'success');
      renderCompanyApplications();
    }
  }

  function registerCompanySupervisor(e) {
    e.preventDefault();
    const name = document.getElementById('sup-name').value;
    const email = document.getElementById('sup-email').value;
    const pass = document.getElementById('sup-pass').value;
    const dept = document.getElementById('sup-dept').value;

    const users = DIS.getUsers();
    const newSup = {
      id: 'usr_sup_' + Date.now(),
      name,
      email,
      password: pass,
      role: 'supervisor',
      companyId: currentCompany.id,
      designation: dept,
      status: 'approved'
    };

    users.push(newSup);
    DIS.setUsers(users);
    DIS.showToast('Supervisor account registered!', 'success');
    e.target.reset();
    renderCompanySupervisors();
  }

  function renderCompanySupervisors() {
    const users = DIS.getUsers().filter(u => u.role === 'supervisor');
    const grid = document.getElementById('registered-supervisors-grid');
    grid.innerHTML = '';

    users.forEach(u => {
      const col = document.createElement('div');
      col.className = 'col-md-6';
      col.innerHTML = `
        <div class="master-card-black p-4 d-flex justify-content-between align-items-center">
          <div>
            <h5 class="fw-black text-black mb-1">${u.name}</h5>
            <small class="text-primary font-weight-bold d-block mb-1">${u.email}</small>
            <span class="badge badge-black-pill badge-emerald">${u.designation || 'Supervisor'}</span>
          </div>
        </div>
      `;
      grid.appendChild(col);
    });
  }

  function loadNotifications() {
    const notifs = DIS.getNotifications(currentCompany.id);
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

<?php require_once __DIR__ . '/includes/footer.php'; ?>
