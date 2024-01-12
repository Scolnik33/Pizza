<?php
    session_start();

    require_once '../../connect/connect.php';
    
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM Users WHERE email='$email'";

    $user = mysqli_query($connect, $sql);
    $user = mysqli_fetch_assoc($user);

    $_SESSION['validation'] = [];
    $_SESSION['oldEmail'] = [];
    $_SESSION['user'] = [];

    if (empty($email) || empty($password)) {
        $_SESSION['oldEmail']['email'] = $email;
        $_SESSION['validation']['notAllFieldAreFilled'] = 'Все поля должны быть заполнены';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['oldEmail']['email'] = $email;
        $_SESSION['validation']['uncurrectEmail'] = 'Некорректный email';
    }

    if (!empty($_SESSION['validation'])) {
        header('Location: ../../register.php');
        die();
    }
    
    if ($user) {
        die('Такой пользователь уже существует');
    }

    $addUser = "INSERT INTO Users VALUES (1, '$email', '$hashPassword')";
    mysqli_query($connect, $addUser);

    header('Location: ../../index.php');
?>