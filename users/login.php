<?php
    require('db.php');
    session_start();

    // Jika user sudah login, redirect ke index.php
    if (isset($_SESSION["nama_user"]) && isset($_SESSION["id_user"])) {
        header("Location: index.php");
        exit();
    }

    // Ketika form dikirim, cek dan buat session untuk user.
    if (isset($_POST['email'])) {
        $email    = stripslashes($_POST['email']); // Hapus backslashes
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($con, $password);

        // Cek apakah user ada di database
        $query  = "SELECT * FROM `users` WHERE email='$email' AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            // Ambil data user
            $user = mysqli_fetch_assoc($result);

            // Set session
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama_user'] = $user['nama_user'];

            // Redirect ke index.php
            header("Location: index.php");
            exit();
        } else {
            // Pesan error jika login gagal
            echo "<div class='form'>
                <h3>Incorrect Email/Password.</h3><br/>
                <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                </div>";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>BJ's Coffee | Login Form</title>
    <link rel="stylesheet" href="../assets/css/login.css"/>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
</head>
<body>
    <form class="form" method="post" name="login">
        <center>
            <img src="../assets/images/logo.png" alt="" class="img img-fluid">
        </center>
        <hr />
        <h1 class="login-title">Login</h1>
        <input type="email" class="login-input" name="email" placeholder="Email Address" autofocus="true" required/>
        <input type="password" class="login-input" name="password" placeholder="Password" required/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? <a href="registration.php">Register here!</a></p>
        <hr />
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>