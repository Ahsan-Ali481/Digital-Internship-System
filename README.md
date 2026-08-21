# Digital Internship System (DIS)

![Project Status](https://img.shields.io/badge/Project--Status-Completed-success)
![Initial Commit](https://img.shields.io/badge/Initial--Commit-March--2--2026-blue)
![Completion Date](https://img.shields.io/badge/Completion--Date-July--9--2026-emerald)
![Language](https://img.shields.io/badge/Primary--Language-PHP-purple)

An intermediate university student web application engineered for managing student internships, company job postings, physical onsite interview schedules, workplace supervisor task evaluations, and institutional administration.

---

## 📅 Project Timeline & Milestone Records

- **Project Initiation Date**: 2 March 2026
- **Initial Git Commit**: 2 March 2026
- **Development Phase**: March 2, 2026 – July 9, 2026
- **Final Release Date**: 9 July 2026
- **Total Development Commits**: 200 Commits (125 Main Branch + 75 Second Branch)

---

## 🛠️ Technology Stack & Architecture

- **Backend**: PHP 8.x (Modular Architecture)
- **Database**: MySQL / MariaDB (`digital_internship_db` with PDO Connection)
- **Frontend Styling**: Bootstrap 5.3 CDN, Tailwind CSS, FontAwesome 6
- **Web Server Environment**: XAMPP (Apache + MySQL)

---

## 👥 System Modules & User Roles

1. **Student Module**:
   - Browse active internship opportunities.
   - 1-Click CV application.
   - Track application status and physical onsite interview details (Date, Month, Year, Time, Venue Address).
   - Log weekly progress reports & view supervisor ratings.
   - Manage profile & update Gmail address.

2. **Company HR Module**:
   - Post new internship opportunities with application deadline validation.
   - Review applicant CVs & shortlist candidates.
   - Schedule physical onsite interviews with full office venue address.
   - Register and assign workplace supervisors to selected interns.

3. **Workplace Supervisor Module**:
   - Issue workplace tasks with completion deadlines.
   - Review weekly intern learning progress logs.
   - Grade performance with 1-5 Star Ratings and constructive feedback.

4. **System Administrator Module**:
   - Manage registered user accounts (Approve/Block/Delete).
   - Verify company registration certificates.
   - Export audit logs in CSV format for university record keeping.

---

## 🚀 Installation & Local Execution (XAMPP)

1. **Clone Repository**:
   ```bash
   git clone https://github.com/Ahsan-Ali481/Digital-Internship-System.git
   ```

2. **Move to XAMPP htdocs**:
   Place the project folder inside `C:\xampp\htdocs\digital-internship-system`.

3. **Start XAMPP Services**:
   Open XAMPP Control Panel and start **Apache** and **MySQL**.

4. **Database Import**:
   Import `database.sql` into MySQL (`digital_internship_db`).

5. **Launch Web Application**:
   Open browser and navigate to:
   `http://localhost/digital-internship-system/index.php`
