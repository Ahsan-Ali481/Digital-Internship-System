<?php
// index.php - Premium Intermediate Landing Page
$pageTitle = "Digital Internship System - Career & Internship Platform";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- SECTION 1: HOME (HERO BANNER) -->
<section id="home" class="bg-primary text-white py-5 position-relative overflow-hidden">
  <div class="container py-4 text-center">
    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white text-primary font-weight-semibold small mb-4 shadow-sm">
      <span class="spinner-grow spinner-grow-sm text-success" role="status"></span>
      Next-Generation Career & Internship Portal
    </div>

    <h1 class="display-5 font-weight-bold mb-3">Bridge the Gap Between Education & Industry</h1>
    <p class="lead mb-4 max-w-3xl mx-auto opacity-90">
      Empowering students, verified company managers, workplace supervisors, and administrators with streamlined internship management and real-time evaluation workflows.
    </p>

    <div class="d-flex justify-content-center gap-3 mb-5">
      <a href="signup.php" class="btn btn-warning btn-lg font-weight-bold px-4 shadow-sm transition-all hover-top">
        <i class="fas fa-rocket me-2"></i> Register Account
      </a>
      <a href="#browse-internships" class="btn btn-outline-light btn-lg font-weight-bold px-4 shadow-sm">
        <i class="fas fa-search me-2"></i> Explore Internships
      </a>
    </div>

    <!-- Stats Bar -->
    <div class="row g-3 max-w-4xl mx-auto pt-3">
      <div class="col-6 col-md-3">
        <div class="p-3 rounded bg-white text-dark shadow-sm card-hover">
          <h3 class="font-weight-bold text-primary mb-0">2,500+</h3>
          <small class="text-muted font-weight-semibold">Students Placed</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded bg-white text-dark shadow-sm card-hover">
          <h3 class="font-weight-bold text-info mb-0">350+</h3>
          <small class="text-muted font-weight-semibold">Verified Companies</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded bg-white text-dark shadow-sm card-hover">
          <h3 class="font-weight-bold text-success mb-0">98.5%</h3>
          <small class="text-muted font-weight-semibold">Completion Rate</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded bg-white text-dark shadow-sm card-hover">
          <h3 class="font-weight-bold text-warning mb-0">100%</h3>
          <small class="text-muted font-weight-semibold">Verified Records</small>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: BROWSE INTERNSHIPS -->
<section id="browse-internships" class="py-5">
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
      <div>
        <h2 class="h2 font-weight-bold text-dark mb-1">Featured Internship Opportunities</h2>
        <p class="text-muted mb-0">Browse latest software engineering, design, and technology roles.</p>
      </div>
      <a href="signin.php" class="btn btn-outline-primary font-weight-bold mt-2 mt-md-0">
        View All Roles <i class="fas fa-arrow-right ms-1"></i>
      </a>
    </div>

    <!-- Category Filter Buttons -->
    <div class="d-flex flex-wrap gap-2 mb-4">
      <button onclick="filterLandingCategory('all')" class="btn btn-primary btn-sm font-weight-semibold active" id="btn-cat-all">All Roles</button>
      <button onclick="filterLandingCategory('Software Development')" class="btn btn-outline-secondary btn-sm font-weight-semibold" id="btn-cat-software">Software Development</button>
      <button onclick="filterLandingCategory('UI/UX Design')" class="btn btn-outline-secondary btn-sm font-weight-semibold" id="btn-cat-uiux">UI/UX Design</button>
      <button onclick="filterLandingCategory('Data Science')" class="btn btn-outline-secondary btn-sm font-weight-semibold" id="btn-cat-data">Data Science</button>
    </div>

    <!-- Internship Cards Grid -->
    <div class="row g-4" id="landing-internships-grid">
      <!-- Card 1 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Software Development">
        <div class="card h-100 border shadow-sm card-hover rounded-3">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-soft-primary px-3 py-2 rounded-pill font-weight-bold">Software Development</span>
              <small class="text-muted"><i class="far fa-clock me-1"></i> Sep 30, 2026</small>
            </div>
            <h5 class="card-title font-weight-bold text-dark mb-1">Full Stack Web Developer Intern</h5>
            <h6 class="card-subtitle text-muted small mb-3"><i class="fas fa-building text-primary me-1"></i> TechCorp Solutions</h6>
            <p class="card-text text-muted small">Develop dynamic PHP & MySQL web applications using Bootstrap 5 and modern REST architecture.</p>
          </div>
          <div class="card-footer bg-white border-top-0 p-4 pt-0 d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-bold"><i class="fas fa-money-bill-wave me-1"></i> PKR 35,000 / mo</span>
            <a href="signin.php" class="btn btn-primary btn-sm font-weight-bold px-3">Apply Now</a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="UI/UX Design">
        <div class="card h-100 border shadow-sm card-hover rounded-3">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-soft-success px-3 py-2 rounded-pill font-weight-bold">UI/UX Design</span>
              <small class="text-muted"><i class="far fa-clock me-1"></i> Oct 15, 2026</small>
            </div>
            <h5 class="card-title font-weight-bold text-dark mb-1">UI/UX Product Design Intern</h5>
            <h6 class="card-subtitle text-muted small mb-3"><i class="fas fa-building text-info me-1"></i> Creative Labs Inc.</h6>
            <p class="card-text text-muted small">Design responsive user interfaces, wireframes, and interactive user prototypes for enterprise products.</p>
          </div>
          <div class="card-footer bg-white border-top-0 p-4 pt-0 d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-bold"><i class="fas fa-money-bill-wave me-1"></i> PKR 30,000 / mo</span>
            <a href="signin.php" class="btn btn-primary btn-sm font-weight-bold px-3">Apply Now</a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Data Science">
        <div class="card h-100 border shadow-sm card-hover rounded-3">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-soft-warning px-3 py-2 rounded-pill font-weight-bold">Data Science</span>
              <small class="text-muted"><i class="far fa-clock me-1"></i> Nov 05, 2026</small>
            </div>
            <h5 class="card-title font-weight-bold text-dark mb-1">Data Analyst Intern</h5>
            <h6 class="card-subtitle text-muted small mb-3"><i class="fas fa-building text-warning me-1"></i> Data Insights Co.</h6>
            <p class="card-text text-muted small">Process structured business data datasets and generate analytical visual dashboards for decision makers.</p>
          </div>
          <div class="card-footer bg-white border-top-0 p-4 pt-0 d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-bold"><i class="fas fa-money-bill-wave me-1"></i> PKR 40,000 / mo</span>
            <a href="signin.php" class="btn btn-primary btn-sm font-weight-bold px-3">Apply Now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: ABOUT US -->
