<?php
// dashboard-student.php - Student Dashboard
$pageTitle = "Student Dashboard - Digital Internship System";
require_once __DIR__ . '/config/db.php';

// Session Auth Check
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    // Default student session for demo if accessing directly
    $_SESSION['user'] = [
        'id' => 'usr_std1',
        'name' => 'Ahmed Hassan',
        'email' => 'ahmed.hassan@gmail.com',
        'role' => 'student'
    ];
}
$currentUser = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="bg-light">

<!-- Top Header Bar -->
<header class="bg-white border-bottom py-2 sticky-top shadow-sm">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <a href="index.php" class="navbar-brand font-weight-bold text-primary mb-0">
        <i class="fas fa-graduation-cap me-1"></i> Digital Internship System
      </a>
      <span class="badge bg-primary text-white">Student Portal</span>
    </div>
    
    <div class="d-flex align-items-center gap-3">
      <!-- Theme Toggle -->
      <button onclick="DIS.toggleTheme()" class="btn btn-outline-secondary btn-sm" title="Toggle Light/Dark Theme">
        <i class="fas fa-moon"></i>
      </button>

      <!-- Notification Bell with Badge -->
      <div class="position-relative">
        <button onclick="toggleNotificationModal()" class="btn btn-outline-primary btn-sm position-relative">
          <i class="fas fa-bell"></i>
          <span id="notif-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            2
          </span>
        </button>
      </div>
    </div>
  </div>
</header>

