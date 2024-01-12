<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['user'] = [];
    }

    header('Location: ../../index.php');
?>