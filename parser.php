<html>
<meta charset="UTF-8">
</html>
<?php
chdir("/home/user1137761/www/bsmu.akson.by");
require_once 'simplehtmldom/simple_html_dom.php';
require_once 'app_config.php';

function searchUser($first_name, $last_name){//ищем юзера по url возвращаем в качестве результата всю строку row
          $query="SELECT * FROM vk_users WHERE first_name='{$first_name}'"." AND last_name='{$last_name}';";
          $res=mysql_query($query) or die("<p>searchUser Невозможно сделать запрос поиска пользователя: " . mysql_error() . "</p>");
          $row=mysql_fetch_array($res);//получение результата запроса из базы;
          return $row;
     }
     function addUser($first_name, $last_name){//добавление пользователя
          $query = "INSERT INTO vk_users (first_name, last_name)" .
          "VALUES ('{$first_name}', '{$last_name}');";
          $result = mysql_query($query) or die("<p>Невозможно добавить пользователя " . mysql_error() . "</p>");
     }

     function addComment($user_id, $comment_life, $comment_time){//добавляем комментарий
          $query= "INSERT INTO vk_comments (user_id, comment_life, comment_time) VALUES ('{$user_id}', '{$comment_life}', '{$comment_time}');";
          $res =mysql_query($query) or die("<p>Невозможно сделать запись комментария: " . mysql_error() . "</p>");
          if($res) return true;
          else return false;
     }
     function getCommentsCount($u_id){
     	  $query="SELECT * FROM vk_comments WHERE user_id='{$u_id}';";
          $res=mysql_query($query) or die("<p>getCommentsCountНевозможно сделать запрос поиска пользователя: " . mysql_error() . "</p>");
          $row=mysql_fetch_array($res);//получение результата запроса из базы;
          $rows=mysql_num_rows($res);
          $query="UPDATE vk_users SET all_comments='{$rows}' WHERE id='$u_id'";
          $res=mysql_query($query) or die("<p>Невозможно сделать запрос поиска пользователя: " . mysql_error() . "</p>");
          echo "All = $rows";
     }

$url="https://m.vk.com/wall-43932139_5970";
$html = file_get_html($url);
if(!$html) echo "error";

$fnd_author=$html->find('div.pi_head a');
$author=end($fnd_author);
$author=$author->innertext;
$first_name=0; $last_name=0;
sscanf($author, "%s %s", $first_name, $last_name);
echo "$first_name $last_name </br>";

$fnd=$html->find('a.item_date');
$comment_time=end($fnd);
$comment_time=$comment_time->innertext;
$num=strlen($comment_time);
$comment_time=substr($comment_time, 18);
echo "$comment_time ";

sscanf($comment_time, "%d:%d", $hour, $min);
$minLastComm=$hour*60+$min;
echo "$minLastComm </br>";//минуты последнего коммента

$currentDate=date("H:i");
echo "$currentDate ";//текущее время

sscanf($currentDate,"%d:%d" ,$hour, $min);
$currentMin=$hour*60+$min;
echo "$currentMin</br>";
$comment_life=$currentMin-$minLastComm;//разница в минутах
echo " LIFE = $comment_life </br>";

$html->clear();//очистка памяти от объекта
unset($html);

if($diff>=20){
	$message = "Последний коммент был оставлен $comment_life минут(ы) назад пользователем $author
	$url";
	mail("good-1991@mail.ru", "Chat", $message);

     	  $dbconnect = mysql_connect ($dbhost, $dbusername, $dbpass) or die("<p>Ошибка подключения к базе данных: " . mysql_error() . "</p>");
          //говорим базе что записываем в нее все в utf8
          mysql_query("SET NAMES 'utf8';"); 
          mysql_query("SET CHARACTER SET 'utf8';"); 
          mysql_query("SET SESSION collation_connection = 'utf8_general_ci';");
          mysql_select_db($db_name) or die ("<p>Невозможно выбрать базу: " . mysql_error() . "</p>");

          $row=searchUser($first_name, $last_name);
          if($row){
               $user_id=$row['id'];
               if($user_id) addComment($user_id, $comment_life, $comment_time);
               getCommentsCount($user_id);
          } else {
            addUser($first_name, $last_name);
            $row=searchUser($first_name, $last_name);
            $user_id=$row['id'];//получаем id вновьдобавленного пользователя
            addComment($user_id, $comment_life, $comment_time);
            getCommentsCount($user_id);
          }
          //запись количества общего комментов
			
}
?>