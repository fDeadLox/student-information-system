<?php include 'db.php';

session_start();

if(!isset($_SESSION['username']))
{
    header("location:login.php");
}
elseif($_SESSION['usertype']=='admin')
{
    header("location:login.php");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Student Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="admin.css">
</head>
<body>

    <header class="header">
        <a href="">Student Dashboard</a>
        <div class="logout">
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </header>

    <div class="container">
    <h2>Student List</h2>
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>DOB</th>
        </tr>

        <?php
        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
        if ($search != '') {
            $result = $conn->query("SELECT * FROM students WHERE name LIKE '%$search%'");
        } else {
            $result = $conn->query("SELECT * FROM students");
        }

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= htmlspecialchars($row['id']); ?></td>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td><?= htmlspecialchars($row['course']); ?></td>
            <td><?= htmlspecialchars($row['dob']); ?></td>
        </tr>
        <?php
            endwhile;
        else:
        ?>
        <tr>
            <td colspan="6" style="text-align: center;">No students found.</td>
        </tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>