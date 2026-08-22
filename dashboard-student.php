<?php
// dashboard-student.php - High Contrast Student Portal (NO FOOTER AS REQUESTED)
$pageTitle = "Student Portal - Digital Internship System";
require_once __DIR__ . '/includes/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    $_SESSION['user'] = [
        'id' => 'usr_std1',
        'name' => 'Ahmed Hassan',
        'email' => 'ahmed123@gmail.com',
        'role' => 'student',
        'university' => 'National University of Sciences & Technology'
    ];
}
$currentStudent = $_SESSION['user'];
?>

<!-- High Contrast Header Bar -->
<header class="bg-white border-bottom border-2 border-slate-200 py-3 sticky-top shadow-sm">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <a href="index.php" class="navbar-brand fw-black text-black mb-0 d-flex align-items-center gap-2">
        <div class="bg-primary text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
          <i class="fas fa-graduation-cap text-white"></i>
        </div>
        <span class="fs-4 text-black fw-black">Digital <span class="text-primary">Internship</span></span>
      </a>
      <span class="badge badge-black-pill badge-indigo px-3 py-2">Student Portal</span>
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
        <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-2 shadow-sm" style="width: 56px; height: 56px; background-color: #e0e7ff;">
          <i class="fas fa-user-graduate fa-lg text-primary"></i>
        </div>
        <h6 class="fw-black mb-0 text-black"><?php echo htmlspecialchars($currentStudent['name']); ?></h6>
        <small class="text-black font-weight-black extra-small d-block text-break"><?php echo htmlspecialchars($currentStudent['email']); ?></small>

        <div class="pt-3 mt-3 border-top d-flex flex-column gap-2">
          <button onclick="switchStudentTab('browse')" class="sidebar-link active w-100 text-start border-0" id="link-std-browse">
            <i class="fas fa-search me-2"></i> Browse Positions
          </button>
          <button onclick="switchStudentTab('apps')" class="sidebar-link w-100 text-start border-0" id="link-std-apps">
            <i class="fas fa-paper-plane me-2"></i> My Applications
          </button>
          <button onclick="switchStudentTab('tasks')" class="sidebar-link w-100 text-start border-0" id="link-std-tasks">
            <i class="fas fa-tasks me-2"></i> Workplace Tasks
          </button>
          <button onclick="switchStudentTab('reports')" class="sidebar-link w-100 text-start border-0" id="link-std-reports">
            <i class="fas fa-file-alt me-2"></i> Submit Reports
          </button>
          <a href="logout.php" class="sidebar-link text-danger w-100 text-start text-decoration-none">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
          </a>
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="col-md-9 col-lg-10">
      
      <!-- TAB 1: BROWSE POSITIONS -->
      <div id="tab-std-browse" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3 class="fw-black text-black mb-0">Browse Verified Internships</h3>
          <input type="text" id="std-search-input" onkeyup="filterStudentInternships()" placeholder="Search title or company..." class="form-control form-control-sm w-auto px-3 py-2">
        </div>
        <div id="student-internships-grid" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 2: MY APPLICATIONS -->
      <div id="tab-std-apps" class="tab-content d-none">
        <h3 class="fw-black text-black mb-3">My Internship Applications</h3>
        <div class="master-card-black p-0 overflow-hidden">
          <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
              <thead class="table-light">
                <tr>
                  <th>Opportunity Title</th>
                  <th>Company Name</th>
                  <th>Applied Date</th>
                  <th>Status</th>
                  <th>Onsite Interview Info</th>
                </tr>
              </thead>
              <tbody id="student-apps-table-body">
                <!-- Dynamically populated -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- TAB 3: WORKPLACE TASKS -->
      <div id="tab-std-tasks" class="tab-content d-none">
        <h3 class="fw-black text-black mb-3">Assigned Workplace Tasks</h3>
        <div id="student-tasks-container" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 4: SUBMIT WEEKLY REPORTS -->
      <div id="tab-std-reports" class="tab-content d-none">
        <div class="master-card-black p-4 mb-4">
          <h4 class="fw-black text-black mb-3">
            <i class="fas fa-plus-circle text-primary me-2"></i> Submit Weekly Progress Report
          </h4>
          <form onsubmit="submitStudentReport(event)">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Week Number</label>
                <input type="number" id="rep-week" min="1" max="16" required class="form-control py-2" placeholder="e.g. 1">
              </div>
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Attach Report Document (PDF/Doc)</label>
                <input type="file" id="rep-file" accept=".pdf,.doc,.docx" required class="form-control py-2">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Weekly Work Summary</label>
              <textarea id="rep-summary" required rows="3" class="form-control py-2" placeholder="Summarize your weekly learning and completed tasks..."></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Key Achievements & Obstacles</label>
              <textarea id="rep-achievements" required rows="2" class="form-control py-2" placeholder="Highlight key achievements..."></textarea>
            </div>
            <button type="submit" class="btn btn-black-primary font-weight-black">
              <i class="fas fa-paper-plane me-1"></i> Submit Weekly Log Report
            </button>
          </form>
        </div>

        <h3 class="fw-black text-black mb-3">Submitted Progress Logs History</h3>
        <div id="student-reports-history" class="space-y-3">
          <!-- Dynamically populated -->
        </div>
      </div>

    </div>
  </div>
