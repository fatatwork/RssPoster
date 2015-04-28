<?php
require_once '../funcLib.php';
//робот для авторазбанивания пользователя
$banned_users=getBannedUsers();
if(is_array($banned_users)){
	print_r($banned_users);
foreach ($banned_users as $user) {
	//разбаниваем
	banUser($user['user_id'], NULL);
	}
}
?>