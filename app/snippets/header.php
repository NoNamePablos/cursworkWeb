<header class="header">
    <div class="header__top">
        <a href="<?=BASE_URL?>index.php"><h1 class="header__title">Avion</h1></a>
        <div class="header__list">
            <a href="<?=BASE_URL?>catalog.php" class="header__list-link">Каталог</a>
        </div>
        <div class="header__top-right">
            <?php if($_SESSION['id']):?>
            <a href="<?=BASE_URL?>cart.php" class="header__cart">
                <img src="<?=BASE_URL?>/assets/img/UI/Shopping--cart.svg" alt="Cart" />
            </a>
            <?php endif;?>
            <div class="header__user-container">
                <?php if(isset($_SESSION['id'])):?>
                <a href="<?=BASE_URL?>authorization.php" class="header__user js-popup">
                    <img src="<?=BASE_URL?>/assets/img/UI/User--avatar.svg" alt="User" />
                </a>
                <?php else:?>
                <a href="<?=BASE_URL?>authorization.php" class="header__user js-popup js-auth">
                    <img src="<?=BASE_URL?>/assets/img/UI/User--avatar.svg" alt="User" />
                </a>
                <?php endif;?>
            </div>
            <ul class="header__user-menu js-mobile">
                <div class="header__user-menu-auth">
                    <p class="title-satoshi title-satoshi-body-medium">
                        Добро пожаловать,
                    </p>
                    <h4 class="title-satoshi title-satoshi-body-large"><?=$_SESSION["login"]?></h4>
                </div>
                <?php if($_SESSION["admin"]):?>
                <li class="header__user-menu-item header__user-menu-admin">
                    <a href="<?=BASE_URL?>admin/catalog/index.php" class="header__user-menu-link">Админка</a>
                </li>
                <?php endif;?>
                <?php if($_SESSION["id"]):?>
                    <li class="header__user-menu-item ">
                        <a href="<?=BASE_URL?>order.php" class="header__user-menu-link">Доставка</a>
                    </li>
                    <li class="header__user-menu-item ">
                        <a href="<?=BASE_URL?>settings.php" class="header__user-menu-link">Настройки</a>
                    </li>
                <?php endif;?>

                <li class="header__user-menu-item header__user-menu-mobile">
                    <a href="<?=BASE_URL?>catalog.php" class="header__user-menu-link">Каталог</a>
                </li>

                <li class="header__user-menu-item">
                    <a href="<?=BASE_URL?>logout.php" class="header__user-menu-link">Выход</a>
                </li>
            </ul>
        </div>
    </div>
</header>