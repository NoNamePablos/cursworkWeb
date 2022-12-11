<?php
include 'app/settings/path.php';
include  'app/settings/db_functions.php';
include 'app/controllers/users.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style.css" />
    <title>kurs</title>
</head>
<body>
<div class="container">
    <?php include('app/snippets/header.php');?>
    <?php if(!isset($_SESSION['id'])):?>
    <div class="card-form card-form-auth">
        <div class="card-form-wrapper">
            <h2 class="card-form__title title-clash title-clash-2">Авторизация</h2>

            <form action="authorization.php" method="post" class="card-form-form">
                <p class="Error">
                    <?=$errMsg?>
                </p>
                <p>
                    <?= $email?>
                </p>
                <div class="card-form-form__item">
                    <div class="input-label">
                        <input type="text" name="email" placeholder="Введите email" class="input-label__input input">
                    </div>
                </div>
                <div class="card-form-form__item">
                    <div class="input-label">
                        <input type="password" name="password" placeholder="Введите password" class="input-label__input input">
                    </div>
                </div>
                <div class="card-form-form__item">
                    <button name="btn-auth" type="submit" class="card-form-form__button button button-dark-purple button-no-border">Авторизация</button>
                    <button type="button" class="card-form-form__button button button-dark-purple button-no-border js-button-reset">Востановление</button>
                    <a href="<?=BASE_URL?>registration.php" class="card-form-form__link">Зарегистрироваться</a>
                </div>
            </form>
        </div>
    </div>
        <div class="card-form hidden card-form-reset">
            <div class="card-form-wrapper">
                <h2 class="card-form__title title-clash title-clash-2">Востановить пароль</h2>
                <form action="authorization.php" method="post" class="card-form-form">
                    <p class="Error">
					    <?=$errMsg?>
                    </p>
                    <p>
					    <?= $email?>
                    </p>
                    <div class="card-form-form__item">
                        <div class="input-label">
                            <input type="text" name="email" placeholder="Введите email" class="input-label__input input">
                        </div>
                    </div>
                    <div class="card-form-form__item">
                        <button name="btn-reset-pass" type="submit" class="card-form-form__button button button-dark-purple button-no-border">Востановить</button>
                        <button type="button" class="card-form-form__button button button-dark-purple button-no-border js-button-auth">Авторизация</button>
                        <a href="<?=BASE_URL?>registration.php" class="card-form-form__link">Зарегистрироваться</a>
                    </div>

                </form>
            </div>
        </div>
    <?php else:?>
    <div>404</div>
    <?php endif;?>
    <!-- Footer -->
    <?php include('app/snippets/footer.php');?>
</div>
<script src="/assets/js/main.js"></script>
</body>
</html>
