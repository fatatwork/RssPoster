<?php 
	require_once 'app_config.php';
	require_once 'pdo_mysql.php';

	$dbconnect = pdo_connect( $dbhost, $dbusername, $dbpass )
	or die( "<p>Ошибка подключения к базе данных: " . pdo_error() . "</p>" );
	//говорим базе что записываем в нее все в utf8
	pdo_query( "SET NAMES 'utf8';" );
	pdo_query( "SET CHARACTER SET 'utf8';" );
	pdo_query( "SET SESSION collation_connection = 'utf8_general_ci';" );
	pdo_select_db( $db_name ) or die ( "<p>Невозможно выбрать базу: "
	                                     . pdo_error() . "</p>" );

function getComment($newsID){
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

			$query="SELECT * FROM users WHERE id='{$userID}';";
			$res=pdo_query($query);
			$row=pdo_fetch_row($res);

			$userArray=array('f_name'=>$row[1], 'l_name'=>$row[2], 'text'=>$commentText);
			return $userArray;
		} else {
			return NULL;
		}
	}
	getComment(5);
?>