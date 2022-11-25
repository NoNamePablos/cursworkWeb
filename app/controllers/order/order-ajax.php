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
    $status=selectOne('cart_status',['id'=>1]);
	$arrdta1=[];
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
	        $arrdta1=$arrData;
            $lastId = insert('cart_order', $arrData);
        }
    }
    echo 1;
    exit();
}
if(isset($_POST['order_cancel'])&&isset($_POST['id'])){
	global $pdo;
	$id = $_POST['id'];
	update('cart_order',$id,['id_status'=>4,'status_cancel'=>1]);
	echo 1;
	exit();
}
