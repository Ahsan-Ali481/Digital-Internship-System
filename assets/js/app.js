/**
 * Digital Internship System (DIS) - Core App Engine
 */

const DIS = {
  getUsers: function () {
    const data = localStorage.getItem('dis_users');
    if (!data) {
      const defaultUsers = [
        { id: 'usr_adm1', name: 'System Admin', email: 'admin123@gmail.com', role: 'admin', status: 'approved' },
        { id: 'usr_std1', name: 'Ahmed Hassan', email: 'ahmed123@gmail.com', role: 'student', status: 'approved', university: 'NUST' },
        { id: 'usr_hr1', name: 'Sarah Jenkins', email: 'hr123@gmail.com', role: 'company', companyName: 'TechCorp Solutions', status: 'approved', verified: true },
        { id: 'usr_sup1', name: 'Workplace Supervisor', email: 'supervisor123@gmail.com', role: 'supervisor', companyId: 'usr_hr1', designation: 'Senior AI Engineer', status: 'approved' }
      ];
      localStorage.setItem('dis_users', JSON.stringify(defaultUsers));
      return defaultUsers;
    }
    return JSON.parse(data);
  },

  setUsers: function (users) {
    localStorage.setItem('dis_users', JSON.stringify(users));
  },

  getInternships: function () {
    const data = localStorage.getItem('dis_internships');
    if (!data) {
      const defaultInternships = [
        {
          id: 'int_101',
          companyId: 'usr_hr1',
          companyName: 'TechCorp Solutions',
          title: 'Full Stack Web Developer Intern',
          category: 'Software Development',
          stipend: 'PKR 35,000 / month',
          location: 'Islamabad (Onsite)',
          deadline: '2026-09-30',
          description: 'Build dynamic PHP & MySQL web applications using Bootstrap 5 and modern REST endpoints.',
          status: 'active',
          createdAt: '2026-03-10'
        },
        {
          id: 'int_102',
          companyId: 'usr_hr1',
          companyName: 'TechCorp Solutions',
          title: 'UI/UX Product Design Intern',
          category: 'UI/UX Design',
          stipend: 'PKR 30,000 / month',
          location: 'Remote',
          deadline: '2026-10-15',
          description: 'Design responsive user interfaces and interactive prototypes for enterprise platforms.',
          status: 'active',
          createdAt: '2026-03-12'
        }
      ];
      localStorage.setItem('dis_internships', JSON.stringify(defaultInternships));
      return defaultInternships;
    }
    return JSON.parse(data);
  },

  setInternships: function (items) {
    localStorage.setItem('dis_internships', JSON.stringify(items));
  },

  getApplications: function () {
    const data = localStorage.getItem('dis_applications');
    if (!data) {
      const defaultApps = [
        {
          id: 'app_201',
          internshipId: 'int_101',
          studentId: 'usr_std1',
          studentName: 'Ahmed Hassan',
          studentEmail: 'ahmed123@gmail.com',
          companyId: 'usr_hr1',
          supervisorId: 'usr_sup1',
          cvName: 'Ahmed_Hassan_CV.pdf',
          status: 'Shortlisted',
          appliedAt: '2026-03-15',
          interview: {
            date: '2026-09-25',
            time: '11:00',
            mode: 'Onsite',
            address: 'TechCorp Tower, Suite 400, Silicon Avenue, Islamabad'
          }
        }
      ];
      localStorage.setItem('dis_applications', JSON.stringify(defaultApps));
      return defaultApps;
    }
    return JSON.parse(data);
  },

  setApplications: function (apps) {
    localStorage.setItem('dis_applications', JSON.stringify(apps));
  },

  getTasks: function () {
    const data = localStorage.getItem('dis_tasks');
    if (!data) {
      const defaultTasks = [
        {
          id: 'tsk_301',
          studentId: 'usr_std1',
          supervisorId: 'usr_sup1',
          companyId: 'usr_hr1',
          title: 'Implement Navigation Component in PHP',
          description: 'Create a clean, responsive navbar component using Bootstrap 5 and PHP includes.',
          deadline: '2026-09-28',
          status: 'Pending',
          assignedAt: '2026-03-20'
        }
      ];
      localStorage.setItem('dis_tasks', JSON.stringify(defaultTasks));
      return defaultTasks;
    }
    return JSON.parse(data);
  },

  setTasks: function (tasks) {
    localStorage.setItem('dis_tasks', JSON.stringify(tasks));
  },

  getProgressReports: function () {
    const data = localStorage.getItem('dis_reports');
    if (!data) {
      const defaultReports = [
        {
          id: 'rep_401',
          studentId: 'usr_std1',
          supervisorId: 'usr_sup1',
          weekNumber: 1,
          summary: 'Configured XAMPP MySQL database schema and built user authentication forms.',
          achievements: 'Mastered PHP PDO prepared statements and session management.',
          fileName: 'Week1_Report.pdf',
          submittedAt: '2026-03-25',
          rating: 5,
          feedback: 'Excellent progress and structured database implementation.'
        }
      ];
      localStorage.setItem('dis_reports', JSON.stringify(defaultReports));
      return defaultReports;
    }
    return JSON.parse(data);
  },

  setProgressReports: function (reports) {
    localStorage.setItem('dis_reports', JSON.stringify(reports));
  },

  getNotifications: function (userId) {
    const data = localStorage.getItem(`dis_notifs_${userId}`);
    if (!data) {
      const defaults = [
        {
          id: 'notif_1',
          title: 'Onsite Interview Scheduled',
          message: 'Your onsite interview is scheduled on 25 September 2026 at TechCorp Tower, Suite 400, Islamabad.',
          timestamp: '2026-03-16',
          read: false
        }
      ];
      localStorage.setItem(`dis_notifs_${userId}`, JSON.stringify(defaults));
      return defaults;
    }
    return JSON.parse(data);
  },

  addNotification: function (userId, title, message, type) {
    const notifs = this.getNotifications(userId);
    notifs.unshift({
      id: 'notif_' + Date.now(),
      title,
      message,
      type: type || 'info',
      timestamp: new Date().toISOString().split('T')[0],
      read: false
    });
    localStorage.setItem(`dis_notifs_${userId}`, JSON.stringify(notifs));
  },

  markAllNotificationsRead: function (userId) {
    const notifs = this.getNotifications(userId);
    notifs.forEach(n => n.read = true);
    localStorage.setItem(`dis_notifs_${userId}`, JSON.stringify(notifs));
  },

  clearAllNotifications: function (userId) {
    localStorage.setItem(`dis_notifs_${userId}`, JSON.stringify([]));
  },

  getCurrentUser: function () {
    const data = localStorage.getItem('dis_current_user');
    return data ? JSON.parse(data) : null;
  },

  setCurrentUser: function (user) {
    localStorage.setItem('dis_current_user', JSON.stringify(user));
  },

  logout: function () {
    localStorage.removeItem('dis_current_user');
    window.location.href = 'signin.php';
  },

  checkAuth: function (allowedRoles) {
    const user = this.getCurrentUser();
    if (!user) {
      return null;
    }
    if (allowedRoles && !allowedRoles.includes(user.role)) {
      alert('Unauthorized access! Redirecting to dashboard...');
      window.location.href = `dashboard-${user.role}.php`;
      return null;
    }
    return user;
  },

  validateFutureDate: function (dateString) {
    if (!dateString) return false;
    const inputDate = new Date(dateString);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    return inputDate >= today;
  },

  exportCSV: function (type) {
    let data = [];
    let filename = `${type}_report_${new Date().toISOString().split('T')[0]}.csv`;

    if (type === 'users') data = this.getUsers();
    else if (type === 'internships') data = this.getInternships();
    else if (type === 'applications') data = this.getApplications();

    if (data.length === 0) {
      alert('No data available to export.');
      return;
    }

    const keys = Object.keys(data[0]);
    let csvContent = 'data:text/csv;charset=utf-8,' + keys.join(',') + '\n';

    data.forEach(row => {
      let values = keys.map(k => {
        let val = row[k] === null || row[k] === undefined ? '' : row[k];
        if (typeof val === 'object') val = JSON.stringify(val).replace(/"/g, '""');
        return `"${val}"`;
      });
      csvContent += values.join(',') + '\n';
    });

    const encodedUri = encodeURI(csvContent);
    const link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  },

  showToast: function (message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow-lg`;
    alertDiv.style.zIndex = 9999;
    alertDiv.innerHTML = `
      <span>${message}</span>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(alertDiv);

    setTimeout(() => {
      if (document.body.contains(alertDiv)) {
        alertDiv.remove();
      }
    }, 3500);
  }
};

window.DIS = DIS;
