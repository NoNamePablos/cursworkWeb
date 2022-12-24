<?php
$cartArray=array();
$totalPrice=0;
if(isset($_SESSION['favourites'])){
    foreach (array_unique($_SESSION['favourites']) as $item){
        if(!empty($item)){
            $card_auto=selectOne('automobile',['id'=>$item]);
            $totalPrice+=$card_auto['price'];
            array_push($cartArray,$card_auto);
        }
    }
    $_SESSION['totalPrice']=$totalPrice;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['car_id'])) {
    $auto = selectOne('automobile', ['id' => $_GET['car_id']]);
    $id_car = $auto['id'];
    $full_name_car = trim($auto['full_name']);
    $price_car = trim($auto['price']);
    $year_car = trim($auto['year']);
}

function itemInCart($id){
    if(isset($_SESSION['favourites'])){
        if(count($_SESSION['favourites'])>0){
            foreach ($_SESSION['favourites'] as $key => $value) {
                if ($value ==$id) {
                    return true;
                }
            }
        }
    }
    return false;
}