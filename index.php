<?php
// index.php - Corporate SaaS Landing Page
$pageTitle = "Digital Internship System - Enterprise Career Platform";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- SECTION 1: HERO BANNER -->
<section id="home" class="py-5 bg-white border-bottom">
  <div class="container py-5 text-center">
    
    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-light border text-primary font-weight-bold small mb-4">
      <span class="badge bg-primary rounded-pill">Platform</span>
      Enterprise Internship Allocation & Management Engine
    </div>

    <h1 class="display-4 font-weight-bold mb-3 text-dark">
      Streamlining University & <span class="text-primary">Industry Partnerships</span>
    </h1>
    <p class="lead mb-4 max-w-3xl mx-auto text-muted fs-5 fw-normal">
      A centralized web platform for managing student internship allocations, physical onsite interview schedules, workplace supervisor tasks, and institutional evaluations.
    </p>

    <div class="d-flex justify-content-center gap-3 mb-5">
      <a href="signup.php" class="btn btn-corp-primary btn-lg shadow-sm">
        <i class="fas fa-rocket me-2"></i> Register Account
      </a>
      <a href="#browse-internships" class="btn btn-corp-secondary btn-lg">
        <i class="fas fa-search me-2"></i> Explore Roles
      </a>
    </div>

    <!-- Metrics Bar -->
    <div class="row g-4 max-w-4xl mx-auto pt-3">
      <div class="col-6 col-md-3">
        <div class="corp-card p-4 text-center">
          <h3 class="font-weight-bold mb-1 text-primary fs-2">2,500+</h3>
          <small class="text-muted font-weight-semibold">Students Placed</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="corp-card p-4 text-center">
          <h3 class="font-weight-bold mb-1 text-info fs-2">350+</h3>
          <small class="text-muted font-weight-semibold">Verified Companies</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="corp-card p-4 text-center">
          <h3 class="font-weight-bold mb-1 text-success fs-2">98.5%</h3>
          <small class="text-muted font-weight-semibold">Completion Rate</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="corp-card p-4 text-center">
          <h3 class="font-weight-bold mb-1 text-warning fs-2">100%</h3>
          <small class="text-muted font-weight-semibold">Verified Records</small>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- SECTION 2: BROWSE INTERNSHIPS -->
<section id="browse-internships" class="py-5 bg-light">
  <div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
      <div>
        <h2 class="h2 font-weight-bold text-dark mb-1">Featured Internship Opportunities</h2>
        <p class="text-muted mb-0">High-value software engineering, product design, and technology positions.</p>
      </div>
      <a href="signin.php" class="btn btn-corp-secondary font-weight-semibold mt-2 mt-md-0">
        View All Roles <i class="fas fa-arrow-right ms-1"></i>
      </a>
    </div>

    <!-- Category Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
      <button onclick="filterLandingCategory('all')" class="btn btn-corp-primary btn-sm active" id="btn-cat-all">All Positions</button>
      <button onclick="filterLandingCategory('Software Development')" class="btn btn-corp-secondary btn-sm" id="btn-cat-software">Software Development</button>
      <button onclick="filterLandingCategory('UI/UX Design')" class="btn btn-corp-secondary btn-sm" id="btn-cat-uiux">UI/UX Design</button>
      <button onclick="filterLandingCategory('Data Science')" class="btn btn-corp-secondary btn-sm" id="btn-cat-data">Data Science</button>
    </div>

    <!-- Internship Cards Grid -->
    <div class="row g-4" id="landing-internships-grid">
      <!-- Card 1 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Software Development">
        <div class="corp-card p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-corp badge-corp-primary"><i class="fas fa-code me-1"></i> Software Development</span>
              <small class="text-muted"><i class="far fa-clock me-1 text-primary"></i> Sep 30, 2026</small>
            </div>
            <h4 class="font-weight-bold text-dark mb-2">Full Stack Web Developer Intern</h4>
            <h6 class="text-primary font-weight-semibold mb-3"><i class="fas fa-building me-1"></i> TechCorp Solutions</h6>
            <p class="text-muted small mb-4">Develop dynamic PHP & MySQL web applications using Bootstrap 5 and modern REST architecture.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-bold small"><i class="fas fa-money-bill-wave me-1"></i> PKR 35,000 / mo</span>
            <a href="signin.php" class="btn btn-corp-primary btn-sm">Apply Role</a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="UI/UX Design">
        <div class="corp-card p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-corp badge-corp-success"><i class="fas fa-palette me-1"></i> UI/UX Design</span>
              <small class="text-muted"><i class="far fa-clock me-1 text-success"></i> Oct 15, 2026</small>
            </div>
            <h4 class="font-weight-bold text-dark mb-2">UI/UX Product Design Intern</h4>
            <h6 class="text-info font-weight-semibold mb-3"><i class="fas fa-building me-1"></i> Creative Labs Inc.</h6>
            <p class="text-muted small mb-4">Design responsive user interfaces, wireframes, and interactive user prototypes for enterprise products.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-bold small"><i class="fas fa-money-bill-wave me-1"></i> PKR 30,000 / mo</span>
            <a href="signin.php" class="btn btn-corp-primary btn-sm">Apply Role</a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Data Science">
        <div class="corp-card p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-corp badge-corp-warning"><i class="fas fa-chart-bar me-1"></i> Data Science</span>
              <small class="text-muted"><i class="far fa-clock me-1 text-warning"></i> Nov 05, 2026</small>
            </div>
            <h4 class="font-weight-bold text-dark mb-2">Data Analyst Intern</h4>
            <h6 class="text-warning font-weight-semibold mb-3"><i class="fas fa-building me-1"></i> Data Insights Co.</h6>
            <p class="text-muted small mb-4">Process structured business data datasets and generate analytical visual dashboards for decision makers.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-bold small"><i class="fas fa-money-bill-wave me-1"></i> PKR 40,000 / mo</span>
            <a href="signin.php" class="btn btn-corp-primary btn-sm">Apply Role</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: ABOUT US (USER ROLES & SYSTEM MODULES) -->
