<?php
// index.php - Premium Intermediate Landing Page
$pageTitle = "Digital Internship System - Career & Internship Platform";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- SECTION 1: HOME (HERO BANNER) -->
<section id="home" class="bg-gradient-dark text-white py-5 position-relative overflow-hidden">
  <div class="container py-5 text-center position-relative" style="z-index: 2;">
    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white font-weight-semibold small mb-4 border border-white border-opacity-20 shadow-sm">
      <span class="spinner-grow spinner-grow-sm text-success" role="status"></span>
      Enterprise-Grade Digital Internship Management
    </div>

    <h1 class="display-4 font-weight-extrabold mb-3 text-white">
      Connect Universities, <span class="text-gradient">Students & Industry</span>
    </h1>
    <p class="lead mb-4 max-w-3xl mx-auto text-white-50 fs-5">
      A unified platform for managing student internship allocations, physical onsite interviews, workplace task tracking, and supervisor performance grading.
    </p>

    <div class="d-flex justify-content-center gap-3 mb-5">
      <a href="signup.php" class="btn btn-primary-gradient btn-lg font-weight-bold px-4 shadow-lg">
        <i class="fas fa-rocket me-2"></i> Register Account
      </a>
      <a href="#browse-internships" class="btn btn-outline-light btn-lg font-weight-bold px-4">
        <i class="fas fa-search me-2"></i> Explore Roles
      </a>
    </div>

    <!-- Stats Counter Bar -->
    <div class="row g-3 max-w-4xl mx-auto pt-3">
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 text-white card-hover">
          <h3 class="font-weight-extrabold mb-0 text-warning">2,500+</h3>
          <small class="text-white-50 font-weight-semibold">Students Placed</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 text-white card-hover">
          <h3 class="font-weight-extrabold mb-0 text-info">350+</h3>
          <small class="text-white-50 font-weight-semibold">Verified Companies</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 text-white card-hover">
          <h3 class="font-weight-extrabold mb-0 text-success">98.5%</h3>
          <small class="text-white-50 font-weight-semibold">Completion Rate</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 text-white card-hover">
          <h3 class="font-weight-extrabold mb-0 text-primary">100%</h3>
          <small class="text-white-50 font-weight-semibold">Verified Records</small>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: BROWSE INTERNSHIPS -->
<section id="browse-internships" class="py-5 bg-light">
  <div class="container py-3">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
      <div>
        <h2 class="h2 font-weight-extrabold text-dark mb-1">Featured Internship Opportunities</h2>
        <p class="text-muted mb-0">Discover software engineering, product design & AI positions.</p>
      </div>
      <a href="signin.php" class="btn btn-outline-primary font-weight-bold mt-2 mt-md-0">
        View All Positions <i class="fas fa-arrow-right ms-1"></i>
      </a>
    </div>

    <!-- Category Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
      <button onclick="filterLandingCategory('all')" class="btn btn-primary-gradient btn-sm font-weight-bold active" id="btn-cat-all">All Positions</button>
      <button onclick="filterLandingCategory('Software Development')" class="btn btn-white border btn-sm font-weight-bold text-secondary" id="btn-cat-software">Software Development</button>
      <button onclick="filterLandingCategory('UI/UX Design')" class="btn btn-white border btn-sm font-weight-bold text-secondary" id="btn-cat-uiux">UI/UX Design</button>
      <button onclick="filterLandingCategory('Data Science')" class="btn btn-white border btn-sm font-weight-bold text-secondary" id="btn-cat-data">Data Science</button>
    </div>

    <!-- Internship Cards Grid -->
    <div class="row g-4" id="landing-internships-grid">
      <!-- Card 1 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Software Development">
        <div class="card h-100 border-0 shadow-sm card-hover rounded-4 glass-card overflow-hidden">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-soft-primary px-3 py-2 rounded-pill">Software Development</span>
              <small class="text-muted font-weight-semibold"><i class="far fa-clock me-1 text-primary"></i> Sep 30, 2026</small>
            </div>
            <h5 class="card-title font-weight-bold text-dark mb-1">Full Stack Web Developer Intern</h5>
            <h6 class="card-subtitle text-muted small mb-3"><i class="fas fa-building text-primary me-1"></i> TechCorp Solutions</h6>
            <p class="card-text text-muted small mb-3">Build dynamic PHP & MySQL web applications using Bootstrap 5 and modern REST architecture.</p>
          </div>
          <div class="card-footer bg-white border-top-0 p-4 pt-0 d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-bold"><i class="fas fa-money-bill-wave me-1"></i> PKR 35,000 / mo</span>
            <a href="signin.php" class="btn btn-primary-gradient btn-sm px-3 shadow-sm">Apply Role</a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="UI/UX Design">
        <div class="card h-100 border-0 shadow-sm card-hover rounded-4 glass-card overflow-hidden">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-soft-success px-3 py-2 rounded-pill">UI/UX Design</span>
              <small class="text-muted font-weight-semibold"><i class="far fa-clock me-1 text-success"></i> Oct 15, 2026</small>
            </div>
            <h5 class="card-title font-weight-bold text-dark mb-1">UI/UX Product Design Intern</h5>
            <h6 class="card-subtitle text-muted small mb-3"><i class="fas fa-building text-info me-1"></i> Creative Labs Inc.</h6>
            <p class="card-text text-muted small mb-3">Design responsive user interfaces, wireframes, and interactive user prototypes for enterprise products.</p>
          </div>
          <div class="card-footer bg-white border-top-0 p-4 pt-0 d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-bold"><i class="fas fa-money-bill-wave me-1"></i> PKR 30,000 / mo</span>
            <a href="signin.php" class="btn btn-primary-gradient btn-sm px-3 shadow-sm">Apply Role</a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Data Science">
        <div class="card h-100 border-0 shadow-sm card-hover rounded-4 glass-card overflow-hidden">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-soft-warning px-3 py-2 rounded-pill">Data Science</span>
              <small class="text-muted font-weight-semibold"><i class="far fa-clock me-1 text-warning"></i> Nov 05, 2026</small>
            </div>
            <h5 class="card-title font-weight-bold text-dark mb-1">Data Analyst Intern</h5>
            <h6 class="card-subtitle text-muted small mb-3"><i class="fas fa-building text-warning me-1"></i> Data Insights Co.</h6>
            <p class="card-text text-muted small mb-3">Process structured business data datasets and generate analytical visual dashboards for decision makers.</p>
          </div>
          <div class="card-footer bg-white border-top-0 p-4 pt-0 d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-bold"><i class="fas fa-money-bill-wave me-1"></i> PKR 40,000 / mo</span>
            <a href="signin.php" class="btn btn-primary-gradient btn-sm px-3 shadow-sm">Apply Role</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: ABOUT US -->