<div class="container-fluid px-4 py-4">
  <div class="row g-4">
    <!-- Left Vertical Sidebar -->
    <div class="col-md-3 col-lg-2">
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center p-3">
          <div class="bg-primary text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-2" style="width: 50px; height: 50px;">
            <i class="fas fa-user-graduate fa-lg"></i>
          </div>
          <h6 id="user-name" class="font-weight-bold mb-0"><?php echo htmlspecialchars($currentUser['name']); ?></h6>
          <small id="user-email" class="text-muted text-break extra-small"><?php echo htmlspecialchars($currentUser['email']); ?></small>
        </div>
        
        <div class="list-group list-group-flush border-top">
          <button onclick="switchTab('browse')" class="list-group-item list-group-item-action active text-start font-weight-semibold" id="link-browse">
            <i class="fas fa-search me-2 text-primary"></i> Browse Internships
          </button>
          <button onclick="switchTab('applications')" class="list-group-item list-group-item-action text-start font-weight-semibold" id="link-applications">
            <i class="fas fa-paper-plane me-2 text-success"></i> My Applications
          </button>
          <button onclick="switchTab('tasks')" class="list-group-item list-group-item-action text-start font-weight-semibold" id="link-tasks">
            <i class="fas fa-tasks me-2 text-warning"></i> Supervisor Tasks
          </button>
          <button onclick="switchTab('reports')" class="list-group-item list-group-item-action text-start font-weight-semibold" id="link-reports">
            <i class="fas fa-clipboard-check me-2 text-info"></i> Weekly Reports
          </button>
          <button onclick="switchTab('profile')" class="list-group-item list-group-item-action text-start font-weight-semibold" id="link-profile">
            <i class="fas fa-user-edit me-2 text-secondary"></i> Profile & Resume
          </button>
          <a href="logout.php" class="list-group-item list-group-item-action text-danger text-start font-weight-semibold">
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
          <h4 class="font-weight-bold mb-0">Browse Available Internships</h4>
          <span class="text-muted small">Find software, design & engineering roles</span>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-5">
            <input type="text" id="search-input" onkeyup="filterInternships()" class="form-control form-control-sm" placeholder="Search title or company...">
          </div>
          <div class="col-md-4">
            <select id="category-filter" onchange="filterInternships()" class="form-select form-select-sm">
              <option value="all">All Categories</option>
              <option value="Software Development">Software Development</option>
              <option value="UI/UX Design">UI/UX Design</option>
              <option value="Data Science">Data Science</option>
            </select>
          </div>
        </div>

        <div id="internships-grid" class="row g-3">
          <!-- Dynamic Internships loaded via app.js -->
        </div>
      </div>

      <!-- TAB 2: MY APPLICATIONS -->
      <div id="tab-applications" class="tab-content d-none">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="font-weight-bold mb-0">My Submitted Applications</h4>
          <span class="badge bg-secondary" id="app-count-badge">0</span>
        </div>

        <div class="card shadow-sm border-0">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Internship Title & Company</th>
                  <th>Applied Date</th>
                  <th>Status</th>
                  <th>Interview Schedule</th>
                  <th>CV File</th>
                </tr>
              </thead>
              <tbody id="student-apps-table-body">
                <!-- Loaded via JS -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- TAB 3: SUPERVISOR TASKS -->
      <div id="tab-tasks" class="tab-content d-none">
        <h4 class="font-weight-bold mb-3">Workplace Supervisor Tasks</h4>
        <div id="student-tasks-list" class="row g-3">
          <!-- Loaded via JS -->
        </div>
      </div>

      <!-- TAB 4: WEEKLY PROGRESS REPORTS -->
      <div id="tab-reports" class="tab-content d-none">
        <div class="card shadow-sm border-0 mb-4">
          <div class="card-header bg-white font-weight-bold">
            <i class="fas fa-pen-nib text-primary me-2"></i> Submit Weekly Progress Report
          </div>
          <div class="card-body">
            <form onsubmit="submitProgressReport(event)">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold">Week Number</label>
                  <input type="number" id="rep-week" min="1" max="16" required class="form-control form-control-sm" placeholder="e.g. 1">
                </div>
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold">Attachment (PDF/ZIP)</label>
                  <input type="file" id="rep-file" class="form-control form-control-sm">
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label font-weight-semibold">Weekly Summary of Tasks Completed</label>
                <textarea id="rep-summary" required rows="3" class="form-control form-control-sm" placeholder="Describe the tasks completed this week..."></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label font-weight-semibold">Key Achievements & Skills Learned</label>
                <textarea id="rep-achievements" required rows="2" class="form-control form-control-sm" placeholder="Mention key achievements..."></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-sm font-weight-bold">
                <i class="fas fa-paper-plane me-1"></i> Submit Progress Report
              </button>
            </form>
          </div>
        </div>

        <h5 class="font-weight-bold mb-3">Past Submitted Reports & Feedback</h5>
        <div id="student-reports-list" class="space-y-3">
          <!-- Loaded via JS -->
        </div>
      </div>

      <!-- TAB 5: PROFILE & RESUME MANAGER -->
      <div id="tab-profile" class="tab-content d-none">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-white font-weight-bold">
            <i class="fas fa-user-edit text-primary me-2"></i> Edit Student Profile & Resume
          </div>
          <div class="card-body">
            <form onsubmit="saveStudentProfile(event)">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold">Full Name</label>
                  <input type="text" id="prof-name" required class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold">Email / Gmail Address</label>
                  <input type="email" id="prof-email" required class="form-control" placeholder="user@gmail.com">
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label font-weight-semibold">Update Resume / CV (PDF File)</label>
                <input type="file" id="prof-resume" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary font-weight-bold">
                <i class="fas fa-save me-1"></i> Save Profile Changes
              </button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- APPLY MODAL -->
