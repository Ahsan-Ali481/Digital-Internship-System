<?php
// index.php - Ultra Premium Landing Page with Emojis & Bootstrap 5
$pageTitle = "Digital Internship System - Enterprise Career Platform";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- SECTION 1: HOME (HERO BANNER WITH EMOJIS & HIGH CONTRAST) -->
<section id="home" class="py-5 bg-white position-relative overflow-hidden border-bottom">
  <div class="container py-5 text-center position-relative" style="z-index: 2;">
    
    <div class="d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill bg-indigo-50 text-indigo-700 font-weight-extrabold small mb-4 border border-indigo-200 shadow-sm">
      <span class="emoji-icon">⚡</span> Next-Gen University & Industry Internship Allocation Engine
    </div>

    <h1 class="display-3 font-weight-extrabold mb-3 text-dark tracking-tight">
      Empowering Students 🎓, Supervisors 👨‍🏫 & <span class="gradient-text-mask">Companies 🏢</span>
    </h1>
    <p class="lead mb-4 max-w-3xl mx-auto text-dark opacity-90 fs-4 fw-semibold">
      Streamlining university internship allocations, physical onsite interview schedules 📍, workplace task tracking 📋, and performance evaluation reports 🏆.
    </p>

    <div class="d-flex justify-content-center gap-3 mb-5">
      <a href="signup.php" class="btn btn-premium-primary shadow-lg">
        <span class="emoji-icon me-2">🚀</span> Register Account
      </a>
      <a href="#browse-internships" class="btn btn-premium-secondary shadow-sm">
        <span class="emoji-icon me-2">🔍</span> Explore Positions
      </a>
    </div>

    <!-- Floating Bootstrap 5 Stats Grid -->
    <div class="row g-4 max-w-4xl mx-auto pt-3">
      <div class="col-6 col-md-3">
        <div class="card-premium p-4 text-center">
          <span class="fs-1 mb-2 d-block">🎓</span>
          <h3 class="font-weight-extrabold mb-1 text-primary fs-2">2,500+</h3>
          <p class="text-dark font-weight-extrabold mb-0 small">Students Placed</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card-premium p-4 text-center">
          <span class="fs-1 mb-2 d-block">🏢</span>
          <h3 class="font-weight-extrabold mb-1 text-info fs-2">350+</h3>
          <p class="text-dark font-weight-extrabold mb-0 small">Verified Companies</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card-premium p-4 text-center">
          <span class="fs-1 mb-2 d-block">🏆</span>
          <h3 class="font-weight-extrabold mb-1 text-success fs-2">98.5%</h3>
          <p class="text-dark font-weight-extrabold mb-0 small">Completion Rate</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card-premium p-4 text-center">
          <span class="fs-1 mb-2 d-block">📜</span>
          <h3 class="font-weight-extrabold mb-1 text-warning fs-2">100%</h3>
          <p class="text-dark font-weight-extrabold mb-0 small">Verified Records</p>
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
        <h2 class="h2 font-weight-extrabold text-dark mb-1">
          <span class="emoji-icon me-2">💼</span> Featured Internship Opportunities
        </h2>
        <p class="text-dark fw-semibold mb-0 fs-6">High-value software engineering, product design, and AI positions.</p>
      </div>
      <a href="signin.php" class="btn btn-premium-secondary font-weight-bold mt-2 mt-md-0">
        View All Roles 🚀 <i class="fas fa-arrow-right ms-1"></i>
      </a>
    </div>

    <!-- Category Filter Buttons -->
    <div class="d-flex flex-wrap gap-2 mb-4">
      <button onclick="filterLandingCategory('all')" class="btn btn-premium-primary btn-sm active" id="btn-cat-all">✨ All Positions</button>
      <button onclick="filterLandingCategory('Software Development')" class="btn btn-premium-secondary btn-sm" id="btn-cat-software">💻 Software Dev</button>
      <button onclick="filterLandingCategory('UI/UX Design')" class="btn btn-premium-secondary btn-sm" id="btn-cat-uiux">🎨 UI/UX Design</button>
      <button onclick="filterLandingCategory('Data Science')" class="btn btn-premium-secondary btn-sm" id="btn-cat-data">📊 Data Science</button>
    </div>

    <!-- Internship Cards Grid -->
    <div class="row g-4" id="landing-internships-grid">
      <!-- Card 1 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Software Development">
        <div class="card-premium p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-pill-custom badge-indigo"><span class="emoji-icon">💻</span> Software Dev</span>
              <small class="text-dark font-weight-extrabold">📅 Sep 30, 2026</small>
            </div>
            <h4 class="font-weight-extrabold text-dark mb-2">Full Stack Web Developer Intern</h4>
            <h6 class="text-primary font-weight-extrabold mb-3">🏢 TechCorp Solutions</h6>
            <p class="text-dark font-weight-medium small mb-4">Develop dynamic PHP & MySQL web applications using Bootstrap 5 and modern REST architecture.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-extrabold fs-6">💵 PKR 35,000 / mo</span>
            <a href="signin.php" class="btn btn-premium-primary btn-sm">Apply 🚀</a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="UI/UX Design">
        <div class="card-premium p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-pill-custom badge-emerald"><span class="emoji-icon">🎨</span> UI/UX Design</span>
              <small class="text-dark font-weight-extrabold">📅 Oct 15, 2026</small>
            </div>
            <h4 class="font-weight-extrabold text-dark mb-2">UI/UX Product Design Intern</h4>
            <h6 class="text-info font-weight-extrabold mb-3">🏢 Creative Labs Inc.</h6>
            <p class="text-dark font-weight-medium small mb-4">Design responsive user interfaces, wireframes, and interactive user prototypes for enterprise products.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-extrabold fs-6">💵 PKR 30,000 / mo</span>
            <a href="signin.php" class="btn btn-premium-primary btn-sm">Apply 🚀</a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-6 col-lg-4 internship-card-item" data-cat="Data Science">
        <div class="card-premium p-4 h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge badge-pill-custom badge-amber"><span class="emoji-icon">📊</span> Data Science</span>
              <small class="text-dark font-weight-extrabold">📅 Nov 05, 2026</small>
            </div>
            <h4 class="font-weight-extrabold text-dark mb-2">Data Analyst Intern</h4>
            <h6 class="text-warning font-weight-extrabold mb-3">🏢 Data Insights Co.</h6>
            <p class="text-dark font-weight-medium small mb-4">Process structured business data datasets and generate analytical visual dashboards for decision makers.</p>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-success font-weight-extrabold fs-6">💵 PKR 40,000 / mo</span>
            <a href="signin.php" class="btn btn-premium-primary btn-sm">Apply 🚀</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: ABOUT US (ROLES & CAPABILITIES WITH EMOJIS) -->
