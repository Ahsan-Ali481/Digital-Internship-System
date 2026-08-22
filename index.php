<?php
// index.php - Clean Canvas Landing Page with Header, Body, & Footer
$pageTitle = "Digital Internship System - Enterprise Career Platform";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- SECTION 1: HERO BANNER (CLEAN WHITE CANVAS WITH STYLISH TYPOGRAPHY) -->
<section id="home" class="hero-clean-canvas py-5 position-relative overflow-hidden">
  <div class="container py-5 text-center position-relative" style="z-index: 2;">
    
    <div class="d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill bg-white border border-2 border-slate-300 text-black font-weight-black small mb-4 shadow-sm">
      <span class="spinner-grow spinner-grow-sm text-primary" role="status"></span>
      Enterprise Internship Management Engine
    </div>

    <h1 class="display-3 font-weight-black mb-3 text-black tracking-tight">
      Empowering Students, Supervisors & <span class="text-primary">Industry Partners</span>
    </h1>
    <p class="lead mb-4 max-w-3xl mx-auto text-black fs-4 font-weight-bold">
      Streamlining university internship allocations, physical onsite interview schedules, workplace supervisor task tracking, and performance evaluation records.
    </p>

    <div class="d-flex justify-content-center gap-3 mb-5">
      <a href="signup.php" class="btn btn-black-primary btn-lg shadow-md">
        <i class="fas fa-rocket me-2"></i> Register Account
      </a>
      <a href="#browse-internships" class="btn btn-black-secondary btn-lg shadow-sm">
        <i class="fas fa-search me-2"></i> Explore Roles
      </a>
    </div>

    <!-- Live Statistics Counter Grid -->
    <div class="row g-4 max-w-4xl mx-auto pt-3">
      <div class="col-6 col-md-3">
        <div class="master-card-black p-4 text-center">
          <h3 class="font-weight-black mb-1 text-primary fs-1">500+</h3>
          <p class="text-black font-weight-black mb-0 small">Active Internships</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="master-card-black p-4 text-center">
          <h3 class="font-weight-black mb-1 text-info fs-1">2,000+</h3>
          <p class="text-black font-weight-black mb-0 small">Students Placed</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="master-card-black p-4 text-center">
          <h3 class="font-weight-black mb-1 text-success fs-1">300+</h3>
          <p class="text-black font-weight-black mb-0 small">Partner Companies</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="master-card-black p-4 text-center">
          <h3 class="font-weight-black mb-1 text-warning fs-1">98%</h3>
          <p class="text-black font-weight-black mb-0 small">Success Rate</p>
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
        <h2 class="h2 font-weight-black text-black mb-1">Featured Internship Opportunities</h2>
        <p class="text-black font-weight-bold mb-0 fs-6">High-value software engineering, product design, and AI positions.</p>
      </div>
      <a href="signin.php" class="btn btn-black-secondary font-weight-black mt-2 mt-md-0">
        View All Roles <i class="fas fa-arrow-right ms-1"></i>
      </a>
    </div>

    <!-- Category Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
      <button onclick="filterLandingCategory('all')" class="btn btn-black-primary btn-sm active" id="btn-cat-all">All Positions</button>
      <button onclick="filterLandingCategory('Software Development')" class="btn btn-black-secondary btn-sm" id="btn-cat-software">Software Development</button>
      <button onclick="filterLandingCategory('UI/UX Design')" class="btn btn-black-secondary btn-sm" id="btn-cat-uiux">UI/UX Design</button>
      <button onclick="filterLandingCategory('Data Science')" class="btn btn-black-secondary btn-sm" id="btn-cat-data">Data Science</button>
    </div>

    <!-- Internship Cards Grid -->
    <div class="row g-4" id="landing-internships-grid">
      <!-- Card 1 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Software Development">
        <div class="master-card-black p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-black-pill badge-indigo"><i class="fas fa-code me-1"></i> Software Dev</span>
              <small class="text-black font-weight-black"><i class="far fa-clock me-1 text-primary"></i> Sep 30, 2026</small>
            </div>
            <h4 class="font-weight-black text-black mb-2">Full Stack Web Developer Intern</h4>
            <h6 class="text-primary font-weight-black mb-3"><i class="fas fa-building me-1"></i> TechCorp Solutions</h6>
            <p class="text-black font-weight-bold small mb-4">Develop dynamic PHP & MySQL web applications using Bootstrap 5 and modern REST architecture.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-black fs-6"><i class="fas fa-money-bill-wave me-1"></i> PKR 35,000 / mo</span>
            <a href="signin.php" class="btn btn-black-primary btn-sm">Apply Role</a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="UI/UX Design">
        <div class="master-card-black p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-black-pill badge-emerald"><i class="fas fa-palette me-1"></i> UI/UX Design</span>
              <small class="text-black font-weight-black"><i class="far fa-clock me-1 text-success"></i> Oct 15, 2026</small>
            </div>
            <h4 class="font-weight-black text-black mb-2">UI/UX Product Design Intern</h4>
            <h6 class="text-info font-weight-black mb-3"><i class="fas fa-building me-1"></i> Creative Labs Inc.</h6>
            <p class="text-black font-weight-bold small mb-4">Design responsive user interfaces, wireframes, and interactive user prototypes for enterprise products.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-black fs-6"><i class="fas fa-money-bill-wave me-1"></i> PKR 30,000 / mo</span>
            <a href="signin.php" class="btn btn-black-primary btn-sm">Apply Role</a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Data Science">
        <div class="master-card-black p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-black-pill badge-amber"><i class="fas fa-chart-bar me-1"></i> Data Science</span>
              <small class="text-black font-weight-black"><i class="far fa-clock me-1 text-warning"></i> Nov 05, 2026</small>
            </div>
            <h4 class="font-weight-black text-black mb-2">Data Analyst Intern</h4>
            <h6 class="text-warning font-weight-black mb-3"><i class="fas fa-building me-1"></i> Data Insights Co.</h6>
            <p class="text-black font-weight-bold small mb-4">Process structured business data datasets and generate analytical visual dashboards for decision makers.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-black fs-6"><i class="fas fa-money-bill-wave me-1"></i> PKR 40,000 / mo</span>
            <a href="signin.php" class="btn btn-black-primary btn-sm">Apply Role</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: HOW IT WORKS (4-STEP PROCESS) -->
