<?php
    $connect = mysqli_connect("localhost", "root", "", "Pizzas");

    if (!$connect) {
        die('Ошибка подключения базы данных');
    }
?>