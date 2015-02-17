<script src="//ulogin.ru/js/ulogin.js"></script>
<div id="uLogin" data-ulogin="display=small;fields=first_name,last_name;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;redirect_uri=http%3A%2F%2Fbsmu.akson.by%2Fsample.php"></div>
    
    <?php
     $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
     $user = json_decode($s, true);
     if($user['first_name']){
     echo ("Your name is ".$user['first_name']);
     echo ("Your login with ".$user['network']);
     echo ("Your id ".$user['identity']);
     }
                    //$user['network'] - соц. сеть, через которую авторизовался пользователь
                    //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
                    //$user['first_name'] - имя пользователя
                    //$user['last_name'] - фамилия пользователя
     ?>