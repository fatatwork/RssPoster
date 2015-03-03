<?php 
	require_once 'pdo_mysql.php';
	require_once 'app_config.php';
	$dbconnect = pdo_connect( $dbhost, $dbusername, $dbpass )
	or die( "<p>Ошибка подключения к базе данных: " . pdo_error() . "</p>" );
	//говорим базе что записываем в нее все в utf8
	pdo_query( "SET NAMES 'utf8';" );
	pdo_query( "SET CHARACTER SET 'utf8';" );
	pdo_query( "SET SESSION collation_connection = 'utf8_general_ci';" );
	pdo_select_db( $db_name ) or die ( "<p>Невозможно выбрать базу: "
	                                     . pdo_error() . "</p>" );
?>