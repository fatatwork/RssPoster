<?php 
     $boolCheckCookie = false;
     if(isset($_COOKIE['first_name'])){ $username['first_name'] = $_COOKIE['first_name']; $boolCheckCookie = true;}
     if(isset($_COOKIE['last_name'])){ $username['last_name'] = $_COOKIE['last_name']; $boolCheckCookie = true;}
     if(isset($_COOKIE['network'])){ $username['network'] = $_COOKIE['network']; $boolCheckCookie = true;}
     if(isset($_COOKIE['identity'])){ $username['identity'] = $_COOKIE['identity']; $boolCheckCookie = true;}

     if($boolCheckCookie == false){
          session_start();
          if(isset($_SESSION['user'])){ $username = $_SESSION['user'];}
     }
     
     $comment = trim($_REQUEST['user_comment']);
     if(!$comment) die("Error comment");
     if(isset($username)){
          $db_name="user1137761_testn";
          $dbhost = "localhost"; // Имя хоста БД
          $dbusername = "fatatwork"; // Пользователь БД
          $dbpass = "nyatech22"; // Пароль к базе
          $dbconnect = mysql_connect ($dbhost, $dbusername, $dbpass); 
          if (!$dbconnect){ die("<p>Ошибка подключения к базе данных: " . mysql_error() . "</p>"); }
          mysql_select_db($db_name) or die ("<p>Невозможно выбрать базу: " . mysql_error() . "</p>");

          $query = "INSERT INTO comments (firstname, lastname, url, network, comment)" .
          "VALUES ('{$username['first_name']}', '{$username['last_name']}', '{$username['identity']}', '{$username['network']}', '{$comment}');";
          $result = mysql_query($query);
          if(!$result) die("<p>Невозможно сделать запись комментария: " . mysql_error() . "</p>"); 
          else echo ("Success");

     } else echo ("Error: user not exist.");
                    //$user['network'] - соц. сеть, через которую авторизовался пользователь
                    //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
                    //$user['first_name'] - имя пользователя
                    //$user['last_name'] - фамилия пользователя
     ?>