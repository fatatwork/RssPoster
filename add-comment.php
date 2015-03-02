<?php
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

function searchActicle( $page_adress ) {
	$query = "SELECT id FROM news WHERE link = '{$page_adress}';";
	$result = mysql_query( $query )
	or die( "<p>Невозможно получить адрес страницы: " . mysql_error()
	        . "</p>" );
	$row        = mysql_fetch_array( $result );
	$article_id = $row['id'];

	return $article_id;
}

function searchUser(
	$username
) {//ищем юзера по url возвращаем в качестве результата всю строку row
	$query
		=
		"SELECT id, first_name, last_name, network_url FROM users WHERE first_name='{$username['first_name']}'"
		.
		" AND last_name='{$username['last_name']}' AND network_url = '{$username['identity']}'";//ищем есть ли такой же url в базе
	$res = mysql_query( $query )
	or die( "<p>Невозможно сделать запрос поиска пользователя: " . mysql_error()
	        . "</p>" );
	$row     = mysql_fetch_array( $res );//получение результата запроса из базы;
	$user_id = $row['id'];//получаем id пользователя
	return $user_id;
}

function addUser( $username ) {//добавление пользователя
	if ( $username['first_name'] ) {
		$query
			=
			"INSERT INTO users (first_name, last_name, network, network_url)" .
			"VALUES ('{$username['first_name']}', '{$username['last_name']}', '{$username['network']}', '{$username['identity']}');";
		$result = mysql_query( $query )
		or die( "<p>Невозможно добавить пользователя " . mysql_error()
		        . "</p>" );
	} else {
		die( "Ошибка: нет данных о пользователе\n" );
	}
}

function addComment( $article_id, $user_id, $comment ) {//добавляем комментарий
	$query
		= "INSERT INTO comments (news_id, user_id, comment) VALUES ('{$article_id}', '{$user_id}', '{$comment}');";
	$res = mysql_query( $query )
	or die( "<p>Невозможно сделать запись комментария: " . mysql_error()
	        . "</p>" );
	if ( $res ) {
		return true;
	} else {
		return false;
	}
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