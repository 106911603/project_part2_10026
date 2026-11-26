<?php
/*
  filename: jobs.php
  author: Minh Nguyen
  created: 05/10/2026 (as jobs.html)
  description: Job Descriptions page. The jobs are read from the jobs table.
  acknowledgements:
    - Salary ranges were checked against Payscale (Melbourne salary data, 2026)
      and the Robert Half 2026 Salary Guide (Melbourne).
    - Generative AI (Claude, by Anthropic) was used to review this page and
      to help with layout and the database code.
      All content was checked and edited by the author.
*/

require_once "settings.php";
require_once "job_functions.inc";

$jobs = array();
$db_error = false;

// Database errors throw an exception, handled in catch below
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
    mysqli_set_charset($conn, "utf8mb4");

    $query = "SELECT job_ref, title, salary_min, salary_max, salary_note,
                     reports_to, location, employment_type, closing_date,
                     description, responsibilities, essential, preferable, benefits
              FROM jobs
              ORDER BY closing_date, job_ref";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $jobs[] = $row;
    }

    mysqli_free_result($result);
    mysqli_close($conn);
} catch (mysqli_sql_exception $e) {
    $db_error = true;

    // Logged for the developer, never shown on the page
    error_log("jobs.php database error: " . $e->getMessage());
}

$job_count = count($jobs);
if ($job_count == 1) {
    $roles_text = "1 role";
} else {
    $roles_text = "$job_count roles";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Current job vacancies at LearnBridge, a creative digital media agency in Melbourne, with salary, requirements and how to apply.">
  <meta name="keywords" content="LearnBridge, jobs, careers, vacancies, creative agency, web design, digital content, Melbourne">
  <meta name="author" content="Minh Nguyen">
  <!-- External CSS -->
  <link rel="stylesheet" href="styles/styles.css">

  <!-- Embedded CSS || Used in Inclusion Section -->
  <style>
    .inclusion {
      margin-top: 1rem;
      padding: 2rem;
      color: #ffffff;
      background-color: #6a1424;
      border-radius: 6px;
    }
 
    .inclusion h2,
    .inclusion h3 {
      color: #ffffff;
    }
 
    .inclusion h2 {
      margin-top: 0;
    }

    .inclusion h2 + p {
      font-family: Georgia, "Times New Roman", serif;
      font-size: 1.25rem;
    }

    .inclusion p,
    .inclusion li {
      max-width: 70ch;
    }
  </style>
  
  <title>Job Descriptions | LearnBridge Careers</title>

</head>
 
<body>
  <!-- Common header and menu -->
<?php include "header.inc"; ?>

  <main id="main">
    
    <!-- Page intro -->
    <section class="page-intro">
      <h1>Job Descriptions</h1>
      <p>LearnBridge is a creative digital media agency in Melbourne. We design websites, build brands and produce digital content for clients in education, health, the arts and small business. Our team of 24 designers, developers and content creators works closely with each client from first sketch to launch.</p>
<?php
if ($job_count > 0) {
?>
      <p>We are growing and have <?php echo $roles_text; ?> open. Read the details below, note the reference number, then <a href="apply.php">submit your application</a>.</p>
<?php
}
?>
    </section>

<?php
if ($job_count > 0) {
?>
    <!-- Search bar -->
<?php include "search_form.inc"; ?>

    <!-- In-page menu -->
    <nav class="job-links" aria-labelledby="vacancies-heading">
      <h2 id="vacancies-heading">Current vacancies</h2>
      <ul>
<?php
    foreach ($jobs as $job) {
        $ref = htmlspecialchars($job["job_ref"]);
        $title = htmlspecialchars($job["title"]);
        echo "        <li><a href=\"#$ref\">$title <span class=\"ref-code\">$ref</span></a></li>\n";
    }
?>
      </ul>
    </nav>
<?php
}
?>

    <!-- Two columns: job list on the left, aside floated on the right -->
    <div class="jobs-layout">
      <div class="job-list">
<?php
if ($db_error) {
?>
        <p class="notice">Sorry, we cannot show our job list right now. Please try again later, or email our hiring team at <a href="mailto:info@learnbridge.example">info@learnbridge.example</a>.</p>
<?php
} elseif ($job_count == 0) {
?>
        <p class="notice">We have no open roles at the moment. Please check back soon.</p>
<?php
} else {
    foreach ($jobs as $job) {
        print_job($job);
    }
}
?>

      </div>
 
      <!-- Sidebar - Extra Info
           Floated right at 25% width in styles.css. -->
      <aside class="sidebar" aria-label="Application information">
        <h2>How to apply</h2>
        <ol>
          <li>Choose a role and note its 5-character reference number.</li>
          <li>Prepare your resume and a link to your portfolio.</li>
          <li>Complete the form on our <a href="apply.php">Apply page</a>.</li>
          <li>We will reply to every applicant within 10 working days.</li>
          <li>Shortlisted applicants are invited to a 45-minute interview, online or in person.</li>
        </ol>
 
        <h2>Need adjustments?</h2>
        <p>If you need any adjustments during the application or interview process, such as extra time, captions or an accessible meeting room, let us know in your application. Asking will not affect your result.</p>

        <h2>Questions?</h2>
        <p>Email our hiring team at <a href="mailto:info@learnbridge.example">info@learnbridge.example</a>.</p>
      </aside>
 
    </div>
 
    <!-- Inclusive employment statement || Used Embedded CSS in head -->
    <section class="inclusion" id="inclusion">
      <h2>Our commitment to inclusive employment</h2>

      <!-- Inline CSS -->
      <p style="font-weight: bold;">We strongly encourage applications from Aboriginal and Torres Strait Islander peoples. We also welcome people with disability, people from culturally diverse backgrounds and people of all ages and genders.</p>
 
      <h3>What this means in practice</h3>
      <ul>
        <li>Aboriginal and Torres Strait Islander staff can take paid cultural and ceremonial leave.</li>
        <li>You can ask for a support person to join your interview.</li>
        <li>We do not use Aboriginal and Torres Strait Islander art, symbols or stories in our designs without permission from the artists or communities they belong to, and we pay for that work fairly.</li>
      </ul>
 
      <h3>Why this matters to us</h3>
      <p>As a creative agency, our websites and content shape how people and cultures are seen online. Teams with different life experiences make work that is more accurate, respectful and useful for everyone. Respecting who owns cultural knowledge and art is part of doing ethical design work, not an extra.</p>
    </section>
 
  </main>

  <!-- Footer -->
<?php include "footer.inc"; ?>
</body>
</html>
