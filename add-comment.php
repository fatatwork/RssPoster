<?php
require_once 'funcLib.php';
$boolCheckCookie = false;
error_reporting(0);

if ( isset( $_COOKIE['first_name'] ) ) {
	$username['first_name'] = $_COOKIE['first_name'];
	$username['last_name']  = $_COOKIE['last_name'];
	$username['network']    = $_COOKIE['network'];
	$username['identity']   = $_COOKIE['identity'];
	$page_adress            = $_COOKIE['page_adress'];
	$boolCheckCookie        = true;
	echo "Отработали куки <br>";
} else {
	if ( $boolCheckCookie == false ) {
		session_start();
		if ( isset( $_SESSION['user'], $_SESSION['page_adress'] ) ) {
			$username    = $_SESSION['user'];
			$page_adress = $_SESSION['page_adress'];
			echo "Отработала сессия <br>";
		}
	}
}

require_once 'app_config.php'; //подключение файла с данными для входа в БД

$comment = trim( $_REQUEST['user_comment'] );
if ( ! $comment ) {
	die( "Error comment" );
}

if ( isset( $username ) ) {
	//коннект к базе
	$dbconnect = mysql_connect( $dbhost, $dbusername, $dbpass )
	or die( "<p>Ошибка подключения к базе данных: " . mysql_error() . "</p>" );
	//говорим базе что записываем в нее все в utf8
	mysql_query( "SET NAMES 'utf8';" );
	mysql_query( "SET CHARACTER SET 'utf8';" );
	mysql_query( "SET SESSION collation_connection = 'utf8_general_ci';" );
	mysql_select_db( $db_name ) or die ( "<p>Невозможно выбрать базу: "
	                                     . mysql_error() . "</p>" );

	$article_id = searchActicle( $page_adress ); //Получаем идентификатор страницы на которой нужно разместить комментарий
	$user_id = searchUser( $username );//первоначально ищем пользователя
	if ( $user_id ) {//пишем коммент
		
		$comment_result = addComment( $article_id, $user_id, $comment );
		if ( $comment_result ) {
			echo "<br> Комментарий добавлен";
		} else {
			echo "<br> Комментарий НЕ добавлен";
		}

	} else {//если пользователя нет - добавляем нового и пишем коммент
		addUser( $username );
		$user_id        = searchUser( $username );
		$comment_result = addComment( $article_id, $user_id, $comment );
		if ( $comment_result ) {
			echo "<br> Комментарий добавлен";
		} else {
			echo "<br> Комментарий НЕ добавлен";
		}
	}

} else {
	echo( "Error: user not exist." );
}

//$user['network'] - соц. сеть, через которую авторизовался пользователь
//$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
//$user['first_name'] - имя пользователя
//$user['last_name'] - фамилия пользователя
?>