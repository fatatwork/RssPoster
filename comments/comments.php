<?php
session_start();
require_once '../funcLib.php';
$articles=getArticles();
header('Content-type: text/html; charset=utf-8');
if($_GET){
	if($_GET['article']){
				$article=searchArticleById($_GET['article']);
				$comments=getComments($article['link']);
				//print_r($comments);
				echo "<ul> Введите количество дней бана";
				foreach ($comments as $comment) {
					echo "<li>".$comment['first_name']." ".$comment['last_name']." ".$comment['add_time']."<br />".
					$comment['comment'];
					if(!$comment['ban_time']){
						echo "<form class='ban_form' method='POST' action='".$_SERVER['REQUEST_URI']."'>
								<div class='ban_buttons'>
									<input type='radio'  name='day' value='day'/>День
									<input type='radio'  name='month' value='month'/>Месяц
									<input type='radio'  name='year' value='year'/>Год
									<input type='radio'  name='forever' value='forever'/>Навсегда<br />
									<input type='submit' name='user_id_".$comment['user_id']."' value='забанить'/>
									<input type='submit' name='comment_id_".$comment['id']."' value='удалить'/>
									<input type='reset' value='очистить'/>
								</div>
				 			 </form>";
				} else {
						echo "<form action='".$_SERVER['REQUEST_URI']."' method = 'POST'>".
						"<input type='submit' name='user_id_".$comment['user_id']."' value='разбанить'/> </form>";
						}
					echo "</li><br />";
				}
				echo "</ul>";
		}
}
if($_REQUEST){
	$usersOut=getUsers();
	print_r($_REQUEST);
	echo $comment['user_id'];
	foreach($usersOut as $user){
		switch($_REQUEST['user_id_'.$user['user_id']]){
			case 'забанить':
				if(isset($_REQUEST['day'])) banUser($user['user_id'], $_REQUEST['day']);
				if(isset($_REQUEST['month'])) banUser($user['user_id'], $_REQUEST['month']);
				if(isset($_REQUEST['year'])) banUser($user['user_id'], $REQUEST['year']);
				if(isset($_REQUEST['forever'])) banUser($user['user_id'], $_REQUEST['forever']);
				break;
			case 'разбанить': 
				banUser($user['user_id'], NULL);
				break;
			default: break;	
		}
 	}
 	foreach ($comments as $comment) {
 		if($_REQUEST['comment_id_'.$comment['id']]) deleteComment($comment['id']);
 	}
 }
?>