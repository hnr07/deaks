$(document).ready(function(){
    // ловим событие отправки формы
    $('.auth_form form').submit(function(){
             
        // хорошим тоном будет сделать минимальную проверку формы перед отправкой
        // хотя бы на заполненность всех обязательных полей
        // в целях краткости здесь она не приводится
		var lang = $("#site_lang").val();
        var path = '/ajax/ajax_auth_form.php?/'+lang+'/'; // объявляем путь к ajax-скрипту авторизации
        var formData = $(this).serialize(); // выдергиваем данные из формы
         
        // объявляем функцию, которая принимает данные из скрипта path
        var success = function( response ){
		var ar_h=response.split("^");
            if (ar_h[0] == 'Y')
            {
               // window.location.href = window.location.href; // если авторизация успешна, перезагрузим страницу
				$('.auth_start .auth_name div').html( ar_h[1]).show();
				$('.auth_start .logout').css({"display":"inline"});
				$('.auth_start .ah_auth').css({"display":"none"});
				$('.auth_start .auth_name').css({"display":"inline"});
				$('.index-news_mq div').css({"visibility":"visible"});
				$('.auth_form .md-close').click();
				
				//$('#mainMenuBox').html( ar_h[2] ).show();
				$('#header_menu_top').html( ar_h[2]).show();
				$('.footer #phone').html( ar_h[3]).show();
            }
            else
            {
                // в противном случае в переменной response будет текст ошибки
                // и его нужно где-то отобразить
                $('#auth-error').html( response ).show();
            }          
        };
 
        // явно указываем тип возвращаемых данных
        var responseType = 'html';
 
        // делаем ajax-запрос
        $.post( path, formData, success, responseType );
 
        return false; // не даем форме отправиться обычным способом
    });
});
