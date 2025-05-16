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
      SELECT p.FirstName,
             p.LastName,
             s.SectionNumber,
             c.CourseNumber,
             c.Title,
             s.Classroom,
             s.MeetingDays,
             s.StartTime,
             s.EndTime
      FROM Section s
      JOIN Course    c ON s.CourseNumber = c.CourseNumber
      JOIN Professor p ON s.ProfessorSSN = p.SSN
      WHERE s.ProfessorSSN = '$ssn'
    ";
    $res = $conn->query($sql);

    if ($res->num_rows) {
        // Fetch the first row to get professor name, then rewind pointer
        $first = $res->fetch_assoc();
        echo "<h2>Schedule for Prof. {$first['FirstName']} {$first['LastName']} (SSN $ssn)</h2>
              <table border='1'>
                <tr>
                  <th>Section No</th>
                  <th>Course</th>
                  <th>Title</th>
                  <th>Room</th>
                  <th>Days</th>
                  <th>Start</th>
                  <th>End</th>
                </tr>";

        // Output the first row
        echo "<tr>
                <td>{$first['SectionNumber']}</td>
                <td>{$first['CourseNumber']}</td>
                <td>{$first['Title']}</td>
                <td>{$first['Classroom']}</td>
                <td>{$first['MeetingDays']}</td>
                <td>{$first['StartTime']}</td>
                <td>{$first['EndTime']}</td>
              </tr>";

        // Output the rest
        while ($row = $res->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['SectionNumber']}</td>
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
