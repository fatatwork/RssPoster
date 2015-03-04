<?
require_once 'connectDB.php';
function searchActicle( $page_adress ) {
	$query = "SELECT id FROM news WHERE link = '{$page_adress}';";
	$result = pdo_query( $query )
	or die( "<p>Невозможно получить адрес страницы: " . mysql_error()
	        . "</p>" );
	$row = $result->fetch(PDO::FETCH_ASSOC);
	$article_id = $row['id'];
	return $article_id;
}

function searchUser($username) {//ищем юзера по url возвращаем в качестве результата всю строку row
	$query = "SELECT user_id, first_name, last_name, network_url FROM users WHERE first_name='{$username['first_name']}'"
		.
		" AND last_name='{$username['last_name']}' AND network_url = '{$username['identity']}'";//ищем есть ли такой же url в базе
	$res = mysql_query( $query )
	or die( "<p>Невозможно сделать запрос поиска пользователя: " . mysql_error()
	        . "</p>" );
	$row     = mysql_fetch_array( $res );//получение результата запроса из базы;
	$user_id = $row['user_id'];//получаем id пользователя
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
	$add_time = time();
	$query
		= "INSERT INTO comments (news_id, user_id, comment, add_time) VALUES ('{$article_id}', '{$user_id}', '{$comment}', '{$add_time}');";
	$res = mysql_query( $query )
	or die( "<p>Невозможно сделать запись комментария: " . mysql_error()
	        . "</p>" );
	if ( $res ) {
		return true;
	} else {
		return false;
	}
}

function getComments(){
	if(isset($_COOKIE['page_adress'])){
		$newsID = searchActicle($_COOKIE['page_adress']);
		//Получаем адрес страницы из кук или сессии, и, используя фуннцию из add-comment.php ищем по адресу id страницы
	}
	else{
		$newsID = searchActicle($_SESSION['page_adress']);
	}	
	$actualTime = time();
	//Создаем запрос на слияние данных о пользователях с данными об их комментариях
	$query = "SELECT id, user_id, comment, add_time, first_name, last_name, network_url FROM users NATURAL JOIN comments WHERE news_id='{$newsID}' ORDER BY id;";
	$result_obj = pdo_query($query) or die("<p>Невозможно получить данные о комментариях: " . mysql_error()
	        . "</p>");
	$commentArray = array();
	while($row = $result_obj->fetch(PDO::FETCH_ASSOC)){ //Сюда должна лечь новая строка ассоциативного массива
		$row['add_time'] = date("d.m.y - H:i", $row['add_time']); //преобразуем время к формату
		array_push($commentArray, $row);
	}
	return $commentArray;
}
?>