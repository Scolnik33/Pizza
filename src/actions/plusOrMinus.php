<?php
    require_once '../../connect/connect.php';

    $image = $_POST['image'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];
    $mark = $_POST['mark'];

    $sql = "SELECT * FROM SelectedItems WHERE image='$image' AND size='$size'";
    $item = mysqli_query($connect, $sql);
    $item = mysqli_fetch_assoc($item);
    if ($mark == '+') {
        $item = $item['quantity'] + 1;
    } else if ($mark == '-') {
        if ($quantity > 1) {
            $item = $item['quantity'] - 1;
        }
    }

    $sqlUpdate = "UPDATE SelectedItems SET quantity='$item' WHERE image='$image' AND size='$size'";
    mysqli_query($connect, $sqlUpdate);

    header('Location: ../../recyclebin.php');
?>