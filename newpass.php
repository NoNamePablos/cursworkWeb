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
			<h2 class="card-form__title title-clash title-clash-2">Востановление</h2>

			<form action="newpass.php" method="get" class="card-form-form">
				<p class="Error">
					<?=$errMsg?>
				</p>
				<input type="hidden" name="key" value="<?=$_GET['key']?>">
				<div class="card-form-form__item">
					<div class="input-label">
						<input type="password" name="new_password" placeholder="Введите новый пароль" class="input-label__input input">
					</div>
				</div>
				<div class="card-form-form__item">
					<button name="btn-update-pass" type="submit" class="card-form-form__button button button-dark-purple button-no-border">Востановить</button>
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
