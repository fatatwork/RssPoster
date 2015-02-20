<html>
<meta charset="UTF-8">
</html>
<?php
chdir("/home/user1137761");
require_once 'simplehtmldom/simple_html_dom.php';
$html = file_get_html('http://m.vk.com/wall-43932139_5970');
if(!$html) echo "error";

$fnd=$html->find('a.item_date');

$item=end($fnd);
$item=substr($item, -10);
echo "$item ";

sscanf($item, "%d:%d", $hour, $min);
$minLastComm=$hour*60+$min;
echo "$minLastComm ";//минуты последнего коммента

$currentDate=date("H:i");
echo "$currentDate ";//минуты текущего времени

sscanf($currentDate,"%d:%d" ,$hour, $min);
$currentMin=$hour*60+$min;
echo "$currentMin ";
$diff=$currentMin-$minLastComm;//разница в минутах
echo " DIFF=$diff ";

$html->clear();//очистка памяти от объекта
unset($html);

if($diff>=20){
	$message = "Последний коммент был оставлен $diff минут(ы) назад";
	//$body=file_get_contents("http://sms.ru/sms/send?api_id=b8646699-0b12-1c14-ad92-7ab16971b8a1&to=375259466591&text=".urlencode(iconv("windows-1251","utf-8","Привет!")));
	mail("good-1991@mail.ru", "Chat", $message);
}
?>