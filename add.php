<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<div class="container">
    <h2>Add Student</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="course" placeholder="Course" required>
        <input type="date" name="dob" required>
        <button type="submit">Add Student</button>
    </form>
    <a href="adminhome.php">Back to List</a>
</div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $dob = $_POST['dob'];
    $sql = "INSERT INTO students (name, email, course, dob) VALUES ('$name', '$email', '$course', '$dob')";
    if ($conn->query($sql) === TRUE) {
        header("Location: adminhome.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
