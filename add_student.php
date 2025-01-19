<?php
include('connect_db.php');

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['first_name'], $data['last_name'])) {
    $first_name = $data['first_name'];
    $middle_name = $data['middle_name'] ?? '';
    $last_name = $data['last_name'];

    // Insert into the database
    $query = "INSERT INTO student_info (first_name, middle_name, last_name) VALUES ('$first_name', '$middle_name', '$last_name')";
    if (mysqli_query($conn, $query)) {
        $student_id = mysqli_insert_id($conn);

        // Fetch the newly added record
        $select_query = "SELECT * FROM student_info WHERE student_id = $student_id";
        $result = mysqli_query($conn, $select_query);
        $new_student = mysqli_fetch_assoc($result);

        // Return the new record as JSON
        echo json_encode(['success' => true, 'data' => $new_student]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to insert student']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

// Close the connection
mysqli_close($conn);
?>
