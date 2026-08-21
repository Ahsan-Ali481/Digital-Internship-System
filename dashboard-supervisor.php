<?php
// dashboard-supervisor.php - Premium Supervisor Portal
$pageTitle = "Supervisor Portal - Digital Internship System";
require_once __DIR__ . '/includes/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'supervisor') {
    $_SESSION['user'] = [
        'id' => 'usr_sup1',
        'name' => 'Dr. Robert Chen',
        'email' => 'supervisor123@gmail.com',
        'role' => 'supervisor'
    ];
}
$currentSup = $_SESSION['user'];
?>

<!-- Premium Top Header Bar -->
<header class="bg-gradient-dark text-white border-bottom border-dark-subtle py-2 sticky-top shadow-sm">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <a href="index.php" class="navbar-brand fw-bold text-white mb-0 d-flex align-items-center gap-2">
        <div class="bg-gradient-success text-white rounded-3 p-1 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
          <i class="fas fa-user-tie"></i>
        </div>
        <span>Digital Internship</span>
      </a>
      <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-20 px-3 py-1">Supervisor Portal</span>
    </div>
    
    <div class="d-flex align-items-center gap-3">
      <button onclick="toggleNotificationModal()" class="btn btn-outline-light btn-sm position-relative rounded-pill px-3">
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
      <div class="card border-0 shadow-sm rounded-4 mb-4 glass-card">
        <div class="card-body text-center p-3">
          <div class="bg-gradient-success text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-2 shadow-sm" style="width: 54px; height: 54px;">
            <i class="fas fa-user-tie fa-lg"></i>
          </div>
          <h6 class="fw-bold mb-0 text-dark"><?php echo htmlspecialchars($currentSup['name']); ?></h6>
          <small class="text-muted extra-small d-block text-break"><?php echo htmlspecialchars($currentSup['email']); ?></small>
        </div>
        
        <div class="p-2 border-top d-flex flex-column gap-1">
          <button onclick="switchSupTab('tasks')" class="sidebar-link active w-100 text-start border-0" id="link-sup-tasks">
            <i class="fas fa-tasks me-2 text-amber-500"></i> Issue Task
          </button>
          <button onclick="switchSupTab('reports')" class="sidebar-link w-100 text-start border-0" id="link-sup-reports">
            <i class="fas fa-clipboard-check me-2 text-cyan-500"></i> Review Reports
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
        <div class="card border-0 shadow-sm rounded-4 glass-card mb-4">
          <div class="card-header bg-white fw-bold py-3 border-0">
            <i class="fas fa-plus-circle text-success me-2"></i> Issue New Task to Intern
          </div>
          <div class="card-body p-4">
            <form onsubmit="assignTaskToStudent(event)">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Select Intern Student</label>
                  <select id="task-student-select" required class="form-select"></select>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Task Completion Deadline</label>
                  <input type="date" id="task-deadline" required class="form-control">
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Task Title</label>
                <input type="text" id="task-title" required class="form-control" placeholder="e.g. Implement Responsive Navigation Component">
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Task Instructions</label>
                <textarea id="task-desc" required rows="3" class="form-control" placeholder="Provide instructions..."></textarea>
              </div>
              <button type="submit" class="btn btn-primary-gradient px-4 font-weight-bold">
                <i class="fas fa-paper-plane me-1"></i> Issue Workplace Task
              </button>
            </form>
          </div>
        </div>

        <h5 class="fw-extrabold mb-3">Issued Tasks Overview</h5>
        <div id="issued-tasks-grid" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 2: REVIEW REPORTS -->
      <div id="tab-sup-reports" class="tab-content d-none">
        <h4 class="fw-extrabold mb-3">Review Progress Reports</h4>
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
      <div class="modal-header bg-gradient-success text-white border-0">
        <h5 class="modal-title font-weight-bold">Evaluate Report</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveReportEvaluation(event)">
        <div class="modal-body p-4">
          <input type="hidden" id="rev-report-id">
          <div class="mb-3">
            <label class="form-label fw-semibold">Rating (1 - 5 Stars)</label>
            <select id="rev-rating" required class="form-select">
              <option value="5">5 Stars - Excellent</option>
              <option value="4">4 Stars - Very Good</option>
              <option value="3">3 Stars - Good</option>
              <option value="2">2 Stars - Needs Improvement</option>
              <option value="1">1 Star - Unsatisfactory</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Supervisor Feedback</label>
            <textarea id="rev-feedback" required rows="3" class="form-control" placeholder="Provide constructive feedback..."></textarea>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm px-4 font-weight-bold">Submit Evaluation</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- NOTIFICATIONS MODAL -->
<div class="modal fade" id="notifModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-gradient-dark text-white border-0">
        <h5 class="modal-title font-weight-bold"><i class="fas fa-bell text-warning me-2"></i> Notifications</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div id="notif-list-container" class="space-y-2"></div>
      </div>
    </div>
  </div>
</div>

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
      grid.innerHTML = '<div class="col-12 text-center py-4 text-muted">No tasks issued yet.</div>';
      return;
    }

    tasks.forEach(t => {
      const isDone = t.status === 'Completed';
      const col = document.createElement('div');
      col.className = 'col-md-6';
      col.innerHTML = `
        <div class="card h-100 border-0 shadow-sm rounded-4 glass-card card-hover p-3">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted"><i class="far fa-clock me-1"></i> Deadline: ${t.deadline}</small>
              <span class="badge ${isDone ? 'badge-soft-success' : 'badge-soft-warning'} px-3 py-1 rounded-pill">${t.status}</span>
            </div>
            <h6 class="card-title font-weight-bold text-dark mb-1">${t.title}</h6>
            <p class="card-text text-muted small">${t.description}</p>
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
      container.innerHTML = '<div class="text-center py-4 text-muted">No reports submitted.</div>';
      return;
    }

    reports.forEach(r => {
      const card = document.createElement('div');
      card.className = 'card border-0 shadow-sm rounded-4 glass-card mb-3 p-3';
      card.innerHTML = `
        <div class="card-body">
          <div class="d-flex justify-content-between mb-2">
            <h6 class="font-weight-bold text-primary mb-0">Week ${r.weekNumber} Report - Student (${r.studentId})</h6>
            <small class="text-muted">${r.submittedAt}</small>
          </div>
          <p class="small text-muted mb-1"><strong>Summary:</strong> ${r.summary}</p>
          <p class="small text-muted mb-3"><strong>Achievements:</strong> ${r.achievements}</p>
          ${r.rating ? `
            <div class="bg-light p-3 rounded-3 border border-success extra-small">
              <span class="text-success font-weight-bold"><i class="fas fa-star text-warning me-1"></i> Rating: ${r.rating}/5 Stars</span>
              <div class="text-muted mt-1"><strong>Feedback:</strong> ${r.feedback}</div>
            </div>
          ` : `
            <button onclick="openReviewModal('${r.id}')" class="btn btn-success btn-sm px-3 font-weight-bold">
              <i class="fas fa-star me-1"></i> Evaluate & Grade Report
            </button>
          `}
        </div>
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
    container.innerHTML = notifs.length ? '' : '<div class="text-center text-muted small py-3">No notifications</div>';
    notifs.forEach(n => {
      container.innerHTML += `<div class="p-2 border rounded-3 small bg-light mb-2"><strong>${n.title}</strong><br>${n.message}</div>`;
    });
  }

  function toggleNotificationModal() {
    const bsModal = new bootstrap.Modal(document.getElementById('notifModal'));
    bsModal.show();
  }
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
