<?php
/*
  filename: nav.inc
  author: Minh Nguyen
  created: 16/11/2026
  description: Main menu, highlights the link of the page that is open.
*/

// A page can set $current_page before including header.inc
if (!isset($current_page)) {
    $current_page = basename($_SERVER["SCRIPT_NAME"]);
}

$menu_items = array(
    "index.php" => "Home",
    "jobs.php"  => "Job Descriptions",
    "apply.php" => "Apply",
    "about.php" => "About"
);
?>
    <nav aria-label="Main navigation">
      <ul class="menu">
<?php
foreach ($menu_items as $menu_file => $menu_label) {
    if ($menu_file == $current_page) {
        echo "        <li><a href=\"$menu_file\" aria-current=\"page\">$menu_label</a></li>\n";
    } else {
        echo "        <li><a href=\"$menu_file\">$menu_label</a></li>\n";
    }
}
?>
      </ul>
    </nav>
