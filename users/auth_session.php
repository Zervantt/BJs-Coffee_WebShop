<?php
    session_start();

    if (!isset($_SESSION["nama_user"]) || !isset($_SESSION["id_user"])) {
        header("Location: login.php");
        exit();
    }
?>