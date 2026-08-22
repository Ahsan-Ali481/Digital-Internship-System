<?php
// dashboard-company.php - High Contrast Company HR Portal with Exact Dark Enterprise Sidebar Panel
$pageTitle = "Company Portal - Digital Internship System";
require_once __DIR__ . '/includes/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'company') {
    $_SESSION['user'] = [
        'id' => 'usr_hr1',
        'name' => 'Sara Khan',
        'email' => 'hr123@gmail.com',
        'role' => 'company',
        'companyName' => 'TechCorp Solutions'
    ];
}
$currentCompany = $_SESSION['user'];
?>

<!-- High Contrast Header Bar with Menu Toggle -->
<header class="bg-white border-bottom border-2 border-slate-200 py-3 sticky-top shadow-sm">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <!-- Menu Toggle Button -->
      <button onclick="toggleSidebarMenu()" class="btn btn-black-secondary btn-sm px-3 font-weight-black d-flex align-items-center gap-2" id="btn-toggle-menu">
        <i class="fas fa-bars text-primary" id="menu-icon"></i> <span>Menu</span>
      </button>

      <a href="index.php" class="navbar-brand fw-black text-black mb-0 d-flex align-items-center gap-2">
        <div class="bg-info text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
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

<div class="container-fluid px-0">
  <div class="row g-0">
    
    <!-- Left Dark Vertical Sidebar Panel (EXACT REPLICA OF REFERENCE SCREENSHOT) -->
    <div class="col-md-3 col-lg-2 p-0" id="sidebar-wrapper">
      <div class="sidebar-dark-panel">
        
        <!-- Large Circular Avatar & Company Name -->
        <div class="text-center pb-2 mb-2">
          <div class="rounded-circle border border-2 border-secondary d-flex align-items-center justify-center mx-auto mb-2 shadow-sm" style="width: 80px; height: 80px; background-color: #1e293b;">
            <i class="fas fa-user-tie fa-2x text-light opacity-75"></i>
          </div>
          <h6 class="fw-bold mb-1 text-white fs-5"><?php echo htmlspecialchars(strtolower(explode(' ', $currentCompany['companyName'])[0])); ?></h6>
          <small class="text-secondary extra-small d-block text-break mb-3"><?php echo htmlspecialchars($currentCompany['email']); ?></small>

          <!-- Outlined Action Pill Buttons -->
          <div class="d-flex flex-column gap-2 mb-2">
            <button onclick="switchCompanyTab('postings')" class="btn-sidebar-outline">
              <i class="fas fa-building"></i> Edit Company Profile
            </button>
            <button onclick="switchCompanyTab('postings')" class="btn-sidebar-outline">
              <i class="fas fa-certificate"></i> Verified Certificate
            </button>
          </div>
          <small class="text-secondary extra-small font-weight-bold d-block mt-2">
            <i class="fas fa-check-circle me-1 text-success"></i> Verified HR Account
          </small>
        </div>

        <hr class="border-secondary opacity-25 my-2">

        <!-- Scrollable Vertical Modules -->
        <div class="sidebar-dark-scroll d-flex flex-column gap-2 mt-1">
          <button onclick="switchCompanyTab('postings')" class="sidebar-dark-link active" id="link-cmp-postings">
            <i class="fas fa-chart-line"></i> <span>Dashboard</span>
          </button>
          <button onclick="switchCompanyTab('applicants')" class="sidebar-dark-link" id="link-cmp-applicants">
            <i class="fas fa-users"></i> <span>Applicants</span>
          </button>
          <button onclick="switchCompanyTab('interviews')" class="sidebar-dark-link" id="link-cmp-interviews">
            <i class="fas fa-calendar-alt"></i> <span>Interviews</span>
          </button>

          <hr class="border-secondary opacity-25 my-2">

          <a href="logout.php" class="sidebar-dark-link text-danger text-decoration-none">
            <i class="fas fa-sign-out-alt text-danger"></i> <span class="text-danger">Logout</span>
          </a>
        </div>

      </div>
    </div>

    <!-- Main Content Area -->
    <div class="col-md-9 col-lg-10 p-4" id="main-content-col">
      
      <!-- TAB 1: MANAGE POSTINGS -->
      <div id="tab-cmp-postings" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3 class="fw-black text-black mb-0">Posted Internship Opportunities</h3>
          <button onclick="openCreatePostingModal()" class="btn btn-black-primary btn-sm font-weight-black">
            <i class="fas fa-plus-circle me-1"></i> Post New Internship
          </button>
        </div>
        <div id="company-postings-grid" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 2: REVIEW APPLICANTS -->
      <div id="tab-cmp-applicants" class="tab-content d-none">
        <h3 class="fw-black text-black mb-3">Applicant Submissions</h3>
        <div class="master-card-black p-0 overflow-hidden">
          <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
              <thead class="table-light">
                <tr>
                  <th>Student Name</th>
                  <th>Applied Position</th>
                  <th>Resume/CV</th>
                  <th>Status</th>
                  <th>Action & Evaluation</th>
                </tr>
              </thead>
              <tbody id="company-applicants-table-body">
                <!-- Dynamically populated -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- TAB 3: SCHEDULE INTERVIEWS -->
      <div id="tab-cmp-interviews" class="tab-content d-none">
        <h3 class="fw-black text-black mb-3">Onsite Interview Schedules</h3>
        <div id="company-interviews-list" class="space-y-3">
          <!-- Dynamically populated -->
        </div>
      </div>

    </div>
  </div>
