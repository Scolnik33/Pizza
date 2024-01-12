<?php
    require_once '../../connect/connect.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM SelectedItems WHERE id='$id'";

    mysqli_query($connect, $sql);

    header('Location: ../../recyclebin.php');
?>