<?php
include "../../settings/path.php";
include "../../settings/db_functions.php";

if (isset($_POST['username']) && isset($_POST['telephone']) && isset($_POST['id_user'])) {
    global $pdo;
    $id = $_POST['id_user'];
    $username=$_POST['username'];
    $telephone=$_POST['telephone'];
    $address=$_POST['address'];
    $cartItems=$_POST['items'];
    $status=selectOne('cart-status',['name'=>'В работе']);
    if(count($cartItems)>0){
        foreach ($cartItems as $key => $value) {
            $arrData = [
                'id_user' => $id,
                'username' => $username,
                'telephone' => $telephone,
                'address'=>$address,
                'id_auto' => $value,
                'id_status'=>$status['id'],
            ];
            $lastId = insert('cart-order', $arrData);
        }
    }
    echo 1;
    exit();
}