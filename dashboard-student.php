<?php
// dashboard-student.php - High Contrast Student Portal with Edit Profile Feature
$pageTitle = "Student Portal - Digital Internship System";
require_once __DIR__ . '/includes/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    $_SESSION['user'] = [
        'id' => 'usr_std1',
        'name' => 'Ahmed Hassan',
        'email' => 'ahmed123@gmail.com',
        'phone' => '+92 300 1234567',
        'role' => 'student',
        'university' => 'National University of Sciences & Technology'
    ];
}
$currentStudent = $_SESSION['user'];
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

<div class="container-fluid px-0">
  <div class="row g-0">
    
    <!-- 30% Left Professional Sidebar Container -->
    <div class="col-md-4 col-lg-3 p-0" id="sidebar-wrapper">
      <div class="professional-sidebar-panel">
        
        <!-- User Profile Header -->
        <div class="text-center p-4 border-bottom">
          <div id="sidebar-avatar-container" class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3 shadow-sm overflow-hidden" style="width: 76px; height: 76px; background-color: #e0e7ff; border: 3px solid #6366f1;">
            <i class="fas fa-user-graduate fa-2x text-primary"></i>
          </div>
          <h5 id="sidebar-student-name" class="fw-black text-black mb-1"><?php echo htmlspecialchars($currentStudent['name']); ?></h5>
          <small id="sidebar-student-email" class="text-black font-weight-black extra-small d-block text-break mb-3"><?php echo htmlspecialchars($currentStudent['email']); ?></small>

          <!-- Action Buttons -->
          <div class="d-flex flex-column gap-2 mb-2">
            <button onclick="openEditProfileModal()" class="btn-prof-action">
              <i class="fas fa-user-edit me-1"></i> Edit Profile
            </button>
          </div>
          <span class="badge badge-black-pill badge-indigo py-1 px-3 extra-small">
            <i class="fas fa-check-circle me-1 text-primary"></i> Active Student Profile
          </span>
        </div>

        <!-- 100% Flat Module Items -->
        <div class="prof-sidebar-scroll p-3 d-flex flex-column gap-2">
          <button onclick="switchStudentTab('browse')" class="sidebar-pill-link active" id="link-std-browse">
            <i class="fas fa-chart-line"></i> <span>Dashboard</span>
          </button>
          <button onclick="switchStudentTab('tasks')" class="sidebar-pill-link" id="link-std-tasks">
            <i class="fas fa-tasks"></i> <span>My Tasks</span>
          </button>
          <button onclick="switchStudentTab('reports')" class="sidebar-pill-link" id="link-std-reports">
            <i class="fas fa-file-alt"></i> <span>Upload Progress</span>
          </button>
          <button onclick="switchStudentTab('apps')" class="sidebar-pill-link" id="link-std-apps">
            <i class="fas fa-paper-plane"></i> <span>Applications</span>
          </button>

          <hr class="my-2 opacity-25">

          <a href="logout.php" class="sidebar-pill-link text-danger text-decoration-none">
            <i class="fas fa-sign-out-alt text-danger"></i> <span class="text-danger">Logout</span>
          </a>
        </div>

      </div>
    </div>

    <!-- 70% Right Main Content Area -->
    <div class="col-md-8 col-lg-9 p-4" id="main-content-col">
      
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