<section id="how-it-works" class="py-5 bg-white border-top border-bottom">
  <div class="container py-4">
    <div class="text-center max-w-3xl mx-auto mb-5">
      <h2 class="h2 font-weight-black text-black">How It Works</h2>
      <p class="text-black font-weight-bold fs-6">A simple 4-step workflow to launch your professional internship journey.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="master-card-black p-4 text-center h-100">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3 bg-primary text-white font-weight-black fs-4" style="width: 54px; height: 54px;">
            1
          </div>
          <h5 class="font-weight-black text-black mb-2">Create Account</h5>
          <p class="text-black font-weight-bold small mb-0">Register using your Gmail address as a Student or Company Manager.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="master-card-black p-4 text-center h-100">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3 bg-info text-white font-weight-black fs-4" style="width: 54px; height: 54px;">
            2
          </div>
          <h5 class="font-weight-black text-black mb-2">Browse & Apply</h5>
          <p class="text-black font-weight-bold small mb-0">Explore active listings, upload your CV, and submit applications directly.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="master-card-black p-4 text-center h-100">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3 bg-success text-white font-weight-black fs-4" style="width: 54px; height: 54px;">
            3
          </div>
          <h5 class="font-weight-black text-black mb-2">Onsite Interview</h5>
          <p class="text-black font-weight-bold small mb-0">Receive physical onsite interview schedules and venue address details.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="master-card-black p-4 text-center h-100">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3 bg-warning text-dark font-weight-black fs-4" style="width: 54px; height: 54px;">
            4
          </div>
          <h5 class="font-weight-black text-black mb-2">Learn & Get Certified</h5>
          <p class="text-black font-weight-bold small mb-0">Complete supervisor tasks, submit weekly reports, and get verified records.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: USER ROLES & SYSTEM CAPABILITIES -->
<section id="about" class="bg-slate py-5 border-bottom">
  <div class="container py-4">
    <div class="text-center max-w-3xl mx-auto mb-5">
      <h2 class="h2 font-weight-black text-black">System Capabilities & User Modules</h2>
      <p class="text-black font-weight-bold fs-6">A complete web platform built for all 4 key user roles in the internship lifecycle.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="master-card-black p-4 text-center h-100" style="border-top: 4px solid #4f46e5;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px; background-color: #e0e7ff;">
            <i class="fas fa-user-graduate fa-xl text-primary"></i>
          </div>
          <h4 class="font-weight-black text-black mb-2">Student Portal</h4>
          <p class="text-black font-weight-bold small mb-0">Browse verified internships, apply with CV attachments, view onsite interview dates & venue address, and submit weekly logs.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="master-card-black p-4 text-center h-100" style="border-top: 4px solid #0284c7;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px; background-color: #e0f2fe;">
            <i class="fas fa-building fa-xl text-info"></i>
          </div>
          <h4 class="font-weight-black text-black mb-2">Company HR Portal</h4>
          <p class="text-black font-weight-bold small mb-0">Post opportunities, shortlist applicant CVs, schedule physical onsite interviews, and register workplace supervisors.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="master-card-black p-4 text-center h-100" style="border-top: 4px solid #059669;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px; background-color: #d1fae5;">
            <i class="fas fa-user-tie fa-xl text-success"></i>
          </div>
          <h4 class="font-weight-black text-black mb-2">Supervisor Portal</h4>
          <p class="text-black font-weight-bold small mb-0">Assign workplace tasks with deadlines, review intern learning reports, and evaluate performance with 1-5 star ratings.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="master-card-black p-4 text-center h-100" style="border-top: 4px solid #d97706;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px; background-color: #fef3c7;">
            <i class="fas fa-user-shield fa-xl text-warning"></i>
          </div>
          <h4 class="font-weight-black text-black mb-2">Admin Portal</h4>
          <p class="text-black font-weight-bold small mb-0">Manage system user accounts, verify company registration certificates, audit internship completions, and export CSV reports.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: TESTIMONIALS -->
