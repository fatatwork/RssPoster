<?php
session_start();
require_once '../funcLib.php';
$articles=getArticles();
header('Content-type: text/html; charset=utf-8');
if($_GET){
	if($_GET['article']){
				$article=searchArticleById($_GET['article']);
				$comments=getComments($article['link']);
				$comments=array_reverse($comments, true);

				foreach ($comments as $comment) {
					echo "<li>".$comment['first_name']." ".$comment['last_name']." ".$comment['add_time']."<br />".
					$comment['comment'];
					if(!$comment['ban_time']){
						echo "<form class='ban_form' method='POST' action='".$_SERVER['REQUEST_URI']."'>
								<div class='ban_buttons'>
									<input type='radio'  name='ban' value='day'/>День
									<input type='radio'  name='ban' value='week'/>День
									<input type='radio'  name='ban' value='month'/>Месяц
									<input type='radio'  name='ban' value='year'/>Год
									<input type='radio'  name='ban' value='forever'/>Навсегда<br />
									<button type='submit' name='user_id' value='".$comment['user_id']."'>забанить</button>
									<button type='submit' name='comment_id' value='".$comment['id']."'>удалить</button>
									<input type='reset' value='сбросить'/>
								</div>
				 			 </form>";
				} else {
						echo 
						"<form action='".$_SERVER['REQUEST_URI']."' method = 'POST'>".
							"<button type='submit' name='unban_user_id' value='".$comment['user_id']."'>разбанить</button>
						</form>";
						}
					echo "</li><br />";
				}
				echo "</ul>";
		}
}

if($_REQUEST){
	if($_REQUEST['user_id'] && $_REQUEST['ban']) banUser($_REQUEST['user_id'], $_REQUEST['ban']);
	if($_REQUEST['unban_user_id']) banUser($_REQUEST['unban_user_id'], NULL);
 }
?>