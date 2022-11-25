<?php
require('db_connection.php');
session_start();
function showArr($value){
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

//БД чекер на ошибку
function dbCheckError($query){
    $errInfo=$query->errorInfo();
    if($errInfo[0]!=PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
    return true;
}
//Получить все данные из таблицы
function selectAll($table,$params=[]){
    global $pdo;
    $sql="SELECT * From $table";
    if(!empty($params)){
        $i=0;
        foreach ($params as $key=>$value){
            if(!is_numeric($value)){
                $value="'".$value."'";
            }
            if($i===0){
                $sql=$sql . " WHERE $key=$value";
            }else{
                $sql=$sql . " AND $key=$value";
            }
            $i++;
        }
    }

    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

//Выборка 1 записи

function selectOne($table,$params=[]){
    global $pdo;
    $sql="SELECT * From `$table`";
    if(!empty($params)){
        $i=0;
        foreach ($params as $key=>$value){
            if(!is_numeric($value)){
                $value="'".$value."'";
            }
            if($i===0){
                $sql=$sql . " WHERE $key=$value";
            }else{
                $sql=$sql . " AND $key=$value";
            }
            $i++;
        }
    }
    $sql=$sql." LIMIT 1";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

function insert($table,$params=[]){
    /*
 * INSERT INTO `users` (`id`, `admin`, `username`, `password`, `email`, `created`, `age`) VALUES (NULL, '0', 'test', 'test', 'test@mail.ru', CURRENT_TIMESTAMP, '17');
 * */
    global  $pdo;
    $i=0;
    $coll='';
    $mask='';

    foreach ($params as $key =>$value){
        if($i===0){
            $coll=$coll ."$key";
            $mask=$mask."'"."$value"."'";
        }else{
            $coll=$coll .", $key";
            $mask=$mask.", '"."$value"."'";
        }

        $i++;
    }

    $sql="INSERT INTO $table ($coll) VALUES($mask)";
    $query=$pdo->prepare($sql);

    $query->execute($params);
    dbCheckError($query);
    return  $pdo->lastInsertId();
}
function  update($table,$id,$params){
    global  $pdo;
    $i=0;
    $str='';

    foreach ($params as $key =>$value){
        if($i===0){
            $str=$str. $key ." = '".$value."'";
        }else{

            $str=$str. ", ".$key ." = '".$value."'";
        }

        $i++;
    }
    $sql="UPDATE $table SET $str WHERE id = $id ";
    $query=$pdo->prepare($sql);

    $query->execute($params);
    dbCheckError($query);

}
//Обновить в бд
function updateOrder($table, $id, $params){
    global  $pdo;
    $i=0;
    $str='';

    foreach ($params as $key =>$value){
        if($i===0){
            $str=$str. $key ." = '".$value."'";
        }else{

            $str=$str. ", ".$key ." = '".$value."'";
        }

        $i++;
    }
    $sql="UPDATE $table SET $str WHERE id_user = $id ";
    $query=$pdo->prepare($sql);

    $query->execute($params);
    dbCheckError($query);

}

//глобальная функ удаления
function delete($table, $id)
{
	global $pdo;
	$sql = "DELETE FROM $table WHERE id = $id";
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);

}

function deleteUseComments($table, $id)
{
	global $pdo;
	$sql = "DELETE FROM $table WHERE id = '$id'";
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);

}

function deleteAuto($table, $id)
{
	global $pdo;
	$sql = "DELETE FROM $table WHERE id_auto = $id";
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);

}

function deleteBrand($table, $id)
{
	global $pdo;
	$sql = "DELETE FROM $table WHERE id_brand = $id";
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);

}
function deleteBrandUseStr($table, $id)
{
	global $pdo;
	$sql = "DELETE FROM $table WHERE id_brand = '$id'";
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);

}
//Выборка под клуб
function selectAllAutoAndBrand($table1, $table2)
{
	global $pdo;
	$sql = "SELECT
       t1.id,
       t1.full_name,
       t1.status,
       t1.price,
       t1.year,
       t1.created_date,
       t1.img_preview,
       t2.name,
       t2.country
       FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_brand=t2.id";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}


function selectAllFromSubsWitUsers($table1,$table2){
    global $pdo;
    $sql="SELECT
       t1.id,
       t1.name,
       t1.status,
       t2.login
       FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user=t2.id";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}


//Выборка под фитнесс
function selectAllFromFitnessWitUsersWithStatus($table1, $table2, $status){
    global $pdo;
    $sql="SELECT
       t1.id_fitness,
       t1.fitness_description,
       t1.fitness_preview,
       t1.fitness_country,
       t1.fitness_video,
       t1.fitness_name,
       t1.created_date,
       t1.status,
       t1.fitness_top,
       t2.login
       FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user=t2.id AND t1.status='$status'";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
function selectAllOrderParams($cart, $users, $cart_status,$auto,$id){
	global $pdo;
	$sql="SELECT
       t1.id,
       t1.username,
       t1.telephone,
       t1.address,
       t1.created_date,
       t1.status_cancel,
       t2.login,
       t3.name,
       t4.full_name,
       t4.price,
       t4.img_preview,
       t4.year
       FROM $cart AS t1 JOIN $users AS t2 ON t1.id_user=t2.id JOIN $cart_status AS t3 ON t1.id_status=t3.id JOIN $auto AS t4 ON t1.id_auto=t4.id AND t1.id_user=$id";
	$query=$pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}
function selectAllOrder($cart, $users, $cart_status,$auto){
	global $pdo;
	$sql="SELECT
       t1.id,
       t1.username,
       t1.telephone,
       t1.address,
       t1.created_date,
       t1.status_cancel,
       t2.login,
       t3.name,
       t4.full_name,
       t4.price,
       t4.img_preview,
       t4.year
       FROM $cart AS t1 JOIN $users AS t2 ON t1.id_user=t2.id JOIN $cart_status AS t3 ON t1.id_status=t3.id JOIN $auto AS t4 ON t1.id_auto=t4.id";
	$query=$pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}






function countRow($table1){
    global $pdo;
    $sql="SELECT COUNT(*) FROM $table1 WHERE status= 1";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchColumn();
}
//Выборка под фильмы
function selectAllFromFitnessWitUsersWithStatusIndex($table1, $table2, $limit, $offset){
    global $pdo;
    $sql="SELECT
      t1.*,
       t2.login
       FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user=t2.id AND t1.status=1 LIMIT $limit OFFSET $offset";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
//Выборка под все посты
function selectAllPostIndex($table1,$table2,$limit,$offset){
    global $pdo;
    $sql="SELECT
      t1.*,
       t2.*
       FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_fitness=t2.id_fitness AND t1.status=1 LIMIT $limit OFFSET $offset";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}


function selectLastComment($table1,$table2,$lastId){
    global $pdo;
    $sql="SELECT
      t1.*,
       t2.login
       FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user=t2.id AND t1.id=$lastId";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

function selectAllComments($table1,$table2,$id_car){
    global $pdo;
    $sql="SELECT
      t1.*,
       t2.login
       FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user=t2.id AND t1.id_auto=$id_car";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
/*
 * Функиции для систеиы рейтинга фитнесс-клуба
 * */

function insertRating($table,$params=[]){
    /*
     * обновляет данные лайка и дизлайка unlike и undislike отдельная функцияы
     * */
    global  $pdo;
    $i=0;
    $coll='';
    $mask='';

    foreach ($params as $key =>$value){
        if($i===0){
            $coll=$coll ."$key";
            $mask=$mask."'"."$value"."'";
        }else{
            $coll=$coll .", $key";
            $mask=$mask.", '"."$value"."'";
        }
        $i++;
    }
    $lastEl = array_values(array_slice($params, -1))[0];

    $lastKey=array_key_last($params);
    $sql="INSERT INTO $table ($coll) VALUES($mask)";
    $sql=$sql." ON DUPLICATE KEY UPDATE $lastKey='$lastEl'";
    $query=$pdo->prepare($sql);
    $query->execute($params);
    dbCheckError($query);
}


function unInsertRataing($table,$id_user,$id_fitness){
    global  $pdo;
    $sql="DELETE FROM $table WHERE id_user = $id_user AND id_fitness=$id_fitness";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}
function getLikes($id)
{
    global $pdo;

    $sql = "SELECT COUNT(*) 
					FROM fitness_rating 
					WHERE id_fitness = $id
					 AND rating_action='like'";

    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);

    return $query->fetch()["COUNT(*)"];
}
function getDislikes($id)
{
    global $pdo;

    $sql = "SELECT COUNT(*) 
					FROM fitness_rating 
					WHERE id_fitness = $id 
					 AND rating_action='dislike'";

    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);

    return $query->fetch()["COUNT(*)"];
}
function getRating($id)
{
    global $pdo;
    $rating = array();
    $likes_query = "SELECT COUNT(*) 
					FROM fitness_rating 
					WHERE id_fitness = $id 
					 AND rating_action='like'";

    $dislikes_query = "SELECT COUNT(*) 
					FROM fitness_rating 
					WHERE id_fitness = $id 
					 AND rating_action='dislike'";
    $query=$pdo->prepare($likes_query);
    $query->execute();
    dbCheckError($query);
    $query1=$pdo->prepare($dislikes_query);
    $query1->execute();
    dbCheckError($query1);
    $rating = [
        'likes' => $query->fetch()["COUNT(*)"],
        'dislikes' => $query1->fetch()["COUNT(*)"]
    ];

    return json_encode($rating);
}
function userLiked($id_fitness)
{
    global $pdo;
    $id_user=$_SESSION['id'];

    $sql = "SELECT * FROM fitness_rating 
					WHERE id_user=$id_user AND id_fitness=$id_fitness AND rating_action='like'";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    if ($query->rowCount() > 0) {
        return true;
    }else{
        return false;
    }
}
function userDisliked($id_fitness)
{
    global $pdo;
    $id_user=$_SESSION['id'];

    $sql = "SELECT * FROM fitness_rating 
					WHERE id_user=$id_user AND id_fitness=$id_fitness AND rating_action='dislike'";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    if ($query->rowCount() > 0) {
        return true;
    }else{
        return false;
    }
}


