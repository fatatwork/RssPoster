<?php 
     require 'app_config.php'; //подключение файла с данными для входа в БД
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
          
          //коннект к базе
          $dbconnect = mysql_connect ($dbhost, $dbusername, $dbpass);
          if (!$dbconnect){ die("<p>Ошибка подключения к базе данных: " . mysql_error() . "</p>"); }
          //говорим базе что записываем в нее все в utf8
          mysql_query("SET NAMES 'utf8';"); 
          mysql_query("SET CHARACTER SET 'utf8';"); 
          mysql_query("SET SESSION collation_connection = 'utf8_general_ci';");

          mysql_select_db($db_name) or die ("<p>Невозможно выбрать базу: " . mysql_error() . "</p>");


          $query = "INSERT INTO users (first_name, last_name, network, network_url)" .
          "VALUES ('{$username['first_name']}', '{$username['last_name']}', '{$username['network']}', '{$username['identity']}');";
          $result = mysql_query($query) or die("<p>Невозможно сделать запись комментария: " . mysql_error() . "</p>"); 
          
          $query= "INSERT INTO comments (comment) VALUES ('{$comment}');" or die("<p>Невозможно сделать запись комментария: " . mysql_error() . "</p>");
          $result = mysql_query($query) or die("<p>Невозможно сделать запись комментария: " . mysql_error() . "</p>");
     } else echo ("Error: user not exist.");
                    //$user['network'] - соц. сеть, через которую авторизовался пользователь
                    //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
                    //$user['first_name'] - имя пользователя
                    //$user['last_name'] - фамилия пользователя
     ?>