<?php
/*
  filename: search.php
  author: Minh Nguyen
  created: 17/11/2026
  description: Search results. Shows the jobs that contain every word searched for.
  acknowledgements: Generative AI (Claude, by Anthropic) was used to help
                    with the search query. All code was checked by the author.
*/

require_once "settings.php";
require_once "job_functions.inc";

// Keeps "Job Descriptions" highlighted in the menu
$current_page = "jobs.php";

$search = "";
$jobs = array();
$db_error = false;


if (isset($_GET["q"]) && is_string($_GET["q"])) {
    $search = trim($_GET["q"]);
    $search = mb_substr($search, 0, 50);
    $search = trim($search);
}


if ($search != "") {
    $words = preg_split('/\s+/', $search);

    // The text columns joined into one, so a word can be in any of them
    $all_text = "CONCAT_WS(' ', job_ref, title, location, employment_type,
                           description, responsibilities, essential, preferable, benefits)";

    $conditions = array();
    $patterns = array();

    foreach ($words as $word) {
        $conditions[] = "$all_text LIKE ?";
        $patterns[] = "%" . $word . "%";
    }

    $query = "SELECT job_ref, title, salary_min, salary_max, salary_note,
                     reports_to, location, employment_type, closing_date,
                     description, responsibilities, essential, preferable, benefits
              FROM jobs
              WHERE " . implode(" AND ", $conditions) . "
              ORDER BY closing_date, job_ref";

    // Database errors throw an exception, handled in catch below
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $conn = mysqli_connect($host, $user, $pwd, $sql_db);
        mysqli_set_charset($conn, "utf8mb4");

        $stmt = mysqli_prepare($conn, $query);

        $types = str_repeat("s", count($patterns));
        mysqli_stmt_bind_param($stmt, $types, ...$patterns);

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $jobs[] = $row;
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } catch (mysqli_sql_exception $e) {
        $db_error = true;

        // Logged for the developer, never shown on the page
        error_log("search.php database error: " . $e->getMessage());
    }
}

$job_count = count($jobs);

$search_safe = htmlspecialchars($search);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Search the current job vacancies at LearnBridge, a creative digital media agency in Melbourne.">
  <meta name="author" content="Minh Nguyen">
<?php
if ($search != "") {
    echo "  <title>Search: $search_safe | LearnBridge Careers</title>\n";
    $heading = "Search results";
} else {
    echo "  <title>Find a job | LearnBridge Careers</title>\n";
    $heading = "Find a job";
}
?>

  <!-- External CSS -->
  <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
  <!-- Common header and menu -->
<?php include "header.inc"; ?>

  <main id="main">
    <h1><?php echo $heading; ?></h1>

    <!-- Search bar -->
<?php include "search_form.inc"; ?>

<?php
if ($db_error) {
?>
    <p class="notice">Sorry, we cannot search our jobs right now. Please try again later, or email our hiring team at <a href="mailto:info@learnbridge.example">info@learnbridge.example</a>.</p>
<?php
} elseif ($search == "") {
?>
    <p class="notice">Type a word in the search box to find a job.</p>
<?php
} elseif ($job_count == 0) {
?>
    <p class="notice">No jobs match &ldquo;<?php echo $search_safe; ?>&rdquo;.</p>

    <h2>Search tips</h2>
    <ul>
      <li>Check the spelling of each word.</li>
      <li>Use fewer words. A job must contain every word you type.</li>
      <li>Try a more general word, such as a skill or a job title.</li>
    </ul>
<?php
} else {
    if ($job_count == 1) {
        $summary = "<strong>1 job</strong> matches";
    } else {
        $summary = "<strong>$job_count jobs</strong> match";
    }
?>
    <p class="search-summary"><?php echo $summary; ?> &ldquo;<?php echo $search_safe; ?>&rdquo;.</p>
<?php
    foreach ($jobs as $job) {
        print_job($job);
    }
}
?>

    <p><a href="jobs.php">View all jobs</a></p>
  </main>

  <!-- Footer -->
<?php include "footer.inc"; ?>
</body>
</html>
