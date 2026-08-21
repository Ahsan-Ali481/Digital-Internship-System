<?php
// dashboard-company.php - Company HR Portal with Left Sidebar Navigation
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
$currentHR = $_SESSION['user'];
?>

<!-- Top Header Bar -->
<header class="bg-white border-bottom py-2 sticky-top shadow-sm">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <a href="index.php" class="navbar-brand font-weight-bold text-primary mb-0">
        <i class="fas fa-graduation-cap me-1"></i> Digital Internship System
      </a>
      <span class="badge bg-info text-white">Company HR Portal</span>
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
          <div class="bg-info text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-2" style="width: 50px; height: 50px;">
            <i class="fas fa-building fa-lg"></i>
          </div>
          <h6 id="hr-name" class="font-weight-bold mb-0"><?php echo htmlspecialchars($currentHR['name']); ?></h6>
          <small class="text-muted extra-small d-block"><?php echo htmlspecialchars($currentHR['companyName'] ?? 'TechCorp'); ?></small>
        </div>
        
        <div class="list-group list-group-flush border-top">
          <button onclick="switchHRTab('post')" class="list-group-item list-group-item-action active text-start font-weight-semibold" id="link-hr-post">
            <i class="fas fa-plus-circle me-2 text-primary"></i> Post Opportunity
          </button>
          <button onclick="switchHRTab('applicants')" class="list-group-item list-group-item-action text-start font-weight-semibold" id="link-hr-applicants">
            <i class="fas fa-users me-2 text-info"></i> Applicant Manager
          </button>
          <button onclick="switchHRTab('supervisors')" class="list-group-item list-group-item-action text-start font-weight-semibold" id="link-hr-supervisors">
            <i class="fas fa-user-tie me-2 text-success"></i> Supervisors
          </button>
          <button onclick="switchHRTab('profile')" class="list-group-item list-group-item-action text-start font-weight-semibold" id="link-hr-profile">
            <i class="fas fa-edit me-2 text-secondary"></i> Company Profile
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
        <div class="col-md-4">
          <div class="card border-0 shadow-sm bg-primary text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <small class="text-white-50">Active Postings</small>
                <h3 class="mb-0 font-weight-bold" id="stat-postings">0</h3>
              </div>
              <i class="fas fa-briefcase fa-2x opacity-50"></i>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow-sm bg-info text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <small class="text-white-50">Total Applicants</small>
                <h3 class="mb-0 font-weight-bold" id="stat-applicants">0</h3>
              </div>
              <i class="fas fa-users fa-2x opacity-50"></i>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow-sm bg-success text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <small class="text-white-50">Workplace Supervisors</small>
                <h3 class="mb-0 font-weight-bold" id="stat-supervisors">0</h3>
              </div>
              <i class="fas fa-user-tie fa-2x opacity-50"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- TAB 1: POST OPPORTUNITY -->
      <div id="tab-hr-post" class="tab-content">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-white font-weight-bold">
            <i class="fas fa-plus-circle text-primary me-2"></i> Post New Internship Opportunity
          </div>
          <div class="card-body">
            <form onsubmit="saveNewInternship(event)">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold">Internship Title</label>
                  <input type="text" id="post-title" required class="form-control" placeholder="e.g. Full Stack Web Developer Intern">
                </div>
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold">Category</label>
                  <select id="post-category" required class="form-select">
                    <option value="Software Development">Software Development</option>
                    <option value="UI/UX Design">UI/UX Design</option>
                    <option value="Data Science">Data Science</option>
                  </select>
                </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-md-4">
                  <label class="form-label font-weight-semibold">Monthly Stipend</label>
                  <input type="text" id="post-stipend" required class="form-control" placeholder="e.g. PKR 35,000 / month">
                </div>
                <div class="col-md-4">
                  <label class="form-label font-weight-semibold">Office Location</label>
                  <input type="text" id="post-location" required class="form-control" placeholder="e.g. Islamabad / Lahore">
                </div>
                <div class="col-md-4">
                  <label class="form-label font-weight-semibold">Application Deadline</label>
                  <input type="date" id="post-deadline" required class="form-control">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-semibold">Job Description</label>
                <textarea id="post-desc" required rows="3" class="form-control" placeholder="Provide role details..."></textarea>
              </div>

              <button type="submit" class="btn btn-primary font-weight-bold">
                <i class="fas fa-check me-1"></i> Publish Opportunity
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- TAB 2: APPLICANTS MANAGER -->
      <div id="tab-hr-applicants" class="tab-content d-none">
        <h4 class="font-weight-bold mb-3">Manage Applicants</h4>
        <div class="card shadow-sm border-0">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Candidate Name</th>
                  <th>Position Applied</th>
                  <th>Applied Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="company-apps-table-body">
                <!-- Dynamically populated -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- TAB 3: SUPERVISORS MANAGER -->
      <div id="tab-hr-supervisors" class="tab-content d-none">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="font-weight-bold mb-0">Workplace Supervisors</h4>
          <button onclick="openAddSupervisorModal()" class="btn btn-success btn-sm font-weight-bold">
            <i class="fas fa-user-plus me-1"></i> Add Supervisor
          </button>
        </div>
        <div id="supervisors-grid" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 4: COMPANY PROFILE -->
      <div id="tab-hr-profile" class="tab-content d-none">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-white font-weight-bold">
            <i class="fas fa-edit text-primary me-2"></i> Edit Company Info
          </div>
          <div class="card-body">
            <form onsubmit="updateCompanyProfile(event)">
              <div class="mb-3">
                <label class="form-label font-weight-semibold">Company Name</label>
                <input type="text" id="prof-company-name" required class="form-control">
              </div>
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold">Industry Domain</label>
                  <input type="text" id="prof-industry" required class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold">Website URL</label>
                  <input type="url" id="prof-website" required class="form-control">
                </div>
              </div>
              <button type="submit" class="btn btn-primary font-weight-bold">
                <i class="fas fa-save me-1"></i> Save Changes
              </button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- ONSITE PHYSICAL INTERVIEW SCHEDULER MODAL -->
