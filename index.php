<?php
// index.php
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Academic Records Home</title>
  <style>
    body { font-family: sans-serif; padding: 2rem; }
    h1 { margin-bottom: 1rem; }
    ul { list-style: none; padding: 0; }
    li { margin: 0.5rem 0; }
    a { text-decoration: none; color: #0074D9; font-weight: bold; }
    a:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <h1>Academic Records System</h1>
  <p>Select an action below:</p>
  <ul>
    <li><a href="professor-classes.php">Professor Schedule Lookup</a></li>
    <li><a href="count-grades.php">Professor Grade Distribution</a></li>
    <li><a href="class-sections.php">Course Sections &amp; Enrollment</a></li>
    <li><a href="student-courses.php">Student Transcript Lookup</a></li>
  </ul>
</body>
</html>