</div>

<!-- CREATE POSTING MODAL -->
<div class="modal fade" id="createPostingModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-primary text-white border-0 py-3">
        <h5 class="modal-title font-weight-black text-white"><i class="fas fa-plus-circle me-2"></i> Post New Internship</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="submitNewInternship(event)">
        <div class="modal-body p-4">
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label font-weight-black text-black">Internship Title</label>
              <input type="text" id="post-title" required class="form-control py-2" placeholder="e.g. Software Engineer Intern">
            </div>
            <div class="col-md-6">
              <label class="form-label font-weight-black text-black">Category</label>
              <select id="post-category" class="form-select py-2">
                <option value="Software Development">Software Development</option>
                <option value="UI/UX Design">UI/UX Design</option>
                <option value="Data Science">Data Science</option>
                <option value="Digital Marketing">Digital Marketing</option>
                <option value="Cyber Security">Cyber Security</option>
              </select>
            </div>
          </div>
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label font-weight-black text-black">Stipend / Salary</label>
              <input type="text" id="post-stipend" required class="form-control py-2" placeholder="e.g. PKR 35,000 / month">
            </div>
            <div class="col-md-6">
              <label class="form-label font-weight-black text-black">Application Deadline</label>
              <input type="date" id="post-deadline" required class="form-control py-2">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Job Description & Requirements</label>
            <textarea id="post-desc" required rows="4" class="form-control py-2" placeholder="Detail the duties, required skills, and duration..."></textarea>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-black-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-black-primary btn-sm px-4 font-weight-black">Publish Opportunity</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- SCHEDULE INTERVIEW MODAL -->
<div class="modal fade" id="interviewModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-info text-white border-0 py-3">
        <h5 class="modal-title font-weight-black text-white"><i class="fas fa-calendar-plus me-2"></i> Schedule Onsite Interview</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveInterviewSchedule(event)">
        <div class="modal-body p-4">
          <input type="hidden" id="int-app-id">
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Candidate Name</label>
            <input type="text" id="int-student-name" readonly class="form-control bg-light py-2">
          </div>
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
            <label class="form-label font-weight-black text-black">Onsite Venue / Address</label>
            <textarea id="int-address" required rows="2" class="form-control py-2" placeholder="Enter company office address or floor number..."></textarea>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
