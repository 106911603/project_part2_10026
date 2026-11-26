<?php
/*
  filename: job_functions.inc
  author: Minh Nguyen
  created: 17/11/2026
  description: Functions that read jobs from the database and print them.
  acknowledgements: Generative AI (Claude, by Anthropic) was used to help
                    with the database code. All code was checked by the author.
*/


function print_list($text) {
    $items = explode("\n", $text);

    echo "            <ul>\n";
    foreach ($items as $item) {
        $item = trim($item);

        if ($item != "") {
            echo "              <li>" . htmlspecialchars($item) . "</li>\n";
        }
    }
    echo "            </ul>\n";
}


function print_job($job) {
    $ref             = htmlspecialchars($job["job_ref"]);
    $title           = htmlspecialchars($job["title"]);
    $reports_to      = htmlspecialchars($job["reports_to"]);
    $location        = htmlspecialchars($job["location"]);
    $employment_type = htmlspecialchars($job["employment_type"]);
    $description     = htmlspecialchars($job["description"]);

    $salary = '$' . number_format($job["salary_min"]) . ' &ndash; $' . number_format($job["salary_max"]) . ' per year';

    if (!empty($job["salary_note"])) {
        $salary = $salary . ", " . htmlspecialchars($job["salary_note"]);
    }

    $closing_attribute = htmlspecialchars($job["closing_date"]);
    $closing_text      = date("j F Y", strtotime($job["closing_date"]));
?>

        <article class="job" id="<?php echo $ref; ?>">
          <h2><?php echo $title; ?></h2>

          <dl class="job-summary">
            <dt>Reference number</dt>
            <dd><span class="ref-code"><?php echo $ref; ?></span></dd>
            <dt>Salary</dt>
            <dd><?php echo $salary; ?></dd>
            <dt>Reports to</dt>
            <dd><?php echo $reports_to; ?></dd>
            <dt>Location</dt>
            <dd><?php echo $location; ?></dd>
            <dt>Employment type</dt>
            <dd><?php echo $employment_type; ?></dd>
            <dt>Closing date</dt>
            <dd><time datetime="<?php echo $closing_attribute; ?>"><?php echo $closing_text; ?></time></dd>
          </dl>

          <section>
            <h3>About the role</h3>
            <p><?php echo $description; ?></p>
          </section>

          <section>
            <h3>Key responsibilities</h3>
<?php print_list($job["responsibilities"]); ?>
          </section>

          <section>
            <h3>Requirements</h3>
            <h4>Essential</h4>
<?php print_list($job["essential"]); ?>
            <h4>Preferable</h4>
<?php print_list($job["preferable"]); ?>
          </section>

          <section>
            <h3>What we offer</h3>
<?php print_list($job["benefits"]); ?>
          </section>

          <p class="apply-link"><a href="apply.php">Apply for <?php echo $title; ?></a></p>
        </article>
<?php
}
