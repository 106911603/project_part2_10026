<?php
/*
  filename: apply.php
  author: Nguyen Ba Thanh Trung (page content)
          Minh Nguyen (conversion to PHP)
  description: Job application form.
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- AI used in mobile's view -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Apply online for a job at LearnBridge, a creative digital media agency.">
  <title>Apply | LearnBridge Careers</title>
  <link rel="stylesheet" href="styles/styles.css">
  <!-- AI used in CSS embedding -->
  <style>
    .apply-page .form-intro {
      margin-bottom: 1rem;
    }
  </style>
</head>
<body class="apply-page">
  <!-- Common header and menu -->
<?php include "header.inc"; ?>

  <main id="main">
    <h1>Apply to LearnBridge</h1>
    <!-- AI used in CSS embedding -->
    <p class="form-intro" style="font-style: italic;">Tell us about yourself and the role you are interested in.</p>

    <form>
      <fieldset>
        <legend>Application details</legend>
        <p>
          <label for="job-reference">Job reference number</label><br>
          <input type="text" id="job-reference" name="job-reference" pattern="[A-Za-z0-9]{5}" maxlength="5" title="Enter exactly 5 letters or numbers." required>
        </p>
        <p>
          <label for="first-name">First name</label><br>
          <input type="text" id="first-name" name="first-name" pattern="[A-Za-z ]{1,20}" maxlength="20" title="Use up to 20 letters." required>
        </p>
        <p>
          <label for="last-name">Last name</label><br>
          <input type="text" id="last-name" name="last-name" pattern="[A-Za-z ]{1,20}" maxlength="20" title="Use up to 20 letters." required>
        </p>
        <p>
          <label for="date-of-birth">Date of birth</label><br>
          <input type="date" id="date-of-birth" name="date-of-birth" required>
        </p>
        <p>
          <label for="street-address">Street address</label><br>
          <input type="text" id="street-address" name="street-address" maxlength="40" required>
        </p>
        <p>
          <label for="suburb-town">Suburb / Town</label><br>
          <input type="text" id="suburb-town" name="suburb-town" maxlength="40" required>
        </p>
        <p>
          <label for="province">State</label><br>      
            <select id="province" name="province" required>
              <option value="">State</option>
              <option value="VIC">VIC</option>
              <option value="NSW">NSW</option>
              <option value="QLD">QLD</option>
              <option value="NT">NT</option>
              <option value="WA">WA</option>
              <option value="SA">SA</option>
              <option value="TAS">TAS</option>
              <option value="ACT">ACT</option>
            </select>
        </p>
        <p>
          <label for="postcode">Postcode</label><br>
          <!-- limit at 4 digits -->
          <input type="text" id="postcode" name="postcode" pattern="[0-9]{4}" maxlength="4" title="Enter exactly 4 digits." required>
        </p>
        <p>
          <label for="email">Email address</label><br>
          <input type="email" id="email" name="email" required>
        </p>
        <p>
          <label for="phone">Phone number</label><br>
          <!-- pattern limits number, 8 to 12 nums */-->
          <input type="tel" id="phone" name="phone" pattern="[0-9]{8,12}" title="Enter 8 to 12 digits." required>
        </p>
      </fieldset>

      <!-- Radio buttons = circle with only 1 option if same name -->
      <fieldset>
        <legend>Gender</legend>
        <p>
          <input type="radio" id="gender-female" name="gender" value="female" required>
          <label for="gender-female">Female</label>
        </p>
        <p>
          <input type="radio" id="gender-male" name="gender" value="male">
          <label for="gender-male">Male</label>
        </p>
        <p>
          <input type="radio" id="gender-prefer-not-to-say" name="gender" value="prefer-not-to-say">
          <label for="gender-prefer-not-to-say">Prefer not to say</label>
        </p>
      </fieldset>

      
      <fieldset>
        <legend>Skills</legend>
        <p>Choose any skills that apply.</p>
        <p>
          <input type="checkbox" id="skill-html-css" name="skills" value="html-css">
          <label for="skill-html-css">HTML and CSS</label>
        </p>
        <p>
          <input type="checkbox" id="skill-javascript" name="skills" value="javascript">
          <label for="skill-javascript">JavaScript</label>
        </p>
        <p>
          <input type="checkbox" id="skill-web-design" name="skills" value="web-design">
          <label for="skill-web-design">Web design</label>
        </p>
        <p>
          <input type="checkbox" id="skill-accessibility" name="skills" value="accessibility">
          <label for="skill-accessibility">Accessibility</label>
        </p>
    
        <p>
          <label for="other-skills">Other skills</label><br>
          <textarea id="other-skills" name="other-skills" placeholder="Tell us about any other relevant skills"></textarea>
        </p>
      </fieldset>

      
      <p>
        <button type="submit">Submit application</button>
        <button type="reset">Clear form</button>
      </p>
    </form>
  </main>

  <!-- Footer -->
<?php include "footer.inc"; ?>
</body>
</html>
