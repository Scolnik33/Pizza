<?php
    session_start();
    require_once 'connect/connect.php';
    
    $userId = $_SESSION['user']['id'] ?? null;
    $dublicate = $_SESSION['error']['dublicate'] ?? null;

    $definityPizza = $_GET['pizzaId'];

    $sql = "SELECT * FROM Pizzas WHERE pizzaId='$definityPizza'";

    
    $pizza = mysqli_query($connect, $sql);
    $pizza = mysqli_fetch_assoc($pizza);

    $changedTitle = str_replace('.', ' ', $pizza['name']);

    $sqlPrices = "SELECT price24, price30, price38 FROM Pizzas WHERE pizzaId='$definityPizza'";

    $sqlPrices = mysqli_query($connect, $sqlPrices);
    $sqlPrices = mysqli_fetch_assoc($sqlPrices);
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

    <div class="container mt-5">
        <div class="row align-items-center ps-4 pe-4">
            <div class="col-md-6 col-12 mb-2">
                <img class="w-100" src="<?= $pizza['Image'] ?>" alt="">
            </div>
            <div class="col-md-6 col-12">
                <div class="fs-2 fw-semibold"><?= $changedTitle ?></div>
                <div class="fs-6 mt-2 mb-3"><?= $pizza['includes'] ?></div>
                <div class="d-flex flex-row align-items-center flex-wrap">
                    <div class="fs-5 me-4">Выбери размерчик:</div>
                    <div class="btn-group mt-2" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                        <label class="btn btn-warning ps-3 pe-3 btn-price btn-size" data-price="<?= $sqlPrices['price24']; ?>" for="btnradio1"><?= $pizza['size24'] ?> см</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                        <label class="btn btn-warning ps-3 pe-3 btn-price btn-size" data-price="<?= $sqlPrices['price30']; ?>" for="btnradio2"><?= $pizza['size30'] ?> см</label>
    
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                        <label class="btn btn-warning ps-3 pe-3 btn-price btn-size" data-price="<?= $sqlPrices['price38']; ?>" for="btnradio3"><?= $pizza['size38'] ?> см</label>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between align-items-center flex-wrap mt-3">
                    <div class="d-flex flex-row align-items-center mt-2">
                        <div class="fs-5 fw-semibold pizza-price me-3 one-pizza-price"><?= $pizza['price24'] ?> P</div>
                        <div class="btn-group ms-3">
                            <button href="#" class="btn btn-warning btn-minus btn-quantity-one-pizza">-</button>
                            <button href="#" class="btn btn-warning btn-number btn-quantity-one-pizza">1</button>
                            <button href="#" class="btn btn-warning btn-plus btn-quantity-one-pizza">+</button>
                        </div>
                    </div>
                    <form action="src/actions/addProduct.php" method="post">
                        <button type="submit" class="btn btn-warning btn-recyclebin-one-pizza mt-2" id="toast-button">В корзину</button>
                        <div class="d-none">
                            <input type="text" name="id" value=<?= $pizza['pizzaId'] ?>>
                            <input type="text" name="userId" value=<?= $userId ?>>
                            <input type="text" name="image" value=<?= $pizza['Image'] ?>>
                            <input type="text" name="name" value=<?= $pizza['name'] ?>>
                            <input type="text" name="size" class="post">
                            <input type="text" name="price" class="post">
                            <input type="text" name="quantity" class="post">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="m-5 invisible">ds</div>
    <div class="m-5 invisible">ds</div>

    <?php include_once 'components/footer.php' ?>

    <?php
        if (!$dublicate) {
            ?>
                <div class="toast align-items-center position-fixed bottom-0 end-0 me-4 mb-4 warning" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            Товар успешно добавлен в корзину!
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            <?php
        } else {
            ?>
                <div class="toast align-items-center position-fixed bottom-0 end-0 me-4 mb-4 warning" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            Количество увеличено. 
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            <?php
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/choosePizza.js"></script>
    <script src="js/toast.js"></script>
    <script src="js/scroll.js"></script>

    <?php
        $_SESSION['error'] = [];
    ?>
</body>
</html>