<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>Login Form</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
</head>
<body>

    <center>

        <div class="form_design">

            <center class="title_design">
                Login Form

                <h4>
                    <?php
                        error_reporting(0);
                        session_start();
                        session_destroy();
                        echo $_SESSION['loginMessage'];

                    ?>
                </h4>
            </center>

            <form action="login_check.php" method="POST" class="login_form">

                <div>
                    <label class="label_deg">Username</label>
                    <input type="text" name="username">
                </div>

                <div>
                    <label class="label_deg">Password</label>
                    <input type="Password" name="password">
                </div>

                <div>
                    <input class="btn btn-primary" type="submit" name="submit" value="Login">
                    <a href="index.php" class="btn btn-secondary">Back</a>
                </div>
            </form>

        </div> 

    </center>

</body>
</html>