<div class="modal fade" id="interviewModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Schedule Physical Onsite Interview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveInterviewSchedule(event)">
        <div class="modal-body">
          <input type="hidden" id="int-app-id">
          <div class="row g-3 mb-3">
            <div class="col-6">
              <label class="form-label font-weight-semibold">Interview Date</label>
              <input type="date" id="int-date" required class="form-control form-control-sm">
            </div>
            <div class="col-6">
              <label class="form-label font-weight-semibold">Time</label>
              <input type="time" id="int-time" required class="form-control form-control-sm">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-semibold">Physical Office Venue Address</label>
            <input type="text" id="int-link" required placeholder="e.g. TechCorp Tower, Suite 400, Silicon Avenue, Islamabad" class="form-control form-control-sm">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary btn-sm font-weight-bold">Save & Notify Candidate</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ADD SUPERVISOR MODAL -->
<div class="modal fade" id="addSupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Register New Supervisor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveNewSupervisor(event)">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label font-weight-semibold">Supervisor Name</label>
            <input type="text" id="sup-name" required class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-semibold">Email Address</label>
            <input type="email" id="sup-email" required class="form-control" placeholder="supervisor123@gmail.com">
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-semibold">Designation</label>
            <input type="text" id="sup-designation" required class="form-control" placeholder="e.g. Senior Software Engineer">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm font-weight-bold">Register Supervisor</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ASSIGN SUPERVISOR MODAL -->
