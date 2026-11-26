<?php
/*
  filename: search_form.inc
  author: Minh Nguyen
  created: 17/11/2026
  description: Job search bar, used on jobs.php and search.php.
*/

if (!isset($search)) {
    $search = "";
}
?>
    <form class="job-search" action="search.php" method="get" role="search">
      <label for="job-search-box">Search our jobs</label>
      <div class="job-search-row">
        <input type="search" id="job-search-box" name="q" maxlength="50" value="<?php echo htmlspecialchars($search); ?>" aria-describedby="job-search-hint">
        <button type="submit">Search</button>
      </div>
      <p class="job-search-hint" id="job-search-hint">Try a job title, a skill, a place or a reference number.</p>
    </form>
