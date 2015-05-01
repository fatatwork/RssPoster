<?php
require_once '../funcLib.php';
session_start();
header('Content-type: text/html; charset=utf-8');
$articles=getArticles();

if($_REQUEST){
	if(!isset($_REQUEST['article']) && isset($_SESSION['article'])) $_REQUEST['article']=$_SESSION['article'];

	if(isset($_REQUEST['user_id']) && isset($_REQUEST['ban'])) banUser($_REQUEST['user_id'], $_REQUEST['ban']);
	if(isset($_REQUEST['unban_user_id'])) banUser($_REQUEST['unban_user_id'], NULL);
	if(isset($_REQUEST['comment_id'])) deleteComment($_REQUEST['comment_id']);

	if($_REQUEST['article']){
				$_SESSION['article']=$_REQUEST['article'];
				$article=searchArticleById($_REQUEST['article']);
				$comments=getComments($article['link']);
				$comments=array_reverse($comments, true);
				echo "<form='comment_list' action='admin_get_comments.php' method='POST'>";
				foreach ($comments as $comment) {
					echo $comment['first_name']." ".$comment['last_name']." ".$comment['add_time']."<br />".
					$comment['comment'];
					if(!$comment['ban_time']){
						echo "<form class='ban_form' action='admin_get_comments.php' method='POST'>
								<div class='ban_buttons'>
									<input type='radio'  name='ban' value='day'/>День
									<input type='radio'  name='ban' value='week'/>Неделя
									<input type='radio'  name='ban' value='month'/>Месяц
									<input type='radio'  name='ban' value='year'/>Год
									<input type='radio'  name='ban' value='forever'/>Навсегда<br />
									<button type='submit' name='user_id' value='".$comment['user_id']."'/>забанить</button>
									<button type='submit' name='comment_id' value='".$comment['id']."'/>удалить</button>
									<input type='reset' value='очистить'/>
								</div>
				 			 </form>";
				} else {
						echo 
						"<form class='ban_form' action='admin_get_comments.php' method='POST'>".
							"<button type='submit' name='unban_user_id' value='".$comment['user_id']."'/>разбанить</button>
						</form>";
						}
					echo "<br />";
				}
		}
}

?>

