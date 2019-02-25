<?
    // подключим пролог
    //if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	IncludeTemplateLangFile(__FILE__);
	global $_lang;
$_lang=LANGUAGE_ID;
global $_lang_dir; 
$_lang_dir="/".LANGUAGE_ID."/";
    global $USER;
global $_lang;
    if ($USER -> IsAuthorized()) {
       // die('Y'); // если авторизация прошла успешно, возвращаем Y
		echo "Y^".$USER->GetFullName()."^";
		
		$APPLICATION->IncludeComponent("cc_15:menu.top", "menu_top_15", array(

			"ROOT_MENU_TYPE" => "top",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600"
			),
			false
		);
		echo "^";
	include "../com/include/footer-phone.php";
    }
	else {
		// в противном случае нам нужно вернуть html с описанием ошибок
		if (isset($arResult['ERROR_MESSAGE']['MESSAGE']) && strlen($arResult['ERROR_MESSAGE']['MESSAGE']) > 0)
		{
			die($arResult['ERROR_MESSAGE']['MESSAGE']);
		}
		else
		{
			// ну а если описание ошибок отсутствует, вернем простое служебное сообщение,
			// чтобы не держать пользователя в неведении
			die('Ошибка авторизации');
		}
	}
?>