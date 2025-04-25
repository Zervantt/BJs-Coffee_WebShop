<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>BJ's Coffee | Registration Form</title>
    <link rel="stylesheet" href="../assets/css/login.css"/>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
</head>
<body>
    <?php
        require('db.php');
        session_start();

        // Jika user sudah login, redirect ke index.php
        if (isset($_SESSION["nama_user"]) && isset($_SESSION["id_user"])) {
            header("Location: index.php");
            exit();
        }

        // When form submitted, insert values into the database.
        if (isset($_REQUEST['email'])) {
            // Removes backslashes and escapes special characters
            $name    = stripslashes($_REQUEST['name']);
            $name    = mysqli_real_escape_string($con, $name);
            $email   = stripslashes($_REQUEST['email']);
            $email   = mysqli_real_escape_string($con, $email);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);

            // Insert data into the database
            $query = "INSERT INTO `users` (nama_user, email, password)
                        VALUES ('$name', '$email', '" . md5($password) . "')";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<script>
                        alert('You are registered successfully.');
                        window.location.href = 'login.php';
                        </script>";
            } else {
                echo "<div class='form'>
                        <h3>Registration failed. Please try again.</h3><br/>
                        <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
                        </div>";
            }
        } else {
    ?>
        <form class="form" action="" method="post">
            <center>
                <img src="../assets/images/logo.png" alt="" class="img img-fluid">
            </center>
            <hr />
            <h1 class="login-title">Registration</h1>
            <input type="text" class="login-input" name="name" placeholder="Name" required />
            <input type="email" class="login-input" name="email" placeholder="Email Address" required>
            <input type="password" class="login-input" name="password" placeholder="Password" required>
            <input type="submit" name="submit" value="Register" class="login-button">
            <p class="link">Already have an account? <a href="login.php">Login here!</a></p>
        </form>
    <?php
        }
    ?>
</body>
</html>