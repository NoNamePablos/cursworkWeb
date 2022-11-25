<?php
include '../../app/settings/path.php';
include '../../app/settings/db_functions.php';
include '../../app/controllers/users.php';
include '../../app/controllers/catalog-auto.php';
include '../../app/controllers/cart/cart-controller.php';
include '../../app/controllers/order/order-controller.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
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
                <div class="admin-table">
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Статус</th>
                            <th>Получатель</th>
                            <th>Телефон</th>
                            <th>Адрес</th>
                            <th>id auto</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($order_cartAdmins as $key=>$item):?>
                            <tr>
                                <td><?= $item['id']; ?></td>
                                <td><?= $item['name']; ?></td>
                                <td><?= $item['username']; ?></td>
                                <td><?= $item['telephone']; ?></td>
                                <td><?= $item['address']; ?></td>
                                <td><?= $item['full_name']; ?></td>
                                <td class="admin-table-control">
                                    <?php if(!$item['status_cancel']):?>
                                    <a class="button button-primary" href="edit.php?edit_id=<?= $item['id']; ?>">Редактировать</a>
                                    <?php else:?>
                                    <a class="button button-primary button-disabled" href="edit.php?edit_id=<?= $item['id']; ?>">Редактировать</a>
                                    <?php endif;?>
                                    <a class="button  button-danger"
                                       href="index.php?delete_id=<?= $item['id']; ?>">Удалить</a>
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
