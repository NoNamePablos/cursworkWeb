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
            Заказ
        </h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>index.php" class="breadcrumb-link">Главная</a></li>
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>cart.php" class="breadcrumb-link">Заказ</a></li>
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
                        <button class="button button-no-border button-primary js-cart-form">Оформить заказ</button>
                        <!--                        <button class="button-remove"></button>-->
                    </div>
                </div>
                <div class="detail-body__item">
                    <div class="basket-item">
                        <p class="basket-count">В корзине <?=count($cartArray)?> товар</p>
                        <button class="button button-no-border button-primary js-remove-all">Очистить</button>
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
                <div class="detail-body__item detail-body-hidden js-cart-basket">
                    <div class="basket-item">
                        <div class="card-form">
                            <div class="card-form-wrapper">
                                <h2 class="card-form__title title-clash title-clash-2">Оформление заказа</h2>
                                <form  method="post" class="card-form-form">

                                    <p class="Error">
                                        <?=$errMsg?>
                                    </p>
                                    <p>
                                        <?= $email?>
                                    </p>
                                    <div class="card-form-form__item">
                                        <div class="input-label">
                                            <input type="hidden" class="input-id-user-baket" value="<?=$_SESSION['id']?>" >
                                            <?php foreach ($cartArray as $key=>$item):?>
                                            <input type="hidden" class="input-basket-item" data-basketitemid="<?=$item['id']?>">
                                            <?php endforeach;?>
                                            <input type="text" name="username" placeholder="Имя получателя" class="input-label__input input input-username">
                                        </div>
                                    </div>
                                    <div class="card-form-form__item">
                                        <div class="input-label">
                                            <input type="tel" name="telephone" placeholder="Введите телефон" class="input-label__input input input-tel">
                                        </div>
                                    </div>
                                    <div class="card-form-form__item">
                                        <div class="input-label">
                                            <input type="address" name="telephone" placeholder="Введите телефон" class="input-address input-label__input input">
                                        </div>
                                    </div>
                                    <div class="card-form-form__item">
                                        <button name="" type="button" class="card-form-form__button button button-dark-purple button-no-border js-cart-basket-button">Добавить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
