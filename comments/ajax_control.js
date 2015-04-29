$(document).ready(function(){

	var sucessful = false;
	var approve = true; //Разрешение на повторное нажатие кнопки отправки комментария
	var errorDelay = 10000;
	var sentCheckInterval = 1000;
	var antiSpamTimeout = 10000;
	var messageOnce = false; //Показывает выводилось ли уже сообщение о частой отправке

	function getExistComments(){
		var params = "getComments=true"; 
		makeRequest(params);
	}

	function makeRequest(params){
		sucessful = false;
		request = new ajaxRequest(); /*Создаем новый обьект запроса (функция снизу)*/
		request.open("POST", "../add-comment.php", true); /*Настраиваем обьект на создаение post запроса по адресу файла php сценария. true - указывает на включение асинхронного режима*/
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
		/*Отправляем http заголовки, для того чтобы сервер знал о поступлении POST запроса*/
		request.onreadystatechange = function(){ /*Указывает на CALLBACK функцию, которая должна вызываться при каждом изменении свойства readyState*/
			if (this.readyState == 4) {
				if(this.status == 200){
					clearTimeout(timeoutHandle);
					if(this.responseText != null){
						var comments = this.responseText;
						document.getElementsByClassName("comment-list")[0].innerHTML = comments;
						sucessful = true;
					}
					else{
						alert("Ошибка AJAX: Данные не получены");
					}
				}
				else{
					clearTimeout(timeoutHandle);
					alert("Ошибка AJAX: " + this.statusText);
				}
			};
		}
		request.send(params); /*Собственно отправка запроса*/
		var timeoutHandle = setTimeout( function(){ /*Таймаут на соединение*/
	    	request.abort(); errorHandler("Время ожидания вышло. Проверьте соединение и попробуйте ещё раз.") 
	    	}, errorDelay);
	}


	function ajaxRequest(){
		try{
			var request = new XMLHttpRequest()
		}
		catch(e1){
			try{
				request = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e2){
				try{
					request = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch(e3){
					request = false;
				}
			}
		}
		return request;
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
 			approve = false; //Кнопка нажата, больше жать нельзя
 			messageOnce = false; //Можно снова выводить сообщения
	 		$(btn).addClass("send_button_loading");
			/*Извлекаем текст комментария из текстового поля*/
			var textOfComment = $('textarea[name=user_comment]')[0].value;
			var params = "currentComment=" + textOfComment; /*Параметры: пара = значение*/
			makeRequest(params);
			var intervalHandle = setInterval( function(){ /*Таймаут на соединение*/
					if(sucessful == true){
						$(btn).removeClass("send_button_loading");
						$(btn).addClass("send_button_blocked");
						clearInterval(intervalHandle);
						setTimeout(function(){ //Выставляем таймаут для спамеров, которые не знают js или надеятся на то, что нет проверки на сервере
							approve = true;
							if(firstValue != "" || firstValue != "undefined"){
								$(btn).context.innerHTML = firstValue;
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

});