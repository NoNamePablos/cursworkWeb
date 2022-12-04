<?php
$isSubmit = false;
$errMsg = '';
$users_admin = selectAll('users');
 $ROOT__PATH_FOR_FILES = realpath("../../");
$catalog = selectAllAutoAndBrand('automobile', 'brand');

function moveFile($img)
{
	global $ROOT__PATH_FOR_FILES;
	$prev_name = time() . "_" . $img['name'];
	$prev_TMPname = $img['tmp_name'];
	$destintaiton =  $ROOT__PATH_FOR_FILES . '\\upload\assets\img\cars\\' . $prev_name;
	$res = move_uploaded_file($prev_TMPname, $destintaiton);
	return $prev_name;
}
function reArrayFiles(&$file_post){
	$isMulti    = is_array($file_post['name']);
	$file_count    = $isMulti?count($file_post['name']):1;
	$file_keys    = array_keys($file_post);

	$file_ary    = [];    //Итоговый массив
	for($i=0; $i<$file_count; $i++)
		foreach($file_keys as $key)
			if($isMulti)
				$file_ary[$i][$key] = $file_post[$key][$i];
			else
				$file_ary[$i][$key]    = $file_post[$key];

	return $file_ary;
}

function mail_utf8($to, $from_user, $from_email,
                   $subject = '(No subject)', $message = '')
{
	$from_user = "=?UTF-8?B?" . base64_encode($from_user) . "?=";
	$subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";

	$headers = "From: $from_user <$from_email>\r\n" .
		"MIME-Version: 1.0" . "\r\n" .
		"Content-type: text/html; charset=UTF-8" . "\r\n";

	return mail($to, $subject, $message, $headers);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['append_auto'])) {

	global $ROOT__PATH_FOR_FILES;
	$full_name = trim($_POST['full_name']);
	$brand_selected = trim($_POST['over-selected']);
	$price = trim($_POST['price']);
	$year = trim($_POST['year']);
	$status = isset($_POST['status']) ? 1 : 0;

	$engine_power = trim($_POST['engine_power']);
	$transmission = trim($_POST['transmission']);
	$engine = trim($_POST['engine']);
	$privod = trim($_POST['privod']);
	$description = trim($_POST['description']);

	if (!empty($_FILES['img_preview']['name'])) {
		$auto_prev_name = time() . "_" . $_FILES['img_preview']['name'];
		$auto_prev_TMPname = $_FILES['img_preview']['tmp_name'];
		$destintaiton = $ROOT__PATH_FOR_FILES . '\\upload\assets\img\cars\\' . $auto_prev_name;
		$res = move_uploaded_file($auto_prev_TMPname, $destintaiton);
		if ($res) {
			$_POST['img_preview'] = $auto_prev_name;
		} else {
			$errMsg = "Уккщк";
		}
	}
	if ($full_name === "" || $brand_selected === "" || !is_numeric($price) || !is_numeric($year)) {
		$errMsg = "Не все поля заполнены !";
	} else {
		$arrData = [
			'full_name' => $full_name,
			'id_brand' => $brand_selected,
			'status' => $status,
			'price' => $price,
			'year' => $year,
			'img_preview' => $_POST['img_preview'],

		];
		$id = insert('automobile', $arrData);
		$arrInfo = [
			'engine_power' => $engine_power,
			'engine' => $engine,
			'transmission' => $transmission,
			'privod' => $privod,
			'description' => $description,
			'id_auto' => $id,
		];
		$id_info = insert('specifications', $arrInfo);

		if (count($_FILES['img_files']) > 0) {
			$file_count = count($_FILES['img_files']);
			$res = [];
			$format_files = reArrayFiles($_FILES['img_files']);
			for ($i = 0; $i < count($format_files); $i++) {
				$arrData = [
					'id_auto' => (int)$id,
					'img' => moveFile($format_files[$i]),
				];
				$id_file = insert('upload_table', $arrData);
			}

		}
		header('location: ' . BASE_URL . 'admin/catalog/index.php');
	}
} else {
	$login = '';
	$email = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_auto'])) {

	global $ROOT__PATH_FOR_FILES;
	$full_name = trim($_POST['full_name']);
	$brand_selected = trim($_POST['over-selected']);
	$price = trim($_POST['price']);
	$year = trim($_POST['year']);
	$status = isset($_POST['status']) ? 1 : 0;

	$engine_power = trim($_POST['engine_power']);
	$transmission = trim($_POST['transmission']);
	$engine = trim($_POST['engine']);
	$privod = trim($_POST['privod']);
	$description = trim($_POST['description']);

	if (!empty($_FILES['img_preview']['name'])) {
		$auto_prev_name = time() . "_" . $_FILES['img_preview']['name'];
		$auto_prev_TMPname = $_FILES['img_preview']['tmp_name'];
		$destintaiton = $ROOT__PATH_FOR_FILES . '\\upload\assets\img\cars\\' . $auto_prev_name;
		$res = move_uploaded_file($auto_prev_TMPname, $destintaiton);
		if ($res) {
			$_POST['img_preview'] = $auto_prev_name;
		} else {
			$errMsg = "Уккщк";
		}
	}
	if ($full_name === "" || $brand_selected === "" || !is_numeric($price) || !is_numeric($year)) {
		$errMsg = "Не все поля заполнены !";
	} else {
		$arrData = [
			'full_name' => $full_name,
			'id_brand' => $brand_selected,
			'status' => $status,
			'price' => $price,
			'year' => $year,
			'img_preview' => $_POST['img_preview'],

		];
		$id = $_POST['id-auto'];
		update('automobile', $id, $arrData);
//		$id = insert('automobile', $arrData);
		$arrInfo = [
			'engine_power' => $engine_power,
			'engine' => $engine,
			'transmission' => $transmission,
			'privod' => $privod,
			'description' => $description,
			'id_auto' => $id,
		];
		$car_info = selectOne('specifications', ['id_auto' => $id]);
		update('specifications', $car_info['id'], $arrInfo);
		if (count($_FILES['img_files']) > 0) {
			$file_count = count($_FILES['img_files']);
			$res = [];
			$format_files = reArrayFiles($_FILES['img_files']);
			deleteAuto('upload_table', $id);
			for ($i = 0; $i < count($format_files); $i++) {
				$arrData = [
					'id_auto' => (int)$id,
					'img' => moveFile($format_files[$i]),
				];

				$id_file = insert('upload_table', $arrData);
			}

		}
		header('location: ' . BASE_URL . 'admin/catalog/index.php');
	}
} else {
	$login = '';
	$email = '';
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['carid'])) {
	$auto = selectOne('automobile', ['id' => $_GET['carid']]);
	$id = $auto['id'];
	$full_name = trim($auto['full_name']);
	$price = trim($auto['price']);
	$year = trim($auto['year']);
	$auto_images = selectAll('upload_table', ['id_auto' => (int)$id]);
	$car_info = selectOne('specifications', ['id_auto' => $id]);
	$car_comments = selectAllComments('auto_comments', 'users',$id);
}


