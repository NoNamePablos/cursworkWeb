<?php
include "../../settings/path.php";
include "../../settings/db_functions.php";

//Это php заглушка которая обрабатывает AJAX (Корзина)

if(isset($_POST['remove_all'])){
    foreach ($_SESSION['favourites'] as $key => $value) {
            unset($_SESSION['favourites'][$key]);
    }
    $_SESSION['totalPrice']=0;
    echo 0;
    exit();
}
if (isset($_POST['id_auto'])) {
    $fav_id = $_POST['id_auto'];
    if (!isset($_SESSION['favourites'])) {
        $_SESSION['favourites'] = array();
    }
    array_push($_SESSION['favourites'], $fav_id);
    echo 1;
    exit();
}
if (isset($_POST['id_remove'])) {
    $totalPrice=0;


        foreach ($_SESSION['favourites'] as $key => $value) {
            if ($value == $_POST['id_remove']) {
                unset($_SESSION['favourites'][$key]);
            }else{
                $card_auto=selectOne('automobile',['id'=>$value]);
                $totalPrice+=$card_auto['price'];
            }
        }
    $_SESSION['totalPrice']=$totalPrice;
    echo $totalPrice;
    exit();
}
