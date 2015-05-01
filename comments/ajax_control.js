$(document).ready(function(){

	sucessful = false;
	errorDelay = 10000;

	var approve = true; //Разрешение на повторное нажатие кнопки отправки комментария
	var sentCheckInterval = 1000;
	var antiSpamTimeout = 10000;
	var messageOnce = false; //Показывает выводилось ли уже сообщение о частой отправке

	function getExistComments(){
		var params = "getComments=true"; 
		insertNewData(params, "../add-comment.php", "comment-list", "POST");
	}

	function errorHandler(errorText){
		alert("Ошибка AJAX: " + errorText);
	}

	getExistComments(); //Получаем уже существующие комментарии
	//Обрабатываем клик по кнопке
	var firstValue

	$("#send_button").click(
 	function (){
 		var btn = this;
 		if(approve == true){
 			firstValue = $(btn).context.innerHTML;
 			approve = false; //Кнопка нажата, больше жать нельзя
 			messageOnce = false; //Можно снова выводить сообщения
	 		$(btn).addClass("send_button_loading");
			/*Извлекаем текст комментария из текстового поля*/
			var textOfComment = $('textarea[name=user_comment]')[0].value;
			var params = "currentComment=" + textOfComment; /*Параметры: пара = значение*/
			insertNewData(params, "../add-comment.php", "comment-list", "POST");
			var intervalHandle = setInterval( function(){ /*Таймаут на соединение*/
					if(sucessful == true){
						$(btn).removeClass("send_button_loading");
						$(btn).addClass("send_button_blocked");
						clearInterval(intervalHandle);
						setTimeout(function(){ //Выставляем таймаут для спамеров, которые не знают js или надеятся на то, что нет проверки на сервере
							approve = true;
							if(firstValue != "" || firstValue != "undefined"){
								$(btn).context.innerHTML = "<span>" + firstValue + "</span>";
							}
							$(btn).removeClass("send_button_blocked");
						}, antiSpamTimeout);
					}
		    	}, sentCheckInterval);
 		}
 		else{
 			//выводим поясняющую надпись
 			if(messageOnce != true){
 				firstValue = $(btn).context.innerHTML;
	 			var tempValue = "<span>Подождите " + antiSpamTimeout/1000 + " секунд.</span>";
	 			$(btn).context.innerHTML = tempValue;
	 			messageOnce = true;
 			}
 		}
	});

	/*$("#vk_auth").click(
		function () {
			var params = "goAuth=true";
			insertNewData(params, "/vk_auth2.php", null, "POST"); //Просто вызываем скрипт
		});*/

});