<?php
// dashboard-student.php - High Contrast Student Portal
$pageTitle = "Student Portal - Digital Internship System";
require_once __DIR__ . '/includes/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    $_SESSION['user'] = [
        'id' => 'usr_std1',
        'name' => 'Ahmed Hassan',
        'email' => 'ahmed123@gmail.com',
        'role' => 'student'
    ];
}
$currentUser = $_SESSION['user'];
?>

<!-- High Contrast Top Header Bar -->
<header class="bg-white border-bottom border-2 border-slate-200 py-3 sticky-top shadow-sm">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <a href="index.php" class="navbar-brand fw-extrabold text-dark-contrast mb-0 d-flex align-items-center gap-2">
        <div class="bg-gradient-primary text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <span class="fs-4">Digital <span class="gradient-text-mask">Internship</span></span>
      </a>
      <span class="badge badge-adv badge-adv-primary px-3 py-2">Student Portal</span>
    </div>
    
    <div class="d-flex align-items-center gap-3">
      <button onclick="toggleNotificationModal()" class="btn btn-adv-secondary btn-sm position-relative px-3">
        <i class="fas fa-bell me-1 text-warning"></i> Notifications
        <span id="notif-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>
      </button>
    </div>
  </div>
</header>

<div class="container-fluid px-4 py-4">
  <div class="row g-4">
    <!-- Left Sidebar Navigation -->
    <div class="col-md-3 col-lg-2">
      <div class="adv-card mb-4 p-3 text-center">
        <div class="bg-indigo-100 text-indigo-700 rounded-circle mx-auto d-flex align-items-center justify-center mb-2 shadow-sm" style="width: 56px; height: 56px; background-color: #e0e7ff;">
          <i class="fas fa-user-graduate fa-lg text-primary"></i>
        </div>
        <h6 id="user-name" class="fw-extrabold mb-0 text-dark-contrast"><?php echo htmlspecialchars($currentUser['name']); ?></h6>
        <small id="user-email" class="text-dark-contrast fw-semibold text-break extra-small"><?php echo htmlspecialchars($currentUser['email']); ?></small>

        <div class="pt-3 mt-3 border-top d-flex flex-column gap-2">
          <button onclick="switchTab('browse')" class="sidebar-link active w-100 text-start border-0" id="link-browse">
            <i class="fas fa-search me-2"></i> Browse Roles
          </button>
          <button onclick="switchTab('applications')" class="sidebar-link w-100 text-start border-0" id="link-applications">
            <i class="fas fa-paper-plane me-2"></i> My Applications
          </button>
          <button onclick="switchTab('tasks')" class="sidebar-link w-100 text-start border-0" id="link-tasks">
            <i class="fas fa-tasks me-2"></i> Supervisor Tasks
          </button>
          <button onclick="switchTab('reports')" class="sidebar-link w-100 text-start border-0" id="link-reports">
            <i class="fas fa-clipboard-check me-2"></i> Weekly Reports
          </button>
          <button onclick="switchTab('profile')" class="sidebar-link w-100 text-start border-0" id="link-profile">
            <i class="fas fa-user-edit me-2"></i> Profile Manager
          </button>
          <a href="logout.php" class="sidebar-link text-danger w-100 text-start text-decoration-none">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
          </a>
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="col-md-9 col-lg-10">
      
      <!-- TAB 1: BROWSE INTERNSHIPS -->
      <div id="tab-browse" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3 class="fw-extrabold text-dark-contrast mb-0">Available Internship Positions</h3>
          <span class="text-dark-contrast fw-semibold small">Explore software engineering & technology roles</span>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <input type="text" id="search-input" onkeyup="filterInternships()" class="form-control py-2" placeholder="Search title or company...">
          </div>
          <div class="col-md-4">
            <select id="category-filter" onchange="filterInternships()" class="form-select py-2">
              <option value="all">All Categories</option>
              <option value="Software Development">Software Development</option>
              <option value="UI/UX Design">UI/UX Design</option>
              <option value="Data Science">Data Science</option>
            </select>
          </div>
        </div>

        <div id="internships-grid" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 2: MY APPLICATIONS -->
      <div id="tab-applications" class="tab-content d-none">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3 class="fw-extrabold text-dark-contrast mb-0">My Applications</h3>
          <span class="badge badge-adv badge-adv-primary" id="app-count-badge">0</span>
        </div>

        <div class="adv-card p-0 overflow-hidden">
          <div class="table-responsive">
            <table class="table-adv">
              <thead>
                <tr>
                  <th>Internship Title & Company</th>
                  <th>Applied Date</th>
                  <th>Status</th>
                  <th>Onsite Physical Interview Schedule</th>
                  <th>CV Attachment</th>
                </tr>
              </thead>
              <tbody id="student-apps-table-body">
                <!-- Dynamically populated -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- TAB 3: SUPERVISOR TASKS -->
      <div id="tab-tasks" class="tab-content d-none">
        <h3 class="fw-extrabold text-dark-contrast mb-3">Assigned Supervisor Tasks</h3>
        <div id="student-tasks-list" class="row g-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 4: WEEKLY PROGRESS REPORTS -->
      <div id="tab-reports" class="tab-content d-none">
        <div class="adv-card mb-4 p-4">
          <h4 class="fw-extrabold text-dark-contrast mb-3">
            <i class="fas fa-pen-nib text-primary me-2"></i> Submit Weekly Progress Report
          </h4>
          <form onsubmit="submitProgressReport(event)">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label font-weight-bold text-dark-contrast">Week Number</label>
                <input type="number" id="rep-week" min="1" max="16" required class="form-control" placeholder="e.g. 1">
              </div>
              <div class="col-md-6">
                <label class="form-label font-weight-bold text-dark-contrast">Report Attachment (PDF/ZIP)</label>
                <input type="file" id="rep-file" class="form-control">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label font-weight-bold text-dark-contrast">Tasks Completed Summary</label>
              <textarea id="rep-summary" required rows="3" class="form-control" placeholder="Describe tasks completed..."></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label font-weight-bold text-dark-contrast">Key Achievements & Skills Gained</label>
              <textarea id="rep-achievements" required rows="2" class="form-control" placeholder="Describe key achievements..."></textarea>
            </div>
            <button type="submit" class="btn btn-adv-primary font-weight-bold">
              <i class="fas fa-paper-plane me-1"></i> Submit Progress Report
            </button>
          </form>
        </div>

        <h4 class="fw-extrabold text-dark-contrast mb-3">Submitted Reports History</h4>
        <div id="student-reports-list" class="space-y-3">
          <!-- Dynamically populated -->
        </div>
      </div>

      <!-- TAB 5: PROFILE MANAGER -->
      <div id="tab-profile" class="tab-content d-none">
        <div class="adv-card p-4">
          <h4 class="fw-extrabold text-dark-contrast mb-3">
            <i class="fas fa-user-edit text-primary me-2"></i> Update Profile & Gmail Address
          </h4>
          <form onsubmit="saveStudentProfile(event)">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label font-weight-bold text-dark-contrast">Full Name</label>
                <input type="text" id="prof-name" required class="form-control py-2">
              </div>
              <div class="col-md-6">
                <label class="form-label font-weight-bold text-dark-contrast">Gmail Address</label>
                <input type="email" id="prof-email" required class="form-control py-2" placeholder="user@gmail.com">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label font-weight-bold text-dark-contrast">Upload Updated Resume (PDF)</label>
              <input type="file" id="prof-resume" class="form-control py-2">
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

