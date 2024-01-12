<?php
    session_start();

    require_once 'connect/connect.php';

    $userId = $_SESSION['user']['id'] ?? null;
    $dublicate = $_SESSION['error']['dublicate'] ?? null;
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

    <div class="toast w-50 align-items-center position-fixed top-0 start-50 mt-5 pe-3 ps-3 pt-2 pb-2 popup" style="z-index: 1020; transform: translateX(-50%)" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Чтобы добавить товар в корзину необходимо авторизироваться.
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://logyka.net/assets/templates/media/0117/11117/seo.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://a-static.besthdwallpaper.com/colorful-fruit-juice-wallpaper-1920x600-2950_57.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://a-static.besthdwallpaper.com/pizza-with-extra-cheese-wallpaper-1920x600-43744_57.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Предыдущий</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Следующий</span>
        </button>
    </div>

    <div class="invisible m-2" id="pizzas">s</div>

    <div class="mt-5">
        <div class="container">
            <div class="fs-2 fw-semibold" id="pizzas">Пиццы</div>

            <div class="d-flex flex-row justify-content-around flex-wrap">
                <?php
                    $sqlPizzas = "SELECT * From Pizzas";

                    $pizzas = mysqli_query($connect, $sqlPizzas);
                    $pizzas = mysqli_fetch_all($pizzas);

                    foreach ($pizzas as $item) {
                        $changedTitle = str_replace('.', ' ', $item[2])

                        ?>
                            <div class="col-xxl-3 col-xl-4 col-lg-4">
                                <div class="card mt-4 mb-4 pt-4" style="width: 18rem;">
                                    <img src="<?= $item[1] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $changedTitle ?></h5>
                                        <p class="card-text text-truncate text-secondary"><?= $item[3] ?></p>
                                        <div class="d-flex flex-row justify-content-between align-items-center mt-4">
                                            <span class="fs-5 fw-semibold">От <?= $item[7] ?>P</span>
                                            <?php
                                                    if ($userId) {
                                                        ?>
                                                            <a href="onePizza.php?pizzaId=<?= $item[0] ?>" class="btn btn-warning add-product btn-recyclebin" type="submit" data-log=<?= $userId ?? 0 ?>>В корзину</a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <div class="btn btn-warning add-product btn-recyclebin" id="popup-button" data-log=<?= $userId ?? 0 ?>>В корзину</div>
                                                        <?php
                                                    }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="invisible mt-5 mb-5" id="sauses">s</div>

    <div class="mt-5">
        <div class="container">
            <div class="fs-2 fw-semibold" id="sauses">Соусы</div>

            <div class="d-flex flex-row justify-content-around flex-wrap">
                <?php
                    $sqlSauses = "SELECT * FROM Sauses";

                    $sauses = mysqli_query($connect, $sqlSauses);
                    $sauses = mysqli_fetch_all($sauses);

                    
                    foreach ($sauses as $item) {
                        $changedTitle = str_replace('.', ' ', $item[2]);

                        ?>
                            <div class="col-xxl-3 col-xl-4 col-lg-4">
                                <form action="src/actions/addProduct.php" method="post">
                                    <div class="card mt-4 mb-4 pt-4" style="width: 18rem;">
                                        <img src="<?= $item[1] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-truncate"><?= $changedTitle ?></h5>
                                            <div class="d-flex flex-row justify-content-between align-items-center mt-4">
                                                <span class="fs-5 fw-semibold"><?= $item[3] ?>P</span>
                                                <?php
                                                    if ($userId) {
                                                        ?>
                                                            <button class="btn btn-warning add-product btn-recyclebin" id="toast-button" type="submit" data-log=<?= $userId ?>>В корзину</button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <div class="btn btn-warning add-product btn-recyclebin" id="popup-button" data-log=<?= $userId ?>>В корзину</div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="d-none">
                                            <input type="text" name="id" value=<?= $item[0] ?>>
                                            <input type="text" name="userId" value=<?= $userId ?>>
                                            <input type="text" name="image" value=<?= $item[1] ?>>
                                            <input type="text" name="name" value=<?= $item[2] ?>>
                                            <input type="text" name="price" value=<?= $item[3] ?>>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="invisible mt-5 mb-5" id="drinks">s</div>

    <div class="mt-5">
        <div class="container">
            <div class="fs-2 fw-semibold">Напитки</div>

            <div class="d-flex flex-row justify-content-around flex-wrap">
                <?php
                    $sqlDrinks = "SELECT * FROM Drinks";

                    $drinks = mysqli_query($connect, $sqlDrinks);
                    $drinks = mysqli_fetch_all($drinks);

                    foreach ($drinks as $item) {
                        $changedTitle = str_replace('.', ' ', $item[2]);

                        ?>
                            <div class="col-xxl-3 col-xl-4 col-lg-4">
                                <form action="src/actions/addProduct.php" method="post">
                                    <div class="card mt-4 mb-4 pt-4" style="width: 18rem;">
                                        <img src="<?= $item[1] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-truncate"><?= $changedTitle ?></h5>
                                            <div class="d-flex flex-row justify-content-between align-items-center mt-4">
                                                <span class="fs-5 fw-semibold"><?= $item[3] ?>P</span>
                                                <?php
                                                    if ($userId) {
                                                        ?>
                                                            <button class="btn btn-warning add-product btn-recyclebin" id="toast-button" type="submit" data-log=<?= $userId ?? 0 ?>>В корзину</button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <div class="btn btn-warning add-product btn-recyclebin" id="popup-button" data-log=<?= $userId ?? 0 ?>>В корзину</div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="d-none">
                                            <input type="text" name="id" value=<?= $item[0] ?>>
                                            <input type="text" name="userId" value=<?= $userId ?>>
                                            <input type="text" name="image" value=<?= $item[1] ?>>
                                            <input type="text" name="name" value=<?= $item[2] ?>>
                                            <input type="text" name="price" value=<?= $item[3] ?>>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="m-5 invisible">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint eveniet rerum mollitia animi esse nesciunt sed! Laboriosam rem quia </div>

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
    <script src="js/scroll.js"></script>
    <script src="js/toast.js"></script>
    <script src="js/popup.js"></script>
    <script src="js/menu.js"></script>

    <?php
        $_SESSION['error'] = [];
    ?>
</body>
</html>