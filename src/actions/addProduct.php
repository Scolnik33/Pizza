<?php
    require_once '../../connect/connect.php';

    session_start();

    $id = $_POST['id'] ?? null;
    $userId = $_POST['userId'] ?? null;
    $image = $_POST['image'] ?? null;
    $name = $_POST['name'] ?? null;
    $size = $_POST['size'] ?? 0;
    $price = $_POST['price'] ?? null;
    $quantity = $_POST['quantity'] ?? 1;

    function direction($size, $id) {
        if ($size == 0) {
            header('Location: ../../index.php');
        } else {
            header("Location: ../../onePizza.php?pizzaId=$id");
        }
    }

    $sqlAll = "SELECT * FROM SelectedItems";
    $items = mysqli_query($connect, $sqlAll);
    $items = mysqli_fetch_all($items);

    foreach ($items as $item) {
        if ($item[2] == $image && $item[4] == $size) {
            $_SESSION['error']['dublicate'] = true;

            $sqlQuantity = "SELECT quantity FROM SelectedItems WHERE image='$image' AND size='$size'";
            $quantityPlus = mysqli_query($connect, $sqlQuantity);
            $quantityPlus = mysqli_fetch_assoc($quantityPlus);
            $quantityPlus = $quantityPlus['quantity'] + $quantity;
            
            $sqlUpdate = "UPDATE SelectedItems SET quantity='$quantityPlus' WHERE image='$image' AND size='$size'";
            mysqli_query($connect, $sqlUpdate);

            direction($size, $id);
            var_dump($quantityPlus);
            die();
        }
    }
    
    $sqlAdd = "INSERT INTO SelectedItems VALUES (0, '$userId', '$image', '$name', '$size', '$price', '$quantity')";
    mysqli_query($connect, $sqlAdd);

    direction($size, $id);
?>