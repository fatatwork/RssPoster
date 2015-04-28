<?php
session_start();
require_once '../funcLib.php';
if($_GET['unbanned_user']){
		banUser($_GET['unbanned_user'], NULL);
		header("Location: http://".$_SESSION['ban_page']);
	}
header('Content-type: text/html; charset=utf-8');
$_SESSION['ban_page']=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$usersOut=getUsers();

if(is_array($usersOut)){
	if($_REQUEST){
	foreach($usersOut as $user){
			if($_REQUEST['user_id_'.$user['user_id']]){
			$ban_time=trim($_REQUEST['user_id_'.$user['user_id']]);
			if(!preg_match("/^[0-9]+$/", $ban_time)){
				echo "ошибка установки времени";
				exit;
			}
			$ban_time=$ban_time*3600+time();
			banUser($user['user_id'], (int)$ban_time);
			}
 		}
 	}
 	echo "<ul> Ввести часы бана";
		foreach($usersOut as $user){
			echo "<li> user_id: ".$user['user_id']."\t\t".
				 "<a href=\"http://vk.com/id".$user['network_url']."\">".$user['last_name']." "
			     .$user['first_name']."</a>\t";
			if(!$user['ban_time']){
			echo "<form class='ban_form' method='POST' action='".$_SERVER['REQUEST_URI']."'>
					<div class='ban_time_area'>
						<textarea name='user_id_".$user['user_id']."' cols='12' rows='1'></textarea>
						<input type='submit' value='забанить'/>
					</div>
				  </form>";
				} else echo "<a href=\"".$_SERVER['REQUEST_URI'].
				"?unbanned_user=".$user['user_id']."\"> разбанить</a></li></br>";
		}
	echo "</ul>";
}
?>