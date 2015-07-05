<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; CHARSET=UTF-8">
</head>
</html>
<?php
require_once 'VKclass.php';
//инациализация вк
//$token="c76ae506cd10e151a03b47f0ca8160552cb64ac8799bfddeecebd44674b4175ff25323df2933c530470fb&expires_in=0&user_id=152223765";
$token    = '92b73575a455b69bd32a54215038a3a74e7997d73923a364bd93790912b7f576c18b813f440348dfb5321&expires_in=0&user_id=152223765';
$delta    = '100';
$app_id   = '4832378';
$group_id = '85303665';
$vk       = new vk( $token, $delta, $app_id, $group_id );

$rss_url = "http://www.bsmu.by/rss/rss.xml";
$rss     = simplexml_load_file( $rss_url );
$items   = $rss->channel->item;

$filter="owner"; $count=sizeof($items)*2;
$posts = $vk->getPosts($filter, $count);
if ( sizeof($items) ) {
	foreach ( $items as $item ) {
		$flag=true;//флаг разрешения для отправки поста
		for($i=1; $i<sizeof($posts); ++$i){
			if($posts[$i]->media->share_url == $item->link){
				//проверка, если изменили название статьи, но ссылка осталась той же
				//удаляем текущий пост и делаем новый с той же ссылкой
				if(strcasecmp($posts[$i]->text, $item->title)) $vk->deletePost($posts[$i]->id);
				else $flag=false;
				break;
			}
		}
		if($flag) $vk->post(null, null, $item->link);
	}
}
?>