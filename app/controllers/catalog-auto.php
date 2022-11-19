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
			'img_preview'=>$_POST['img_preview'],

		];
		$id = insert('automobile', $arrData);

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


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['carid'])) {
	$auto = selectOne('automobile', ['id' => $_GET['carid']]);
	$id = $auto['id'];
	$full_name = trim($auto['full_name']);
	$price = trim($auto['price']);
	$year = trim($auto['year']);
	$auto_images=selectAll('upload_table',['id_auto'=>(int)$id]);
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


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_film'])) {
	if (!empty($_FILES['film_preview']['name'])) {
		$film_prev_name = time() . "_" . $_FILES['film_preview']['name'];
		$film_prev_TMPname = $_FILES['film_preview']['tmp_name'];
		$destintaiton = $ROOT__PATH_FOR_FILMS . '\assets\uploads\\' . $film_prev_name;
		$res = move_uploaded_file($film_prev_TMPname, $destintaiton);
		if ($res) {
			$_POST['film_preview'] = $film_prev_name;
		} else {
			$errMsg = "Уккщк";
		}
	} else {
		$errMsg = "Уккщк1";
	}
	if (!empty($_FILES['film_video']['name'])) {
		$film_prev_name = time() . "_" . $_FILES['film_video']['name'];
		$film_prev_TMPname = $_FILES['film_video']['tmp_name'];
		$destintaiton = $ROOT__PATH_FOR_FILMS . '\\assets\\uploads\\' . $film_prev_name;
		$res = move_uploaded_file($film_prev_TMPname, $destintaiton);
		if ($res) {
			$_POST['film_video'] = $film_prev_name;
		} else {
			$errMsg = "Уккщк";
		}
	} else {
		$errMsg = "Уккщк1";
	}
	$id_film = trim($_POST['id']);
	$title = trim($_POST['film_name']);
	$descr = trim($_POST['film_description']);
	$acters = trim($_POST['film_acters']);
	$preview = trim($_POST['film_preview']);
	$world_money = trim($_POST['film_world_money']);
	$rus_money = trim($_POST['film_rus_money']);
	$year = trim($_POST['film_year']);
	$genres = trim($_POST['film_genres']);
	$director = trim($_POST['film_director']);
	$film_contry = trim($_POST['film_country']);
	$publish = isset($_POST['publish']) ? 1 : 0;
	$top = isset($_POST['film_top']) ? 1 : 0;
	if ($title === "" || $descr === "" || $acters === "" || $genres === "") {
		$errMsg = "Не все поля заполнены !";
	} elseif (mb_strlen($title, 'UTF8') < 2) {
		$errMsg = "Логин не может быть меньше 2-х символов!ы";
	} else {
		$arrData = [
			'film_year' => $year,
			'film_country' => $film_contry,
			'film_genres' => $genres,
			'film_time' => 120,
			'film_preview' => $_POST['film_preview'],
			'film_video' => $_POST['film_video'],
			'film_director' => $director,
			'film_acters' => $acters,
			'film_description' => $descr,
			'film_name' => $title,
			'film_world_money' => (int)$world_money,
			'film_rus_money' => (int)$rus_money,
			'status' => $publish,
			'id_user' => $_SESSION['id'],
			'film_top' => $top
		];
		showArr($id_film);
		showArr($arrData);

		updateFilms('films', $id_film, $arrData);
		header('location: ' . BASE_URL . 'admin/films/index.php');
	}

}


//Удаление через админку
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
	$id = $_GET['delete_id'];
	deleteFilms('films', $id);
	header('location: ' . BASE_URL . 'admin/films/index.php');
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

