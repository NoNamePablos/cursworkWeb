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
                    <a href="<?= BASE_URL . 'admin/brand/create.php'; ?>" class="button button-dark-purple">Добавить</a>
                    <!--                                        <a href="-->
					<? //=BASE_URL.'admin/catalog/index.php';?><!--" class="admin-table--manage_btn btn btn-success">Вернуться назад</a>-->
                </div>
                <div class="admin-table">
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>название</th>
                            <th>город</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ($brands as $key => $brand): ?>
                            <tr>
                                <td><?= $brand['id']; ?></td>
                                <td><?= $brand['name']; ?></td>
                                <td><?= $brand['country']; ?></td>
                                <td class="admin-table-control">
                                    <a class="button button-primary" href="edit.php?edit_id=<?= $brand['id']; ?>">Редактировать</a>
                                        <a class="button button-danger"
                                           href="index.php?delete_id=<?= $brand['id']; ?>">Удалить</a>
                                </td>
                            </tr>
						<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
	<?php include('../../app/snippets/footer.php') ?>
</div>
<script src="/assets/js/main.js"></script>
</body>
</html>
