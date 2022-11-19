<?php
include '../../app/settings/path.php';
include '../../app/settings/db_functions.php';
include '../../app/controllers/users.php';
include '../../app/controllers/catalog-auto.php';
$brands = selectAll('brand');
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
            <aside class="sidebar">
                <ul class="sidebar-list">
                    <li class="sidebar-list__item">
                        <a href="<?= BASE_URL ?>/admin/catalog/index.php" class="sidebar-list__link">Каталог</a>
                    </li>
                    <li class="sidebar-list__item">
                        <a href="<?= BASE_URL ?>/admin/users/index.php" class="sidebar-list__link">Пользователи</a>
                    </li>
                </ul>
            </aside>
            <div class="admin-wrapper">
                <div class="admin-manage">
                    <a href="<?= BASE_URL . 'admin/catalog/index.php'; ?>" class="button button-dark-purple">Назад</a>
                </div>
                <div class="admin-form">
                    <div class="card-form">
                        <div class="card-form-wrapper">
                            <h2 class="card-form__title title-clash title-clash-2">Добавление автомобиля</h2>

                            <form action="create.php" method="post" class="card-form-form"
                                  enctype="multipart/form-data">
                                <p class="Error">
									<?= $errMsg ?>
                                </p>
                                <div class="card-form-form__item">
                                    <div class="input-label">
                                        <input type="text" name="full_name" placeholder="Полное название автомобиля"
                                               class="input-label__input input">
                                    </div>
                                </div>
                                <div class="card-form-form__item">
                                    <select class="form-control" name="over-selected" id="exampleFormControlSelect1">
                                        <option value="-1">Выбрать</option>
										<?php foreach ($brands as $brand): ?>
                                            <option value="<?= $brand['id']; ?>"><?= $brand['name']; ?></option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="card-form-form__item">
                                    <div class="input-label">
                                        <input type="number" name="price" placeholder="Введите цену"
                                               class="input-label__input input">
                                    </div>
                                </div>
                                <div class="card-form-form__item">
                                    <div class="input-label">
                                        <input type="number" name="year" placeholder="Год"
                                               class="input-label__input input">
                                    </div>
                                </div>
                                <div class="card-form-form__item">
                                    <label for="value-admin" class="filter-card-checkbox custom-checkbox">
                                        <input type="checkbox" name="status" value="1" id="value-admin">
                                        <span>В наличии?</span>
                                    </label>
                                </div>
                                <div class="card-form-form__item">
                                    <div class="input-label">
                                        <input type="file" name="img_files[]" multiple
                                               class="input-label__input input">
                                    </div>
                                </div>
                                <div class="card-form-form__item">
                                    <p>Preview image</p>
                                    <div class="input-label">
                                        <input type="file" name="img_preview"
                                               class="input-label__input input">
                                    </div>
                                </div>
                                <div class="card-form-form__item">
                                    <div class="input-label">
                                        <input type="number" name="engine_power"
                                               class="input-label__input input" placeholder="Мощность л/с">
                                    </div>
                                </div>
                                <div class="card-form-form__item">
                                    <div class="input-label">
                                        <input type="text" name="transmission"
                                               class="input-label__input input" placeholder="Коробка">
                                    </div>
                                </div>
                                <div class="card-form-form__item">
                                    <div class="input-label">
                                        <input type="text" name="engine"
                                               class="input-label__input input" placeholder="Тип двигателя">
                                    </div>
                                </div>
                                <div class="card-form-form__item">
                                    <div class="input-label">
                                        <input type="text" name="privod"
                                               class="input-label__input input" placeholder="Привод">
                                    </div>
                                </div>
                                <div class="card-form-form__item">
                                    <div class="input-label">
                                        <input type="text" name="description"
                                               class="input-label__input input" placeholder="Описание">
                                    </div>
                                </div>
                                <div class="card-form-form__item">
                                    <button name="append_auto" type="submit"
                                            class="card-form-form__button button button-dark-purple button-no-border">
                                        Добавить
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
