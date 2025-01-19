<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="attendance_container">
        <div id="student_list" class="student_list">
            <h2>Student List</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Timestamp</th> <!-- New column for timestamp -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection
                    include('connect_db.php');

                    // Fetch the student data
                    $query = "SELECT * FROM student_info";
                    $result = mysqli_query($conn, $query);

                    // Check if there are records
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                            <td>{$row['student_id']}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['middle_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['present_time']}</td> <!-- Display the timestamp -->
                          </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No students found</td></tr>";
                    }

                    // Close the connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
        <button id="add_attendance">Add student</button>
    </div>

    <div id="form_container" class="form_container" style="display: none;">
        <form>
            <input type="text" id="first_name" class="first_name" placeholder="first name">
            <input type="text" id="middle_name" class="middle_name" placeholder="middle name">
            <input type="text" id="last_name" class="last_name" placeholder="last name">
            <div class="button_cointainer">
                <button id="cancel_button" class="cancel_button">Cancel</button>
                <button id="add_button" class="add_button">Add</button>
            </div>
        </form>
    </div>
</body>
<script src="index.js"></script>

</html>