<section id="testimonials" class="py-5 bg-white border-bottom">
  <div class="container py-4">
    <div class="text-center max-w-3xl mx-auto mb-5">
      <h2 class="h2 font-weight-black text-black">Student & Partner Testimonials</h2>
      <p class="text-black font-weight-bold fs-6">See what our students and company partners have to say about the Digital Internship System.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="master-card-black p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="text-warning mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <p class="text-black font-weight-bold small mb-3">"The platform streamlined my internship allocation process. I received my onsite interview schedule within 3 days and got selected at TechCorp!"</p>
          </div>
          <div class="pt-3 border-top d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white font-weight-black d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">AH</div>
            <div>
              <h6 class="fw-black text-black mb-0">Ahmed Hassan</h6>
              <small class="text-black font-weight-bold extra-small">Software Engineer Intern, NUST</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="master-card-black p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="text-warning mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <p class="text-black font-weight-bold small mb-3">"Managing applicant CVs and assigning onsite physical interview schedules to candidates has never been this smooth."</p>
          </div>
          <div class="pt-3 border-top d-flex align-items-center gap-3">
            <div class="rounded-circle bg-info text-white font-weight-black d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">SJ</div>
            <div>
              <h6 class="fw-black text-black mb-0">Sarah Jenkins</h6>
              <small class="text-black font-weight-bold extra-small">HR Manager, TechCorp Solutions</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="master-card-black p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="text-warning mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <p class="text-black font-weight-bold small mb-3">"Issuing workplace tasks and rating weekly intern reports is clean, fast, and structured. Highly recommended!"</p>
          </div>
          <div class="pt-3 border-top d-flex align-items-center gap-3">
            <div class="rounded-circle bg-success text-white font-weight-black d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">WS</div>
            <div>
              <h6 class="fw-black text-black mb-0">Workplace Supervisor</h6>
              <small class="text-black font-weight-bold extra-small">Lead AI Engineer, TechCorp</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 6: FAQ ACCORDION -->
<section id="faq" class="py-5 bg-slate border-bottom">
  <div class="container py-4">
    <div class="text-center max-w-3xl mx-auto mb-5">
      <h2 class="h2 font-weight-black text-black">Frequently Asked Questions</h2>
      <p class="text-black font-weight-bold fs-6">Find quick answers to common questions about accounts, applications, and evaluations.</p>
    </div>

    <div class="max-w-3xl mx-auto">
      <div class="accordion" id="faqAccordion">
        <div class="accordion-item master-card-black mb-3 border-0">
          <h2 class="accordion-header">
            <button class="accordion-button font-weight-black text-black bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
              How do students register for internships?
            </button>
          </h2>
          <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
            <div class="accordion-body text-black font-weight-bold small">
              Students can register dynamically via the <a href="signup.php" class="text-primary font-weight-black">Registration Page</a> using their Gmail address and custom password. Once registered, you can browse listings and apply with your CV.
            </div>
          </div>
        </div>

        <div class="accordion-item master-card-black mb-3 border-0">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed font-weight-black text-black bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
              How are onsite interviews scheduled?
            </button>
          </h2>
          <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body text-black font-weight-bold small">
              Company HR managers shortlist applicant CVs and set the physical onsite interview date, time, and office venue address directly from the Company HR Portal.
            </div>
          </div>
        </div>

        <div class="accordion-item master-card-black mb-3 border-0">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed font-weight-black text-black bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
              What is the password reset policy for Admin accounts?
            </button>
          </h2>
          <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body text-black font-weight-bold small">
              For security compliance, online password reset is strictly disabled for Administrator accounts. Password resets for Students, HRs, and Supervisors remain available online.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 7: CONTACT US -->
<section id="contact" class="py-5 bg-white">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-7">
        <div class="master-card-black p-0 overflow-hidden">
          <div class="bg-primary text-white text-center py-4 px-3">
            <h3 class="mb-1 font-weight-black text-white"><i class="fas fa-paper-plane me-2"></i> Get In Touch With Us</h3>
            <p class="mb-0 text-white font-weight-bold small">Have inquiries regarding university partnerships or company onboarding?</p>
          </div>
          <div class="p-4 p-md-5">
            <form onsubmit="handleContactSubmit(event)">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label font-weight-black text-black">Your Name</label>
                  <input type="text" id="c-name" required placeholder="John Doe" class="form-control py-2">
                </div>
                <div class="col-md-6">
                  <label class="form-label font-weight-black text-black">Email Address / Gmail</label>
                  <input type="email" id="c-email" required placeholder="john@gmail.com" class="form-control py-2">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-black text-black">Subject</label>
                <input type="text" id="c-subject" required placeholder="Inquiry topic..." class="form-control py-2">
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-black text-black">Message</label>
                <textarea id="c-message" required rows="4" placeholder="Write your message here..." class="form-control py-2"></textarea>
              </div>

              <button type="submit" class="btn btn-black-primary w-100 py-3 font-weight-black">
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
