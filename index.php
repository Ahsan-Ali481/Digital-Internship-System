<?php
// index.php - Ultra Modern Intermediate Landing Page
$pageTitle = "Digital Internship System - Career & Internship Platform";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- SECTION 1: HOME (HERO BANNER WITH ANIMATED GRADIENT) -->
<section id="home" class="animated-gradient text-white py-5 position-relative overflow-hidden shadow-lg">
  <div class="container py-5 text-center position-relative" style="z-index: 2;">
    
    <div class="d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill bg-white bg-opacity-20 text-white font-weight-bold small mb-4 border border-white border-opacity-30 shadow-sm">
      <span class="spinner-grow spinner-grow-sm text-warning" role="status"></span>
      Next-Generation Internship Allocation Engine
    </div>

    <h1 class="display-3 font-weight-extrabold mb-3 text-white tracking-tight">
      Empowering Students & Industry Partners
    </h1>
    <p class="lead mb-4 max-w-3xl mx-auto text-white opacity-90 fs-4 fw-medium">
      Streamlining university internship allocations, physical onsite interview schedules, weekly supervisor logs, and institutional performance evaluations.
    </p>

    <div class="d-flex justify-content-center gap-3 mb-5">
      <a href="signup.php" class="btn btn-modern-primary btn-lg shadow-lg">
        <i class="fas fa-rocket me-2"></i> Register Account
      </a>
      <a href="#browse-internships" class="btn btn-modern-secondary btn-lg shadow-sm">
        <i class="fas fa-search me-2"></i> Explore Positions
      </a>
    </div>

    <!-- High-Contrast Floating Stats Cards -->
    <div class="row g-3 max-w-4xl mx-auto pt-3">
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-4 bg-white text-dark shadow-sm modern-card border-0">
          <h3 class="font-weight-extrabold mb-0 text-primary fs-2">2,500+</h3>
          <small class="text-muted-contrast font-weight-bold">Students Placed</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-4 bg-white text-dark shadow-sm modern-card border-0">
          <h3 class="font-weight-extrabold mb-0 text-info fs-2">350+</h3>
          <small class="text-muted-contrast font-weight-bold">Verified Companies</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-4 bg-white text-dark shadow-sm modern-card border-0">
          <h3 class="font-weight-extrabold mb-0 text-success fs-2">98.5%</h3>
          <small class="text-muted-contrast font-weight-bold">Completion Rate</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-4 bg-white text-dark shadow-sm modern-card border-0">
          <h3 class="font-weight-extrabold mb-0 text-warning fs-2">100%</h3>
          <small class="text-muted-contrast font-weight-bold">Verified Records</small>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- SECTION 2: BROWSE INTERNSHIPS -->
