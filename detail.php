<?php
include 'app/settings/path.php';
include 'app/settings/db_functions.php';
include 'app/controllers/users.php';
include './app/controllers/catalog-auto.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./style.css" />
    <title>kurs</title>
  </head>
  <body>
    <div class="container">
	    <?php include('app/snippets/header.php'); ?>
      <div class="subheader">
        <h1 class="subheader__title title-clash title-clash-2">
          Продажа автомобилей с пробегом в Москве
        </h1>
      </div>
      <div class="detail">
        <div class="detail__container">
          <section class="detail-body">
            <!-- Detail swiper -->
            <div class="detail-body__item">
              <div
                class="detail-body__item-slider card-slider swiper js-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($auto_images as $key => $auto_image):?>
                  <div class="swiper-slide card-slider__item">
                    <img src="<?=BASE_URL .'/upload/assets/img/cars/'. $auto_image['img'];?>" />
                  </div>
                <?php endforeach;?>
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
                  <li><b>Цвет</b><span>fsdadf</span></li>
                  <li><b>Цвет</b><span>fsdadf</span></li>
                  <li><b>Цвет</b><span>fsdadf</span></li>
                </ul>
              </div>
            </div>
            <div class="detail-body__item">
              <div class="detail-body__item-header">
                <p class="title-clash title-clash-2">Описание</p>
              </div>
              <div class="detail-body__item-body">
                <p class="detail-body__item-description">
                  - V-образный, 8-цилиндровый бензиновый двигатель 5.6 (VK56),
                  7-ст АКПП (JR711E), полный привод - 405 л.с. 560 Н*м, 6.6 сек
                  до 100 км/ч - выпуск – ноябрь 2014 год - пробег - 74.700 км -
                  владельцы - 4 ⠀ Цвет: белый перламутр Салон: черная кожа ⠀
                  Комплектация: TOP (максимальная комплектация), японская
                  сборка, светодиодные фары, светодиодные задние фонари, 4-х
                  зонный климат-контроль, бесключевой доступ, люк,
                  мультифункциональное рулевое колесо с обогревом, передние
                  сиденья с электроприводом, вентиляцией, подогревом и
                  мониторами в подголовниках, память водительского сиденья,
                  задние сиденья с регулировкой спинки и подогревом, система
                  ISOFIX, адаптивный круиз-контроль, ассистент сохранения
                  полосы, система предотвращения столкновения с функцией
                  автоматического торможения, аудиосистема BOSE, камеры
                  кругового обзора 360, датчики парковки спереди и сзади, датчик
                  дождя и света, декоративные планки c отделкой деревом,
                  электропривод крышки багажника, 20" Легкосплавные диски и
                  многое другое. ⠀ Дополнительно: изготовлены на заказ
                  анатомические передние сиденья, передняя часть автомобиля
                  оклеена защитной пленкой, установлен оригинальный обвес Nismo
                  (оригинальные бампера в комплекте), сигнализация с
                  автозапуском, фаркоп. ⠀ Два комплекта колес на дисках зима /
                  лето ⠀ Обслуживание у Официального дилера и в профильном
                  сервисе. Пройдена диагностика в @unionmotorsrus ⠀ Автомобиль
                  находится на крытой освещенной парковке AutoLab по адресу: г.
                  Москва, ул. Киевская, д.8 (метро Киевская) ⠀ Для
                  дополнительной информации по автомобилю +7-985-770-60-01 (есть
                  мессенджеры)
                </p>
              </div>
            </div>
            <!--Отзывы-->
            <div class="detail-body__item">
              <div class="detail-body__item-header">
                <p class="title-clash title-clash-2">Отзывы</p>
                <div class="detail-body__item-body"></div>
              </div>
            </div>
          </section>
          <aside class="detail-payment">
            <div class="detail-payment__container">
              <div class="detail-payment-price">
                <span>6 390 000</span>
                <span>₽</span>
              </div>
              <div class="detail-payment-availabile">В наличие</div>
              <div class="detail-payment-buttons">
                <button class="button button-no-border button-primary">
                  Добавить в избранное
                </button>
                <button class="button button-no-border button-dark-purple">
                  Смотреть отзывыв
                </button>
              </div>
            </div>
          </aside>
        </div>
      </div>
	    <?php include('app/snippets/footer.php') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="/assets/js/main.js"></script>
  </body>
</html>
