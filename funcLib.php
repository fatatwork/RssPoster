<?
require_once 'connectDB.php';
function searchActicle( $page_adress ) {
	$query = "SELECT id FROM news WHERE link = '{$page_adress}';";
	$result = pdo_query( $query )
	or die( "<p>Невозможно получить адрес страницы: " . mysql_error()
	        . "</p>" );
	$row        = pdo_fetch_row( $result );
	$article_id = $row['id'];

	return $article_id;
}

function searchUser(
	$username
) {//ищем юзера по url возвращаем в качестве результата всю строку row
	$query
		=
		"SELECT id, first_name, last_name, network_url FROM users WHERE first_name='{$username['first_name']}'"
		.
		" AND last_name='{$username['last_name']}' AND network_url = '{$username['identity']}'";//ищем есть ли такой же url в базе
	$res = mysql_query( $query )
	or die( "<p>Невозможно сделать запрос поиска пользователя: " . mysql_error()
	        . "</p>" );
	$row     = mysql_fetch_array( $res );//получение результата запроса из базы;
	$user_id = $row['id'];//получаем id пользователя
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

function getComment(){
	if(isset($_COOKIE['page_adress'])){
		$newsID = searchActicle($_COOKIE['page_adress']);
		//Получаем адрес страницы из кук или сессии, и, используя фуннцию из add-comment.php ищем по адресу id страницы
	}
	else{
		$newsID = searchActicle($_SESSION['page_adress']);
	}
		$query="SELECT MAX(id) FROM comments WHERE news_id='{$newsID}';";
		$res=pdo_query($query);
		$row=pdo_fetch_row($res);
		if($row[0]!=NULL) {//если новость существует
			$maxID=$row[0];
			$query = "SELECT * FROM comments WHERE id='{$maxID}';";
			$res   = pdo_query( $query );
			$row   = pdo_fetch_row( $res );
			$userID      = $row[2];
			$commentText = $row[3];//сам текст комментария
			$seconds = $row[4];

			$query="SELECT * FROM users WHERE id='{$userID}';";
			$res=pdo_query($query);
			$row=pdo_fetch_row($res);
			$time_comment = date("d.m.y - H.i", $seconds); //Формируем дату и время из секунд
			$userArray=array('f_name'=>$row[1], 'l_name'=>$row[2], 'text'=>$commentText, 'time_data'=>$time_comment);
			return $userArray;
		} else {
			return NULL;
		}
}
?>