<section id="about" class="bg-white py-5 border-top border-bottom">
  <div class="container py-4">
    <div class="text-center max-w-3xl mx-auto mb-5">
      <h2 class="h2 font-weight-bold text-dark">System Capabilities & User Modules</h2>
      <p class="text-muted">A structured platform tailored for all 4 key user roles in the internship lifecycle.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="corp-card p-4 text-center h-100" style="border-top: 4px solid #4f46e5;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 54px; height: 54px; background-color: #eef2ff;">
            <i class="fas fa-user-graduate fa-lg text-primary"></i>
          </div>
          <h5 class="font-weight-bold text-dark mb-2">Student Portal</h5>
          <p class="text-muted small mb-0">Browse verified internships, apply with CV attachments, view onsite interview dates & venue address, and submit weekly logs.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="corp-card p-4 text-center h-100" style="border-top: 4px solid #0284c7;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 54px; height: 54px; background-color: #f0f9ff;">
            <i class="fas fa-building fa-lg text-info"></i>
          </div>
          <h5 class="font-weight-bold text-dark mb-2">Company HR Portal</h5>
          <p class="text-muted small mb-0">Post opportunities, shortlist applicant CVs, schedule physical onsite interviews, and register workplace supervisors.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="corp-card p-4 text-center h-100" style="border-top: 4px solid #059669;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 54px; height: 54px; background-color: #ecfdf5;">
            <i class="fas fa-user-tie fa-lg text-success"></i>
          </div>
          <h5 class="font-weight-bold text-dark mb-2">Supervisor Portal</h5>
          <p class="text-muted small mb-0">Assign workplace tasks with deadlines, review intern learning reports, and evaluate performance with 1-5 star ratings.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="corp-card p-4 text-center h-100" style="border-top: 4px solid #d97706;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 54px; height: 54px; background-color: #fffbeb;">
            <i class="fas fa-user-shield fa-lg text-warning"></i>
          </div>
          <h5 class="font-weight-bold text-dark mb-2">Admin Portal</h5>
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
        <div class="corp-card p-0 overflow-hidden">
          <div class="bg-primary text-white text-center py-4 px-3">
            <h3 class="mb-1 font-weight-bold text-white"><i class="fas fa-paper-plane me-2"></i> Get In Touch With Us</h3>
            <p class="mb-0 text-white-50 small">Have inquiries regarding university partnerships or company onboarding?</p>
          </div>
          <div class="p-4 p-md-5">
            <form onsubmit="handleContactSubmit(event)">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold text-dark">Your Name</label>
                  <input type="text" id="c-name" required placeholder="John Doe" class="form-control py-2">
                </div>
                <div class="col-md-6">
                  <label class="form-label font-weight-semibold text-dark">Email Address / Gmail</label>
                  <input type="email" id="c-email" required placeholder="john@gmail.com" class="form-control py-2">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-semibold text-dark">Subject</label>
                <input type="text" id="c-subject" required placeholder="Inquiry topic..." class="form-control py-2">
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-semibold text-dark">Message</label>
                <textarea id="c-message" required rows="4" placeholder="Write your message here..." class="form-control py-2"></textarea>
              </div>

              <button type="submit" class="btn btn-corp-primary w-100 py-3 font-weight-bold">
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
