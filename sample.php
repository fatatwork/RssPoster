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
     require_once '/app_config.php'; //подключение файла с данными для входа в БД

     $comment = trim($_REQUEST['user_comment']);
     if(!$comment) die("Error comment");

     function searchUser($username){//ищем юзера по url возвращаем в качестве результата всю строку row
          $query="SELECT * FROM users WHERE first_name='{$username['first_name']}'".
          " AND last_name='{$username['last_name']}' AND network_url = '{$username['identity']}'";//ищем есть ли такой же url в базе
          $res=mysql_query($query) or die("<p>Невозможно сделать запрос поиска пользователя: " . mysql_error() . "</p>");
          $row=mysql_fetch_array($res);//получение результата запроса из базы;
          return $row;
     }
     function addUser($username){//добавление пользователя
          $query = "INSERT INTO users (first_name, last_name, network, network_url)" .
          "VALUES ('{$username['first_name']}', '{$username['last_name']}', '{$username['network']}', '{$username['identity']}');";
          $result = mysql_query($query) or die("<p>Невозможно добавить пользователя " . mysql_error() . "</p>");
     }

     function addComment($user_id, $comment){//добавляем комментарий
          $query= "INSERT INTO comments (user_id, comment) VALUES ('{$user_id}', '{$comment}');";
          $res =mysql_query($query) or die("<p>Невозможно сделать запись комментария: " . mysql_error() . "</p>");
          if($res) return true;
          else return false;
     }

     if(isset($username)){
          //коннект к базе
          $dbconnect = mysql_connect ($dbhost, $dbusername, $dbpass) or die("<p>Ошибка подключения к базе данных: " . mysql_error() . "</p>");
          //говорим базе что записываем в нее все в utf8
          mysql_query("SET NAMES 'utf8';"); 
          mysql_query("SET CHARACTER SET 'utf8';"); 
          mysql_query("SET SESSION collation_connection = 'utf8_general_ci';");
          mysql_select_db($db_name) or die ("<p>Невозможно выбрать базу: " . mysql_error() . "</p>");

          $row=searchUser($username);//первоначально ищем пользователя
          if($row){//если есть пользователь с таким url - получаем ммассив-строку с его данными и пишем коммент
               $user_id=$row['id'];
               if($user_id) addComment($user_id, $comment);
               
          } else {//если пользователя нет - добавляем нового и пишем коммент
            addUser($username);
            $row=searchUser($username);
            $user_id=$row['id'];//получаем id вновьдобавленного пользователя
            addComment($user_id, $comment);
          }

     } else echo ("Error: user not exist.");
                    //$user['network'] - соц. сеть, через которую авторизовался пользователь
                    //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
                    //$user['first_name'] - имя пользователя
                    //$user['last_name'] - фамилия пользователя
     ?>