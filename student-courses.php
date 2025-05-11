<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Transcript</title>
</head>
<body>
  <h1>Courses Taken by a Student</h1>
  <form method="get">
    <label for="sid">Student ID:</label>
    <input type="text" id="sid" name="student" required>
    <input type="submit" value="Lookup">
  </form>

<?php
if (!empty($_GET['student'])) {
    $sid = $conn->real_escape_string($_GET['student']);
    $sql = "
      SELECT c.CourseNumber, c.Title, e.Grade
      FROM Enrollment e
      JOIN Section  s ON e.SectionID = s.SectionID
      JOIN Course   c ON s.CourseNumber = c.CourseNumber
      WHERE e.StudentID = '$sid'
    ";
    $res = $conn->query($sql);

    if ($res->num_rows) {
        echo "<h2>Transcript for $sid</h2>
              <table border='1'><tr>
                <th>Course</th><th>Title</th><th>Grade</th>
              </tr>";
        while ($r = $res->fetch_assoc()) {
            echo "<tr>
                    <td>{$r['CourseNumber']}</td>
                    <td>{$r['Title']}</td>
                    <td>{$r['Grade']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No records found for student $sid.</p>";
    }
}
?>
</body>
</html>
