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
$currentHR = $_SESSION['user'];
?>

<!-- High Contrast Top Header Bar -->
<header class="bg-white border-bottom border-2 border-slate-200 py-3 sticky-top shadow-sm">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <a href="index.php" class="navbar-brand fw-extrabold text-dark-contrast mb-0 d-flex align-items-center gap-2">
        <div class="bg-gradient-secondary text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
          <i class="fas fa-building"></i>
        </div>
        <span class="fs-4">Digital <span class="gradient-text-mask">Internship</span></span>
      </a>
      <span class="badge badge-adv badge-adv-info px-3 py-2">Company HR Portal</span>
    </div>
    
    <div class="d-flex align-items-center gap-3">
      <button onclick="toggleNotificationModal()" class="btn btn-adv-secondary btn-sm position-relative px-3">
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
      <div class="adv-card mb-4 p-3 text-center">
        <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-2 shadow-sm" style="width: 56px; height: 56px; background-color: #e0f2fe;">
          <i class="fas fa-building fa-lg text-info"></i>
        </div>
        <h6 id="hr-name" class="fw-extrabold mb-0 text-dark-contrast"><?php echo htmlspecialchars($currentHR['name']); ?></h6>
        <small class="text-dark-contrast font-weight-bold extra-small d-block"><?php echo htmlspecialchars($currentHR['companyName'] ?? 'TechCorp'); ?></small>

        <div class="pt-3 mt-3 border-top d-flex flex-column gap-2">
          <button onclick="switchHRTab('post')" class="sidebar-link active w-100 text-start border-0" id="link-hr-post">
            <i class="fas fa-plus-circle me-2"></i> Post Role
          </button>
          <button onclick="switchHRTab('applicants')" class="sidebar-link w-100 text-start border-0" id="link-hr-applicants">
            <i class="fas fa-users me-2"></i> Applicants
          </button>
          <button onclick="switchHRTab('supervisors')" class="sidebar-link w-100 text-start border-0" id="link-hr-supervisors">
            <i class="fas fa-user-tie me-2"></i> Supervisors
          </button>
          <button onclick="switchHRTab('profile')" class="sidebar-link w-100 text-start border-0" id="link-hr-profile">
            <i class="fas fa-edit me-2"></i> Company Profile
          </button>
          <a href="logout.php" class="sidebar-link text-danger w-100 text-start text-decoration-none">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
          </a>
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="col-md-9 col-lg-10">
      
      <!-- Stats Header Widgets -->
      <div class="row g-4 mb-4">
        <div class="col-md-4">
          <div class="adv-card p-4 text-center">
            <h3 class="font-weight-extrabold mb-1 text-primary fs-1" id="stat-postings">0</h3>
            <p class="text-dark-contrast font-weight-extrabold mb-0 small">Active Postings</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="adv-card p-4 text-center">
            <h3 class="font-weight-extrabold mb-1 text-info fs-1" id="stat-applicants">0</h3>
            <p class="text-dark-contrast font-weight-extrabold mb-0 small">Total Applicants</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="adv-card p-4 text-center">
            <h3 class="font-weight-extrabold mb-1 text-success fs-1" id="stat-supervisors">0</h3>
            <p class="text-dark-contrast font-weight-extrabold mb-0 small">Workplace Supervisors</p>
          </div>
        </div>
      </div>

      <!-- TAB 1: POST OPPORTUNITY -->
      <div id="tab-hr-post" class="tab-content">
        <div class="adv-card p-4">
          <h4 class="fw-extrabold text-dark-contrast mb-3">
            <i class="fas fa-plus-circle text-primary me-2"></i> Post New Internship Opportunity
          </h4>
          <form onsubmit="saveNewInternship(event)">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label font-weight-bold text-dark-contrast">Internship Title</label>
                <input type="text" id="post-title" required class="form-control py-2" placeholder="e.g. Full Stack Web Developer Intern">
              </div>
              <div class="col-md-6">
                <label class="form-label font-weight-bold text-dark-contrast">Category</label>
                <select id="post-category" required class="form-select py-2">
                  <option value="Software Development">Software Development</option>
                  <option value="UI/UX Design">UI/UX Design</option>
                  <option value="Data Science">Data Science</option>
                </select>
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label font-weight-bold text-dark-contrast">Monthly Stipend</label>
                <input type="text" id="post-stipend" required class="form-control py-2" placeholder="e.g. PKR 35,000 / month">
              </div>
              <div class="col-md-4">
                <label class="form-label font-weight-bold text-dark-contrast">Office Location</label>
                <input type="text" id="post-location" required class="form-control py-2" placeholder="e.g. Islamabad / Lahore">
              </div>
              <div class="col-md-4">
                <label class="form-label font-weight-bold text-dark-contrast">Application Deadline</label>
                <input type="date" id="post-deadline" required class="form-control py-2">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label font-weight-bold text-dark-contrast">Job Description</label>
              <textarea id="post-desc" required rows="3" class="form-control py-2" placeholder="Provide role details..."></textarea>
            </div>

            <button type="submit" class="btn btn-adv-primary font-weight-bold">
              <i class="fas fa-check me-1"></i> Publish Opportunity
            </button>
          </form>
        </div>
      </div>

      <!-- TAB 2: APPLICANTS MANAGER -->
      <div id="tab-hr-applicants" class="tab-content d-none">
        <h3 class="fw-extrabold text-dark-contrast mb-3">Manage Candidates</h3>
        <div class="adv-card p-0 overflow-hidden">
          <div class="table-responsive">
            <table class="table-adv">
              <thead>
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
          <h3 class="fw-extrabold text-dark-contrast mb-0">Workplace Supervisors</h3>
          <button onclick="openAddSupervisorModal()" class="btn btn-adv-primary btn-sm font-weight-bold">
            <i class="fas fa-user-plus me-1"></i> Register Supervisor
          </button>
        </div>
        <div id="supervisors-grid" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 4: COMPANY PROFILE -->
      <div id="tab-hr-profile" class="tab-content d-none">
        <div class="adv-card p-4">
          <h4 class="fw-extrabold text-dark-contrast mb-3">
            <i class="fas fa-edit text-primary me-2"></i> Edit Company Information
          </h4>
          <form onsubmit="updateCompanyProfile(event)">
            <div class="mb-3">
              <label class="form-label font-weight-bold text-dark-contrast">Company Name</label>
              <input type="text" id="prof-company-name" required class="form-control py-2">
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label font-weight-bold text-dark-contrast">Industry Domain</label>
                <input type="text" id="prof-industry" required class="form-control py-2">
              </div>
              <div class="col-md-6">
                <label class="form-label font-weight-bold text-dark-contrast">Website URL</label>
                <input type="url" id="prof-website" required class="form-control py-2">
              </div>
            </div>
            <button type="submit" class="btn btn-adv-primary font-weight-bold">
              <i class="fas fa-save me-1"></i> Save Changes
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- ONSITE PHYSICAL INTERVIEW SCHEDULER MODAL -->
<div class="modal fade" id="interviewModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-gradient-primary text-white border-0 py-3">
        <h5 class="modal-title font-weight-extrabold text-white">Schedule Physical Onsite Interview</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveInterviewSchedule(event)">
        <div class="modal-body p-4">
          <input type="hidden" id="int-app-id">
          <div class="row g-3 mb-3">
            <div class="col-6">
              <label class="form-label font-weight-bold text-dark-contrast">Interview Date</label>
              <input type="date" id="int-date" required class="form-control py-2">
            </div>
            <div class="col-6">
              <label class="form-label font-weight-bold text-dark-contrast">Time</label>
              <input type="time" id="int-time" required class="form-control py-2">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-bold text-dark-contrast">Physical Office Venue Address</label>
            <input type="text" id="int-link" required placeholder="e.g. TechCorp Tower, Suite 400, Silicon Avenue, Islamabad" class="form-control py-2">
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-adv-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-adv-primary btn-sm px-4 font-weight-bold">Save & Notify Candidate</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ADD SUPERVISOR MODAL -->
<div class="modal fade" id="addSupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-gradient-success text-white border-0 py-3">
        <h5 class="modal-title font-weight-extrabold text-white">Register New Supervisor</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveNewSupervisor(event)">
        <div class="modal-body p-4">
          <div class="mb-3">
            <label class="form-label font-weight-bold text-dark-contrast">Supervisor Name</label>
            <input type="text" id="sup-name" required class="form-control py-2">
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-bold text-dark-contrast">Email Address</label>
            <input type="email" id="sup-email" required class="form-control py-2" placeholder="supervisor123@gmail.com">
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-bold text-dark-contrast">Designation</label>
            <input type="text" id="sup-designation" required class="form-control py-2" placeholder="e.g. Senior Software Engineer">
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-adv-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-adv-primary btn-sm px-4 font-weight-bold">Register Supervisor</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ASSIGN SUPERVISOR MODAL -->
<div class="modal fade" id="assignSupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-gradient-primary text-white border-0 py-3">
        <h5 class="modal-title font-weight-extrabold text-white">Assign Supervisor</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveSupervisorAssignment(event)">
        <div class="modal-body p-4">
          <input type="hidden" id="assign-app-id">
          <div class="mb-3">
            <label class="form-label font-weight-bold text-dark-contrast">Select Supervisor</label>
            <select id="assign-sup-select" required class="form-select py-2"></select>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-adv-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-adv-primary btn-sm px-4 font-weight-bold">Assign Supervisor</button>
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
        <h5 class="modal-title font-weight-extrabold text-dark-contrast"><i class="fas fa-bell text-warning me-2"></i> Notifications</h5>
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
    document.querySelectorAll('.sidebar-link').forEach(el => el.classList.remove('active'));

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
      tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-dark-contrast font-weight-bold">No applications received.</td></tr>';
      return;
    }

    apps.forEach(app => {
      const internship = internships.find(i => i.id === app.internshipId);
      let badgeClass = 'badge-adv-warning';
      if (app.status === 'Shortlisted') badgeClass = 'badge-adv-info';
      if (app.status === 'Selected') badgeClass = 'badge-adv-success';
      if (app.status === 'Rejected') badgeClass = 'badge-adv-danger';

      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>
          <div class="fw-bold text-dark-contrast">${app.studentName}</div>
          <small class="text-primary font-weight-bold">${app.studentEmail}</small>
        </td>
        <td class="small font-weight-bold text-primary">${internship ? internship.title : 'Position'}</td>
        <td class="small text-dark-contrast font-weight-semibold">${app.appliedAt}</td>
        <td><span class="badge badge-adv ${badgeClass}">${app.status}</span></td>
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
      grid.innerHTML = '<div class="col-12 text-center py-4 text-dark-contrast font-weight-bold">No supervisors registered yet.</div>';
      return;
    }

    sups.forEach(s => {
      const col = document.createElement('div');
      col.className = 'col-md-4';
      col.innerHTML = `
        <div class="adv-card p-4 text-center">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-2 shadow-sm" style="width: 50px; height: 50px; background-color: #d1fae5;">
            <i class="fas fa-user-tie fa-lg text-success"></i>
          </div>
          <h6 class="fw-bold mb-1 text-dark-contrast">${s.name}</h6>
          <small class="text-dark-contrast font-weight-semibold d-block">${s.designation || 'Supervisor'}</small>
          <small class="text-primary font-weight-bold">${s.email}</small>
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
    container.innerHTML = notifs.length ? '' : '<div class="text-center text-dark-contrast font-weight-bold small py-3">No notifications</div>';
    notifs.forEach(n => {
      container.innerHTML += `<div class="p-3 border rounded-3 small bg-light mb-2 text-dark-contrast font-weight-semibold"><strong>${n.title}</strong><br>${n.message}</div>`;
    });
  }

  function toggleNotificationModal() {
    const bsModal = new bootstrap.Modal(document.getElementById('notifModal'));
    bsModal.show();
  }
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
