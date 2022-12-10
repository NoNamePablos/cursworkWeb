<?php
include '../../app/settings/path.php';
include '../../app/settings/db_functions.php';

include '../../app/controllers/brand-controller.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="theme-color" content="#111111"/>
    <title>Kurs</title>
    <link rel="stylesheet" href="/style.css"/>
</head>

<body>
<div class="container container-admin">
	<?php include('../../app/snippets/header.php'); ?>
    <section class="admin">
        <div class="admin-container">
			<?php include('../../app/snippets/sidebar.php'); ?>

            <div class="admin-wrapper">
                <div class="admin-manage">
                    <a href="<?= BASE_URL . 'admin/users/index.php'; ?>" class="button button-dark-purple">Назад</a>
                    <!--                                        <a href="-->
					<? //=BASE_URL.'admin/catalog/index.php';?><!--" class="admin-table--manage_btn btn btn-success">Вернуться назад</a>-->
                </div>
                <div class="admin-form">
                    <div class="card-form">
                        <div class="card-form-wrapper">
                            <h2 class="card-form__title title-clash title-clash-2">Редактирование бренда</h2>

                            <form action="create.php" method="post" class="card-form-form">
                                <p class="Error">
									<?= $errMsg ?>
                                </p>
                                <div class="card-form-form__item">
                                    <input type="hidden" name="id-brand" value="<?= $id_brand; ?>" ">
                                    <div class="input-label">
                                        <input type="text" name="name" placeholder="Введите название бренда"
                                               class="input-label__input input" value="<?= $name ?>">
                                    </div>
                                </div>
                                <div class="card-form-form__item">
                                    <div class="input-label">
                                        <input type="text" name="country" placeholder="Введите город\страну"
                                               class="input-label__input input" value="<?= $country ?>">
                                    </div>
                                </div>

                                <div class="card-form-form__item">
                                    <button name="btn-edit-brand-admin" type="submit"
                                            class="card-form-form__button button button-dark-purple button-no-border">
                                        Редактировать
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<?php include('../../app/snippets/footer.php') ?>
</div>
<script src="/assets/js/main.js"></script>
</body>
</html>
