$(document).ready(function(){

	function getExistComments(){
		var params = "getComments=true"; 
		makeRequest(params);
	}

	var sendFunction = function (){
		/*Извлекаем текст комментария из текстового поля*/
		var textOfComment = $('textarea[name=user_comment]')[0].value;
		var params = "currentComment=" + textOfComment; /*Параметры: пара = значение*/
		makeRequest(params);
	}

	function makeRequest(params){
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
	    	}, 10000);
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

	getExistComments();
	//Обрабатываем клик по кнопке
	$("#send_button").click(sendFunction);

});