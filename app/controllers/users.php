<?php

$isSubmit=false;
$errMsg='';
$users_admin=selectAll('users');

if($_SERVER['REQUEST_METHOD']==='POST' && (isset($_POST['btn-registration'])||isset($_POST['btn-registration-admin']))){
    $login=trim($_POST['login']);
    $email=trim($_POST['email']);

    $passwordSecond=trim($_POST['password-second']);
    $passwordFirst=trim($_POST['password-first']);
    $admin=0;
    if($login===""||$email===""||$passwordSecond===""||$passwordFirst===""){
        $errMsg="Не все поля заполнены !";
    }elseif(mb_strlen($login,'UTF8')<2){
        $errMsg="Логин не может быть меньше 2-х символов!ы";
    }elseif($passwordFirst!==$passwordSecond){
        $errMsg="Не правильные пароли!";
    }
    else{
        $checkMail=selectOne('users',['email'=>$email]);
        $checkLogin=selectOne('users',['login'=>$login]);

        if($checkMail['email']===$email){
            $errMsg="Эта почта уже зарегистрирована!";
        }elseif($checkLogin['login']===$login){
            $errMsg="Этот логин уже используется!";
        }else{
            $password=password_hash($_POST['password-second'],PASSWORD_DEFAULT);
            if(isset($_POST['admin']))$admin=1;
            $arrData=[
                'admin'=>$admin,
                'login'=>$login,
                'password'=>$password,
                'email'=>trim($email),
            ];
            $id=insert('users',$arrData);
            $isSubmit=true;
            $user=selectOne('users',['id'=>$id]);
            $_SESSION['id'] = $user['id'];
            $_SESSION['login']=$user['login'];
            $_SESSION['admin']=$user['admin'];
            $_SESSION['totalPrice']=0;
            if (!isset($_SESSION['favourites'])) {
                $_SESSION['favourites'] = array();
            }
            if(isset($_POST['btn-registration-admin'])){
                header('location: '. BASE_URL . 'admin/users/index.php');
            }else{
                header('location: /');
            }
        }

    }

//$lastRow=selectOne('users',['id'=>$id]);
}else{
    $login='';
    $email='';


}
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['btn-auth'])){
    $emails=trim($_POST['email']);
    $passwordS=trim($_POST['password']);
    showArr($emails);
    showArr($passwordS);
    if($emails===""||$passwordS===""){
        $errMsg="Не все поля заполнены !";
    }else{
        $checkAuthMail=selectOne('users',['email'=>$emails]);

        if($checkAuthMail && password_verify($passwordS,$checkAuthMail['password'])){
            $_SESSION['id']=$checkAuthMail['id'];
            $_SESSION['login']=$checkAuthMail['login'];
            $_SESSION['admin']=$checkAuthMail['admin'];
            $_SESSION['totalPrice']=0;
            if (!isset($_SESSION['favourites'])) {
                $_SESSION['favourites'] = array();
            }
           /* if($_SESSION['admin']){

            }else{
                header('location: /' );
            }*/
            header('location: /' );
        }else{
            //ошибка авторизации
            $errMsg= 'Почта либо пароль неверный!';
        }
    }
}else{
    $emails='';
}
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['btn-update-settings'])){
    $IdUpdate=$_SESSION['id'];
    $user=selectOne('users',['id'=>$IdUpdate]);
    $passwordOld=trim($_POST['old_password']);
    $passwordNew=trim($_POST['new_password']);
    if(password_verify($passwordOld,$user['password'])){
        $setPassword=$password=password_hash($passwordNew,PASSWORD_DEFAULT);
        update('users',$IdUpdate,['password'=>$setPassword]);
	    header('location: /');
    }
}
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['btn-newpass'])){
    $email=$_POST['email'];
    $user=selectOne('users',['email'=>$email]);


    if($email===$user['email']){
        showArr($user);
        $securitykey=md5(rand(1000,100000));
        update('users',$user['id'],['change_key'=>$securitykey]);
        $url='http://kursweb/newpass.php?key='.$securitykey;
        $message=$user['login'].", был отправлен запрос на востановление пароля!!Для востановления пройлите по ссылке : ". $url." \n";
        if(mail($user['email'],"Подтвердить действие",$message)){
            showArr($user['email']);
        }else{
            echo 'Error';
        }
        header('location: /');
    }

}
if($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['btn-reset'])){
    $seckey=$_GET['key'];
    $user=selectOne('users',['change_key'=>$seckey]);
    if($user){
        $password=$_GET['password'];
        update('users',$user['id'],['password'=>password_hash($password,PASSWORD_DEFAULT),'change_key'=>'NULL']);
        header('location: /');

    }

}
//Авторизация в админке
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['create-user'])){

    $login=trim($_POST['login']);
    $email=trim($_POST['email']);
    $passwordSecond=trim($_POST['password-second']);
    $passwordFirst=trim($_POST['password-first']);
    $admin=0;
    if($login===""||$email===""||$passwordSecond===""||$passwordFirst===""){
        $errMsg="Не все поля заполнены !";
    }elseif(mb_strlen($login,'UTF8')<2){
        $errMsg="Логин не может быть меньше 2-х символов!ы";
    }elseif($passwordFirst!==$passwordSecond){
        $errMsg="Не правильные пароли!";
    }
    else{
        $checkMail=selectOne('users',['email'=>$email]);
        $checkLogin=selectOne('users',['login'=>$login]);

        if($checkMail['email']===$email){
            $errMsg="Эта почта уже зарегистрирована!";
        }elseif($checkLogin['login']===$login){
            $errMsg="Этот логин уже используется!";
        }else{
            $password=password_hash($_POST['password-second'],PASSWORD_DEFAULT);
            if(isset($_POST['admin']))$admin=1;
            $arrData=[
                'admin'=>$admin,
                'login'=>$login,
                'password'=>$password,
                'email'=>trim($email),
            ];
            $id=insert('users',$arrData);
            $isSubmit=true;
            header('location: '.BASE_URL . 'admin/users/index.php');
        }

    }

//$lastRow=selectOne('users',['id'=>$id]);
}else{
    $login='';
    $email='';


}
//Удаление через админку
if($_SERVER['REQUEST_METHOD']==='GET'&&isset($_GET['delete_id'])){
    $id=$_GET['delete_id'];
    delete('users',$id);
    header('location: '. BASE_URL . 'admin/users/index.php');
}
//обновление через админку

