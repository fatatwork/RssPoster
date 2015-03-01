<html>
<meta charset="UTF-8">
</html>
<?php
chdir( "/home/user1137761/www/bsmu.akson.by" );
require_once 'simplehtmldom/simple_html_dom.php';
require_once 'app_config.php';

function searchUser(
	$author_id
) {//ищем юзера по url возвращаем в качестве результата всю строку row
	$query = "SELECT * FROM vk_users WHERE vk_id='{$author_id}';";
	$res = mysql_query( $query )
	or die( "<p>searchUser Невозможно сделать запрос поиска пользователя: "
	        . mysql_error() . "</p>" );
	$row = mysql_fetch_array( $res );//получение результата запроса из базы;
	return $row;
}

function addUser(
	$first_name, $last_name, $author_id
) {//добавление пользователя
	$query = "INSERT INTO vk_users (first_name, last_name, vk_id)" .
	         "VALUES ('{$first_name}', '{$last_name}', '{$author_id}');";
	$result = mysql_query( $query )
	or die( "<p>Невозможно добавить пользователя " . mysql_error() . "</p>" );
}

function addComment(
	$user_id, $comment_life, $comment_time, $currentDay
) {//добавляем комментарий
	$query = "SELECT comment_time FROM vk_comments WHERE user_id='{$user_id}' AND day='{$currentDay}';";
	$res = mysql_query( $query ) or die( "<p>searchUser Невозможно сделать запрос поиска комментария для пользователя $user_id: "
	                                     . mysql_error() . "</p>" );
	$row = mysql_fetch_array( $res );//получение результата запроса из базы;

	if ( $row ) {
		$com_time = end( $row );
		if ( $com_time != $comment_time ) {
			$query
				= "INSERT INTO vk_comments (user_id, comment_life, comment_time, day) VALUES ('{$user_id}', '{$comment_life}', '{$comment_time}', '{$currentDay}');";
			$res = mysql_query( $query )
			or die( "<p>Невозможно сделать запись комментария: " . mysql_error()
			        . "</p>" );
		} else {
			$query = "UPDATE vk_comments SET comment_life='{$comment_life}' WHERE user_id='{$user_id}';";
			$res = mysql_query( $query ) or die( "<p>addComment Невозможно обновить время жизни комментария для пользователя $user_id: "
	                                     . mysql_error() . "</p>" );
		}
	} else {
		$query
			= "INSERT INTO vk_comments (user_id, comment_life, comment_time, day) VALUES ('{$user_id}', '{$comment_life}', '{$comment_time}', '{$currentDay}');";
		$res = mysql_query( $query )
		or die( "<p>Невозможно сделать запись комментария: " . mysql_error()
		        . "</p>" );
	}

	return $res;
}

function getCommentsCount( $u_id ) {
	$query = "SELECT * FROM vk_comments WHERE user_id='{$u_id}';";
	$res = mysql_query( $query )
	or die( "<p>getCommentsCountНевозможно сделать запрос поиска пользователя: "
	        . mysql_error() . "</p>" );
	$rows  = mysql_num_rows( $res );
	$query = "UPDATE vk_users SET all_comments='{$rows}' WHERE id='$u_id'";
	$res = mysql_query( $query )
	or die( "<p>Невозможно сделать запрос поиска пользователя: " . mysql_error()
	        . "</p>" );
	echo "All = $rows";
}

 function commentStat($currentDay, $dbhost, $dbusername, $dbpass, $db_name){
 	connect($dbhost, $dbusername, $dbpass,$db_name);
 	$all_results=array(0=>20, 1=>30, 2=>40, 3=>50);
 	$fields=array(0=>'comment_life_20', 1=>'comment_life_30', 2=>'comment_life_40', 3=>'comment_life_50');

 	for($i=0; $i<4; $i++){
 		$query="SELECT * FROM vk_comments WHERE comment_life>=$all_results[$i]&&comment_life<($all_results[$i]+10) AND day='{$currentDay}';";
 		$res = mysql_query( $query )
			or die( "<p>commentStat Невозможно сделать запрос для анализа статистики: "
	        . mysql_error() . "</p>" );
		$rows_num=mysql_num_rows($res);

		if($rows_num){
			$query="SELECT * FROM vk_comment_stat WHERE day='{$currentDay}';";
			$res = mysql_query( $query )
			or die( "<p>getCommentsCountНевозможно сделать запрос для анализа статистика: "
	        . mysql_error() . "</p>" );
			$row=mysql_fetch_row($res);
			if($row){
				$query="UPDATE vk_comment_stat SET $fields[$i]='$rows_num' WHERE day='{$currentDay}';";
				$res = mysql_query( $query )
					or die( "<p>getCommentsCountНевозможно сделать запрос для анализа статистика: "
	        		. mysql_error() . "</p>" );
			} else {
				$query="INSERT INTO vk_comment_stat (comment_life_20, comment_life_30, comment_life_40, comment_life_50, day) 
				VALUES ('0','0','0','0','{$currentDay}');";
				$res = mysql_query( $query )
					or die( "<p>getCommentsCountНевозможно сделать запрос для анализа статистика: "
	        		. mysql_error() . "</p>" );
	        	$query="UPDATE vk_comment_stat SET $fields[$i]='$rows_num' WHERE day='{$currentDay}';";
				$res = mysql_query( $query )
					or die( "<p>getCommentsCountНевозможно сделать запрос для анализа статистика: "
	        		. mysql_error() . "</p>" );
			}
		}

 	}

}
	function connect($dbhost, $dbusername, $dbpass, $db_name){

	$dbconnect = mysql_connect( $dbhost, $dbusername, $dbpass )
	or die( "<p>Ошибка подключения к базе данных: " . mysql_error() . "</p>" );
	//говорим базе что записываем в нее все в utf8
	mysql_query( "SET NAMES 'utf8';" );
	mysql_query( "SET CHARACTER SET 'utf8';" );
	mysql_query( "SET SESSION collation_connection = 'utf8_general_ci';" );
	mysql_select_db( $db_name ) or die ( "<p>Невозможно выбрать базу: "
	                                     . mysql_error() . "</p>" );
	}