//
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
	$id = $_GET['pub_id'];
	$status = $_GET['publish'];
	$film = selectOne('films', ['id_film' => $id]);
	updateFilms('films', $id, ['status' => $status]);
	if ($status == 1) {
		$usersAll = selectAll('users');
		foreach ($usersAll as $user) {
			mail_utf8($user['email'],
				'test123mail12311@mail.ru',
				'test123mail12311@mail.ru',
				"added new film",
				'Новый фильм уже на сайте ' . $film['film_name']
			);
		}
	}
	header('location: ' . BASE_URL . 'admin/films/index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['status_id'])) {
	$id = $_GET['status_id'];
	$status = $_GET['top'];
	$film = selectOne('films', ['id_film' => $id]);
	updateFilms('films', $id, ['film_top' => $status]);
	header('location: ' . BASE_URL . 'admin/films/index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
	$id = $_GET['pub_id'];
	$status = $_GET['publish'];
	$film = selectOne('films', ['id_film' => $id]);
	updateFilms('films', $id, ['status' => $status]);
	if ($status == 1) {
		$usersAll = selectAll('users');
		foreach ($usersAll as $user) {
			mail_utf8($user['email'],
				'test123mail12311@mail.ru',
				'test123mail12311@mail.ru',
				"added new film",
				'Новый фильм уже на сайте ' . $film['film_name']
			);
		}
	}
	header('location: ' . BASE_URL . 'admin/films/index.php');
}

//Добавить в избранное
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fav'])) {

	$fav_id = $_GET['fav'];
	if (!isset($_SESSION['favourites'])) {
		$fav_array = array();
		$_SESSION['favourites'] = $fav_array;
	}
	array_push($_SESSION['favourites'], $fav_id);
	header('location: ' . BASE_URL . 'detalnaya.php?film=' . $fav_id);
}



if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
	$auto = selectOne('automobile', ['id' => $_GET['edit_id']]);
	$id = $auto['id'];
	$full_name = trim($auto['full_name']);
	$price = trim($auto['price']);
	$year = trim($auto['year']);
	$auto_images = selectAll('upload_table', ['id_auto' => (int)$id]);
	$car_info = selectOne('specifications', ['id_auto' => $id]);
	$car_comments = selectAllComments('auto_comments', 'users', $id);

}


//Удаление через админку
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
	$id = $_GET['delete_id'];
	delete('automobile', $id);
	deleteAuto('specifications', $id);
	deleteAuto('upload_table', $id);

	header('location: ' . BASE_URL . 'admin/catalog/index.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['deletefav_id'])) {

	foreach ($_SESSION['favourites'] as $item) {

		foreach ($_SESSION['favourites'] as $key => $value) {
			if ($value == $_GET['deletefav_id']) {
				unset($_SESSION['favourites'][$key]);
			}
		}
	}
}




//   $password=password_hash($_POST['password-second'],PASSWORD_DEFAULT);
/*$id=insert('users',$arrData);
$lastRow=selectOne('users',['id'=>$id]);*/