<section id="about" class="bg-white py-5 border-top border-bottom">
  <div class="container py-4">
    <div class="text-center max-w-3xl mx-auto mb-5">
      <h2 class="h2 font-weight-extrabold text-dark">
        <span class="emoji-icon me-2">⚡</span> System Capabilities & User Modules
      </h2>
      <p class="text-dark font-weight-semibold fs-6">A complete web platform built for all 4 key user roles in the internship lifecycle.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card-premium p-4 text-center h-100" style="border-top: 4px solid #4f46e5;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 64px; height: 64px; background-color: #e0e7ff;">
            <span class="fs-2">🎓</span>
          </div>
          <h4 class="font-weight-extrabold text-dark mb-2">Student Portal</h4>
          <p class="text-dark font-weight-medium small mb-0">Browse verified internships, apply with CV attachments 📄, view onsite interview dates & venue address 📍, and submit weekly logs 📝.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card-premium p-4 text-center h-100" style="border-top: 4px solid #0284c7;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 64px; height: 64px; background-color: #e0f2fe;">
            <span class="fs-2">🏢</span>
          </div>
          <h4 class="font-weight-extrabold text-dark mb-2">Company HR Portal</h4>
          <p class="text-dark font-weight-medium small mb-0">Post opportunities 📢, shortlist applicant CVs 📄, schedule physical onsite interviews 🗓️, and register workplace supervisors 👨‍🏫.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card-premium p-4 text-center h-100" style="border-top: 4px solid #059669;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 64px; height: 64px; background-color: #d1fae5;">
            <span class="fs-2">👨‍🏫</span>
          </div>
          <h4 class="font-weight-extrabold text-dark mb-2">Supervisor Portal</h4>
          <p class="text-dark font-weight-medium small mb-0">Assign workplace tasks with deadlines 📌, review intern learning reports 📋, and evaluate performance with 1-5 star ratings ⭐.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card-premium p-4 text-center h-100" style="border-top: 4px solid #d97706;">
          <div class="rounded-circle mx-auto d-flex align-items-center justify-center mb-3" style="width: 64px; height: 64px; background-color: #fef3c7;">
            <span class="fs-2">🛡️</span>
          </div>
          <h4 class="font-weight-extrabold text-dark mb-2">Admin Portal</h4>
          <p class="text-dark font-weight-medium small mb-0">Manage system user accounts 👥, verify company registration certificates 📜, audit internship completions 📊, and export CSV reports 📥.</p>
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
        <div class="card-premium p-0 overflow-hidden">
          <div class="bg-gradient-primary text-white text-center py-4 px-3">
            <h3 class="mb-1 font-weight-extrabold text-white"><span class="emoji-icon me-2">✉️</span> Get In Touch With Us</h3>
            <p class="mb-0 text-white opacity-90 small font-weight-semibold">Have inquiries regarding university partnerships or company onboarding?</p>
          </div>
          <div class="p-4 p-md-5">
            <form onsubmit="handleContactSubmit(event)">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label font-weight-bold text-dark">👤 Your Name</label>
                  <input type="text" id="c-name" required placeholder="John Doe" class="form-control py-2">
                </div>
                <div class="col-md-6">
                  <label class="form-label font-weight-bold text-dark">✉️ Email Address / Gmail</label>
                  <input type="email" id="c-email" required placeholder="john@gmail.com" class="form-control py-2">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-bold text-dark">📌 Subject</label>
                <input type="text" id="c-subject" required placeholder="Inquiry topic..." class="form-control py-2">
              </div>

              <div class="mb-3">
                <label class="form-label font-weight-bold text-dark">📝 Message</label>
                <textarea id="c-message" required rows="4" placeholder="Write your message here..." class="form-control py-2"></textarea>
              </div>

              <button type="submit" class="btn btn-premium-primary w-100 py-3 font-weight-bold">
                <span class="emoji-icon me-2">🚀</span> Submit Inquiry Message
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
  DIS.showToast('Thank you! Your message has been sent successfully. 🚀', 'success');
  e.target.reset();
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
