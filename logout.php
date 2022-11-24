<?php
session_start();
include 'app/settings/path.php';
unset($_SESSION['id']);
unset($_SESSION['login']);
unset($_SESSION['admin']);
unset($_SESSION['favourites']);
unset($_SESSION['totalPrice']);

header('location: /');
