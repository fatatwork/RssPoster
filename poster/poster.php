<?php
require_once 'VKclass.php';
$token = '92b73575a455b69bd32a54215038a3a74e7997d73923a364bd93790912b7f576c18b813f440348dfb5321&expires_in=0&user_id=152223765';
$delta = '100';
$app_id = '4832378';
$group_id = '32434505';
$vk = new vk( $token, $delta, $app_id, $group_id );
//Допустим альбом уже создан, проверим не переполнен ли он
$vk_album = '147357697';
if( $vk->get_album_size( $vk_album ) > 400 ) {
	//если переполнен, более 400 фоток
	//то создаём новый
	$vk_album = $vk->create_album( 'Мемы', 'описание' );
}
//загружаем фотографию
$vk_photo = $vk->upload_photo('/tmp/books.png', $vk_album, 'фотка' );
//пишем пост на стену
$vk_post = $vk->post('', $vk_photo, 'http://www.bsmu.by/allarticles/rubric2/article1046/' );
?>