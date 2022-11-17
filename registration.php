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
    <div class="card-form">
        <div class="card-form-wrapper">
            <h2 class="card-form__title title-clash title-clash-2">Регистрация</h2>

            <form action="registration.php" method="post" class="card-form-form">
                <p class="Error">
                    <?=$errMsg?>
                </p>
                <p>
                    <?= $email?>
                </p>
                <div class="card-form-form__item">
                    <div class="input-label">
                        <input type="text" name="login" placeholder="Введите login" class="input-label__input input">
                    </div>
                </div>
                <div class="card-form-form__item">
                    <div class="input-label">
                        <input type="text" name="email" placeholder="Введите email" class="input-label__input input">
                    </div>
                </div>
                <div class="card-form-form__item">
                    <div class="input-label">
                        <input type="password" name="password-first" placeholder="Введите пароль" class="input-label__input input">
                    </div>
                </div>
                <div class="card-form-form__item">
                    <div class="input-label">
                        <input type="password" name="password-second" placeholder="Повторите пароль" class="input-label__input input">
                    </div>
                </div>
                <div class="card-form-form__item">
                    <button name="btn-registration" type="submit" class="card-form-form__button button button-dark-purple button-no-border">Регистрация</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <?php include('app/snippets/footer.php');?>
</div>
<script src="/assets/js/main.js"></script>
</body>
</html>
