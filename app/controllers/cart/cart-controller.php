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


function itemInCart($id){
    if(count($_SESSION['favourites'])>0){
        foreach ($_SESSION['favourites'] as $key => $value) {
            if ($value ==$id) {
                return true;
            }
        }
    }
    return false;
}