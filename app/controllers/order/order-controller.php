<?php
if(isset($_SESSION['id'])){
	$order_cart=selectAllOrderParams('cart_order','users','cart_status','automobile',$_SESSION['id']);
}
if(isset($_SESSION['admin'])){
	$order_cartAdmins=selectAllOrder('cart_order','users','cart_status','automobile');
	var_dump($order_cartAdmins);
}
if($_SERVER['REQUEST_METHOD']==='GET'&&isset($_GET['edit_id'])){
	$order=selectOne('cart_order',['id'=>$_GET['edit_id']]);
	$id=$order['id'];
	$status=selectAll('cart_status');
}

if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST['btn-edit-order'])){
	$id=$_POST['id'];
	$select=$_POST['over-selected'];

	if($select==4){
		$arrData=[
			'id_status'=>$select,
			'status_cancel'=>1,
		];
	}else{
		$arrData=[
			'id_status'=>$select,
		];
	}
		update('cart_order',$id,$arrData);
		header('location: '.BASE_URL . 'admin/order/index.php');
}
if($_SERVER['REQUEST_METHOD']==='GET'&&isset($_GET['delete_id'])){
		$id=$_GET['delete_id'];
		delete('cart_order',$id);
		header('location: '.BASE_URL . 'admin/order/index.php');
}