<!-- EDIT STUDENT PROFILE MODAL -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-primary text-white border-0 py-3">
        <h5 class="modal-title font-weight-black text-white">
          <i class="fas fa-user-edit me-2"></i> Edit Student Profile
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form onsubmit="saveStudentProfile(event)">
        <div class="modal-body p-4">
          
          <!-- Avatar Upload & Live Preview -->
          <div class="text-center mb-4">
            <div class="position-relative d-inline-block">
              <div id="modal-avatar-preview-box" class="rounded-circle mx-auto d-flex align-items-center justify-content-center shadow-sm overflow-hidden" style="width: 96px; height: 96px; background-color: #e0e7ff; border: 3px solid #6366f1;">
                <i id="modal-avatar-preview-icon" class="fas fa-user-graduate fa-3x text-primary"></i>
                <img id="modal-avatar-preview-img" src="" class="w-100 h-100 object-fit-cover d-none" alt="Profile Preview">
              </div>
              <label for="edit-profile-pic" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle shadow-sm" style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; cursor: pointer;" title="Upload Profile Picture">
                <i class="fas fa-camera text-white"></i>
              </label>
              <input type="file" id="edit-profile-pic" accept="image/*" class="d-none" onchange="previewProfilePic(event)">
            </div>
            <small class="text-black font-weight-bold d-block mt-2">Click camera icon to change profile photo</small>
          </div>

          <!-- Full Name -->
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Full Name</label>
            <input type="text" id="edit-student-name-input" required class="form-control py-2" placeholder="Enter full name">
          </div>

          <!-- Gmail Address -->
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Gmail Address</label>
            <input type="email" id="edit-student-email-input" required class="form-control py-2" placeholder="Enter Gmail address">
          </div>

          <!-- Contact Number -->
          <div class="mb-3">
            <label class="form-label font-weight-black text-black">Contact Number</label>
            <input type="tel" id="edit-student-phone-input" required class="form-control py-2" placeholder="e.g. +92 300 1234567">
          </div>

        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-black-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-black-primary btn-sm px-4 font-weight-black">Save Profile Changes</button>
        </div>
      </form>
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
  let currentStudent = DIS.checkAuth(['student']);
  let newAvatarBase64 = null;

  document.addEventListener('DOMContentLoaded', () => {
    if (!currentStudent) return;
    
    // Load persisted profile user data if available
    const activeUser = DIS.getCurrentUser() || currentStudent;
    if (activeUser) {
      currentStudent = activeUser;
      document.getElementById('sidebar-student-name').innerText = activeUser.name || 'Ahmed Hassan';
      document.getElementById('sidebar-student-email').innerText = activeUser.email || 'ahmed123@gmail.com';
      
      if (activeUser.avatar) {
        document.getElementById('sidebar-avatar-container').innerHTML = `<img src="${activeUser.avatar}" class="w-100 h-100 object-fit-cover">`;
      }
    }

    renderStudentInternships();
    renderStudentApplications();
    renderStudentTasks();
    renderStudentReports();
    loadNotifications();
  });

  function openEditProfileModal() {
    const user = DIS.getCurrentUser() || currentStudent;
    
    document.getElementById('edit-student-name-input').value = user.name || '';
    document.getElementById('edit-student-email-input').value = user.email || '';
    document.getElementById('edit-student-phone-input').value = user.phone || user.contactNo || '+92 300 1234567';
    
    const imgPreview = document.getElementById('modal-avatar-preview-img');
    const iconPreview = document.getElementById('modal-avatar-preview-icon');
    
    if (user.avatar) {
      imgPreview.src = user.avatar;
      imgPreview.classList.remove('d-none');
      iconPreview.classList.add('d-none');
      newAvatarBase64 = user.avatar;
    } else {
      imgPreview.classList.add('d-none');
      iconPreview.classList.remove('d-none');
      newAvatarBase64 = null;
    }

    const bsModal = new bootstrap.Modal(document.getElementById('editProfileModal'));
    bsModal.show();
  }

  function previewProfilePic(e) {
    const file = e.target.files[0];
    if (!file) return;

    if (file.size > 5 * 1024 * 1024) {
      DIS.showToast('Image size must be less than 5 MB!', 'error');
      return;
    }

    const reader = new FileReader();
    reader.onload = function(evt) {
      newAvatarBase64 = evt.target.result;
      const imgPreview = document.getElementById('modal-avatar-preview-img');
      const iconPreview = document.getElementById('modal-avatar-preview-icon');
      
      imgPreview.src = newAvatarBase64;
      imgPreview.classList.remove('d-none');
      iconPreview.classList.add('d-none');
    };
    reader.readAsDataURL(file);
  }

  function saveStudentProfile(e) {
    e.preventDefault();
    const newName = document.getElementById('edit-student-name-input').value.trim();
    const newEmail = document.getElementById('edit-student-email-input').value.trim();
    const newPhone = document.getElementById('edit-student-phone-input').value.trim();

    if (!newName || !newEmail || !newPhone) {
      DIS.showToast('Please fill all required profile fields!', 'warning');
      return;
    }

    // 1. Update session user
    let user = DIS.getCurrentUser() || currentStudent;
    user.name = newName;
    user.email = newEmail;
    user.phone = newPhone;
    user.contactNo = newPhone;
    if (newAvatarBase64) {
      user.avatar = newAvatarBase64;
    }

    DIS.setCurrentUser(user);
    currentStudent = user;

    // 2. Update users registry list in DIS localStorage
    let users = DIS.getUsers();
    const idx = users.findIndex(u => u.id === user.id);
    if (idx !== -1) {
      users[idx] = { ...users[idx], ...user };
      DIS.setUsers(users);
    }

    // 3. Update DOM UI elements in Sidebar
    document.getElementById('sidebar-student-name').innerText = newName;
    document.getElementById('sidebar-student-email').innerText = newEmail;

    const sidebarContainer = document.getElementById('sidebar-avatar-container');
    if (user.avatar) {
      sidebarContainer.innerHTML = `<img src="${user.avatar}" class="w-100 h-100 object-fit-cover">`;
    } else {
      sidebarContainer.innerHTML = `<i class="fas fa-user-graduate fa-2x text-primary"></i>`;
    }

    DIS.showToast('Profile updated successfully!', 'success');

    const modalEl = document.getElementById('editProfileModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
  }

  function toggleSidebarMenu() {
    const sidebarWrapper = document.getElementById('sidebar-wrapper');
    const mainContentCol = document.getElementById('main-content-col');
    const menuIcon = document.getElementById('menu-icon');

    if (sidebarWrapper) {
      sidebarWrapper.classList.toggle('d-none');
      if (sidebarWrapper.classList.contains('d-none')) {
        if (mainContentCol) {
          mainContentCol.classList.remove('col-md-8', 'col-lg-9');
          mainContentCol.classList.add('col-12');
        }
        if (menuIcon) menuIcon.className = 'fas fa-bars text-primary';
      } else {
        if (mainContentCol) {
          mainContentCol.classList.remove('col-12');
          mainContentCol.classList.add('col-md-8', 'col-lg-9');
        }
        if (menuIcon) menuIcon.className = 'fas fa-times text-danger';
      }
    }
  }

  function switchStudentTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('d-none'));
    document.querySelectorAll('.sidebar-pill-link').forEach(el => el.classList.remove('active'));

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
