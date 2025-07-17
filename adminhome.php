<?php include 'db.php';

session_start();

if(!isset($_SESSION['username'])) {
    header("location:login.php");
}
elseif($_SESSION['usertype']=='student') {
    header("location:login.php");
}

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
if ($search != '') {
    $result = $conn->query("SELECT * FROM students WHERE name LIKE '%$search%'");
} else {
    $result = $conn->query("SELECT * FROM students");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header class="header">
    <a href="">Admin Dashboard</a>
    <div class="logout">
        <a href="logout.php" class="btn btn-primary">Logout</a>
    </div>
</header>

<div class="container">
    <h2>Student List</h2>

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
    <a href="add.php" class="btn btn-sm">➕ Add New Student</a>

    <form method="GET" class="d-flex align-items-center" style="gap: 5px; max-height: 38px; padding-top: 15px;">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search name..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" style="max-width: 200px; height: 38px;">
        <button type="submit" class="btn btn-sm btn-outline-primary px-2 py-1">🔍</button>
        
    </form>
</div>


    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>DOB</th>
            <th>Actions</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['course']); ?></td>
                    <td><?= htmlspecialchars($row['dob']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" style="color: #007BFF;">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" style="color: red;" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center;">No students found.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>
