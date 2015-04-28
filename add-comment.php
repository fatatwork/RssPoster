<?php
session_start();
require_once 'funcLib.php';

if ( isset( $_COOKIE['first_name'], $_COOKIE['last_name'] ) ) {
	$username['first_name'] = $_COOKIE['first_name'];
	$username['last_name']  = $_COOKIE['last_name'];
	$username['image']		= $_COOKIE['image'];
	$username['network']    = $_COOKIE['network'];
	$username['identity']   = $_COOKIE['identity'];
	$page_adress            = $_COOKIE['page_adress'];
	$boolCheckCookie        = true;
} else {
		if ( isset( $_SESSION['first_name'], $_SESSION['last_name'] ) ) {
			$username['first_name'] = $_SESSION['first_name'];
			$username['last_name']  = $_SESSION['last_name'];
			$username['image']		= $_SESSION['image'];
			$username['network']    = $_SESSION['network'];
			$username['identity']   = $_SESSION['identity'];
			$page_adress            = $_SESSION['page_adress'];		
		}
}
$comment = trim( $_REQUEST['user_comment'] );
if ( ! $comment ) {
	die( "Error comment" );
}

if ( isset( $username ) ) {
	$article_id = searchActicle( $page_adress ); //Получаем идентификатор страницы на которой нужно разместить комментарий
	$user_id = searchUser( $username );//первоначально ищем пользователя
	if ( $user_id) {//пишем коммент
		updateUser($username, $user_id);	
		$comment_result = addComment( $article_id, $user_id, $comment );
	} else {//если пользователя нет - добавляем нового и пишем коммент
		addUser( $username );
		$user_id        = searchUser( $username );
		$comment_result = addComment( $article_id, $user_id, $comment );
	}

}
//редирект на страницу с которой пришли
header("Location: http://".$_SESSION['page_adress']);
?>