$url  = "https://m.vk.com/wall-43932139_5970";
$html = file_get_html( $url );
if ( ! $html ) {
	echo "error";
}
$fnd_author  = $html->find( 'a.pi_author' );//в масссиве вк всегда 51 коммент
$fnd_comment = $html->find( 'div.pi_text' );
for ( $i = 46; $i < count( $fnd_author ); ++ $i ) {
	$author = trim( $fnd_author[ $i ]->innertext );
	if ( $author == "Официальное сообщество Plantronics" ) {
		$message = "Message from admin";
		mail( "good-1991@mail.ru", "Chat", $message );
		mail( "feliasfogg1@yandex.ru", "Chat", $message );
		mail( "pavel.felias@gmail.com", "Chat", $message );
		mail( "feliasfogg@outlook.com", "Chat", $message );
		break;
	}
}

$author = end( $fnd_author );
sscanf( $author, "<a class=\"pi_author\" href=\"/%s\">", $author_id );
$author = trim( $author->innertext );
sscanf( $author, "%s %s", $first_name, $last_name );
echo "$first_name $last_name </br>";
$author_id = substr( $author_id, 0, strpos( $author_id, "\">" ) );
echo "<a href=\"https://vk.com/$author_id\">$author_id<a/></br>";

$fnd          = $html->find( 'a.item_date' );
$comment_time = end( $fnd );
$comment_time = $comment_time->innertext;
$num          = strlen( $comment_time );
$comment_time = substr( $comment_time, 18 );
echo "$comment_time ";

sscanf( $comment_time, "%d:%d", $hour, $min );
$minLastComm = $hour * 60 + $min;
echo "$minLastComm </br>";//минуты последнего коммента

$currentDay=date("d.m.Y");
$currentDate = date( "H:i" );
echo "$currentDate ";//текущее время

sscanf( $currentDate, "%d:%d", $hour, $min );
$currentMin = $hour * 60 + $min;
echo "$currentMin</br>";
$comment_life = $currentMin - $minLastComm;//разница в минутах
echo "DIFF = $comment_life </br>";
echo "<a href=\"https://m.vk.com/wall-43932139_5970?post_add#post_add\">Add post</a></br>";
$html->clear();//очистка памяти от объекта
unset( $html );

if ( $comment_life >=20 ) {
	if ( $comment_life >= 35 && $author_id != "id152223765" ) {
		$message = "Last comment was added $comment_life minutes ago by user
  $first_name $last_name at $comment_time";
		mail( "good-1991@mail.ru", "Chat", $message );
		mail( "feliasfogg1@yandex.ru", "Chat", $message );
		mail( "pavel.felias@gmail.com", "Chat", $message );
		mail( "feliasfogg@outlook.com", "Chat", $message );
		if ( $comment_life >= 40 ) {
			$sms = file_get_contents( "http://sms.ru/sms/send?api_id=b8646699-0b12-1c14-ad92-7ab16971b8a1&to=375259466591&text="
				                     . urlencode( iconv( "windows-1251",
					"utf-8",
					"Last comment was added $comment_life minutes ago" ) ) );
		}
	}
	connect($dbhost, $dbusername, $dbpass, $db_name);

	$row = searchUser( $author_id );
	if ( $row ) {
		$user_id = $row['id'];
		if ( $user_id ) {
			addComment( $user_id, $comment_life, $comment_time, $currentDay);
		}
		getCommentsCount( $user_id );
	} else {
		addUser( $first_name, $last_name, $author_id );
		$row     = searchUser( $author_id );
		$user_id = $row['id'];//получаем id вновьдобавленного пользователя
		addComment( $user_id, $comment_life, $comment_time, $currentDay );
		getCommentsCount( $user_id );
	}
}
commentStat($currentDay, $dbhost, $dbusername, $dbpass, $db_name);
?>