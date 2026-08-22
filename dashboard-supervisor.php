<?php
// dashboard-supervisor.php - High Contrast Supervisor Portal with Collapsible & Scrollable Sidebar
$pageTitle = "Supervisor Portal - Digital Internship System";
require_once __DIR__ . '/includes/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'supervisor') {
    $_SESSION['user'] = [
        'id' => 'usr_sup1',
        'name' => 'Workplace Supervisor',
        'email' => 'supervisor123@gmail.com',
        'role' => 'supervisor',
        'department' => 'Workplace Operations & Evaluation'
    ];
}
$currentSup = $_SESSION['user'];
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
        <div class="bg-success text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
          <i class="fas fa-user-check text-white"></i>
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
    
    <!-- Collapsible & Scrollable Left Sidebar Navigation -->
    <div class="col-md-3 col-lg-2" id="sidebar-wrapper">
      <div class="master-card-black mb-4 p-3 text-center">
        <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-2 shadow-sm" style="width: 56px; height: 56px; background-color: #d1fae5;">
          <i class="fas fa-user-check fa-lg text-success"></i>
        </div>
        <h6 class="fw-black mb-0 text-black"><?php echo htmlspecialchars($currentSup['name']); ?></h6>
        <small class="text-black font-weight-black extra-small d-block text-break mb-3"><?php echo htmlspecialchars($currentSup['email']); ?></small>

        <!-- Scrollable Sidebar Container -->
        <div class="sidebar-scrollable-container pt-2 border-top d-flex flex-column gap-2">
          <button onclick="switchSupTab('tasks')" class="sidebar-link active w-100 text-start border-0" id="link-sup-tasks">
            <i class="fas fa-tasks"></i> <span>Assign Workplace Tasks</span>
          </button>
          <button onclick="switchSupTab('reports')" class="sidebar-link w-100 text-start border-0" id="link-sup-reports">
            <i class="fas fa-clipboard-check"></i> <span>Review Student Logs</span>
          </button>          <a href="logout.php" class="sidebar-link text-danger w-100 text-start text-decoration-none">
            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="col-md-9 col-lg-10" id="main-content-col">
      
      <!-- TAB 1: ASSIGN WORKPLACE TASKS -->
      <div id="tab-sup-tasks" class="tab-content">
        <div class="master-card-black p-4 mb-4">
          <h4 class="fw-black text-black mb-3">
            <i class="fas fa-tasks text-success me-2"></i> Assign Workplace Task to Student
          </h4>
          <form onsubmit="createSupervisorTask(event)">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Select Student</label>
                <select id="task-student-id" required class="form-select py-2">
                  <option value="usr_std1">Ahmed Hassan (NUST)</option>
                  <option value="usr_std2">Fatima Ali (FAST)</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Task Title</label>
                <input type="text" id="task-title" required class="form-control py-2" placeholder="e.g. Build REST API Module">
              </div>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Task Deadline</label>
                <input type="date" id="task-deadline" required class="form-control py-2">
              </div>
              <div class="col-md-6">
                <label class="form-label font-weight-black text-black">Priority Level</label>
                <select id="task-priority" class="form-select py-2">
                  <option value="Normal">Normal Priority</option>
                  <option value="High">High Priority</option>
                  <option value="Urgent">Urgent Priority</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label font-weight-black text-black">Detailed Instructions</label>
              <textarea id="task-desc" required rows="3" class="form-control py-2" placeholder="Describe the objectives and expected deliverables..."></textarea>
            </div>
            <button type="submit" class="btn btn-black-primary font-weight-black">
              <i class="fas fa-paper-plane me-1"></i> Assign Task to Student
            </button>
          </form>
        </div>

        <h3 class="fw-black text-black mb-3">Assigned Tasks Directory</h3>
        <div id="sup-tasks-list" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 2: REVIEW PROGRESS LOGS -->
      <div id="tab-sup-reports" class="tab-content d-none">
        <h3 class="fw-black text-black mb-3">Student Weekly Progress Logs Evaluation</h3>
        <div id="sup-reports-list" class="space-y-3">
          <!-- Dynamically populated -->
        </div>
      </div>

    </div>
  </div>
</div>

