<?php
// register.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $school = $_POST['school'];
    $grade = $_POST['grade'];
    $group = $_POST['group'];

    $timestamp = date('Y-m-d H:i:s');
    $progress = 0; // Initial progress

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'student_progress');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "INSERT INTO students (name, phone, school, grade, groups, timestamp, progress) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssisi', $name, $phone, $school, $grade, $group, $timestamp, $progress);

    if ($stmt->execute()) {
        header('Location: ../test.php');
        exit();
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>