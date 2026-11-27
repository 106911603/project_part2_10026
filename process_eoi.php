<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: apply.php");
    exit;
}

$errors = [];


$first_name = trim($_POST["first-name"] ?? "");

if ($first_name == "") {
    $errors[] = "First name is required";
} elseif (strlen($first_name) > 20) {
    $errors[] = "First name must not exceed 20 characters";
} elseif (!ctype_alpha($first_name)) {
    $errors[] = "First name must contain letters only";
}


$last_name = trim($_POST["last-name"] ?? "");

if ($last_name == "") {
    $errors[] = "Last name is required";
} elseif (strlen($last_name) > 20) {
    $errors[] = "Last name must not exceed 20 characters";
} elseif (!ctype_alpha($last_name)) {
    $errors[] = "Last name must contain letters only";
}


$job_reference = trim($_POST["job-reference"] ?? "");

if ($job_reference == "") {
    $errors[] = "Job reference is required";
} elseif (strlen($job_reference) != 5) {
    $errors[] = "Job reference must contain exactly 5 characters";
} elseif (!ctype_alnum($job_reference)) {
    $errors[] = "Job reference must contain letters and numbers only";
}


$email = trim($_POST["email"] ?? "");

if ($email == "") {
    $errors[] = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address";
}


$phone = trim($_POST["phone"] ?? "");

if ($phone == "") {
    $errors[] = "Phone number is required";
} elseif (!ctype_digit($phone)) {
    $errors[] = "Phone number must contain digits only";
} elseif (strlen($phone) < 8 || strlen($phone) > 12) {
    $errors[] = "Phone number must contain 8 to 12 digits";
}


$postcode = trim($_POST["postcode"] ?? "");

if ($postcode == "") {
    $errors[] = "Postcode is required";
} elseif (!ctype_digit($postcode)) {
    $errors[] = "Postcode must contain digits only";
} elseif (strlen($postcode) != 4) {
    $errors[] = "Postcode must contain exactly 4 digits";
}


$street_address = trim($_POST["street-address"] ?? "");

if ($street_address == "") {
    $errors[] = "Street address is required";
} elseif (strlen($street_address) > 40) {
    $errors[] = "Street address must not exceed 40 characters";
}


$suburb = trim($_POST["suburb-town"] ?? "");

if ($suburb == "") {
    $errors[] = "Suburb is required";
} elseif (strlen($suburb) > 40) {
    $errors[] = "Suburb must not exceed 40 characters";
}


$state = trim($_POST["province"] ?? "");
$valid_states = ["VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"];

if ($state == "") {
    $errors[] = "State is required";
} elseif (!in_array($state, $valid_states, true)) {
    $errors[] = "Invalid state";
}


$gender = trim($_POST["gender"] ?? "");
$valid_genders = ["male", "female", "prefer-not-to-say"];

if ($gender == "") {
    $errors[] = "Gender is required";
} elseif (!in_array($gender, $valid_genders, true)) {
    $errors[] = "Invalid gender";
}


$skills = $_POST["skills"] ?? [];
$valid_skills = ["html-css", "javascript", "web-design", "accessibility"];

if (!is_array($skills)) {
    $errors[] = "Invalid skills";
} elseif (empty($skills)) {
    $errors[] = "Please select at least one skill";
} else {
    foreach ($skills as $skill) {
        if (!in_array($skill, $valid_skills, true)) {
            $errors[] = "Invalid skill selected";
            break;
        }
    }
}

$other_skills = trim($_POST["other-skills"] ?? "");


/* AI used for dob validation */
$dob = trim($_POST["date-of-birth"] ?? "");

if ($dob == "") {
    $errors[] = "Date of birth is required";
} else {
    $date = DateTime::createFromFormat("!Y-m-d", $dob);

    if (!$date || $date->format("Y-m-d") !== $dob) {
        $errors[] = "Invalid date of birth";
    } elseif ($date > new DateTime("today")) {
        $errors[] = "Date of birth cannot be in the future";
    }
}


if (!empty($errors)) {
     echo "<h2>Please correct the following errors:</h2>";
    echo "<ul>";

    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }

    echo "</ul>";
    exit;
}


require_once "settings.php";

try {
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
    mysqli_set_charset($conn, "utf8mb4");
} catch (mysqli_sql_exception $e) {
    echo "Database not connected";
    exit;
}


$sql = "CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    job_reference VARCHAR(5) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    gender VARCHAR(20) NOT NULL,
    street_address VARCHAR(40) NOT NULL,
    suburb VARCHAR(40) NOT NULL,
    state VARCHAR(3) NOT NULL,
    postcode VARCHAR(4) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    skills TEXT NOT NULL,
    other_skills TEXT,
    status ENUM('New', 'Current', 'Final') NOT NULL DEFAULT 'New'
)";

try {
    mysqli_query($conn, $sql);
} catch (mysqli_sql_exception $e) {
    echo "Failed to create EOI table";
    exit;
}


$skills_text = implode(", ", $skills);


$sql = "INSERT INTO eoi (
    job_reference, first_name, last_name,
    dob, gender, street_address, suburb,
    state, postcode, email, phone,
    skills, other_skills
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


/* AI used for prepared statement to prevent SQL injection */
try {
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssssssssss",
        $job_reference,
        $first_name,
        $last_name,
        $dob,
        $gender,
        $street_address,
        $suburb,
        $state,
        $postcode,
        $email,
        $phone,
        $skills_text,
        $other_skills
    );

    mysqli_stmt_execute($stmt);

    $eoi_number = mysqli_insert_id($conn);

    echo "Application submitted";
    echo "<br>";
    echo "Your number is: " . $eoi_number;

    mysqli_stmt_close($stmt);
} catch (mysqli_sql_exception $e) {
    echo "Application submitting failed";
}

mysqli_close($conn);
?>