<!-- EVALUATE LOG REPORT MODAL -->
<div class="modal fade" id="evalModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-success text-white border-0 py-3">
        <h5 class="modal-title font-weight-black text-white"><i class="fas fa-star me-2"></i> Grade & Evaluate Log Report</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveReportEvaluation(event)">
        <div class="modal-body p-4">
          <input type="hidden" id="eval-report-id">
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Star Rating (1 to 5 Stars)</label>
            <select id="eval-rating" class="form-select py-2">
              <option value="5">⭐⭐⭐⭐⭐ 5 Stars - Outstanding Performance</option>
              <option value="4">⭐⭐⭐⭐ 4 Stars - Excellent Work</option>
              <option value="3">⭐⭐⭐ 3 Stars - Good Progress</option>
              <option value="2">⭐⭐ 2 Stars - Satisfactory</option>
              <option value="1">⭐ 1 Star - Needs Improvement</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Supervisor Guidance & Feedback</label>
            <textarea id="eval-feedback" required rows="3" class="form-control py-2" placeholder="Write constructive feedback for the student..."></textarea>
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
    renderSupervisorTasks();
    renderSupervisorReports();
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

  function switchSupTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('d-none'));
    document.querySelectorAll('.sidebar-link').forEach(el => el.classList.remove('active'));

    document.getElementById(`tab-sup-${tabId}`).classList.remove('d-none');
    document.getElementById(`link-sup-${tabId}`).classList.add('active');
  }

  function createSupervisorTask(e) {
    e.preventDefault();
    const studentId = document.getElementById('task-student-id').value;
    const title = document.getElementById('task-title').value;
    const deadline = document.getElementById('task-deadline').value;
    const priority = document.getElementById('task-priority').value;
    const description = document.getElementById('task-desc').value;

    const tasks = DIS.getTasks();
    const newTask = {
      id: 'task_' + Date.now(),
      supervisorId: currentSup.id,
      studentId,
      title,
      description: `[${priority} Priority] ${description}`,
      deadline,
      status: 'Assigned'
    };

    tasks.unshift(newTask);
    DIS.setTasks(tasks);
    DIS.addNotification(studentId, 'New Workplace Task Assigned', `Supervisor assigned task: ${title}`);
    DIS.showToast('Workplace task assigned to student!', 'success');
    e.target.reset();

    renderSupervisorTasks();
  }

  function renderSupervisorTasks() {
    const tasks = DIS.getTasks();
    const container = document.getElementById('sup-tasks-list');
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
          <div class="pt-2 border-top extra-small text-black font-weight-black">
            Assigned Student ID: ${t.studentId}
          </div>
        </div>
      `;
      container.appendChild(col);
    });
  }

  function renderSupervisorReports() {
    const reports = DIS.getProgressReports();
    const container = document.getElementById('sup-reports-list');
    container.innerHTML = '';

    if (reports.length === 0) {
      container.innerHTML = '<div class="text-center py-4 text-black font-weight-black">No student log reports submitted yet.</div>';
      return;
    }

    reports.forEach(r => {
      const isEvaluated = r.rating !== null;
      const card = document.createElement('div');
      card.className = 'master-card-black p-4 mb-3 d-flex justify-content-between align-items-center';
      card.innerHTML = `
        <div>
          <h5 class="font-weight-black text-black mb-1">Week ${r.weekNumber} Log Report</h5>
          <p class="small text-black font-weight-bold mb-1"><strong>Summary:</strong> ${r.summary}</p>
          <a href="#" onclick="alert('Viewing Attached Document: ${r.fileName}'); return false;" class="text-primary font-weight-black extra-small text-decoration-none">
            <i class="fas fa-file-pdf me-1"></i> Attached: ${r.fileName}
          </a>
        </div>
        <div>
          ${isEvaluated ? `
            <div class="text-end">
              <span class="badge badge-black-pill badge-emerald mb-1"><i class="fas fa-star text-warning me-1"></i> ${r.rating}/5 Stars</span>
              <small class="d-block extra-small text-black font-weight-bold">${r.feedback}</small>
            </div>
          ` : `
            <button onclick="openEvalModal('${r.id}')" class="btn btn-black-primary btn-sm font-weight-black">
              Grade & Evaluate
            </button>
          `}
        </div>
      `;
      container.appendChild(card);
    });
  }

  function openEvalModal(reportId) {
    document.getElementById('eval-report-id').value = reportId;
    const bsModal = new bootstrap.Modal(document.getElementById('evalModal'));
    bsModal.show();
  }

  function saveReportEvaluation(e) {
    e.preventDefault();
    const reportId = document.getElementById('eval-report-id').value;
    const rating = document.getElementById('eval-rating').value;
    const feedback = document.getElementById('eval-feedback').value;

    const reports = DIS.getProgressReports();
    const r = reports.find(x => x.id === reportId);
    if (r) {
      r.rating = parseInt(rating, 10);
      r.feedback = feedback;
      DIS.setProgressReports(reports);

      DIS.addNotification(r.studentId, 'Progress Report Evaluated', `Supervisor evaluated Week ${r.weekNumber} report: ${rating}/5 Stars.`);
      DIS.showToast('Evaluation saved & student notified!', 'success');

      const modalEl = document.getElementById('evalModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();

      renderSupervisorReports();
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
