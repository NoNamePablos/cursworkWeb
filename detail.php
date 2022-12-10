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
    <div class="detail">
        <div class="detail__container">
            <section class="detail-body">
                <!-- Detail swiper -->
                <div class="detail-body__item">
                    <div
                            class="detail-body__item-slider card-slider swiper js-slider">
                        <div class="swiper-wrapper">
							<?php foreach ($auto_images as $key => $auto_image): ?>
                                <div class="swiper-slide card-slider__item">
                                    <img src="<?= BASE_URL . '/upload/assets/img/cars/' . $auto_image['img']; ?>"/>
                                </div>
							<?php endforeach; ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination card-slider__pagination">
                            <span class="swiper-pagination-current">1</span> /
                            <span class="swiper-pagination-total">9</span>
                        </div>
                    </div>
                </div>
                <!-- Detail info -->
                <div class="detail-body__item">
                    <div class="detail-body__item-header">
                        <p class="title-clash title-clash-2">
                            Характеристики автомобиля
                        </p>
                    </div>
                    <div class="detail-body__item-body">
                        <ul class="detail-body__item-list">
                            <li><b>Мощность</b><span><?= $car_info['engine_power'] ?></span></li>
                            <li><b>Коробка</b><span><?= $car_info['transmission'] ?></span></li>
                            <li><b>Двигатель</b><span><?= $car_info['engine'] ?></span></li>
                            <li><b>Привод</b><span><?= $car_info['privod'] ?></span></li>

                        </ul>
                    </div>
                </div>
                <div class="detail-body__item">
                    <div class="detail-body__item-header">
                        <p class="title-clash title-clash-2">Описание</p>
                    </div>
                    <div class="detail-body__item-body">
                        <p class="detail-body__item-description">
							<?= $car_info['description'] ?>
                        </p>
                    </div>
                </div>
                <!--Отзывы-->
                <div class="detail-body__item js-animation-target">
                    <div class="detail-body__item-header">
                        <p class="title-clash title-clash-2">Отзывы</p>
                        <div class="review-control">
							<?php if (isset($_SESSION['id'])): ?>
                                <div class="card-form">
                                    <div class="card-form-wrapper">
                                        <form method="post" class="card-form-form js-form"
                                              enctype="multipart/form-data">
                                            <p class="Error">
												<?= $errMsg ?>
                                            </p>
                                            <div class="card-form-form__item">
                                                <input type="hidden" name="id" class="input-user"
                                                       value="<?= $_SESSION['id']; ?>">
                                                <input type="hidden" class="input-auto" name="id_auto"
                                                       value="<?= $auto['id']; ?>">
                                                <div class="input-label">
                                                    <p>Оценка</p>
                                                    <input type="number" name="score_scope" min="1" value="1" step='1'
                                                           max="5"
                                                           class="input-label__input input input-score">
                                                </div>
                                            </div>
                                            <div class="card-form-form__item">
                                                <div class="input-label">
                                                    <p>Достоинства</p>
                                                    <textarea name="review_positiv_text"
                                                              class="js-positiv-text"></textarea>
                                                </div>
                                            </div>
                                            <div class="card-form-form__item">
                                                <div class="input-label">
                                                    <p>Недостатки</p>
                                                    <textarea name="review_negative_text"
                                                              class="js-negativ-text"></textarea>
                                                </div>
                                            </div>
                                            <div class="card-form-form__item">
                                                <button name="" type="button"
                                                        class=" js-append-review card-form-form__button button button-dark-purple button-no-border">
                                                    Добавить
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
							<?php else: ?>
                                <a class="button button-danger"
                                   href="<?= BASE_URL ?>authorization.php">Авторизация</a>
							<?php endif; ?>
                        </div>
                        <div class="detail-body__item-body">
                            <div class="review-body">
			                    <?php foreach ($car_comments as $key => $car_comment): ?>
                                    <div class="review-card" data-commentid="<?= $car_comment['id'] ?>">
                                        <?php if($_SESSION["admin"]):?>
                                        <div class="review-card__close js-review-close">X</div>
                                        <?php endif;?>
                                        <div class="review-card__block">
                                            <div class="review-card__item">
                                                <p>Пользователь</p>
                                                <span><?= $car_comment['login'] ?></span>
                                            </div>
                                            <div class="review-card__item">
                                                <p>Оценка</p>
                                                <span><?= $car_comment['score_scope'] ?></span>/ <span>5</span>
                                            </div>
                                        </div>
                                        <div class="review-card__item">
                                            <p>Достоинства</p>
                                            <div class="review-card__pole">
                                                <p><?= $car_comment['review_positiv_text'] ?></p>
                                            </div>
                                        </div>
                                        <div class="review-card__item">
                                            <p>Недостатки</p>
                                            <div class="review-card__pole">
                                                <p><?= $car_comment['review_negative_text'] ?></p>
                                            </div>

                                        </div>
                                    </div>
			                    <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <aside class="detail-payment">
                <div class="detail-payment__container">
                    <div class="detail-payment-price">
                        <span><?= $auto['price'] ?></span>
                        <span>₽</span>
                    </div>
	                <?php if($auto['status']):?>
                    <div class="detail-payment-availabile">В наличии</div>
	                <?php else :?>
                    <div class="detail-payment-availabile">Нет в наличии</div>
	                <?php endif;?>
                    <div class="detail-payment-buttons">
                        <?php if($auto['status']):?>
	                        <?php if(!itemInCart($auto['id'])||isset($_SESSION['id'])):?>
                                <button data-carid="<?=$auto['id']?>" class="js-cart button button-no-border button-primary">
                                    Добавить в избранное
                                </button>
	                        <?php else :?>
                                <button data-carid="<?=$auto['id']?>" class="button-disabled button button-no-border button-primary">
                                    Добавить в избранное
                                </button>
	                        <?php endif;?>
                        <?php else :?>
                            <button  class="button-disabled button button-no-border button-primary">
                                Добавить в избранное
                            </button>
                            <?php endif?>

                        <button class="button button-no-border button-dark-purple js-animation">
                            Смотреть отзывыв
                        </button>
	                    <?php if($_SESSION['admin']):?>
                        <a class="button button-no-border button-primary" href="<?BASE_URL?>admin/catalog/edit.php?edit_id=<?= $auto['id']; ?>">Редактировать</a>
	                    <?php endif;?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
	<?php include('app/snippets/footer.php') ?>
</div>
<script src="./assets/js/vendor/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>