<section id="about" class="bg-white py-5 border-top border-bottom">
  <div class="container py-3">
    <div class="text-center max-w-3xl mx-auto mb-5">
      <h2 class="h2 font-weight-bold text-dark">About Digital Internship System</h2>
      <p class="text-muted">A streamlined platform created to connect academia with enterprise industry partners for verified internship programs.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-3 text-center card-hover bg-light">
          <div class="bg-primary text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 54px; height: 54px;">
            <i class="fas fa-user-graduate fa-lg"></i>
          </div>
          <h5 class="font-weight-bold text-dark">Student Role</h5>
          <p class="text-muted small mb-0">Browse verified internships, apply with CV attachments, track application status, view onsite interview schedules, and log weekly reports.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-3 text-center card-hover bg-light">
          <div class="bg-info text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 54px; height: 54px;">
            <i class="fas fa-building fa-lg"></i>
          </div>
          <h5 class="font-weight-bold text-dark">Company HR Role</h5>
          <p class="text-muted small mb-0">Post internship opportunities, shortlist candidate resumes, schedule physical onsite interviews, and assign workplace supervisors.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-3 text-center card-hover bg-light">
          <div class="bg-success text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 54px; height: 54px;">
            <i class="fas fa-user-tie fa-lg"></i>
          </div>
          <h5 class="font-weight-bold text-dark">Supervisor Role</h5>
          <p class="text-muted small mb-0">Issue structured workplace tasks to assigned interns, review weekly learning logs, and grade intern performance with 1-5 star ratings.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-3 text-center card-hover bg-light">
          <div class="bg-warning text-dark rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 54px; height: 54px;">
            <i class="fas fa-user-shield fa-lg"></i>
          </div>
          <h5 class="font-weight-bold text-dark">Admin Role</h5>
          <p class="text-muted small mb-0">Manage registered user accounts, verify company registration certificates, audit internship completions, and export CSV reports.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: CONTACT US -->
<section id="contact" class="py-5 bg-light">
  <div class="container py-3">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-7">
        <div class="card shadow border-0 rounded-3">
          <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-envelope me-2"></i> Get in Touch With Us</h4>
          </div>
          <div class="card-body p-4">
            <p class="text-muted text-center small mb-4">Have questions regarding university partnerships or company onboarding? Send us an inquiry.</p>

            <form onsubmit="handleContactSubmit(event)">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold text-secondary">Your Name</label>
                  <input type="text" id="c-name" required placeholder="John Doe" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold text-secondary">Email Address / Gmail</label>
                  <input type="email" id="c-email" required placeholder="john@gmail.com" class="form-control">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-semibold text-secondary">Subject</label>
                <input type="text" id="c-subject" required placeholder="Inquiry about..." class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-semibold text-secondary">Message</label>
                <textarea id="c-message" required rows="4" placeholder="Type your message details here..." class="form-control"></textarea>
              </div>

              <button type="submit" class="btn btn-primary w-100 py-2 font-weight-bold shadow-sm">
                <i class="fas fa-paper-plane me-1"></i> Send Inquiry Message
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function filterLandingCategory(category) {
  const cards = document.querySelectorAll('.internship-card-item');
  document.querySelectorAll('#browse-internships .btn').forEach(btn => btn.classList.replace('btn-primary', 'btn-outline-secondary'));
  
  if (category === 'all') {
    cards.forEach(c => c.classList.remove('d-none'));
    document.getElementById('btn-cat-all').className = 'btn btn-primary btn-sm font-weight-semibold active';
  } else {
    cards.forEach(c => {
      if (c.getAttribute('data-cat') === category) c.classList.remove('d-none');
      else c.classList.add('d-none');
    });
  }
}

function handleContactSubmit(e) {
  e.preventDefault();
  DIS.showToast('Thank you! Your message has been sent successfully.', 'success');
  e.target.reset();
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
