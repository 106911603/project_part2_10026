/*
  filename: jobs.sql
  author: Minh Nguyen
  created: 17/11/2026
  description: Creates the jobs table and adds the four jobs.
               Import it in phpMyAdmin. Running it again resets the table.
*/


-- 1. Database
CREATE DATABASE IF NOT EXISTS learnbridge_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE learnbridge_db;


-- 2. Table
DROP TABLE IF EXISTS jobs;

CREATE TABLE jobs (
    job_ref          CHAR(5)       NOT NULL,
    title            VARCHAR(60)   NOT NULL,
    salary_min       INT UNSIGNED  NOT NULL,
    salary_max       INT UNSIGNED  NOT NULL,
    salary_note      VARCHAR(100)  NULL,
    reports_to       VARCHAR(60)   NOT NULL,
    location         VARCHAR(100)  NOT NULL,
    employment_type  VARCHAR(60)   NOT NULL,
    closing_date     DATE          NOT NULL,
    description      TEXT          NOT NULL,
    responsibilities TEXT          NOT NULL,
    essential        TEXT          NOT NULL,
    preferable       TEXT          NOT NULL,
    benefits         TEXT          NOT NULL,

    PRIMARY KEY (job_ref),

    CONSTRAINT chk_salary CHECK (salary_max >= salary_min)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 3. Data

-- Front-End Web Developer
INSERT INTO jobs (
    job_ref, title, salary_min, salary_max, salary_note,
    reports_to, location, employment_type, closing_date,
    description, responsibilities, essential, preferable, benefits
) VALUES (
    'FED26',
    'Front-End Web Developer',
    90000,
    105000,
    NULL,
    'Head of Development',
    'Melbourne CBD, VIC (hybrid: 3 days in the studio)',
    'Full-time, permanent',
    '2026-11-30',
    'You will turn our designers'' layouts into fast, responsive and accessible websites for clients. You will work in a small project team with a designer and an account manager, and help keep our code standards high across every launch.',
    'Build client websites from Figma designs using semantic HTML5 and CSS3.
Make sure every site meets the Web Content Accessibility Guidelines (WCAG) 2.2 at level AA before launch.
Test layouts on different browsers, screen sizes and devices.
Maintain our shared library of reusable page components.
Review code written by junior developers and give helpful feedback.',
    'At least 3 years of experience building websites professionally.
Strong skills in HTML5, CSS3, Flexbox and Grid.
Good knowledge of web accessibility and HTML validation.
Experience using Git for version control.',
    'Experience with a content management system such as WordPress.
Some JavaScript experience.
Previous work in a design or digital agency.',
    '$1,500 yearly budget for training, courses and conferences.
Flexible start and finish times.
Latest laptop and a second screen for home.'
);

-- Junior Front-End Developer
INSERT INTO jobs (
    job_ref, title, salary_min, salary_max, salary_note,
    reports_to, location, employment_type, closing_date,
    description, responsibilities, essential, preferable, benefits
) VALUES (
    'JFD26',
    'Junior Front-End Developer',
    65000,
    72000,
    NULL,
    'Senior Front-End Developer',
    'Melbourne CBD, VIC (hybrid: 3 days in the studio)',
    'Full-time, permanent',
    '2026-11-30',
    'This is an entry-level role for a recent graduate or career changer who wants to grow as a web developer. You will be paired with a senior developer as your mentor and work on real client projects from your first month.',
    'Build and update web pages for client projects with support from senior developers.
Fix layout and content issues reported by clients.
Check pages with the W3C validator and accessibility testing tools.
Write clear notes so other team members can understand your code.',
    'A qualification, bootcamp or self-taught portfolio in web development.
Solid understanding of HTML5 and CSS3.
A willingness to learn and to ask questions.',
    'Basic knowledge of Git and GitHub.
An understanding of accessibility basics such as alt text and heading order.
Personal or study projects published online.',
    'A structured 12-month mentoring program.
Paid study leave for relevant courses.
A clear path to a mid-level developer role.'
);

-- UX/UI Designer
INSERT INTO jobs (
    job_ref, title, salary_min, salary_max, salary_note,
    reports_to, location, employment_type, closing_date,
    description, responsibilities, essential, preferable, benefits
) VALUES (
    'UXD26',
    'UX/UI Designer',
    85000,
    100000,
    NULL,
    'Creative Director',
    'Melbourne CBD, VIC (hybrid: 3 days in the studio)',
    'Full-time, permanent',
    '2026-12-07',
    'You will design websites that are easy and enjoyable for everyone to use. You will lead client workshops, research what users need, and turn that research into clear, accessible designs that our developers can build.',
    'Run discovery workshops with clients to understand their goals.
Create user flows, wireframes and interactive prototypes in Figma.
Plan and run usability tests, including with people who use assistive technology.
Design page layouts that follow each client''s brand and style guide.
Work closely with developers so the final website matches the design.',
    'At least 3 years of experience in UX or UI design.
A portfolio showing your design process, not only final screens.
Strong skills in Figma or a similar design tool.
Knowledge of colour contrast, readable typography and inclusive design.',
    'Basic knowledge of HTML and CSS.
Experience presenting design ideas to clients.
Experience creating or maintaining a design system.',
    '$1,500 yearly budget for training, courses and conferences.
One paid creative day each month for personal projects.
Flexible start and finish times.'
);

-- Digital Content Designer
INSERT INTO jobs (
    job_ref, title, salary_min, salary_max, salary_note,
    reports_to, location, employment_type, closing_date,
    description, responsibilities, essential, preferable, benefits
) VALUES (
    'DCD26',
    'Digital Content Designer',
    70000,
    82000,
    NULL,
    'Creative Director',
    'Remote (anywhere in Australia), with monthly studio visits',
    'Part-time (3 days per week), 12-month contract',
    '2026-12-14',
    'You will create the graphics, short videos and social media content that help our clients'' brands come to life online. You will work from each client''s brand guidelines and make sure all content is accessible, with captions and clear text.',
    'Design graphics for websites, social media and email campaigns.
Edit short videos and add accurate captions.
Write clear alt text for every image you produce.
Keep all content consistent with each client''s brand guidelines.',
    'At least 2 years of experience in graphic or digital design.
Strong skills in Adobe Photoshop, Illustrator and Premiere Pro, or similar tools.
A portfolio of digital or social media work.',
    'Experience with motion graphics in After Effects.
Photography skills.
Experience writing short copy for websites or social media.',
    'Work from home with a home office allowance.
Flexible choice of working days.
Access to our licensed stock image and font libraries.'
);
