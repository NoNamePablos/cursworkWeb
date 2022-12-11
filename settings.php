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
			<h2 class="card-form__title title-clash title-clash-2">Настройки</h2>
            <div class="card-form-settings">
                <button class="button button-primary button-no-border js-button-setting" data-form=".card-form-loginset" >Логин</button>
                <button class="button button-primary button-no-border js-button-setting" data-form=".card-form-emailset" >Email</button>
                <button class="button button-primary button-no-border js-button-setting" data-form=".card-form-passset" >Пароль</button>
            </div>
            <form action="settings.php" method="post" class="card-form-form card-form-loginset hidden">
                <div class="card-form-form__item">
                    <p>Логин</p>
                </div>
                <p class="Error">
					<?=$errMsg?>
                </p>
                <div class="card-form-form__item">
                    <div class="input-label">
                        <input type="text" name="login" placeholder="Введите  логин" class="input-label__input input" value="<?=$userSetting['login'];?>">
                    </div>
                </div>

                <div class="card-form-form__item">
                    <div class="input-label">
                        <input type="text" name="password" placeholder="Введите  пароль" class="input-label__input input">
                    </div>
                </div>

                <div class="card-form-form__item">
                    <button name="btn-update-settings-login" type="submit" class="card-form-form__button button button-dark-purple button-no-border">Сохранить</button>
                </div>
            </form>


            <form action="settings.php" method="post" class="card-form-form card-form-emailset hidden">
                <div class="card-form-form__item">
                    <p>Мейл</p>
                </div>
                <p class="Error">
					<?=$errMsg?>
                </p>
                <div class="card-form-form__item">
                    <div class="input-label">
                        <input type="email" name="email" placeholder="Введите  мейл" value="<?=$userSetting['email'];?>" class="input-label__input input">
                    </div>
                </div>

                <div class="card-form-form__item">
                    <div class="input-label">
                        <input type="text" name="password" placeholder="Введите  пароль" class="input-label__input input">
                    </div>
                </div>

                <div class="card-form-form__item">
                    <button name="btn-update-settings-email" type="submit" class="card-form-form__button button button-dark-purple button-no-border">Сохранить</button>
                </div>
            </form>


			<form action="settings.php" method="post" class="card-form-form card-form-passset hidden">
                <div class="card-form-form__item">
                    <p>Пароль</p>
                </div>
                <p class="Error">
					<?=$errMsg?>
				</p>
				<div class="card-form-form__item">
					<div class="input-label">
						<input type="text" name="old_password" placeholder="Введите старый пароль" class="input-label__input input">
					</div>
				</div>
				<div class="card-form-form__item">
					<div class="input-label">
						<input type="password" name="new_password" placeholder="Введите новый пароль" class="input-label__input input">
					</div>
				</div>
				<div class="card-form-form__item">
					<button name="btn-update-settings" type="submit" class="card-form-form__button button button-dark-purple button-no-border">Сохранить</button>
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