<!-- APPLICATION MODAL -->
<div class="modal fade" id="applyModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-gradient-primary text-white border-0 py-3">
        <h5 class="modal-title font-weight-extrabold text-white">Submit Application</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="submitApplication(event)">
        <div class="modal-body p-4">
          <input type="hidden" id="apply-int-id">
          <input type="hidden" id="apply-comp-id">
          <div class="mb-3">
            <label class="form-label font-weight-bold text-dark-contrast">Internship Title</label>
            <input type="text" id="apply-int-title" readonly class="form-control-plaintext font-weight-extrabold text-primary fs-5">
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-bold text-dark-contrast">Upload CV (PDF)</label>
            <input type="file" id="apply-cv" required class="form-control py-2">
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-adv-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-adv-primary btn-sm px-4 font-weight-bold">Submit Application</button>
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
        <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
          <button onclick="markAllNotificationsRead()" class="btn btn-link btn-sm text-decoration-none font-weight-bold p-0 text-primary">Mark All Read</button>
          <button onclick="clearAllNotifications()" class="btn btn-link btn-sm text-danger text-decoration-none font-weight-bold p-0">Clear All</button>
        </div>
        <div id="notif-list-container" class="space-y-2"></div>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/app.js"></script>
<script>
  const currentUser = DIS.checkAuth(['student']);

  document.addEventListener('DOMContentLoaded', () => {
    if (!currentUser) return;
    document.getElementById('user-name').innerText = currentUser.name;
    document.getElementById('user-email').innerText = currentUser.email;

    renderInternships();
    renderMyApplications();
    renderMyTasks();
    renderMyReports();
    loadProfileForm();
    loadNotifications();
  });

  function switchTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('d-none'));
    document.querySelectorAll('.sidebar-link').forEach(el => el.classList.remove('active'));
    
    document.getElementById(`tab-${tabId}`).classList.remove('d-none');
    document.getElementById(`link-${tabId}`).classList.add('active');
  }

  function renderInternships() {
    const internships = DIS.getInternships().filter(i => i.status === 'active');
    const grid = document.getElementById('internships-grid');
    grid.innerHTML = '';

    if (internships.length === 0) {
      grid.innerHTML = '<div class="col-12 text-center py-4 text-dark-contrast font-weight-bold">No active internships posted.</div>';
      return;
    }

    internships.forEach(item => {
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-4';
      col.innerHTML = `
        <div class="adv-card p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge badge-adv badge-adv-primary">${item.category}</span>
              <small class="text-dark-contrast font-weight-bold"><i class="far fa-clock me-1 text-primary"></i> ${item.deadline}</small>
            </div>
            <h5 class="font-weight-extrabold text-dark-contrast mb-1">${item.title}</h5>
            <h6 class="text-primary font-weight-bold small mb-2"><i class="fas fa-building me-1"></i> ${item.companyName}</h6>
            <p class="text-dark-contrast font-weight-medium small">${item.description}</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-extrabold small">${item.stipend}</span>
            <button onclick="openApplyModal('${item.id}', '${item.companyId}', '${item.title}')" class="btn btn-adv-primary btn-sm px-3">Apply</button>
          </div>
        </div>
      `;
      grid.appendChild(col);
    });
  }

  function openApplyModal(id, companyId, title) {
    document.getElementById('apply-int-id').value = id;
    document.getElementById('apply-comp-id').value = companyId;
    document.getElementById('apply-int-title').value = title;
    
    const bsModal = new bootstrap.Modal(document.getElementById('applyModal'));
    bsModal.show();
  }

  function submitApplication(e) {
    e.preventDefault();
    const intId = document.getElementById('apply-int-id').value;
    const compId = document.getElementById('apply-comp-id').value;
    const cvFile = document.getElementById('apply-cv').files[0];

    const apps = DIS.getApplications();
    const newApp = {
      id: 'app_' + Date.now(),
      internshipId: intId,
      studentId: currentUser.id,
      studentName: currentUser.name,
      studentEmail: currentUser.email,
      companyId: compId,
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

    renderMyApplications();
  }

  function formatInterviewDateTime(dateStr, timeStr) {
    if (!dateStr) return '';
    const parts = dateStr.split('-');
    if (parts.length !== 3) return `${dateStr} at ${timeStr}`;
    
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const monthName = months[parseInt(parts[1], 10) - 1] || parts[1];

    let timeFormatted = timeStr || '';
    if (timeStr && timeStr.includes(':')) {
      let [hours, minutes] = timeStr.split(':');
      hours = parseInt(hours, 10);
      const ampm = hours >= 12 ? 'PM' : 'AM';
      hours = hours % 12 || 12;
      timeFormatted = `${String(hours).padStart(2, '0')}:${minutes} ${ampm}`;
    }

    return `${parseInt(parts[2], 10)} ${monthName} ${parts[0]} at ${timeFormatted}`;
  }

  function renderMyApplications() {
    const apps = DIS.getApplications().filter(a => a.studentId === currentUser.id);
    const internships = DIS.getInternships();
    const tbody = document.getElementById('student-apps-table-body');
    document.getElementById('app-count-badge').innerText = apps.length;

    tbody.innerHTML = '';
    if (apps.length === 0) {
      tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-dark-contrast font-weight-bold">No applications submitted yet.</td></tr>';
      return;
    }

    apps.forEach(app => {
      const internship = internships.find(i => i.id === app.internshipId);
      let badgeClass = 'badge-adv-warning';
      if (app.status === 'Shortlisted') badgeClass = 'badge-adv-info';
      if (app.status === 'Selected') badgeClass = 'badge-adv-success';
      if (app.status === 'Rejected') badgeClass = 'badge-adv-danger';

      let interviewHtml = '<span class="text-dark-contrast font-weight-bold small">N/A</span>';
      if (app.interview) {
        const formattedDateTime = formatInterviewDateTime(app.interview.date, app.interview.time);
        const venueAddress = app.interview.address || (internship ? `${internship.companyName} HQ, ${internship.location}` : 'Company Main Office');

        interviewHtml = `
          <div class="small">
            <div class="fw-bold text-dark-contrast"><i class="far fa-calendar-alt text-primary me-1"></i> ${formattedDateTime}</div>
            <div class="bg-light p-2 rounded-3 border mt-1 extra-small text-dark-contrast font-weight-semibold">
              <i class="fas fa-map-marker-alt text-danger me-1"></i> <strong>Venue Address:</strong> ${venueAddress}
            </div>
          </div>
        `;
      }

      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>
          <div class="fw-bold text-dark-contrast">${internship ? internship.title : 'Position'}</div>
          <small class="text-primary font-weight-bold">${internship ? internship.companyName : 'Company'}</small>
        </td>
        <td class="small text-dark-contrast font-weight-semibold">${app.appliedAt}</td>
        <td><span class="badge badge-adv ${badgeClass}">${app.status}</span></td>
        <td>${interviewHtml}</td>
        <td class="small font-weight-bold text-primary"><i class="fas fa-paperclip me-1"></i> ${app.cvName}</td>
      `;
      tbody.appendChild(tr);
    });
  }

  function renderMyTasks() {
    const tasks = DIS.getTasks().filter(t => t.studentId === currentUser.id);
    const container = document.getElementById('student-tasks-list');
    container.innerHTML = '';

    if (tasks.length === 0) {
      container.innerHTML = '<div class="col-12 text-center py-4 text-dark-contrast font-weight-bold">No tasks assigned by supervisor yet.</div>';
      return;
    }

    tasks.forEach(task => {
      const isDone = task.status === 'Completed';
      const col = document.createElement('div');
      col.className = 'col-md-6';
      col.innerHTML = `
        <div class="adv-card p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between mb-2">
              <small class="text-dark-contrast font-weight-bold"><i class="far fa-clock me-1 text-primary"></i> Deadline: ${task.deadline}</small>
              <span class="badge badge-adv ${isDone ? 'badge-adv-success' : 'badge-adv-warning'}">${task.status}</span>
            </div>
            <h5 class="font-weight-bold text-dark-contrast mb-2">${task.title}</h5>
            <p class="text-dark-contrast font-weight-medium small">${task.description}</p>
          </div>
          <div class="pt-3 border-top">
            <button onclick="toggleTaskStatus('${task.id}')" class="btn btn-adv-secondary btn-sm w-100 font-weight-bold">
              Mark as ${isDone ? 'Pending' : 'Completed'}
            </button>
          </div>
        </div>
      `;
      container.appendChild(col);
    });
  }

  function toggleTaskStatus(taskId) {
    const tasks = DIS.getTasks();
    const task = tasks.find(t => t.id === taskId);
    if (task) {
      task.status = task.status === 'Completed' ? 'Pending' : 'Completed';
      DIS.setTasks(tasks);
      DIS.showToast(`Task marked as ${task.status}`, 'success');
      renderMyTasks();
    }
  }

  function submitProgressReport(e) {
    e.preventDefault();
    const weekNumber = document.getElementById('rep-week').value;
    const summary = document.getElementById('rep-summary').value;
    const achievements = document.getElementById('rep-achievements').value;
    const fileInput = document.getElementById('rep-file').files[0];

    const reports = DIS.getProgressReports();
    const newReport = {
      id: 'rep_' + Date.now(),
      studentId: currentUser.id,
      supervisorId: 'usr_sup1',
      weekNumber: parseInt(weekNumber, 10),
      summary,
      achievements,
      fileName: fileInput ? fileInput.name : null,
      submittedAt: new Date().toISOString().split('T')[0],
      rating: null,
      feedback: null
    };

    reports.unshift(newReport);
    DIS.setProgressReports(reports);
    DIS.showToast('Progress report submitted!', 'success');
    e.target.reset();
    renderMyReports();
  }

  function renderMyReports() {
    const reports = DIS.getProgressReports().filter(r => r.studentId === currentUser.id);
    const container = document.getElementById('student-reports-list');
    container.innerHTML = '';

    if (reports.length === 0) {
      container.innerHTML = '<div class="text-center py-3 text-dark-contrast font-weight-bold small">No progress reports submitted yet.</div>';
      return;
    }

    reports.forEach(r => {
      const card = document.createElement('div');
      card.className = 'adv-card p-4 mb-3';
      card.innerHTML = `
        <div class="d-flex justify-content-between mb-2">
          <h5 class="font-weight-extrabold text-primary mb-0">Week ${r.weekNumber} Report</h5>
          <small class="text-dark-contrast font-weight-bold">${r.submittedAt}</small>
        </div>
        <p class="small text-dark-contrast font-weight-semibold mb-1"><strong>Summary:</strong> ${r.summary}</p>
        <p class="small text-dark-contrast font-weight-semibold mb-2"><strong>Achievements:</strong> ${r.achievements}</p>
        ${r.rating ? `
          <div class="bg-light p-3 rounded-3 border border-success extra-small text-dark-contrast font-weight-bold">
            <span class="text-success font-weight-bold"><i class="fas fa-star text-warning me-1"></i> Rating: ${r.rating}/5 Stars</span>
            <div class="text-dark-contrast mt-1"><strong>Supervisor Feedback:</strong> ${r.feedback || 'Great job!'}</div>
          </div>
        ` : '<span class="badge badge-adv badge-adv-warning extra-small">Pending Review</span>'}
      `;
      container.appendChild(card);
    });
  }

  function loadProfileForm() {
    document.getElementById('prof-name').value = currentUser.name;
    document.getElementById('prof-email').value = currentUser.email;
  }

  function saveStudentProfile(e) {
    e.preventDefault();
    const name = document.getElementById('prof-name').value;
    const email = document.getElementById('prof-email').value;

    const users = DIS.getUsers();
    const user = users.find(u => u.id === currentUser.id);
    if (user) {
      user.name = name;
      user.email = email;
      DIS.setUsers(users);
      DIS.setCurrentUser(user);

      document.getElementById('user-name').innerText = name;
      document.getElementById('user-email').innerText = email;
      DIS.showToast('Profile updated!', 'success');
    }
  }

  function loadNotifications() {
    const notifs = DIS.getNotifications(currentUser.id);
    const container = document.getElementById('notif-list-container');
    const badge = document.getElementById('notif-badge');

    const unreadCount = notifs.filter(n => n.read !== true).length;
    if (badge) {
      badge.innerText = unreadCount;
      if (unreadCount === 0) badge.classList.add('d-none');
      else badge.classList.remove('d-none');
    }

    if (!container) return;
    container.innerHTML = notifs.length ? '' : '<div class="text-center py-3 text-dark-contrast font-weight-bold small">No notifications</div>';
    notifs.forEach(n => {
      container.innerHTML += `<div class="p-3 border rounded-3 small bg-light mb-2 text-dark-contrast font-weight-semibold"><strong>${n.title}</strong><br>${n.message}</div>`;
    });
  }

  function markAllNotificationsRead() {
    DIS.markAllNotificationsRead(currentUser.id);
    loadNotifications();
  }

  function clearAllNotifications() {
    DIS.clearAllNotifications(currentUser.id);
    loadNotifications();
  }

  function toggleNotificationModal() {
    const bsModal = new bootstrap.Modal(document.getElementById('notifModal'));
    bsModal.show();
  }
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
