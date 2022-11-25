<?php
include 'app/settings/path.php';
include 'app/settings/db_functions.php';
include 'app/controllers/users.php';
include 'app/controllers/catalog-auto.php';
include 'app/controllers/cart/cart-controller.php';
include 'app/controllers/order/order-controller.php';
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
            Доставка
        </h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>index.php" class="breadcrumb-link">Главная</a></li>
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>order.php" class="breadcrumb-link">Доставка</a></li>
        </ul>
    </div>
    <?php if($_SESSION['id']):?>
    <div class="detail basket">
        <div class="detail__container">
            <div class="detail-body">
                <div class="detail-body__item">
                    <div class="basket-card">
                        <?php foreach ($order_cart as $key=>$item):?>
                            <div class="basket-card__item" data-cardid="<?=$item['id_auto']?>" data-orderid="<?=$item['id']?>">
                                <img src="<?=BASE_URL?>/upload/assets/img/cars/<?=$item['img_preview']?>">
                                <div class="basket-card__column">
                                    <span class="basket-card__title"><?=$item['full_name']?></span>
                                    <span><?=$item['year']?></span>
                                </div>
                                <div class="basket-card__column">
                                    <span class="basket-card__price"><?=$item['price'];?>₽</span>
                                    <span class="basket-cart__status-delivery"><?=$item['name']?></span>
                                    <?php if(!$item['status_cancel']):?>
                                    <button type="button" class="button button-danger js-order-cancel">Отменить</button>
                                    <?php else:?>
                                    <button type="button" class="button button-danger button-disabled">Отменить</button>
                                    <?php endif;?>

                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php endif;?>
    <?php include('app/snippets/footer.php') ?>
</div>
<script src="./assets/js/vendor/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>
