<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Grade Counts</title>
</head>
<body>
  <h1>Grade Distribution for a Section</h1>
  <form method="get">
    <label for="course">Course #:</label>
    <input type="text" id="course" name="course" required>
    <label for="sec">Section #:</label>
    <input type="number" id="sec" name="section" required>
    <input type="submit" value="Count">
  </form>

<?php
if (!empty($_GET['course']) && isset($_GET['section'])) {
    $course  = $conn->real_escape_string($_GET['course']);
    $section = (int)$_GET['section'];

    $sql = "
      SELECT e.Grade, COUNT(*) AS Count
      FROM Enrollment e
      JOIN Section s ON e.SectionID = s.SectionID
      WHERE s.CourseNumber = '$course'
        AND s.SectionNumber = $section
      GROUP BY e.Grade
    ";
    $res = $conn->query($sql);

    if ($res->num_rows) {
        echo "<h2>Grades for $course Sec $section</h2>
              <table border='1'><tr><th>Grade</th><th># Students</th></tr>";
        while ($r = $res->fetch_assoc()) {
            echo "<tr><td>{$r['Grade']}</td><td>{$r['Count']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No grades found for $course section $section.</p>";
    }
}
?>
</body>
</html>
