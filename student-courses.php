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
      SELECT st.FirstName,
             st.LastName,
             c.CourseNumber,
             c.Title,
             e.Grade
      FROM Enrollment e
      JOIN Student   st ON e.StudentID   = st.StudentID
      JOIN Section   s  ON e.SectionID   = s.SectionID
      JOIN Course    c  ON s.CourseNumber = c.CourseNumber
      WHERE e.StudentID = '$sid'
    ";
    $res = $conn->query($sql);

    if ($res->num_rows) {
        // Fetch first row to get name and print header
        $row = $res->fetch_assoc();
        echo "<h2>Transcript for {$row['FirstName']} {$row['LastName']} (ID $sid)</h2>
              <table border='1'>
                <tr>
                  <th>Course</th>
                  <th>Title</th>
                  <th>Grade</th>
                </tr>";

        // Print first record
        echo "<tr>
                <td>{$row['CourseNumber']}</td>
                <td>{$row['Title']}</td>
                <td>{$row['Grade']}</td>
              </tr>";

        // Print remaining records
        while ($row = $res->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['CourseNumber']}</td>
                    <td>{$row['Title']}</td>
                    <td>{$row['Grade']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No records found for student ID $sid.</p>";
    }
}
?>
</body>
</html>