</div>

<!-- APPLY MODAL -->
<div class="modal fade" id="applyModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-primary text-white border-0 py-3">
        <h5 class="modal-title font-weight-black text-white">Apply for Internship</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="submitInternshipApplication(event)">
        <div class="modal-body p-4">
          <input type="hidden" id="apply-internship-id">
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Position Title</label>
            <input type="text" id="apply-title" readonly class="form-control bg-light py-2">
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Company Name</label>
            <input type="text" id="apply-company" readonly class="form-control bg-light py-2">
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Upload CV / Resume (PDF)</label>
            <input type="file" id="apply-cv" accept=".pdf" required class="form-control py-2">
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-black-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-black-primary btn-sm px-4 font-weight-black">Submit Application</button>
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
  const currentStudent = DIS.checkAuth(['student']);

  document.addEventListener('DOMContentLoaded', () => {
    if (!currentStudent) return;
    renderStudentInternships();
    renderStudentApplications();
    renderStudentTasks();
    renderStudentReports();
    loadNotifications();
  });

  function switchStudentTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('d-none'));
    document.querySelectorAll('.sidebar-link').forEach(el => el.classList.remove('active'));

    document.getElementById(`tab-std-${tabId}`).classList.remove('d-none');
    document.getElementById(`link-std-${tabId}`).classList.add('active');
  }

  function renderStudentInternships() {
    const internships = DIS.getInternships().filter(i => i.status === 'active');
    const grid = document.getElementById('student-internships-grid');
    grid.innerHTML = '';

    if (internships.length === 0) {
      grid.innerHTML = '<div class="col-12 text-center py-4 text-black font-weight-black">No active internship opportunities.</div>';
      return;
    }

    internships.forEach(item => {
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-4';
      col.innerHTML = `
        <div class="master-card-black p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge badge-black-pill badge-indigo">${item.category}</span>
              <small class="text-black font-weight-black">${item.deadline}</small>
            </div>
            <h5 class="font-weight-black text-black mb-1">${item.title}</h5>
            <h6 class="text-primary font-weight-black mb-3">${item.companyName}</h6>
            <p class="small text-black font-weight-bold mb-3">${item.description}</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-black extra-small">${item.stipend}</span>
            <button onclick="openApplyModal('${item.id}', '${item.title}', '${item.companyName}')" class="btn btn-black-primary btn-sm font-weight-black">
              Apply Position
            </button>
          </div>
        </div>
      `;
      grid.appendChild(col);
    });
  }

  function openApplyModal(id, title, company) {
    document.getElementById('apply-internship-id').value = id;
    document.getElementById('apply-title').value = title;
    document.getElementById('apply-company').value = company;
    const bsModal = new bootstrap.Modal(document.getElementById('applyModal'));
    bsModal.show();
  }

  function submitInternshipApplication(e) {
    e.preventDefault();
    const id = document.getElementById('apply-internship-id').value;
    const cvFile = document.getElementById('apply-cv').files[0];

    const apps = DIS.getApplications();
    const existing = apps.find(a => a.internshipId === id && a.studentId === currentStudent.id);
    if (existing) {
      DIS.showToast('You have already applied for this position!', 'warning');
      return;
    }

    const newApp = {
      id: 'app_' + Date.now(),
      internshipId: id,
      studentId: currentStudent.id,
      studentName: currentStudent.name,
      studentEmail: currentStudent.email,
      companyId: 'usr_hr1',
      supervisorId: 'usr_sup1',
      cvName: cvFile ? cvFile.name : 'resume.pdf',
      status: 'Pending',
      appliedAt: new Date().toISOString().split('T')[0]
    };

    apps.unshift(newApp);
    DIS.setApplications(apps);
    DIS.showToast('Application submitted successfully!', 'success');

    const modalEl = document.getElementById('applyModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();

    renderStudentApplications();
  }

  function renderStudentApplications() {
    const apps = DIS.getApplications().filter(a => a.studentId === currentStudent.id);
    const tbody = document.getElementById('student-apps-table-body');
    tbody.innerHTML = '';

    if (apps.length === 0) {
      tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-black font-weight-black">No applications submitted yet.</td></tr>';
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
        <td><div class="fw-black text-black">${intObj ? intObj.title : 'Internship Position'}</div></td>
        <td class="small text-black font-weight-bold">${intObj ? intObj.companyName : 'Company'}</td>
        <td class="small text-black font-weight-bold">${a.appliedAt}</td>
        <td><span class="badge badge-black-pill ${badgeClass}">${a.status}</span></td>
        <td class="extra-small text-black font-weight-bold">
          ${a.interview ? `
            <div class="text-success font-weight-black"><i class="fas fa-calendar-check me-1"></i> ${a.interview.date} at ${a.interview.time}</div>
            <div class="text-black"><strong>Venue:</strong> ${a.interview.address}</div>
          ` : '<span class="text-black opacity-75">Pending Schedule</span>'}
        </td>
      `;
      tbody.appendChild(tr);
    });
  }

  function renderStudentTasks() {
    const tasks = DIS.getTasks().filter(t => t.studentId === currentStudent.id);
    const container = document.getElementById('student-tasks-container');
    container.innerHTML = '';

    if (tasks.length === 0) {
      container.innerHTML = '<div class="col-12 text-center py-4 text-black font-weight-black">No tasks assigned yet.</div>';
      return;
    }

    tasks.forEach(t => {
      const isDone = t.status === 'Completed';
      const col = document.createElement('div');
      col.className = 'col-md-6';
      col.innerHTML = `
        <div class="master-card-black p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between mb-2">
              <small class="text-black font-weight-black"><i class="far fa-clock me-1 text-primary"></i> Deadline: ${t.deadline}</small>
              <span class="badge badge-black-pill ${isDone ? 'badge-emerald' : 'badge-amber'}">${t.status}</span>
            </div>
            <h5 class="font-weight-black text-black mb-2">${t.title}</h5>
            <p class="text-black font-weight-bold small mb-3">${t.description}</p>
          </div>
          ${!isDone ? `
            <button onclick="markTaskDone('${t.id}')" class="btn btn-black-primary btn-sm w-100 font-weight-black">
              <i class="fas fa-check me-1"></i> Mark as Completed
            </button>
          ` : '<div class="text-success font-weight-black extra-small text-center"><i class="fas fa-check-circle me-1"></i> Completed</div>'}
        </div>
      `;
      container.appendChild(col);
    });
  }

  function markTaskDone(taskId) {
    const tasks = DIS.getTasks();
    const t = tasks.find(x => x.id === taskId);
    if (t) {
      t.status = 'Completed';
      DIS.setTasks(tasks);
      DIS.showToast('Task marked as completed!', 'success');
      renderStudentTasks();
    }
  }

  function submitStudentReport(e) {
    e.preventDefault();
    const week = document.getElementById('rep-week').value;
    const summary = document.getElementById('rep-summary').value;
    const achievements = document.getElementById('rep-achievements').value;
    const file = document.getElementById('rep-file').files[0];

    const reports = DIS.getProgressReports();
    const newReport = {
      id: 'rep_' + Date.now(),
      studentId: currentStudent.id,
      supervisorId: 'usr_sup1',
      weekNumber: parseInt(week, 10),
      summary,
      achievements,
      fileName: file ? file.name : 'week_report.pdf',
      submittedAt: new Date().toISOString().split('T')[0],
      rating: null,
      feedback: null
    };

    reports.unshift(newReport);
    DIS.setProgressReports(reports);
    DIS.showToast('Weekly log report submitted!', 'success');
    e.target.reset();
    renderStudentReports();
  }

  function renderStudentReports() {
    const reports = DIS.getProgressReports().filter(r => r.studentId === currentStudent.id);
    const container = document.getElementById('student-reports-history');
    container.innerHTML = '';

    if (reports.length === 0) {
      container.innerHTML = '<div class="text-center py-4 text-black font-weight-black">No reports submitted yet.</div>';
      return;
    }

    reports.forEach(r => {
      const card = document.createElement('div');
      card.className = 'master-card-black p-4 mb-3';
      card.innerHTML = `
        <div class="d-flex justify-content-between mb-2">
          <h5 class="font-weight-black text-primary mb-0">Week ${r.weekNumber} Report</h5>
          <small class="text-black font-weight-black">${r.submittedAt}</small>
        </div>
        <p class="small text-black font-weight-bold mb-1"><strong>Summary:</strong> ${r.summary}</p>
        <p class="small text-black font-weight-bold mb-2"><strong>Achievements:</strong> ${r.achievements}</p>
        ${r.rating ? `
          <div class="bg-light p-3 rounded-3 border border-success extra-small text-black font-weight-black">
            <span class="text-success font-weight-black"><i class="fas fa-star text-warning me-1"></i> Supervisor Rating: ${r.rating}/5 Stars</span>
            <div class="text-black mt-1"><strong>Feedback:</strong> ${r.feedback}</div>
          </div>
        ` : '<span class="badge badge-black-pill badge-amber">Pending Evaluation</span>'}
      `;
      container.appendChild(card);
    });
  }

  function loadNotifications() {
    const notifs = DIS.getNotifications(currentStudent.id);
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