<div class="modal fade" id="applyModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Submit Internship Application</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="submitApplication(event)">
        <div class="modal-body">
          <input type="hidden" id="apply-int-id">
          <input type="hidden" id="apply-comp-id">
          <div class="mb-3">
            <label class="form-label font-weight-semibold">Position Title</label>
            <input type="text" id="apply-int-title" readonly class="form-control-plaintext font-weight-bold text-primary">
          </div>
          <div class="mb-3">
            <label class="form-label font-weight-semibold">Upload CV / Resume (PDF)</label>
            <input type="file" id="apply-cv" required class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary btn-sm font-weight-bold">Confirm & Submit Application</button>
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
        <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
          <button onclick="markAllNotificationsRead()" class="btn btn-link btn-sm text-decoration-none font-weight-bold p-0">
            <i class="fas fa-check-double me-1"></i> Mark All as Read
          </button>
          <button onclick="clearAllNotifications()" class="btn btn-link btn-sm text-danger text-decoration-none font-weight-bold p-0">
            <i class="fas fa-trash-alt me-1"></i> Clear All
          </button>
        </div>
        <div id="notif-list-container" class="space-y-2 max-vh-50 overflow-auto">
          <!-- Loaded via JS -->
        </div>
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
    document.querySelectorAll('.list-group-item').forEach(el => el.classList.remove('active'));
    
    document.getElementById(`tab-${tabId}`).classList.remove('d-none');
    document.getElementById(`link-${tabId}`).classList.add('active');
  }

  function renderInternships() {
    const internships = DIS.getInternships().filter(i => i.status === 'active');
    const grid = document.getElementById('internships-grid');
    grid.innerHTML = '';

    if (internships.length === 0) {
      grid.innerHTML = '<div class="col-12 text-center py-4 text-muted">No active internships posted at the moment.</div>';
      return;
    }

    internships.forEach(item => {
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-4';
      col.innerHTML = `
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <span class="badge bg-primary-subtle text-primary">${item.category}</span>
              <small class="text-muted"><i class="far fa-clock me-1"></i> ${item.deadline}</small>
            </div>
            <h5 class="card-title font-weight-bold mb-1">${item.title}</h5>
            <h6 class="card-subtitle text-muted small mb-2"><i class="fas fa-building me-1"></i> ${item.companyName}</h6>
            <p class="card-text text-muted small">${item.description}</p>
          </div>
          <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-bold small">${item.stipend}</span>
            <button onclick="openApplyModal('${item.id}', '${item.companyId}', '${item.title}')" class="btn btn-primary btn-sm font-weight-bold">
              Apply Now
            </button>
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
      tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">No applications submitted yet.</td></tr>';
      return;
    }

    apps.forEach(app => {
      const internship = internships.find(i => i.id === app.internshipId);
      let badgeColor = 'bg-warning';
      if (app.status === 'Shortlisted') badgeColor = 'bg-info';
      if (app.status === 'Selected') badgeColor = 'bg-success';
      if (app.status === 'Rejected') badgeColor = 'bg-danger';

      let interviewHtml = '<span class="text-muted small">N/A</span>';
      if (app.interview) {
        const formattedDateTime = formatInterviewDateTime(app.interview.date, app.interview.time);
        const venueAddress = app.interview.address || (internship ? `${internship.companyName} HQ, ${internship.location}` : 'Company Main Office');

        interviewHtml = `
          <div class="small">
            <div class="font-weight-bold"><i class="far fa-calendar-alt text-primary me-1"></i> ${formattedDateTime}</div>
            <div class="bg-light p-1 rounded mt-1 border extra-small">
              <i class="fas fa-map-marker-alt text-danger me-1"></i> <strong>Venue Address:</strong> ${venueAddress}
            </div>
          </div>
        `;
      }

      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>
          <div class="font-weight-bold">${internship ? internship.title : 'Position'}</div>
          <small class="text-muted">${internship ? internship.companyName : 'Company'}</small>
        </td>
        <td class="small">${app.appliedAt}</td>
        <td><span class="badge ${badgeColor}">${app.status}</span></td>
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
      container.innerHTML = '<div class="col-12 text-center py-4 text-muted">No tasks assigned by your supervisor yet.</div>';
      return;
    }

    tasks.forEach(task => {
      const isDone = task.status === 'Completed';
      const col = document.createElement('div');
      col.className = 'col-md-6';
      col.innerHTML = `
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted"><i class="far fa-clock me-1"></i> Deadline: ${task.deadline}</small>
              <span class="badge ${isDone ? 'bg-success' : 'bg-warning'}">${task.status}</span>
            </div>
            <h6 class="card-title font-weight-bold">${task.title}</h6>
            <p class="card-text text-muted small">${task.description}</p>
          </div>
          <div class="card-footer bg-white border-0">
            <button onclick="toggleTaskStatus('${task.id}')" class="btn btn-outline-primary btn-sm w-100 font-weight-bold">
              <i class="fas ${isDone ? 'fa-undo' : 'fa-check'} me-1"></i> Mark as ${isDone ? 'Pending' : 'Completed'}
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
      DIS.showToast(`Task status updated to ${task.status}`, 'success');
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
      container.innerHTML = '<div class="text-center py-3 text-muted small">No progress reports submitted yet.</div>';
      return;
    }

    reports.forEach(r => {
      const card = document.createElement('div');
      card.className = 'card shadow-sm border-0 mb-3';
      card.innerHTML = `
        <div class="card-body">
          <div class="d-flex justify-content-between mb-2">
            <h6 class="font-weight-bold text-primary mb-0">Week ${r.weekNumber} Report</h6>
            <small class="text-muted">${r.submittedAt}</small>
          </div>
          <p class="small text-muted mb-1"><strong>Summary:</strong> ${r.summary}</p>
          <p class="small text-muted mb-2"><strong>Achievements:</strong> ${r.achievements}</p>
          ${r.rating ? `
            <div class="bg-light p-2 rounded border border-success extra-small">
              <span class="text-success font-weight-bold"><i class="fas fa-star text-warning me-1"></i> Rating: ${r.rating}/5</span>
              <div class="text-muted mt-1"><strong>Supervisor Feedback:</strong> ${r.feedback || 'Great work!'}</div>
            </div>
          ` : '<span class="badge bg-secondary extra-small">Pending Supervisor Review</span>'}
        </div>
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
      DIS.showToast('Profile updated successfully!', 'success');
    }
  }

  function loadNotifications() {
    const notifs = DIS.getNotifications(currentUser.id);
    const container = document.getElementById('notif-list-container');
    const badge = document.getElementById('notif-badge');

    const unreadCount = notifs.filter(n => n.read !== true).length;
    if (badge) {
      if (unreadCount > 0) {
        badge.innerText = unreadCount;
        badge.classList.remove('d-none');
      } else {
        badge.innerText = '0';
        badge.classList.add('d-none');
      }
    }

    if (!container) return;
    container.innerHTML = '';
    if (notifs.length === 0) {
      container.innerHTML = '<div class="text-center py-4 text-muted small"><i class="far fa-bell-slash me-1"></i> No notifications present</div>';
      return;
    }

    notifs.forEach(n => {
      const div = document.createElement('div');
      div.className = `p-2 rounded border mb-2 small ${n.read ? 'bg-light text-muted' : 'bg-primary-subtle text-dark font-weight-semibold'}`;
      div.innerHTML = `
        <div class="d-flex justify-content-between">
          <span>${n.title}</span>
          <small class="text-muted extra-small">${n.timestamp}</small>
        </div>
        <p class="mb-1 extra-small">${n.message}</p>
        <div class="d-flex justify-content-end gap-2">
          ${!n.read ? `<button onclick="markSingleNotifRead('${n.id}')" class="btn btn-link btn-sm p-0 extra-small text-decoration-none">Mark Read</button>` : ''}
          <button onclick="clearSingleNotif('${n.id}')" class="btn btn-link btn-sm p-0 extra-small text-danger text-decoration-none">Clear</button>
        </div>
      `;
      container.appendChild(div);
    });
  }

  function markAllNotificationsRead() {
    DIS.markAllNotificationsRead(currentUser.id);
    DIS.showToast('All notifications marked as read', 'success');
    loadNotifications();
  }

  function clearAllNotifications() {
    DIS.clearAllNotifications(currentUser.id);
    DIS.showToast('All notifications cleared', 'info');
    loadNotifications();
  }

  function markSingleNotifRead(id) {
    DIS.markNotificationRead(id);
    loadNotifications();
  }

  function clearSingleNotif(id) {
    DIS.clearNotification(id);
    loadNotifications();
  }

  function toggleNotificationModal() {
    const bsModal = new bootstrap.Modal(document.getElementById('notifModal'));
    bsModal.show();
  }
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
