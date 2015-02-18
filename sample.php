<?php
     session_start();
     $username = $_SESSION['user'];
     $comment = trim($_REQUEST['user_comment']);
     if(!$comment) die("Error comment");
     if($username){
          $db_name="user1137761_testn";
          $dbhost = "localhost"; // Имя хоста БД
          $dbusername = "mainuser"; // Пользователь БД
          $dbpass = "XnCyWPmG"; // Пароль к базе
          $dbconnect = mysql_connect ($dbhost, $dbusername, $dbpass); 
          if (!$dbconnect){ die("<p>Ошибка подключения к базе данных: " . mysql_error() . "</p>"); }
          mysql_select_db($db_name) or die ("<p>Невозможно выбрать базу: " . mysql_error() . "</p>");

          $query = "INSERT INTO comments (firstname, lastname, url, network, comment)" .
    "VALUES ('{$username['first_name']}', '{$username['last_name']}', '{$username['identity']}', '{$username['network']}', '{$comment}');";
          $result = mysql_query($query);
          if(!$result) die("<p>Невозможно сделать запись комментария: " . mysql_error() . "</p>"); 
          else echo ("Success");
     } else echo ("Error");
                    //$user['network'] - соц. сеть, через которую авторизовался пользователь
                    //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
                    //$user['first_name'] - имя пользователя
                    //$user['last_name'] - фамилия пользователя
     ?>