<?php
/*
  filename: index.php
  author: Nguyen Tri Dung (page content)
          Minh Nguyen (conversion to PHP)
  description: Home page.
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="LearnBridge is hiring web developers and designers to build accessible, inclusive online learning platforms.">
  <title>Careers at LearnBridge | Home</title>
  <link rel="stylesheet" href="styles/styles.css">

  <style>
    .home .slogan {
      font-size: 1.3rem;
      font-style: italic;
      color: #ffdd57;
    }
  </style>
</head>
<body class="home">
  <!-- Common header and menu -->
<?php include "header.inc"; ?>

  <main id="main">
    <section class="hero">
      <div class="hero-text">
        <span class="eyebrow">We are hiring</span>
        <h1>LearnBridge</h1>
        <p class="slogan">Learning without barriers</p>
        <p>LearnBridge is an educational technology company creating accessible and inclusive digital learning tools. We are growing our team and looking for web developers and designers who care about great education.</p>
        <p><a class="btn btn-light" href="jobs.php">View open positions</a></p>
      </div>
      <img class="hero-img" src="hero.svg" alt="Illustration of a laptop showing an online lesson with
       a book and a bridge symbol" width="480" height="320">
    </section>

    <section>
      <form class="search-box" action="search.php" method="get" role="search">
        <label for="search">Search for a job</label>
        <div class="search-row">
          <input type="search" id="search" name="q" placeholder="e.g. front-end developer">
          <button type="submit">Search</button>
        </div>
      </form>
    </section>

    <section aria-label="LearnBridge in numbers">
      <ul class="stats-list">
        <li><strong>50,000+</strong> active learners</li>
        <li><strong>120</strong> partner schools</li>
        <li><strong>3</strong> open roles</li>
        <li><strong>WCAG 2.2</strong> AA standard</li>
      </ul>
    </section>

    <section>
      <h2>Why work with us?</h2>
      <p class="section-intro">We believe good technology removes barriers to learning.
         Here is what you can expect when you join our team.</p>
      <ul class="card-grid">
        <li class="card">
          <h3>Meaningful work</h3>
          <p>Your code and designs help thousands of students learn online every day.</p>
        </li>
        <li class="card">
          <h3>Accessibility first</h3>
          <p>We build to WCAG standards from day one, so every learner can take part.</p>
        </li>
        <li class="card">
          <h3>Flexible working</h3>
          <p>Hybrid arrangements and flexible hours that fit your life.</p>
        </li>
        <li class="card">
          <h3>Room to grow</h3>
          <p>A training budget and mentoring for every team member.</p>
        </li>
      </ul>
    </section>

    <section>
      <h2>Current vacancies</h2>
      <p class="section-intro">Find the role that suits your skills, then apply online in a few minutes.</p>
      <ul class="card-grid">
        <li class="card">
          <h3>Front-End Web Developer</h3>
          <p class="meta">Melbourne (hybrid) &middot; Full-time</p>
          <p>Build responsive, accessible interfaces with semantic HTML and modern CSS.</p>
          <p><a class="btn" href="jobs.php#FED26">Read more</a></p>
        </li>
        <li class="card">
          <h3>UX/UI Designer</h3>
          <p class="meta">Melbourne (hybrid) &middot; Full-time</p>
          <p>Design inclusive learning experiences for students of all abilities.</p>
          <p><a class="btn" href="jobs.php#UXD26">Read more</a></p>
        </li>
        <li class="card">
          <h3>Digital Content Designer</h3>
          <p class="meta">Remote (Australia) &middot; Part-time</p>
          <p>Audit our platform with assistive technology and recommend fixes.</p>
          <p><a class="btn" href="jobs.php#DCD26">Read more</a></p>
        </li>
      </ul>
    </section>

    <section>
      <h2>Our hiring process</h2>
      <p class="section-intro" style="font-weight: bold;">From application to offer in about four weeks.</p>
      <table class="timeline">
        <caption>Recruitment stages at LearnBridge</caption>
        <thead>
          <tr>
            <th scope="col" rowspan="2">Stage</th>
            <th scope="colgroup" colspan="2">Details</th>
          </tr>
          <tr>
            <th scope="col">What happens</th>
            <th scope="col">Duration</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1. Apply</th>
            <td>Submit the online form with your resume and cover letter.</td>
            <td>Open until closing date</td>
          </tr>
          <tr>
            <th scope="row">2. Screening</th>
            <td>Our team reviews your application and contacts shortlisted applicants.</td>
            <td>1 week</td>
          </tr>
          <tr>
            <th scope="row">3. Interview</th>
            <td>A conversation about your skills and a short practical task.</td>
            <td>1&ndash;2 weeks</td>
          </tr>
          <tr>
            <th scope="row">4. Offer</th>
            <td>We send an offer and agree a start date.</td>
            <td>1 week</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3">Total time: approximately 4 weeks</td>
          </tr>
        </tfoot>
      </table>
    </section>

    <section class="cta">
      <h2>Ready to join LearnBridge?</h2>
      <p>Send us your resume and tell us why you would like to help build the future of education.</p>
      <p><a class="btn" href="apply.php">Apply now</a></p>
    </section>
  </main>

  <!-- Footer -->
<?php include "footer.inc"; ?>
</body>
</html>
