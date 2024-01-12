<?php
    session_start();

    require_once '../../connect/connect.php';

    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    
    $sql = "SELECT * FROM Users WHERE email='$email'";
    
    $user = mysqli_query($connect, $sql);
    $user = mysqli_fetch_assoc($user);
    
    $_SESSION['errorsInLogin'] = [];
    $_SESSION['validation'] = [];
    $_SESSION['oldEmail'] = [];

    if (empty($email) || empty($password)) {
        $_SESSION['oldEmail']['email'] = $email;
        $_SESSION['validation']['notAllFieldAreFilled'] = 'Все поля должны быть заполнены';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['oldEmail']['email'] = $email;
        $_SESSION['validation']['uncurrectEmail'] = 'Некорректный email';
    }

    if (!$user) {
        $_SESSION['oldEmail']['email'] = $email;
        $_SESSION['errorsInLogin']['userDoesntExist'] = 'Такого пользователя не существует';
    }

    if (!$verifyPassword = password_verify($password, $user['password'])) {
        $_SESSION['oldEmail']['email'] = $email;
        $_SESSION['errorsInLogin']['uncurrentPassword'] = 'Неверный логин или пароль';
    }

    if (!empty($_SESSION['validation']) || !empty($_SESSION['errorsInLogin'])) {
        header('Location: ../../login.php');
        die();
    }

    $_SESSION['user']['id'] = $user['userId'];

    header('Location: ../../index.php');
?>