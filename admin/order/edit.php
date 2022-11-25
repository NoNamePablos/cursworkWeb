<?php
include '../../app/settings/path.php';
include '../../app/settings/db_functions.php';
include '../../app/controllers/users.php';
include '../../app/controllers/order/order-controller.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="theme-color" content="#111111" />
    <title>Kurs</title>
    <link rel="stylesheet" href="/style.css" />
</head>

<body>
<div class="container container-admin">
    <?php include('../../app/snippets/header.php');?>
    <section class="admin">
        <div class="admin-container">
	        <?php include('../../app/snippets/sidebar.php'); ?>

            <div class="admin-wrapper">
                <div class="admin-manage">
                    <a href="<?=BASE_URL.'admin/users/index.php';?>" class="button button-dark-purple">Назад</a>
                    <!--                                        <a href="--><?//=BASE_URL.'admin/catalog/index.php';?><!--" class="admin-table--manage_btn btn btn-success">Вернуться назад</a>-->
                </div>
                <div class="admin-form">
                    <div class="card-form">
                        <div class="card-form-wrapper">
                            <h2 class="card-form__title title-clash title-clash-2">Редактирование</h2>

                            <form action="edit.php" method="post" class="card-form-form">
                                <p class="Error">
                                    <?=$errMsg?>
                                </p>
                                    <div class="card-form-form__item">
                                        <input type="hidden"  name="id" value="<?=$id;?>" ">
                                        <select class="form-control" name="over-selected" id="exampleFormControlSelect1">
                                            <option value="-1">Выбрать</option>
			                                <?php foreach ( $status as $status_item): ?>
                                                <option value="<?= $status_item['id']; ?>"><?= $status_item['name']; ?></option>
			                                <?php endforeach; ?>
                                        </select>
                                    </div>

                                <div class="card-form-form__item">
                                    <button name="btn-edit-order" type="submit" class="card-form-form__button button button-dark-purple button-no-border">Редактирова</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include ('../../app/snippets/footer.php')?>
</div>
<script src="/assets/js/main.js"></script>
</body>
</html>