<section id="browse-internships" class="py-5 bg-slate">
  <div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
      <div>
        <h2 class="h2 font-weight-extrabold text-dark-contrast mb-1">Featured Internship Opportunities</h2>
        <p class="text-muted-contrast mb-0 fs-6">High-value software development, product design, and AI positions.</p>
      </div>
      <a href="signin.php" class="btn btn-modern-secondary font-weight-bold mt-2 mt-md-0">
        View All Roles <i class="fas fa-arrow-right ms-1"></i>
      </a>
    </div>

    <!-- Category Filter Buttons -->
    <div class="d-flex flex-wrap gap-2 mb-4">
      <button onclick="filterLandingCategory('all')" class="btn btn-modern-primary btn-sm active" id="btn-cat-all">All Roles</button>
      <button onclick="filterLandingCategory('Software Development')" class="btn btn-modern-secondary btn-sm" id="btn-cat-software">Software Development</button>
      <button onclick="filterLandingCategory('UI/UX Design')" class="btn btn-modern-secondary btn-sm" id="btn-cat-uiux">UI/UX Design</button>
      <button onclick="filterLandingCategory('Data Science')" class="btn btn-modern-secondary btn-sm" id="btn-cat-data">Data Science</button>
    </div>

    <!-- Internship Cards Grid -->
    <div class="row g-4" id="landing-internships-grid">
      <!-- Card 1 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Software Development">
        <div class="modern-card p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-modern badge-indigo"><i class="fas fa-code me-1"></i> Software Dev</span>
              <small class="text-muted-contrast font-weight-bold"><i class="far fa-clock me-1 text-primary"></i> Sep 30, 2026</small>
            </div>
            <h4 class="font-weight-extrabold text-dark-contrast mb-2">Full Stack Web Developer Intern</h4>
            <h6 class="text-primary font-weight-bold mb-3"><i class="fas fa-building me-1"></i> TechCorp Solutions</h6>
            <p class="text-muted-contrast small mb-4">Develop dynamic PHP & MySQL web applications using Bootstrap 5 and modern REST architecture.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-extrabold fs-6"><i class="fas fa-money-bill-wave me-1"></i> PKR 35,000 / mo</span>
            <a href="signin.php" class="btn btn-modern-primary btn-sm">Apply Role</a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="UI/UX Design">
        <div class="modern-card p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-modern badge-emerald"><i class="fas fa-palette me-1"></i> UI/UX Design</span>
              <small class="text-muted-contrast font-weight-bold"><i class="far fa-clock me-1 text-success"></i> Oct 15, 2026</small>
            </div>
            <h4 class="font-weight-extrabold text-dark-contrast mb-2">UI/UX Product Design Intern</h4>
            <h6 class="text-info font-weight-bold mb-3"><i class="fas fa-building me-1"></i> Creative Labs Inc.</h6>
            <p class="text-muted-contrast small mb-4">Design responsive user interfaces, wireframes, and interactive user prototypes for enterprise products.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-extrabold fs-6"><i class="fas fa-money-bill-wave me-1"></i> PKR 30,000 / mo</span>
            <a href="signin.php" class="btn btn-modern-primary btn-sm">Apply Role</a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Data Science">
        <div class="modern-card p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-modern badge-amber"><i class="fas fa-chart-bar me-1"></i> Data Science</span>
              <small class="text-muted-contrast font-weight-bold"><i class="far fa-clock me-1 text-warning"></i> Nov 05, 2026</small>
            </div>
            <h4 class="font-weight-extrabold text-dark-contrast mb-2">Data Analyst Intern</h4>
            <h6 class="text-warning font-weight-bold mb-3"><i class="fas fa-building me-1"></i> Data Insights Co.</h6>
            <p class="text-muted-contrast small mb-4">Process structured business data datasets and generate analytical visual dashboards for decision makers.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-extrabold fs-6"><i class="fas fa-money-bill-wave me-1"></i> PKR 40,000 / mo</span>
            <a href="signin.php" class="btn btn-modern-primary btn-sm">Apply Role</a>
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
      <h2 class="h2 font-weight-extrabold text-dark-contrast">System Capabilities & Modules</h2>
      <p class="text-muted-contrast fs-6">A complete web platform built for all 4 key user roles in the internship lifecycle.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="modern-card p-4 text-center h-100" style="border-top: 4px solid #4f46e5;">
          <div class="bg-indigo-100 text-indigo-700 rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px; background-color: #e0e7ff;">
            <i class="fas fa-user-graduate fa-xl text-primary"></i>
          </div>
          <h4 class="font-weight-extrabold text-dark-contrast mb-2">Student Portal</h4>
          <p class="text-muted-contrast small mb-0">Browse verified internships, apply with CV attachments, view onsite interview dates & venue address, and submit weekly logs.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="modern-card p-4 text-center h-100" style="border-top: 4px solid #0284c7;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px; background-color: #e0f2fe;">
            <i class="fas fa-building fa-xl text-info"></i>
          </div>
          <h4 class="font-weight-extrabold text-dark-contrast mb-2">Company HR Portal</h4>
          <p class="text-muted-contrast small mb-0">Post opportunities, shortlist applicant CVs, schedule physical onsite interviews, and register workplace supervisors.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="modern-card p-4 text-center h-100" style="border-top: 4px solid #059669;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px; background-color: #d1fae5;">
            <i class="fas fa-user-tie fa-xl text-success"></i>
          </div>
          <h4 class="font-weight-extrabold text-dark-contrast mb-2">Supervisor Portal</h4>
          <p class="text-muted-contrast small mb-0">Assign workplace tasks with deadlines, review intern learning reports, and evaluate performance with 1-5 star ratings.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="modern-card p-4 text-center h-100" style="border-top: 4px solid #d97706;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px; background-color: #fef3c7;">
            <i class="fas fa-user-shield fa-xl text-warning"></i>
          </div>
          <h4 class="font-weight-extrabold text-dark-contrast mb-2">Admin Portal</h4>
          <p class="text-muted-contrast small mb-0">Manage system user accounts, verify company registration certificates, audit internship completions, and export CSV reports.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: CONTACT US -->
<section id="contact" class="py-5 bg-slate">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-7">
        <div class="modern-card p-0 overflow-hidden">
          <div class="animated-gradient text-white text-center py-4 px-3">
            <h3 class="mb-1 font-weight-extrabold"><i class="fas fa-paper-plane me-2"></i> Get In Touch With Us</h3>
            <p class="mb-0 text-white opacity-90 small">Have inquiries regarding university partnerships or company onboarding?</p>
          </div>
          <div class="p-4 p-md-5">
            <form onsubmit="handleContactSubmit(event)">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label font-weight-bold text-dark-contrast">Your Name</label>
                  <input type="text" id="c-name" required placeholder="John Doe" class="form-control py-2">
                </div>
                <div class="col-md-6">
                  <label class="form-label font-weight-bold text-dark-contrast">Email Address / Gmail</label>
                  <input type="email" id="c-email" required placeholder="john@gmail.com" class="form-control py-2">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-bold text-dark-contrast">Subject</label>
                <input type="text" id="c-subject" required placeholder="Inquiry topic..." class="form-control py-2">
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-bold text-dark-contrast">Message</label>
                <textarea id="c-message" required rows="4" placeholder="Write your message here..." class="form-control py-2"></textarea>
              </div>

              <button type="submit" class="btn btn-modern-primary w-100 py-3 font-weight-bold">
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
