<?php
    session_start();

    $userId = $_SESSION['user']['id'] ?? null;

    if (isset($_SESSION['user']['id'])) {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>PhPizza</title>
</head>
<body>
    <?php include_once 'components/header.php' ?>

    <div id="top" class="w-100 vh-100 d-flex justify-content-center align-items-center">
        <form class="p-5 pt-0 pb-0" action="src/actions/signIn.php" method="post">
            <div class="text-warning">
                <?php
                    if ($_SESSION['validation']['notAllFieldAreFilled'] ?? '') {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['validation']['notAllFieldAreFilled'] ?? '' ?>
                            </div>
                        <?php
                    } else if ($_SESSION['validation']['uncurrectEmail'] ?? '') {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['validation']['uncurrectEmail'] ?? ''; ?>
                            </div>
                        <?php
                    } else if ($_SESSION['errorsInLogin']['userDoesntExist'] ?? '') {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['errorsInLogin']['userDoesntExist'] ?? ''; ?>
                            </div>
                        <?php
                    } else if ($_SESSION['errorsInLogin']['uncurrentPassword'] ?? '') {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['errorsInLogin']['uncurrentPassword'] ?? ''; ?>
                            </div>
                        <?php
                    }
                ?>
            </div>
            <div>
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="text" value="<?= $_SESSION['oldEmail']['email'] ?? ''; ?>" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text invisible">We'll never share your email with anyone else. Lorem ipsum dolor sit amet consectetur adipisicing.</div>
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
            </div>
            <div class="d-flex flex-row justify-content-between align-items-center">
                <button type="submit" class="btn btn-warning btn-form text-light-hover">Войти</button>
                <a href="register.php" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Создать аккаунт</a>
            </div>
        </form>
    </div>

    <?php
        $_SESSION['validation'] = [];
        $_SESSION['oldEmail'] = [];
        $_SESSION['errorsInLogin'] = [];
    ?>
</body>
</html>