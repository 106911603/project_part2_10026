<?php

$errors = [];


$first_name = trim($_POST["first-name"] ?? "");

if ($first_name == "") {
    $errors[] = "First name is required!";
} elseif (strlen($first_name) > 20) {
    $errors[] = "First name must not exceed 20 characters!";
} elseif (!ctype_alpha($first_name)) {
    $errors[] = "First name must contain letters only!";
}


$last_name = trim($_POST["last-name"] ?? "");

if ($last_name == "") {
    $errors[] = "Last name is required!";
} elseif (strlen($last_name) > 20) {
    $errors[] = "Last name must not exceed 20 characters!";
} elseif (!ctype_alpha($last_name)) {
    $errors[] = "Last name must contain letters only!";
}


$job_reference = trim($_POST["job-reference"] ?? "");

if ($job_reference == "") {
    $errors[] = "Job reference is required!";
} elseif (strlen($job_reference) != 5) {
    $errors[] = "Job reference must contain exactly 5 characters!";
} elseif (!ctype_alnum($job_reference)) {
    $errors[] = "Job reference must contain letters and numbers only!";
}


$email = trim($_POST["email"] ?? "");

if ($email == "") {
    $errors[] = "Email is required!";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address!";
}


$phone = trim($_POST["phone"] ?? "");

if ($phone == "") {
    $errors[] = "Phone number is required!";
} elseif (!ctype_digit($phone)) {
    $errors[] = "Phone number must contain digits only!";
} elseif (strlen($phone) < 8 || strlen($phone) > 12) {
    $errors[] = "Phone number must contain 8 to 12 digits!";
}


$postcode = trim($_POST["postcode"] ?? "");

if ($postcode == "") {
    $errors[] = "Postcode is required!";
} elseif (!ctype_digit($postcode)) {
    $errors[] = "Postcode must contain digits only!";
} elseif (strlen($postcode) != 4) {
    $errors[] = "Postcode must contain exactly 4 digits!";
}


$street_address = trim($_POST["street-address"] ?? "");

if ($street_address == "") {
    $errors[] = "Street address is required!";
} elseif (strlen($street_address) > 40) {
    $errors[] = "Street address must not exceed 40 characters!";
}


$suburb = trim($_POST["suburb-town"] ?? "");

if ($suburb == "") {
    $errors[] = "Suburb is required!";
} elseif (strlen($suburb) > 40) {
    $errors[] = "Suburb must not exceed 40 characters!";
}


$state = trim($_POST["province"] ?? "");
$valid_states = ["VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"];

if ($state == "") {
    $errors[] = "State is required!";
} elseif (!in_array($state, $valid_states, true)) {
    $errors[] = "Invalid state!";
}


$gender = trim($_POST["gender"] ?? "");
$valid_genders = ["male", "female", "prefer-not-to-say"];

if ($gender == "") {
    $errors[] = "Gender is required!";
} elseif (!in_array($gender, $valid_genders, true)) {
    $errors[] = "Invalid gender!";
}


$skills = $_POST["skills"] ?? [];
$valid_skills = ["html-css", "javascript", "web-design", "accessibility"];

if (!is_array($skills)) {
    $errors[] = "Invalid skills!";
} elseif (empty($skills)) {
    $errors[] = "Please select at least one skill!";
} else {
    foreach ($skills as $skill) {
        if (!in_array($skill, $valid_skills, true)) {
            $errors[] = "Invalid skill selected!";
            break;
        }
    }
}

$other_skills = trim($_POST["other-skills"] ?? "");


/* AI used for date validation */
$dob = trim($_POST["date-of-birth"] ?? "");

if ($dob == "") {
    $errors[] = "Date of birth is required!";
} else {
    $date = DateTime::createFromFormat("!Y-m-d", $dob);

    if (!$date || $date->format("Y-m-d") !== $dob) {
        $errors[] = "Invalid date of birth!";
    } elseif ($date > new DateTime("today")) {
        $errors[] = "Date of birth cannot be in the future!";
    }
}


if (empty($errors)) {
    echo "Validation passed!";
} else {
    echo "<h2>Please correct the following errors:</h2>";
    echo "<ul>";

    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }

    echo "</ul>";
}
?>