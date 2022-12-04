<?php
include '../../app/settings/path.php';
include '../../app/settings/db_functions.php';
include '../../app/controllers/users.php';
include '../../app/controllers/catalog-auto.php';
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
                    <a href="<?= BASE_URL . 'admin/catalog/create.php'; ?>"
                       class="button button-dark-purple">Добавить</a>
                </div>
                <div class="admin-table">
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Полное название</th>
                            <th>Бренд</th>
                            <th>Цена</th>
                            <th>Год</th>
                            <th>Статус</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ($catalog as $key => $catalogItem): ?>
                            <tr>
                                <td><?= $catalogItem['id'] ?></td>
                                <td><?= $catalogItem['full_name'] ?></td>
                                <td><?= $catalogItem['name'] ?></td>
                                <td><?= $catalogItem['price'] ?></td>
                                <td><?= $catalogItem['year'] ?></td>
								<?php if ($catalogItem['status'] == 1): ?>
                                    <td>В наличие</td>
								<?php else: ?>
                                    <td>Не в наличии</td>
								<?php endif; ?>
                                <td class="admin-table-control">
                                    <a class="button button-primary" href="edit.php?edit_id=<?= $catalogItem['id']; ?>">Редактировать</a>
                                    <a class="button button-danger"
                                       href="index.php?delete_id=<?= $catalogItem['id']; ?>">Удалить</a>
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