<section id="about" class="bg-white py-5 border-top border-bottom">
  <div class="container py-4">
    <div class="text-center max-w-3xl mx-auto mb-5">
      <h2 class="h2 font-weight-extrabold text-dark">System Capabilities & User Modules</h2>
      <p class="text-muted">A comprehensive web suite tailored for all four key user roles in the internship ecosystem.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-4 text-center card-hover rounded-4 bg-light">
          <div class="bg-gradient-primary text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-3 shadow-sm" style="width: 58px; height: 58px;">
            <i class="fas fa-user-graduate fa-lg"></i>
          </div>
          <h5 class="font-weight-bold text-dark mb-2">Student Portal</h5>
          <p class="text-muted small mb-0">Browse verified internships, apply with CV attachments, view onsite interview dates & venue address, and submit weekly logs.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-4 text-center card-hover rounded-4 bg-light">
          <div class="bg-gradient-secondary text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-3 shadow-sm" style="width: 58px; height: 58px;">
            <i class="fas fa-building fa-lg"></i>
          </div>
          <h5 class="font-weight-bold text-dark">Company HR Portal</h5>
          <p class="text-muted small mb-0">Post opportunities, shortlist applicant CVs, schedule physical onsite interviews, and register workplace supervisors.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-4 text-center card-hover rounded-4 bg-light">
          <div class="bg-gradient-success text-white rounded-circle mx-auto d-flex align-items-center justify-center mb-3 shadow-sm" style="width: 58px; height: 58px;">
            <i class="fas fa-user-tie fa-lg"></i>
          </div>
          <h5 class="font-weight-bold text-dark">Supervisor Portal</h5>
          <p class="text-muted small mb-0">Assign workplace tasks with deadlines, review intern learning reports, and evaluate performance with 1-5 star ratings.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-4 text-center card-hover rounded-4 bg-light">
          <div class="bg-gradient-warning text-dark rounded-circle mx-auto d-flex align-items-center justify-center mb-3 shadow-sm" style="width: 58px; height: 58px;">
            <i class="fas fa-user-shield fa-lg"></i>
          </div>
          <h5 class="font-weight-bold text-dark">Administrator Portal</h5>
          <p class="text-muted small mb-0">Manage system user accounts, verify company registration certificates, audit internship completions, and export CSV reports.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: CONTACT US -->
<section id="contact" class="py-5 bg-light">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-7">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
          <div class="card-header bg-gradient-primary text-white text-center py-4 border-0">
            <h4 class="mb-1 font-weight-extrabold"><i class="fas fa-paper-plane me-2"></i> Get In Touch With Us</h4>
            <p class="mb-0 text-white-50 small">Have inquiries regarding university partnerships or company registration?</p>
          </div>
          <div class="card-body p-4 p-md-5">
            <form onsubmit="handleContactSubmit(event)">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold text-secondary">Your Name</label>
                  <input type="text" id="c-name" required placeholder="John Doe" class="form-control py-2">
                </div>
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold text-secondary">Email Address / Gmail</label>
                  <input type="email" id="c-email" required placeholder="john@gmail.com" class="form-control py-2">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-semibold text-secondary">Subject</label>
                <input type="text" id="c-subject" required placeholder="Inquiry topic..." class="form-control py-2">
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-semibold text-secondary">Message</label>
                <textarea id="c-message" required rows="4" placeholder="Write your message here..." class="form-control py-2"></textarea>
              </div>

              <button type="submit" class="btn btn-primary-gradient w-100 py-3 font-weight-bold shadow-md rounded-3">
                <i class="fas fa-paper-plane me-2"></i> Submit Inquiry Message
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
  
  if (category === 'all') {
    cards.forEach(c => c.classList.remove('d-none'));
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
