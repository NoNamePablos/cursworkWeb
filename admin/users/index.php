<?php
include '../../app/settings/path.php';
include '../../app/settings/db_functions.php';
include '../../app/controllers/users.php';
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
            <aside class="sidebar">
                <ul class="sidebar-list">
                    <li class="sidebar-list__item">
                        <a href="<?=BASE_URL?>/admin/catalog/index.php" class="sidebar-list__link">Каталог</a>
                    </li>
                    <li class="sidebar-list__item">
                        <a href="<?=BASE_URL?>/admin/users/index.php" class="sidebar-list__link">Пользователи</a>
                    </li>
                </ul>
            </aside>
            <div class="admin-wrapper">
                <div class="admin-manage">
                    <a href="<?=BASE_URL.'admin/users/create.php';?>" class="button button-dark-purple">Добавить</a>
                    <!--                                        <a href="--><?//=BASE_URL.'admin/catalog/index.php';?><!--" class="admin-table--manage_btn btn btn-success">Вернуться назад</a>-->
                </div>
                <div class="admin-table">
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Логин</th>
                            <th>Email</th>
                            <th>Admin</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users_admin as $key=>$user_admin):?>
                            <tr>
                                <td><?= $user_admin['id']; ?></td>
                                <td><?= $user_admin['login']; ?></td>
                                <td><?= $user_admin['email']; ?></td>
		                        <?php if ($user_admin['admin'] == 1): ?>
                                    <td>Админ</td>
		                        <?php else: ?>
                                    <td>Пользователь</td>
		                        <?php endif; ?>
                                <td class="admin-table-control">
                                    <a class="button button-primary" href="edit.php?edit_id=<?= $user_admin['id']; ?>">Редактировать</a>
			                        <?php if ($_SESSION['id'] != $user_admin['id']): ?>
                                        <a class="button button-danger"
                                           href="index.php?delete_id=<?= $user_admin['id']; ?>">Удалить</a>
			                        <?php else: ?>
                                        <a class="button button-disabled button-danger"
                                           href="index.php?delete_id=<?= $user_admin['id']; ?>">Удалить</a>
			                        <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php include ('../../app/snippets/footer.php')?>
</div>
<script src="/assets/js/main.js"></script>
</body>
</html>
