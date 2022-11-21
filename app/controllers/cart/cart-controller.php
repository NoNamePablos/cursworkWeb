<?php
$cartArray=array();
$totalPrice=0;
if(isset($_SESSION['favourites'])){
    foreach (array_unique($_SESSION['favourites']) as $item){
        if(!empty($item)){
            $card_auto=selectOne('automobile',['id'=>$item]);
            var_dump($card_auto);
            $totalPrice+=$card_auto['price'];
            array_push($cartArray,$card_auto);
        }
    }
    $_SESSION['totalPrice']=$totalPrice;

}