<?php
session_start();
require_once '../funcLib.php';
header('Content-type: text/html; charset=utf-8');
$articles=getArticles();
$_SESSION['articles_page']=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(is_array($articles)){
	foreach($articles as $article){
		echo "<li>".date("d.m.y - H:i", $article['date']).
		"<a href='http://bsmu.akson.by/comments/comments.php".
		"?article=".$article['id']."'>".$article['title']."</a></li>";
	}
	echo "</ul>";
}
?>