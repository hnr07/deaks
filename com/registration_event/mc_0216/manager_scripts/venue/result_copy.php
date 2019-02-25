<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?> 

<?  CModule::IncludeModule('form'); // подключаем модуль форма ?>
<br><br><br>
<h2>
Страница копирования заявки.
</h2>
<p>
Страница создает копию предложенной заявки от Вашего имени. Заявка-оригинал переводится в статус "Отменена".<br>
В заявке-копии поля оплаты доступны для редактирования при первом редактировании.<br>
При последующих редактированиях заявки доступность полей оплаты регламентируется на общем основании. 

</p>
<p><a href="#" onclick="history.back();">Админ-лист >>></a></p>
<br><br><br>
<?if(isset($_GET['copy_id'])){?>
<?
$RESULT_ID=$_GET['copy_id'];
$ar_Answer = CFormResult::GETDataByID(
	$RESULT_ID, 
	array(),  // массив символьных кодов необходимых вопросов
	$ar_Res, 
	$ar_Answer2);
	//echo "<pre>";print_r($ar_Res);echo "</pre>";
	//echo "<pre>";print_r($arAnswer);echo "</pre>";
	
	?>
	<?
	//if($ar_Res['STATUS_ID']!=$status_del) {
	$arValues = CFormResult::GetDataByIDForHTML($RESULT_ID, "Y");
	//echo "<pre>";print_r($arValues);echo "</pre>";
	
	?>
	<?
// ID веб-формы
$FORM_ID = $ar_Res['FORM_ID'];

// массив описывающий загруженную на сервер фотографию
//$arImage = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/images/photo.gif");



// создадим новый результат

if ($NEW_RESULT_ID = CFormResult::Add($FORM_ID, $arValues))
{ 



	echo "Копируем заявку № ".$RESULT_ID."...<br>";
    echo "Заявка № ".$NEW_RESULT_ID." успешно создана  в форме #".$ar_Res['FORM_ID']." - ".$ar_Res['NAME']."<br>";
	CFormResult::SetField( $NEW_RESULT_ID, "history_status", array ($ar_Answer['history_status'][0]['ANSWER_ID'] => "Копия №".$RESULT_ID." - ".date("Y.m.d H:i:s")));// Записываем изменение статуса в историю
	CFormResult::SetField( $NEW_RESULT_ID, "key_edit", array ($ar_Answer['key_edit'][0]['ANSWER_ID'] => "0"));// изменяем Ключ редактирования
    CFormResult::SetField( $NEW_RESULT_ID, "copy", array ($ar_Answer['copy'][0]['ANSWER_ID'] => "1"));// изменяем Ключ копирования		
	CFormResult::SetStatus($RESULT_ID, $status_del,"N");
	echo "Заявка № ".$RESULT_ID." переведена в статус \"Отменена\"<br>";
	CFormResult::SetStatus($NEW_RESULT_ID, $ar_Res['STATUS_ID'],"N");
	echo "Заявка № ".$NEW_RESULT_ID." переведена в статус ".$ar_Res['STATUS_TITLE']."<br>";

echo "<p><a href='result_edit_1.php?RESULT_ID=".$NEW_RESULT_ID."&WEB_FORM_ID=".$FORM_ID."'>Редактировать заявку № ".$NEW_RESULT_ID." >>></a></p>";

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>