<script>
  const currentCompany = DIS.checkAuth(['company']);

  document.addEventListener('DOMContentLoaded', () => {
    if (!currentCompany) return;
    renderCompanyPostings();
    renderCompanyApplicants();
    renderCompanyInterviews();
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

  function switchCompanyTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('d-none'));
    document.querySelectorAll('.sidebar-dark-link').forEach(el => el.classList.remove('active'));

    document.getElementById(`tab-cmp-${tabId}`).classList.remove('d-none');
    document.getElementById(`link-cmp-${tabId}`).classList.add('active');
  }

  function renderCompanyPostings() {
    const internships = DIS.getInternships();
    const grid = document.getElementById('company-postings-grid');
    grid.innerHTML = '';

    if (internships.length === 0) {
      grid.innerHTML = '<div class="col-12 text-center py-4 text-black font-weight-black">No active postings. Click Post New Internship to create.</div>';
      return;
    }

    internships.forEach(item => {
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-4';
      col.innerHTML = `
        <div class="master-card-black p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between mb-2">
              <span class="badge badge-black-pill badge-sky">${item.category}</span>
              <small class="text-black font-weight-black">${item.deadline}</small>
            </div>
            <h5 class="font-weight-black text-black mb-1">${item.title}</h5>
            <p class="small text-black font-weight-bold mb-3">${item.description}</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-black extra-small">${item.stipend}</span>
            <button onclick="deletePosting('${item.id}')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
          </div>
        </div>
      `;
      grid.appendChild(col);
    });
  }

  function openCreatePostingModal() {
    const bsModal = new bootstrap.Modal(document.getElementById('createPostingModal'));
    bsModal.show();
  }

  function submitNewInternship(e) {
    e.preventDefault();
    const title = document.getElementById('post-title').value;
    const category = document.getElementById('post-category').value;
    const stipend = document.getElementById('post-stipend').value;
    const deadline = document.getElementById('post-deadline').value;
    const description = document.getElementById('post-desc').value;

    const internships = DIS.getInternships();
    const newPosting = {
      id: 'int_' + Date.now(),
      companyId: currentCompany.id,
      companyName: currentCompany.companyName || currentCompany.name,
      title,
      category,
      stipend,
      deadline,
      description,
      status: 'active'
    };

    internships.unshift(newPosting);
    DIS.setInternships(internships);
    DIS.showToast('Internship opportunity published!', 'success');

    const modalEl = document.getElementById('createPostingModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();

    renderCompanyPostings();
  }

  function deletePosting(id) {
    if (confirm('Delete this internship posting?')) {
      let internships = DIS.getInternships();
      internships = internships.filter(i => i.id !== id);
      DIS.setInternships(internships);
      DIS.showToast('Posting deleted!', 'info');
      renderCompanyPostings();
    }
  }

  function renderCompanyApplicants() {
    const apps = DIS.getApplications();
    const tbody = document.getElementById('company-applicants-table-body');
    tbody.innerHTML = '';

    if (apps.length === 0) {
      tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-black font-weight-black">No applicants yet.</td></tr>';
      return;
    }

    apps.forEach(a => {
      const internships = DIS.getInternships();
      const intObj = internships.find(i => i.id === a.internshipId);

      let badgeClass = 'badge-amber';
      if (a.status === 'Shortlisted') badgeClass = 'badge-sky';
      if (a.status === 'Selected') badgeClass = 'badge-emerald';
      if (a.status === 'Rejected') badgeClass = 'badge-danger';

      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><div class="fw-black text-black">${a.studentName}</div><small class="text-black font-weight-bold">${a.studentEmail}</small></td>
        <td><div class="small fw-black text-black">${intObj ? intObj.title : 'Position'}</div></td>
        <td><a href="#" onclick="alert('Viewing Resume Document: ${a.cvName}'); return false;" class="text-primary font-weight-black text-decoration-none"><i class="fas fa-file-pdf me-1"></i> ${a.cvName}</a></td>
        <td><span class="badge badge-black-pill ${badgeClass}">${a.status}</span></td>
        <td>
          <div class="btn-group btn-group-sm">
            <button onclick="updateAppStatus('${a.id}', 'Shortlisted')" class="btn btn-outline-info" title="Shortlist Candidate">Shortlist</button>
            <button onclick="openInterviewModal('${a.id}', '${a.studentName}')" class="btn btn-outline-success" title="Schedule Onsite Interview">Schedule</button>
            <button onclick="updateAppStatus('${a.id}', 'Rejected')" class="btn btn-outline-danger" title="Reject Candidate">Reject</button>
          </div>
        </td>
      `;
      tbody.appendChild(tr);
    });
  }

  function updateAppStatus(appId, newStatus) {
    const apps = DIS.getApplications();
    const a = apps.find(x => x.id === appId);
    if (a) {
      a.status = newStatus;
      DIS.setApplications(apps);
      DIS.showToast(`Applicant status updated to ${newStatus}`, 'success');
      renderCompanyApplicants();
    }
  }

  function openInterviewModal(appId, studentName) {
    document.getElementById('int-app-id').value = appId;
    document.getElementById('int-student-name').value = studentName;
    const bsModal = new bootstrap.Modal(document.getElementById('interviewModal'));
    bsModal.show();
  }

  function saveInterviewSchedule(e) {
    e.preventDefault();
    const appId = document.getElementById('int-app-id').value;
    const date = document.getElementById('int-date').value;
    const time = document.getElementById('int-time').value;
    const address = document.getElementById('int-address').value;

    const apps = DIS.getApplications();
    const a = apps.find(x => x.id === appId);
    if (a) {
      a.status = 'Shortlisted';
      a.interview = { date, time, address };
      DIS.setApplications(apps);

      DIS.addNotification(a.studentId, 'Interview Scheduled', `Your onsite interview is scheduled on ${date} at ${time}. Venue: ${address}`);
      DIS.showToast('Interview scheduled & notification sent to student!', 'success');

      const modalEl = document.getElementById('interviewModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();

      renderCompanyApplicants();
      renderCompanyInterviews();
    }
  }

  function renderCompanyInterviews() {
    const apps = DIS.getApplications().filter(a => a.interview);
    const container = document.getElementById('company-interviews-list');
    container.innerHTML = '';

    if (apps.length === 0) {
      container.innerHTML = '<div class="text-center py-4 text-black font-weight-black">No interviews scheduled yet.</div>';
      return;
    }

    apps.forEach(a => {
      const card = document.createElement('div');
      card.className = 'master-card-black p-4 mb-3 d-flex justify-content-between align-items-center';
      card.innerHTML = `
        <div>
          <h5 class="fw-black mb-1 text-black">${a.studentName}</h5>
          <p class="extra-small text-black font-weight-bold mb-1"><i class="fas fa-calendar text-primary me-1"></i> Date: ${a.interview.date} at ${a.interview.time}</p>
          <p class="extra-small text-black font-weight-bold mb-0"><i class="fas fa-map-marker-alt text-danger me-1"></i> Venue: ${a.interview.address}</p>
        </div>
        <div>
          <span class="badge badge-black-pill badge-emerald"><i class="fas fa-check-circle me-1"></i> Scheduled</span>
        </div>
      `;
      container.appendChild(card);
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
</body>
</html>
