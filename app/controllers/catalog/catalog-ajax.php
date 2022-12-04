<?php
include "../../settings/path.php";
include "../../settings/db_functions.php";


try {

	global $pdo;
	// Возвращаем клиенту успешный ответ
	echo json_encode(array(
		'code' => 'success',
		'data' => selectAllAutoAndBrandCatalog('automobile','brand',getOptions()),
	));
}
catch (Exception $e) {
	// Возвращаем клиенту ответ с ошибкой

}
function getOptions() {
//	// Категория и цены
//	$minPrice = (isset($_GET['min_price'])) ? (int)$_GET['min_price'] : 0;
//	$maxPrice = (isset($_GET['max_price'])) ? (int)$_GET['max_price'] : 1000000;

	// Бренды
	$brands = isset($_GET['brands'])?$_GET['brands'] : null;
	$pricewr_min=isset($_GET['price_wrap']['minValue'])?$_GET['price_wrap']['minValue']:null;
	$pricewr_max=isset($_GET['price_wrap']['maxValue'])?$_GET['price_wrap']['maxValue']:null;
	$year_min=isset($_GET['year_wrap']['minYear'])?$_GET['year_wrap']['minYear']:null;
	$year_max=isset($_GET['year_wrap']['maxYear'])?$_GET['year_wrap']['maxYear']:null;


	return array(
		'brands' => $brands,
		'min_price' => $pricewr_min,
		'max_price' => $pricewr_max,
		'min_year'=>$year_min,
		'max_year'=>$year_max,
//		'sort_by' => $sortBy,
//		'sort_dir' => $sortDir
	);
}
