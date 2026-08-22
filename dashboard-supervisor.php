<?php
// dashboard-supervisor.php - High Contrast Supervisor Portal (NO FOOTER AS REQUESTED)
$pageTitle = "Supervisor Portal - Digital Internship System";
require_once __DIR__ . '/includes/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'supervisor') {
    $_SESSION['user'] = [
        'id' => 'usr_sup1',
        'name' => 'Workplace Supervisor',
        'email' => 'supervisor123@gmail.com',
        'role' => 'supervisor'
    ];
}
$currentSup = $_SESSION['user'];
?>

<!-- High Contrast Top Header Bar -->
<header class="bg-white border-bottom border-2 border-slate-200 py-3 sticky-top shadow-sm">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <a href="index.php" class="navbar-brand fw-black text-black mb-0 d-flex align-items-center gap-2">
        <div class="bg-primary text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
          <i class="fas fa-user-tie text-white"></i>
        </div>
        <span class="fs-4 text-black fw-black">Digital <span class="text-primary">Internship</span></span>
      </a>
      <span class="badge badge-black-pill badge-emerald px-3 py-2">Supervisor Portal</span>
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
        <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-2 shadow-sm" style="width: 56px; height: 56px; background-color: #d1fae5;">
          <i class="fas fa-user-tie fa-lg text-success"></i>
        </div>
        <h6 class="fw-black mb-0 text-black"><?php echo htmlspecialchars($currentSup['name']); ?></h6>
        <small class="text-black font-weight-black extra-small d-block text-break"><?php echo htmlspecialchars($currentSup['email']); ?></small>

        <div class="pt-3 mt-3 border-top d-flex flex-column gap-2">
          <button onclick="switchSupTab('tasks')" class="sidebar-link active w-100 text-start border-0" id="link-sup-tasks">
            <i class="fas fa-tasks me-2"></i> Issue Task
          </button>
          <button onclick="switchSupTab('reports')" class="sidebar-link w-100 text-start border-0" id="link-sup-reports">
            <i class="fas fa-clipboard-check me-2"></i> Review Reports
          </button>
          <a href="logout.php" class="sidebar-link text-danger w-100 text-start text-decoration-none">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
          </a>
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="col-md-9 col-lg-10">
      
      <!-- TAB 1: ISSUE WORKPLACE TASK -->
      <div id="tab-sup-tasks" class="tab-content">
        <div class="master-card-black p-4 mb-4">
          <h4 class="fw-black text-black mb-3">
            <i class="fas fa-plus-circle text-success me-2"></i> Issue New Task to Intern
          </h4>
          <form onsubmit="assignTaskToStudent(event)">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Select Intern Student</label>
                <select id="task-student-select" required class="form-select py-2"></select>
              </div>
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Task Completion Deadline</label>
                <input type="date" id="task-deadline" required class="form-control py-2">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Task Title</label>
              <input type="text" id="task-title" required class="form-control py-2" placeholder="e.g. Implement Responsive Navigation Component">
            </div>
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Task Instructions</label>
              <textarea id="task-desc" required rows="3" class="form-control py-2" placeholder="Provide instructions..."></textarea>
            </div>
            <button type="submit" class="btn btn-black-primary font-weight-black">
              <i class="fas fa-paper-plane me-1"></i> Issue Workplace Task
            </button>
          </form>
        </div>

        <h3 class="fw-black text-black mb-3">Issued Tasks Overview</h3>
        <div id="issued-tasks-grid" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 2: REVIEW REPORTS -->
      <div id="tab-sup-reports" class="tab-content d-none">
        <h3 class="fw-black text-black mb-3">Review Progress Reports</h3>
        <div id="supervisor-reports-container" class="space-y-3">
          <!-- Dynamically populated -->
        </div>
      </div>

    </div>
  </div>
</div>

