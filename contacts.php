<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обратная связь");
?> 
<?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback", 
	"personal", 
	array(
		"USE_CAPTCHA" => "Y",
		"OK_TEXT" => "Спасибо, ваше сообщение отправлено.",
		"EMAIL_TO" => "hnr07@mail.ru",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
			2 => "MESSAGE",
		),
		"EVENT_MESSAGE_ID" => array(
		),
		"COMPONENT_TEMPLATE" => "personal"
	),
	false
);?>
<!--
<h1>Контактная информация</h1>
 
<div class="hr"></div>
 
<ul> 	 
  <li>E-mail: <a href="mailto:19Victoria84@gmail.com">19Victoria84@gmail.com</a>.</li>
 
  <li>Skype: Fadeeva_Victoria.</li>
 </ul>
-->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>