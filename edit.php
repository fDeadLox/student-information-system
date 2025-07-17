<?php
include 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("Invalid student ID.");
}

$result = $conn->query("SELECT * FROM students WHERE id = $id");
if ($result->num_rows === 0) {
    die("Student not found.");
}

$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $course = $conn->real_escape_string($_POST['course']);
    $dob = $conn->real_escape_string($_POST['dob']);

    $sql = "UPDATE students SET name='$name', email='$email', course='$course', dob='$dob' WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: adminhome.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Student</title>
    
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h2>Edit Student</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required />
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required />
        <label>Course:</label>
        <input type="text" name="course" value="<?= htmlspecialchars($row['course']) ?>" required />
        <label>Date of Birth:</label>
        <input type="date" name="dob" value="<?= htmlspecialchars($row['dob']) ?>" required />
        <button type="submit">Update Student</button>
        <a href="adminhome.php" class="btn">Back</a>
    </form>
</div>
</body>
</html>