<!-- EVALUATION RATING MODAL -->
<div class="modal fade" id="reviewModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-success text-white border-0 py-3">
        <h5 class="modal-title font-weight-black text-white">Evaluate Report</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveReportEvaluation(event)">
        <div class="modal-body p-4">
          <input type="hidden" id="rev-report-id">
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Rating (1 - 5 Stars)</label>
            <select id="rev-rating" required class="form-select py-2">
              <option value="5">5 Stars - Excellent</option>
              <option value="4">4 Stars - Very Good</option>
              <option value="3">3 Stars - Good</option>
              <option value="2">2 Stars - Needs Improvement</option>
              <option value="1">1 Star - Unsatisfactory</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Supervisor Feedback</label>
            <textarea id="rev-feedback" required rows="3" class="form-control py-2" placeholder="Provide constructive feedback..."></textarea>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-black-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-black-primary btn-sm px-4 font-weight-black">Submit Evaluation</button>
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
  const currentSup = DIS.checkAuth(['supervisor']);

  document.addEventListener('DOMContentLoaded', () => {
    if (!currentSup) return;
    loadStudentSelectOptions();
    renderIssuedTasks();
    renderSubmittedReports();
    loadNotifications();
  });

  function switchSupTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('d-none'));
    document.querySelectorAll('.sidebar-link').forEach(el => el.classList.remove('active'));

    document.getElementById(`tab-sup-${tabId}`).classList.remove('d-none');
    document.getElementById(`link-sup-${tabId}`).classList.add('active');
  }

  function loadStudentSelectOptions() {
    const select = document.getElementById('task-student-select');
    const apps = DIS.getApplications().filter(a => a.supervisorId === currentSup.id || a.status === 'Selected');
    select.innerHTML = '';

    if (apps.length === 0) {
      select.innerHTML = '<option value="usr_std1">Ahmed Hassan (Default Intern)</option>';
    } else {
      apps.forEach(a => {
        select.innerHTML += `<option value="${a.studentId}">${a.studentName} (${a.studentEmail})</option>`;
      });
    }
  }

  function assignTaskToStudent(e) {
    e.preventDefault();
    const studentId = document.getElementById('task-student-select').value;
    const deadline = document.getElementById('task-deadline').value;
    const title = document.getElementById('task-title').value;
    const description = document.getElementById('task-desc').value;

    if (!DIS.validateFutureDate(deadline)) {
      DIS.showToast('Deadline must be a future date!', 'warning');
      return;
    }

    const tasks = DIS.getTasks();
    const newTask = {
      id: 'tsk_' + Date.now(),
      studentId,
      supervisorId: currentSup.id,
      companyId: 'usr_hr1',
      title,
      description,
      deadline,
      status: 'Pending',
      assignedAt: new Date().toISOString().split('T')[0]
    };

    tasks.unshift(newTask);
    DIS.setTasks(tasks);
    DIS.addNotification(studentId, 'New Task Assigned', `Task assigned: ${title}`, 'info');
    DIS.showToast('Task assigned!', 'success');

    e.target.reset();
    renderIssuedTasks();
  }

  function renderIssuedTasks() {
    const tasks = DIS.getTasks().filter(t => t.supervisorId === currentSup.id);
    const grid = document.getElementById('issued-tasks-grid');
    grid.innerHTML = '';

    if (tasks.length === 0) {
      grid.innerHTML = '<div class="col-12 text-center py-4 text-black font-weight-black">No tasks issued yet.</div>';
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
            <p class="text-black font-weight-bold small">${t.description}</p>
          </div>
        </div>
      `;
      grid.appendChild(col);
    });
  }

  function renderSubmittedReports() {
    const reports = DIS.getProgressReports();
    const container = document.getElementById('supervisor-reports-container');
    container.innerHTML = '';

    if (reports.length === 0) {
      container.innerHTML = '<div class="text-center py-4 text-black font-weight-black">No reports submitted.</div>';
      return;
    }

    reports.forEach(r => {
      const card = document.createElement('div');
      card.className = 'master-card-black p-4 mb-3';
      card.innerHTML = `
        <div class="d-flex justify-content-between mb-2">
          <h5 class="font-weight-black text-primary mb-0">Week ${r.weekNumber} Report - Student (${r.studentId})</h5>
          <small class="text-black font-weight-black">${r.submittedAt}</small>
        </div>
        <p class="small text-black font-weight-bold mb-1"><strong>Summary:</strong> ${r.summary}</p>
        <p class="small text-black font-weight-bold mb-3"><strong>Achievements:</strong> ${r.achievements}</p>
        ${r.rating ? `
          <div class="bg-light p-3 rounded-3 border border-success extra-small text-black font-weight-black">
            <span class="text-success font-weight-black"><i class="fas fa-star text-warning me-1"></i> Rating: ${r.rating}/5 Stars</span>
            <div class="text-black mt-1"><strong>Supervisor Feedback:</strong> ${r.feedback}</div>
          </div>
        ` : `
          <button onclick="openReviewModal('${r.id}')" class="btn btn-black-primary btn-sm font-weight-black">
            <i class="fas fa-star me-1"></i> Evaluate & Grade Report
          </button>
        `}
      `;
      container.appendChild(card);
    });
  }

  function openReviewModal(repId) {
    document.getElementById('rev-report-id').value = repId;
    const bsModal = new bootstrap.Modal(document.getElementById('reviewModal'));
    bsModal.show();
  }

  function saveReportEvaluation(e) {
    e.preventDefault();
    const repId = document.getElementById('rev-report-id').value;
    const rating = document.getElementById('rev-rating').value;
    const feedback = document.getElementById('rev-feedback').value;

    const reports = DIS.getProgressReports();
    const rep = reports.find(r => r.id === repId);
    if (rep) {
      rep.rating = parseInt(rating, 10);
      rep.feedback = feedback;
      DIS.setProgressReports(reports);

      DIS.addNotification(rep.studentId, 'Report Evaluated', `Supervisor rated Week ${rep.weekNumber} report: ${rating}/5`, 'success');
      DIS.showToast('Evaluation submitted!', 'success');

      const modalEl = document.getElementById('reviewModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();

      renderSubmittedReports();
    }
  }

  function loadNotifications() {
    const notifs = DIS.getNotifications(currentSup.id);
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
