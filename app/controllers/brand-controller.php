<?php

$isSubmit = false;
$errMsg = '';
$brands = selectAll('brand');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-registration-brand'])) {
	$name = trim($_POST['name']);
	$country = trim($_POST['country']);
	if ($name === "" || $country === "") {
		$errMsg = "Не все поля заполнены !";
	} elseif (mb_strlen($name, 'UTF8') < 2) {
		$errMsg = "Название не может быть меньше 2-х символов!ы";
	} else {
		$checkName = selectOne('brand', ['name' => $name]);

		if ($checkName['name'] === $name) {
			$errMsg = "Этот название уже используется!";
		} else {
			$arrData = [
				'name' => $name,
				'country' => $country,
				'id' => uniqid()
			];
			$id = insert('brand', $arrData);
			$isSubmit = true;
			header('location: ' . BASE_URL . 'admin/brand/index.php');
		}

	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-update'])) {

}

//Удаление через админку
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
	$id = $_GET['delete_id'];
	deleteUseComments('brand', $id);
	$allAutoMobile = selectAll('automobile', ['id_brand' => $id]);
	for ($i = 0; $i < count($allAutoMobile); $i++) {
		deleteAuto('auto_comments', $allAutoMobile[$i]['id']);
	}
	deleteBrandUseStr('automobile',$id);
	header('location: ' . BASE_URL . 'admin/brand/index.php');
}
//обновление через админку

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
	$user = selectOne('users', ['id' => $_GET['edit_id']]);
	$id = $user['id'];
	$login = $user['login'];
	$email = $user['email'];
	$admin = $user['admin'];

}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-edit-admin'])) {
	$id = $_POST['id'];
	$email = trim($_POST['email']);
	$login = $_POST['login'];
	$passwordOld = trim($_POST['password-first']);
	$passwordNew = trim($_POST['password-second']);
	$admin = isset($_POST['admin']) ? 1 : 0;
	if (mb_strlen($login, 'UTF8') < 2) {
		$errMsg = "Логин не может быть меньше 2-х символов!ы";
		echo $errMsg;
	} elseif ($passwordOld !== $passwordNew) {
		$errMsg = "Не правильные пароли!";
		echo $errMsg;
	} else {
		$pass = password_hash($passwordNew, PASSWORD_DEFAULT);
		if (isset($_POST['admin'])) $admin = 1;
		$arrData = [
			'admin' => $admin,
			'login' => $login,
			'password' => $pass
		];
		update('users', $id, $arrData);
		header('location: ' . BASE_URL . 'admin/users/index.php');
	}

}

