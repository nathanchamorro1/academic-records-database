<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Sections</title>
</head>
<body>
  <h1>Sections for a Course</h1>
  <form method="get">
    <label for="course">Course #:</label>
    <input type="text" id="course" name="course" required>
    <input type="submit" value="Show">
  </form>

<?php
if (!empty($_GET['course'])) {
    $course = $conn->real_escape_string($_GET['course']);
    $sql = "
      SELECT s.SectionNumber, s.Classroom,
             s.MeetingDays, s.StartTime, s.EndTime,
             COUNT(e.StudentID) AS Enrolled
      FROM Section s
      LEFT JOIN Enrollment e ON s.SectionID = e.SectionID
      WHERE s.CourseNumber = '$course'
      GROUP BY s.SectionNumber, s.Classroom, s.MeetingDays,
               s.StartTime, s.EndTime
    ";
    $res = $conn->query($sql);

    if ($res->num_rows) {
        echo "<h2>Sections of $course</h2>
              <table border='1'>
                <tr>
                  <th>Sec#</th><th>Room</th><th>Days</th>
                  <th>Start</th><th>End</th><th>Enrolled</th>
                </tr>";
        while ($r = $res->fetch_assoc()) {
            echo "<tr>
                    <td>{$r['SectionNumber']}</td>
                    <td>{$r['Classroom']}</td>
                    <td>{$r['MeetingDays']}</td>
                    <td>{$r['StartTime']}</td>
                    <td>{$r['EndTime']}</td>
                    <td>{$r['Enrolled']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No sections found for $course.</p>";
    }
}
?>
</body>
</html>
