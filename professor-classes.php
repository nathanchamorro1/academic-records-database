<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Professor Classes</title>
</head>
<body>
  <h1>Classes by Professor</h1>
  <form method="get">
    <label for="ssn">Professor SSN:</label>
    <input type="text" id="ssn" name="ssn" required>
    <input type="submit" value="Lookup">
  </form>

<?php
if (!empty($_GET['ssn'])) {
    $ssn = $conn->real_escape_string($_GET['ssn']);
    $sql = "
      SELECT c.CourseNumber, c.Title, s.Classroom,
             s.MeetingDays, s.StartTime, s.EndTime
      FROM Section s
      JOIN Course c ON s.CourseNumber = c.CourseNumber
      WHERE s.ProfessorSSN = '$ssn'
    ";
    $res = $conn->query($sql);

    if ($res->num_rows) {
        echo "<h2>Schedule for SSN $ssn</h2>
              <table border='1'>
                <tr>
                  <th>Course</th><th>Title</th><th>Room</th>
                  <th>Days</th><th>Start</th><th>End</th>
                </tr>";
        while ($row = $res->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['CourseNumber']}</td>
                    <td>{$row['Title']}</td>
                    <td>{$row['Classroom']}</td>
                    <td>{$row['MeetingDays']}</td>
                    <td>{$row['StartTime']}</td>
                    <td>{$row['EndTime']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No classes found for SSN $ssn.</p>";
    }
}
?>
</body>
</html>
