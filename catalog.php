<?php
include 'app/settings/path.php';
include 'app/settings/db_functions.php';
include 'app/controllers/users.php';
include 'app/controllers/catalog-auto.php';
include 'app/controllers/catalog-filter.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="./style.css"/>
    <title>kurs</title>
  </head>
  <body>
    <div class="container">
        <?php include('app/snippets/header.php');?>
      <div class="subheader">
        <h1 class="subheader__title title-clash title-clash-2">
          Продажа автомобилей с пробегом в Москве
        </h1>
      </div>
      <div class="catalog">
        <div class="catalog-container">
          <aside class="catalog-filter">
            <form class="catalog-form" action="" method="get">
              <div class="filter-card active" >
                <div class="filter-card__header">
                  <p class="filter-card__title">Бренд</p>
                  <i class="filter-card__ico" aria-hidden="true"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="5"
                      height="3"
                      viewBox="0 0 5 3">
                      <path
                        class="cls-1"
                        d="M250,80h5l-2.5,3Z"
                        transform="translate(-250 -80)"></path></svg
                  ></i>
                </div>
                <div class="filter-card__body">
                  <div class="filter-card__wrapper filter-card-flex">
                    <div class="filter-card__list filter-card-brand">
                        <?php foreach ($brands as $key => $brand):?>
                        <label
                                for="<?=$brand['id']?>" data-filterid="<?=$brand['id']?>"
                                class="filter-card-checkbox custom-checkbox">
                            <input type="checkbox" id="<?=$brand['id']?>" />
                            <span><?=$brand['name'];?></span>
                        </label>
                        <?php endforeach;?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="filter-card">
                <div class="filter-card__header">
                  <p class="filter-card__title">Цена</p>
                  <i class="filter-card__ico" aria-hidden="true"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="5"
                      height="3"
                      viewBox="0 0 5 3">
                      <path
                        class="cls-1"
                        d="M250,80h5l-2.5,3Z"
                        transform="translate(-250 -80)"></path></svg
                  ></i>
                </div>
                <div class="filter-card__body">
                  <div class="filter-card__wrapper filter-card-flex filter-card-pricevalue">
                    <div class="input-label">
                      <input
                        type="number"
                        min="100000"
                        max="999999999"
                        placeholder="100 000"
                        class="input-label__input input input-first" />
                    </div>
                    <div class="input-label">
                      <input
                        type="number"
                        min="100000"
                        max="999999999"
                        placeholder="999 999 999"
                        class="input-label__input input input-second" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="filter-card">
                <div class="filter-card__header">
                  <p class="filter-card__title">Год</p>
                  <i class="filter-card__ico" aria-hidden="true"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="5"
                      height="3"
                      viewBox="0 0 5 3">
                      <path
                        class="cls-1"
                        d="M250,80h5l-2.5,3Z"
                        transform="translate(-250 -80)"></path></svg
                  ></i>
                </div>
                <div class="filter-card__body">
                  <div class="filter-card__wrapper filter-card-flex filter-card-yearvalue">
                    <div class="input-label">
                      <input
                        type="number"
                        min="2002"
                        max="2022"
                        placeholder="2002"
                        class="input-label__input input input-first" />
                    </div>
                    <div class="input-label">
                      <input
                              type="number"
                              min="2002"
                              max="2022"
                              placeholder="2022"
                              class="input-label__input input input-second"/>
                    </div>
                  </div>
                </div>
              </div>
                <div class="wrap">
                    <button type="button" class="sign-up__button button button-danger button-filter">
                        <span>Фильтровать</span>
                    </button>
                </div>
            </form>
          </aside>
            <section class="catalog-cards">
                <ul class="catalog-grid">
			        <?php foreach ($catalog as $key => $catalogItem): ?>
                        <?php if($key>5):?>
                        <li class="catalog-grid__item catalog-grid--hidden ">
                         <?php else:?>
                            <li class="catalog-grid__item ">
                        <?php endif;?>
                            <div class="card-product" data-ddd="">
                                <a href="<?= BASE_URL ?>detail.php?carid=<?= $catalogItem['id'] ?>"
                                   class="card-product__link"></a>
                                <img
                                        src="<?= BASE_URL . '/upload/assets/img/cars/' . $catalogItem['img_preview']; ?>"
                                        alt="<?= $catalogItem['full_name'] ?>"
                                        class="card-product__img"/>
                                <div class="card-product__description">
                                    <h4 class="title-clash title-clash-4 card-product__title">
								        <?= $catalogItem['full_name'] ?>
                                    </h4>
                                    <p
                                            class="title-satoshi title-satoshi-body-large card-product__price">
								        <?= $catalogItem['price'] ?> <span>₽/шт</span>
                                    </p>
                                    <p
                                            class="title-satoshi title-satoshi-body-large card-product__price">
								        <?= $catalogItem['year'] ?> <span>года</span>
                                    </p>
                                </div>
                            </div>
                        </li>
			        <?php endforeach; ?>
                    <!--Pagination-->

                </ul>
	            <?php include("app/snippets/pagination.php") ?>

            </section>
        </div>
      </div>
	    <?php include('app/snippets/footer.php'); ?>
    </div>
    <script id="goods-template" type="text/template">
        <li class="catalog-grid__item">
            <div class="card-product">
                <a href="<?= BASE_URL ?>detail.php?carid=${id}"
                   class="card-product__link"></a>
                <img
                        src="<?= BASE_URL . '/upload/assets/img/cars/' ?>${img_preview}"
                        alt=" ${full_name}"
                        class="card-product__img"/>
                <div class="card-product__description">
                    <h4 class="title-clash title-clash-4 card-product__title">
					    ${full_name}
                    </h4>
                    <p
                            class="title-satoshi title-satoshi-body-large card-product__price">
					    ${price} <span>₽/шт</span>
                    </p>
                    <p
                            class="title-satoshi title-satoshi-body-large card-product__price">
					    ${year} <span>года</span>
                    </p>
                </div>
            </div>
        </li>
    </script>
    <script id="hidden-template" type="text/template">
        <li class="catalog-grid__item catalog-grid--hidden">
            <div class="card-product">
                <a href="<?= BASE_URL ?>detail.php?carid=${id}"
                   class="card-product__link"></a>
                <img
                        src="<?= BASE_URL . '/upload/assets/img/cars/' ?>${img_preview}"
                        alt=" ${full_name}"
                        class="card-product__img"/>
                <div class="card-product__description">
                    <h4 class="title-clash title-clash-4 card-product__title">
                        ${full_name}
                    </h4>
                    <p
                            class="title-satoshi title-satoshi-body-large card-product__price">
                        ${price} <span>₽/шт</span>
                    </p>
                    <p
                            class="title-satoshi title-satoshi-body-large card-product__price">
					    ${year} <span>года</span>
                    </p>
                </div>
            </div>
        </li>
    </script>
    <script src="./assets/js/vendor/jquery.js"></script>
    <script src="assets/js/vendor/jqueryTemplate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="/assets/js/main.js"></script>
  </body>
</html>
