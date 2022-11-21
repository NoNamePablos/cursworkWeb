<?php
include 'app/settings/path.php';
include 'app/settings/db_functions.php';
include 'app/controllers/users.php';
include 'app/controllers/catalog-auto.php';
include 'app/controllers/cart/cart-controller.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="./style.css"/>
    <title>kurs</title>
</head>
<body>
<div class="container">
    <?php include('app/snippets/header.php'); ?>
    <div class="subheader">
        <h1 class="subheader__title title-clash title-clash-2">
            Продажа автомобилей с пробегом в Москве
        </h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>index.php" class="breadcrumb-link">Главная</a></li>
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>catalog.php" class="breadcrumb-link">Каталог</a></li>
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>detail.php/cardid=<?= $auto['id'] ?>"
                                           class="breadcrumb-link"><?= $auto['full_name'] ?></a></li>
        </ul>
    </div>
    <div class="detail basket">
        <div class="detail__container">
            <div class="detail-body">
                <div class="detail-body__item">
                    <div class="basket-item">
                        <div class="basket-price">
                            <p>Итого:</p>
                            <p class="basket-price__total"><?=$_SESSION['totalPrice']?>₽</p>
                        </div>
                        <button class="button button-no-border button-primary">Оформить заказ</button>
                        <!--                        <button class="button-remove"></button>-->
                    </div>
                </div>
                <div class="detail-body__item">
                    <div class="basket-item">
                        <p class="basket-count">В корзине <?=count($cartArray)?> товар</p>
                        <button class="button button-no-border button-primary">Очистить</button>
<!--                        <button class="button-remove"></button>-->
                    </div>
                </div>
                <div class="detail-body__item">
                    <div class="basket-card">
                       <?php foreach ($cartArray as $key=>$item):?>
                        <div class="basket-card__item" data-cardid="<?=$item['id']?>">
                            <img src="<?=BASE_URL?>/upload/assets/img/cars/<?=$item['img_preview']?>">
                            <div class="basket-card__column">
                                <span class="basket-card__title"><?=$item['full_name']?></span>
                                <span><?=$item['year']?></span>
                            </div>
                            <span class="basket-card__price"><?=$item['price'];?>₽</span>
                            <button class="button-remove js-remove"><span></span></button>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('app/snippets/footer.php') ?>
</div>
<script src="./assets/js/vendor/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>