if($_SERVER['REQUEST_METHOD']==='GET'&&isset($_GET['edit_id'])){
    $user=selectOne('users',['id'=>$_GET['edit_id']]);
    $id=$user['id'];
    $login=$user['login'];
    $email=$user['email'];
    $admin=$user['admin'];

}
if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST['btn-edit-admin'])){
    $id=$_POST['id'];
    $email=trim($_POST['email']);
    $login=$_POST['login'];
    $passwordOld=trim($_POST['password-first']);
    $passwordNew=trim($_POST['password-second']);
    $admin=isset($_POST['admin'])?1:0;
    if(mb_strlen($login,'UTF8')<2){
        $errMsg="Логин не может быть меньше 2-х символов!ы";
        echo $errMsg;
    }elseif($passwordOld!==$passwordNew){
        $errMsg="Не правильные пароли!";
        echo $errMsg;
    }
    else{
        $pass=password_hash($passwordNew,PASSWORD_DEFAULT);
        if(isset($_POST['admin']))$admin=1;
        $arrData=[
            'admin'=>$admin,
            'login'=>$login,
            'password'=>$pass
        ];
        update('users',$id,$arrData);
        header('location: '.BASE_URL . 'admin/users/index.php');
    }

}


//   $password=password_hash($_POST['password-second'],PASSWORD_DEFAULT);
/*$id=insert('users',$arrData);
$lastRow=selectOne('users',['id'=>$id]);*/

