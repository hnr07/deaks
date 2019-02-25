<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
global $USER;
$_SESSION["PHONE"]=$_POST["my_phone"];
$NUMERIC=str_replace(array("+","-","(",")"," "),"",$_POST["my_phone"]);
if($NUMERIC!=$USER->GetLogin()) {
	$rsUser = CUser::GetByLogin($NUMERIC);  // ищем пользователя в базе по коду
	if($arUser = $rsUser->Fetch()){
		//echo "<pre>"; print_r($arUser); echo "</pre>";
		$UID=$arUser["ID"];
		$USER->Authorize(intval($UID)); // авторизуем пользователя
	}
	
}
else $UID=$USER->GetID();

if($UID) {
	echo $UID;
} else {?>
	<b style="font-size:15px;letter-spacing:2px;">Пользователь не найден.</b>
<?}?>
<script></script>