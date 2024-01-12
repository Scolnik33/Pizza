<?php
    session_start();

    require_once 'connect/connect.php';

    if (!isset($_SESSION['user']['id'])) {
        header('Location: index.php');
    }

    $first = true;

    $userId = $_SESSION['user']['id'] ?? null;

    $sqlItems = "SELECT * FROM SelectedItems WHERE userId='$userId' ORDER BY price DESC";

    $items = mysqli_query($connect, $sqlItems);
    $items = mysqli_fetch_all($items);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>PhPizza</title>
</head>
<body>
    <?php include_once 'components/header.php' ?>

    <img src="http://www.ililrehber.com/wp-content/uploads/2016/09/pizza-1920x250.jpg" alt="" class="img-fluid">

    <?php
         if (!$items) {
            ?>
                <div class="fs-1 fw-semibold text-center mt-5">
                    <div class="mb-2">
                        <img src="Images/ClearRecycleBin.png" class="w-25 h-25" alt="">
                    </div>
                    Корзина пуста 😪
                </div>
            <?php
        } else {
            ?>
                <div class="container mt-5 fw-semibold">
                    <div class="row mb-2 sub-pizzas">
                        <div class="col-6">В корзине</div>
                        <div class="col-lg-3 col-2 text-center">Цена</div>
                        <div class="col-lg-1 col-3 ms-3 quantity">Количество</div>
                    </div>
                    <?php
                        foreach ($items as $item) {
                        $changedItem = str_replace('.', ' ', $item[3]);

                        ?>
                            <form action="src/actions/plusOrMinus.php" method="post">
                                <?php
                                    if (!$first) {
                                        ?>
                                            <div class="container fw-semibold">
                                        <?php
                                    }
                                ?>
                                    <div class="row align-items-center text-center border-top border-bottom ps-4 pe-4 info">
                                        <div class="col-sm-2 col-6 pt-3 pb-3">
                                            <img class="w-100 h-100" src="<?= $item[2] ?>" alt="">
                                        </div>
                                        <div class="col-sm-4 col-6 fs-3 text-start title-pizza">
                                            <?= $changedItem ?>
                                            <span class="centimeter">/ <?= $item[4] ?> см</span>
                                        </div>
                                        <div class="col-lg-3 col-sm-2 col-6 fs-3 pizza-price item-price"><?= $item[5] ?> Р</div>
                                        <div class="col-sm-2 col-6 text-start main-group">
                                            <div class="btn-group ms-3">
                                                <button class="btn btn-warning btn-minus btn-quantity" type="submit" data-id="<?= $item[5] ?>">-</button>
                                                <button class="btn btn-warning btn-number btn-quantity"><?= $item[6] ?></button>
                                                <button class="btn btn-warning btn-plus btn-quantity" style="border-radius: 0 6px 6px 0;" type="submit" data-id="<?= $item[5] ?>">+</button>
                                                <div class="d-none">
                                                    <input type="text" name="image" value=<?= $item[2] ?>>
                                                    <input type="text" name="size" value=<?= $item[4] ?>>
                                                    <input type="text" name="quantity" value=<?= $item[6] ?>>
                                                    <input type="text" name="mark">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                        <div class="col-lg-1 col-sm-2 col-4 btn-delete">
                                            <form class="form-close" action="src/actions/removeProduct.php" method="post">
                                                <button type="submit" class="btn-close" aria-label="Close"></button>  
                                                <input class="d-none" name="id" type="text" value=<?= $item[0] ?>>  
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php
                        $first = false;
                    ?>
                </div>
                <?php
            }
        }
        ?>

    <div class="m-3 invisible">ds</div>
    
    <?php
        if ($items) {
            ?>
                <div class="container d-flex justify-content-end align-items-center">
                    <span class="fw-semibold fs-4 me-3 general-sum">Общая сумма: 
                        <span class="fw-bold sum">
                            
                        </span> 
                    P</span>
                    <button class="btn btn-warning fw-semibold ps-4 pe-4 pt-2 pb-2 btn-recyclebin">Заказать</button>
                </div>
            <?php
        }
    ?>

    <div class="m-5 invisible">ds</div>

    <?php include_once 'components/footer.php' ?>

    <script src="js/isInvisible.js"></script>
    <script src="js/recyclebin.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/mark.js"></script>
</body>
</html>