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
                    <!--        --><?php
                    //        include "../../app/snippets/admin_sidebar.php";?>
                                    <div class="admin-manage">
                                        <a href="<?=BASE_URL.'admin/catalog/create.php';?>" class="button button-dark-purple">Добавить</a>
<!--                                        <a href="--><?//=BASE_URL.'admin/catalog/index.php';?><!--" class="admin-table--manage_btn btn btn-success">Вернуться назад</a>-->
                                    </div>
                                    <div class="admin-table">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Название</th>
                                                <th>Цена</th>
                                                <th>Наличие</th>
                                                <th>Добавлено на сайт?</th>
                                                <th>Управление</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Jaguar F-Type 3.0 S/C F-Type British Design Edition AWD Coupe 2016</td>
                                                <td>6 390 000 </td>
                                                <td>В наличие</td>
                                                <td>Нет</td>
                                                <td class="admin-table-control">
                                                    <a class="button button-primary" href="edit.php?id=1">Редактировать</a>
                                                    <a class="button button-danger" href="index.php?delete_id=1">Удалить</a>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Jaguar F-Type 3.0 S/C F-Type British Design Edition AWD Coupe 2016</td>
                                                <td>6 390 000 </td>
                                                <td>В наличие</td>
                                                <td>Нет</td>
                                                <td class="admin-table-control">
                                                    <a class="button button-primary" href="edit.php?id=1">Редактировать</a>
                                                    <a class="button button-danger" href="index.php?delete_id=1">Удалить</a>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Jaguar F-Type 3.0 S/C F-Type British Design Edition AWD Coupe 2016</td>
                                                <td>6 390 000 </td>
                                                <td>В наличие</td>
                                                <td>Нет</td>
                                                <td class="admin-table-control">
                                                    <a class="button button-primary" href="edit.php?id=1">Редактировать</a>
                                                    <a class="button button-danger" href="index.php?delete_id=1">Удалить</a>
                                                </td>

                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>



<!--                                <table class="admin-table table align-middle">-->
<!--                                    <thead>-->
<!--                                    <tr>-->
<!--                                        <th scope="col">ID</th>-->
<!--                                        <th scope="col">Добавил</th>-->
<!--                                        <th scope="col">Время</th>-->
<!--                                        <th scope="col">Название фильма</th>-->
<!--                                        <th scope="col">Ссылка на фильм</th>-->
<!--                                        <th scope="col">Ссылка на превью</th>-->
<!--                                        <th scope="col">Актеры</th>-->
<!--                                        <th scope="col">Режисер</th>-->
<!--                                        <th scope="col">Время</th>-->
<!--                                        <th scope="col">Описание</th>-->
<!--                                        <th scope="col">Мировые сборы</th>-->
<!--                                        <th scope="col">Сборы в России</th>-->
<!--                                        <th scope="col">Год</th>-->
<!--                                        <th scope="col">Управление</th>-->
<!--                                        <th scope="col">Опубликовано</th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody>-->
<!--                                    --><?php //foreach ( $filmsAdm as $key=> $film):?>
<!--                                        <tr>-->
<!--                                            <th scope="row">--><?//=$key+1;?><!--</th>-->
<!--                                            <td>--><?//=$film['username'];?><!--</td>-->
<!--                                            <td>--><?//=$film['created_date'];?><!--</td>-->
<!--                                            <td>--><?//=$film['film_name'];?><!--</td>-->
<!--                                            <td>--><?//=$film['film_video'];?><!--</td>-->
<!--                                            <td>--><?//=$film['film_preview'];?><!--</td>-->
<!--                                            <td class="admin-table__description">-->
<!--                                                <p>-->
<!--                                                    --><?//=$film['film_acters'];?>
<!--                                                </p>-->
<!--                                            </td>-->
<!--                                            <td class="admin-table__description">-->
<!--                                                <p>-->
<!--                                                    --><?//=$film['film_director'];?>
<!--                                                </p>-->
<!--                                            </td>-->
<!--                                            <td>--><?//=$film['film_time'];?><!--</td>-->
<!--                                            <td class="admin-table__description">-->
<!--                                                <p>-->
<!--                                                    --><?//=$film['film_description'];?>
<!--                                                </p>-->
<!--                                            </td>-->
<!--                                            <td>--><?//=$film['film_world_money'];?><!--</td>-->
<!--                                            <td>--><?//=$film['film_rus_money'];?><!--</td>-->
<!--                                            <td>--><?//=$film['film_year'];?><!--</td>-->
<!--                                            <td class="admin-table-control">-->
<!--                                                <a class="admin-table-control_btn btn-primary" href="edit.php?id=--><?//=$film['id_film'];?><!--">edit</a>-->
<!--                                                <a class="admin-table-control_btn btn-danger" href="index.php?delete_id=--><?//=$film['id_film'];?><!--">delete</a>-->
<!--                                            </td>-->
<!--                                            --><?php //if($film['status']):?>
<!--                                                <td class="status"><a href="edit.php?publish=0&pub_id=--><?//=$film['id_film'];?><!--">unpublish</a></td>-->
<!--                                            --><?php //else:?>
<!--                                                <td class="status"><a href="edit.php?publish=1&pub_id=--><?//=$film['id_film'];?><!--">publish</a></td>-->
<!--                                            --><?php //endif; ?>
<!--                                            --><?php //if($film['film_top']):?>
<!--                                                <td class="status"><a href="edit.php?top=0&status_id=--><?//=$film['id_film'];?><!--">Открепить</a></td>-->
<!--                                            --><?php //else:?>
<!--                                                <td class="status"><a href="edit.php?top=1&status_id=--><?//=$film['id_film'];?><!--">Закрепить</a></td>-->
<!--                                            --><?php //endif; ?>
<!--                                        </tr>-->
<!--                                    --><?php //endforeach; ?>
<!--                                    </tbody>-->
<!--                                </table>-->
                </div>
            </div>
        </section>
        <?php include ('../../app/snippets/footer.php')?>
    </div>
<script src="/assets/js/main.js"></script>
</body>
</html>
