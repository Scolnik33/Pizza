<?php
    if ($_SERVER['REQUEST_URI'] == '/index.php') {
        ?>
            <nav class="navbar navbar-expand-lg shadow sticky-top" style="background-color: #ffbb78; z-index: 1000000;">
                <div class="container justify-content-between ps-4 pe-4">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand order-first" href="index.php#top">
                        <img src="Images/Logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                        <span class="text-uppercase fw-semibold text-body-secondary">PhPizza</span>
                    </a>
                    <div class="collapse navbar-collapse justify-content-between menu" id="navbarSupportedContent">
                        <div></div>
                        <div class="d-flex flex-wrap">
                            <a href="#pizzas" class="ps-1 pe-4 pt-1 pb-1 text-dark text-decoration-none fw-semibold header_nav col-12 col-lg-4 nav_item">Пиццы</a>
                            <a href="#sauses" class="ps-1 pe-4 pt-1 pb-1 text-dark text-decoration-none fw-semibold header_nav coд-12 col-lg-4 nav_item">Соусы</a>
                            <a href="#drinks" class="ps-1 pe-4 pt-1 pb-1 text-dark text-decoration-none fw-semibold header_nav col-12 col-lg-4 nav_item">Напитки</a>
                        </div>
                        <div>
                        <?php
                                if ($userId) {
                                    ?>
                                        <form action="src/actions/logout.php" method="post">
                                            <a href="recyclebin.php" class="text-decoration-none">
                                                <img src="Images/RecycleBin.png" alt="" class="me-2" style="width: 40px; height: auto;">
                                            </a>
                                            <button type="submit" class="btn btn-warning btn-logout">Выйти</button>
                                        </form>
                                    <?php
                                } else {
                                    ?>
                                        <a href="login.php" class="btn btn-warning btn-logout">Войти</a>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </nav>
        <?php
    } else {
        ?>
            <nav class="navbar sticky-top shadow" style="background-color: #ffbb78;">
                <div class="container ps-4 pe-4">
                    <a class="navbar-brand col-md-4" href="index.php">
                        <img src="Images/Logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                        <span class="text-uppercase fw-semibold text-body-secondary">PhPizza</span>
                    </a>
                    <div class="col-md-3 text-end">
                    <?php
                            if ($userId) {
                                ?>
                                    <form action="src/actions/logout.php" method="post">
                                        <a href="recyclebin.php" class="text-decoration-none">
                                            <img src="Images/RecycleBin.png" alt="" class="me-2" style="width: 40px; height: auto;">
                                        </a>
                                        <button type="submit" class="btn btn-warning btn-logout">Выйти</button>
                                    </form>
                                <?php
                            } else {
                                ?>
                                    <a href="login.php" class="btn btn-warning">Войти</a>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </nav>
        <?php
    }
?>