<div class="modal fade" id="assignSupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Assign Supervisor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveSupervisorAssignment(event)">
        <div class="modal-body">
          <input type="hidden" id="assign-app-id">
          <div class="mb-3">
            <label class="form-label font-weight-semibold">Select Supervisor</label>
            <select id="assign-sup-select" required class="form-select"></select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary btn-sm font-weight-bold">Assign Supervisor</button>
        </div>
      </form>
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
  const currentHR = DIS.checkAuth(['company']);

  document.addEventListener('DOMContentLoaded', () => {
    if (!currentHR) return;
    renderDashboardStats();
    renderCompanyApplications();
    renderSupervisors();
    loadCompanyProfile();
    loadNotifications();
  });

  function switchHRTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('d-none'));
    document.querySelectorAll('.list-group-item').forEach(el => el.classList.remove('active'));

    document.getElementById(`tab-hr-${tabId}`).classList.remove('d-none');
    document.getElementById(`link-hr-${tabId}`).classList.add('active');
  }

  function renderDashboardStats() {
    const internships = DIS.getInternships().filter(i => i.companyId === currentHR.id);
    const apps = DIS.getApplications().filter(a => a.companyId === currentHR.id);
    const sups = DIS.getUsers().filter(u => u.role === 'supervisor' && u.companyId === currentHR.id);

    document.getElementById('stat-postings').innerText = internships.length;
    document.getElementById('stat-applicants').innerText = apps.length;
    document.getElementById('stat-supervisors').innerText = sups.length;
  }

  function saveNewInternship(e) {
    e.preventDefault();
    const title = document.getElementById('post-title').value;
    const category = document.getElementById('post-category').value;
    const stipend = document.getElementById('post-stipend').value;
    const location = document.getElementById('post-location').value;
    const deadline = document.getElementById('post-deadline').value;
    const description = document.getElementById('post-desc').value;

    if (!DIS.validateFutureDate(deadline)) {
      DIS.showToast('Application deadline must be a future date!', 'warning');
      return;
    }

    const internships = DIS.getInternships();
    const newInt = {
      id: 'int_' + Date.now(),
      companyId: currentHR.id,
      companyName: currentHR.companyName || 'TechCorp',
      title,
      category,
      stipend,
      location,
      deadline,
      description,
      status: 'active',
      createdAt: new Date().toISOString().split('T')[0]
    };

    internships.unshift(newInt);
    DIS.setInternships(internships);
    DIS.showToast('Opportunity published!', 'success');
    e.target.reset();
    renderDashboardStats();
  }

  function renderCompanyApplications() {
    const apps = DIS.getApplications().filter(a => a.companyId === currentHR.id);
    const internships = DIS.getInternships();
    const tbody = document.getElementById('company-apps-table-body');
    tbody.innerHTML = '';

    if (apps.length === 0) {
      tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">No applications received.</td></tr>';
      return;
    }

    apps.forEach(app => {
      const internship = internships.find(i => i.id === app.internshipId);
      let badgeColor = 'bg-warning';
      if (app.status === 'Shortlisted') badgeColor = 'bg-info';
      if (app.status === 'Selected') badgeColor = 'bg-success';
      if (app.status === 'Rejected') badgeColor = 'bg-danger';

      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>
          <div class="font-weight-bold">${app.studentName}</div>
          <small class="text-muted">${app.studentEmail}</small>
        </td>
        <td class="small font-weight-bold text-primary">${internship ? internship.title : 'Position'}</td>
        <td class="small">${app.appliedAt}</td>
        <td><span class="badge ${badgeColor}">${app.status}</span></td>
        <td>
          <div class="btn-group btn-group-sm">
            <button onclick="openInterviewModal('${app.id}')" class="btn btn-outline-info" title="Schedule Onsite Interview"><i class="fas fa-calendar-alt"></i></button>
            <button onclick="openAssignSupModal('${app.id}')" class="btn btn-outline-success" title="Assign Supervisor"><i class="fas fa-user-check"></i></button>
            <button onclick="updateAppStatus('${app.id}', 'Rejected')" class="btn btn-outline-danger" title="Reject"><i class="fas fa-times"></i></button>
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

  function saveInterviewSchedule(e) {
    e.preventDefault();
    const appId = document.getElementById('int-app-id').value;
    const date = document.getElementById('int-date').value;
    const time = document.getElementById('int-time').value;
    const venueAddress = document.getElementById('int-link').value;

    if (!DIS.validateFutureDate(date)) {
      DIS.showToast('Interview date must be a future date!', 'warning');
      return;
    }

    const apps = DIS.getApplications();
    const app = apps.find(a => a.id === appId);
    if (app) {
      app.status = 'Shortlisted';
      app.interview = {
        date,
        time,
        mode: 'Onsite',
        address: venueAddress,
        scheduledAt: new Date().toISOString().split('T')[0]
      };
      DIS.setApplications(apps);

      DIS.addNotification(app.studentId, 'Onsite Interview Scheduled!', `Interview scheduled on ${date} at ${time} at ${venueAddress}.`, 'warning');
      DIS.showToast('Interview scheduled & candidate notified!', 'success');

      const modalEl = document.getElementById('interviewModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();

      renderCompanyApplications();
    }
  }

  function renderSupervisors() {
    const sups = DIS.getUsers().filter(u => u.role === 'supervisor' && u.companyId === currentHR.id);
    const grid = document.getElementById('supervisors-grid');
    grid.innerHTML = '';

    if (sups.length === 0) {
      grid.innerHTML = '<div class="col-12 text-center py-4 text-muted">No supervisors registered yet.</div>';
      return;
    }

    sups.forEach(s => {
      const col = document.createElement('div');
      col.className = 'col-md-4';
      col.innerHTML = `
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center">
            <div class="bg-success text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-2" style="width: 50px; height: 50px;">
              <i class="fas fa-user-tie fa-lg"></i>
            </div>
            <h6 class="font-weight-bold mb-1">${s.name}</h6>
            <small class="text-muted d-block">${s.designation || 'Supervisor'}</small>
            <small class="text-primary">${s.email}</small>
          </div>
        </div>
      `;
      grid.appendChild(col);
    });
  }

  function openAddSupervisorModal() {
    const bsModal = new bootstrap.Modal(document.getElementById('addSupModal'));
    bsModal.show();
  }

  function saveNewSupervisor(e) {
    e.preventDefault();
    const name = document.getElementById('sup-name').value;
    const email = document.getElementById('sup-email').value;
    const designation = document.getElementById('sup-designation').value;

    const users = DIS.getUsers();
    const newSup = {
      id: 'usr_sup_' + Date.now(),
      name,
      email,
      role: 'supervisor',
      designation,
      companyId: currentHR.id
    };

    users.push(newSup);
    DIS.setUsers(users);
    DIS.showToast('Supervisor registered!', 'success');
    
    const modalEl = document.getElementById('addSupModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();

    renderSupervisors();
    renderDashboardStats();
  }

  function openAssignSupModal(appId) {
    document.getElementById('assign-app-id').value = appId;
    const sups = DIS.getUsers().filter(u => u.role === 'supervisor' && u.companyId === currentHR.id);
    const select = document.getElementById('assign-sup-select');
    select.innerHTML = '';

    if (sups.length === 0) {
      select.innerHTML = '<option value="">No supervisors available.</option>';
    } else {
      sups.forEach(s => {
        select.innerHTML += `<option value="${s.id}">${s.name} (${s.designation || 'Supervisor'})</option>`;
      });
    }

    const bsModal = new bootstrap.Modal(document.getElementById('assignSupModal'));
    bsModal.show();
  }

  function saveSupervisorAssignment(e) {
    e.preventDefault();
    const appId = document.getElementById('assign-app-id').value;
    const supId = document.getElementById('assign-sup-select').value;

    if (!supId) {
      DIS.showToast('Please select a valid supervisor!', 'warning');
      return;
    }

    const apps = DIS.getApplications();
    const app = apps.find(a => a.id === appId);
    if (app) {
      app.supervisorId = supId;
      app.status = 'Selected';
      DIS.setApplications(apps);

      DIS.addNotification(app.studentId, 'Supervisor Assigned!', 'A supervisor has been assigned to guide your internship.', 'success');
      DIS.showToast('Supervisor assigned!', 'success');

      const modalEl = document.getElementById('assignSupModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();

      renderCompanyApplications();
    }
  }

  function loadCompanyProfile() {
    document.getElementById('prof-company-name').value = currentHR.companyName || 'TechCorp';
    document.getElementById('prof-industry').value = 'Software & Technology';
    document.getElementById('prof-website').value = 'https://techcorp.example.com';
  }

  function updateCompanyProfile(e) {
    e.preventDefault();
    DIS.showToast('Company profile updated!', 'success');
  }

  function loadNotifications() {
    const notifs = DIS.getNotifications(currentHR.id);
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
