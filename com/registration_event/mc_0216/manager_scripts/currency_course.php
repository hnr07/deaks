<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
include "../var_config.php"; 
global $USER;
if(!in_array($group_id, $USER->GetUserGroupArray())) echo "<meta http-equiv=\"refresh\" content=\"0;url=/\" />";
$APPLICATION->SetTitle($title_m);
?> 
<link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" />
<script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"></script>
<script type="text/javascript" src="/js/datepicker/cal_cur.js"></script>
<link rel="stylesheet" href="/js/datepicker/cal.css" type="text/css" /> 
<script>
$(function()
{
$('#cur_date').simpleDatepicker_cur();  // Привязать вызов календаря к полю с CSS идентификатором

});
</script>
<?
$fi_name='0';
if(isset($_GET['fi_name']) && $_GET['fi_name']!="0") $fi_name=$_GET['fi_name'];
?>
<?
	
	if(CModule::IncludeModule("form")){ 
	
	$FORM_ID = 8;
			
		$rsResults = CFormResult::GetList($FORM_ID, 
			($by="s_timestamp"), 
			($order="asc"), 
			$arFilter, 
			$is_filtered, 
			"Y", 
			false);
		
		while ($arResult = $rsResults->Fetch())
		{
		//echo "<pre>";print_r($arResult);echo "</pre>";
		$RESULT_ID_=$arResult['ID'];
		$arAnswer_ = CFormResult::GetDataByID(
		$RESULT_ID_, 
		array('name','code','currency_number'),  // массив символьных кодов необходимых вопросов
		$ar_Res_, 
		$ar_Answer2_); 
			
		$ar_cur_list[$arAnswer_['currency_number'][0]['USER_TEXT']]['name']=$arAnswer_['name'][0]['USER_TEXT'];
		$ar_cur_list[$arAnswer_['currency_number'][0]['USER_TEXT']]['code']=$arAnswer_['code'][0]['USER_TEXT'];
		$ar_cur_list[$arAnswer_['currency_number'][0]['USER_TEXT']]['currency_number']=$arAnswer_['currency_number'][0]['USER_TEXT'];

		}
	
	
	$FORM_ID = 9;
		$arFilter = array();
		$arFields = array();
		$arFields[] = array(
			"CODE"              => "code_m",     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
			"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
			"VALUE"             => $code_m,        // значение по которому фильтруем
			"EXACT_MATCH"       => "Y"              // ищем точное совпадение
		);
		if($fi_name) {
			$arFields[] = array(
				"CODE"              => "currency_number",     // код поля по которому фильтруем
				"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
				"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
				"VALUE"             => $fi_name,        // значение по которому фильтруем
				"EXACT_MATCH"       => "Y"              // ищем точное совпадение
			);
		}
		
		$arFilter["FIELDS"] = $arFields;
				// выберем (первые) все результатов
		$rsResults = CFormResult::GetList($FORM_ID, 
			($by="s_timestamp"), 
			($order="asc"), 
			$arFilter, 
			$is_filtered, 
			"Y", 
			false);
		
		while ($arResult = $rsResults->Fetch())
		{
		//echo "<pre>";print_r($arResult);echo "</pre>";
		$RESULT_ID=$arResult['ID'];
		$arAnswer = CFormResult::GetDataByID(
		$RESULT_ID, 
		array('course','date_a','currency_number'),  // массив символьных кодов необходимых вопросов
		$ar_Res, 
		$ar_Answer2); 
			
		$ar_cur[$RESULT_ID]['course']=$arAnswer['course'][0]['USER_TEXT'];
		$ar_cur[$RESULT_ID]['date_a']=$arAnswer['date_a'][0]['USER_TEXT'];
		$ar_cur[$RESULT_ID]['currency_number']=$arAnswer['currency_number'][0]['USER_TEXT'];
		$ar_cur[$RESULT_ID]['DATE_CREATE']=$ar_Res['DATE_CREATE'];
		
		$rsUser = CUser::GetByID($ar_Res['USER_ID']);
		$arUser = $rsUser->Fetch();
		$ar_cur[$RESULT_ID]['USER']=$arUser['NAME']." ".$arUser['LAST_NAME'];
		
		//echo "<pre>";print_r($ar_Res);echo "</pre>";
		//echo "<pre>";print_r($arAnswer);echo "</pre>";
		}
		
	}
	
		
?>
<br/>

<div class="manager_scripts">
<div class="a_vozo"><a href="./">Все служебные обработчики</a></div>
<h2><?$APPLICATION->ShowTitle();?><br/> <br/>Курсы валют.</h2>
<br/>
<a href="currency_list.php">Список используемых валют >>></a>
<br/><br/>
<?

if(isset($_GET['nc'])) {
echo "Новый курс валюты добавлен!";
}

if(isset($_POST['add_course'])) {
	
	if($_POST['cur_name'] && $_POST['cur_course'] && $_POST['cur_date']) {	
	
			$arValues = array (
				"form_text_273" => $code_m,    // Код мероприятия
				"form_text_274" => $_POST['cur_name'],    // Код валюты
				"form_text_275" => $_POST['cur_course'],     // Курс валюты
				"form_text_276" => trim($_POST['cur_date']),      // Дата активности валюты
				"form_text_277" => strtotime(trim($_POST['cur_date'])),      // Метка времени
			);
			if ($nr=CFormResult::Add($FORM_ID, $arValues))
			{
				
				
				////////////////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////NEW WS TS SCRIPTS////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////////
				
				require($_SERVER["DOCUMENT_ROOT"]."/ccws/sum_models/class_event.php");
				$ccws= new ccws_event();

					
				$result=$ccws->Set_currency_exchange(array( 
						'SummitId' => $summit_id,
						'CurrencyCode' => trim($_POST['cur_name']),
						'DateOfCurrencyRate' => $_POST['cur_date']." 00:00:00", //Формат времени не важен
						'CurrencyRate' => trim($_POST['cur_course'])
				));

				if ($result['ErrorCode']==0) {
					echo"<script>document.location.href = 'currency_course.php?nc=1&fi_name=$fi_name';</script>";
				}
				else echo $result['ErrorCode']." - ".$result['ErrorText'];
				
				////////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////////
				echo"<script>document.location.href = 'currency_course.php?nc=1&fi_name=$fi_name';</script>";
			}
			else
			{
				echo "Не могу установить курс!";
			}
		
	}
	else echo "Все поля обязательны к заполнению!";

}

?>
<form>
Показать только 
<select id="fi_name" name="fi_name" class="sel_sy">
<option value='0'>- все -</option>
<?
foreach($ar_cur_list as $k=>$v) {
if($fi_name==$k) $ks="selected";
else $ks="";
echo "<option value='".$k."' ".$ks.">".$v['name']."</option>";
}
?>
</select>
<input type="submit" value="выбрать" class="buts">
</form>
<table class="tmbl">
<tr>
<th>Валюта</th><th>ID/Код</th><th>Курс</th><th>Дата активности</th><th>Кем добавлен</th>
</tr>
<?


	foreach($ar_cur as $k=>$v) 
	   {
       $pa=mysql_fetch_array($z);
		  echo "<tr><td width='150'>".$ar_cur_list[$v['currency_number']]['name']."</td><td width='150'>".$v['currency_number']."/".$ar_cur_list[$v['currency_number']]['code']."</td><td width='150'>".$v['course']."</td><td width='150'>".$v['date_a']."</td><td>".$v['USER']." (".$v['DATE_CREATE'].")</td></tr>";

		}
	
?>
</table>

<form action="currency_course.php?fi_name=<?=$fi_name?>" method="POST" onsubmit="return f_course_currency()">
<table class="tmbl">
<tr>
<th colspan="3"><div class="chte"><b>Добавить новый курс</b> <span onclick="f_ps('txt2')"><u>Что это? >>></u></span><div id="txt2" class="txt" onclick="f_us('txt2')">
Данная форма позволяет добавить новый курс с выбранной датой активности в существующий список.<br/>
Все поля обязательны для заполнения.<br/>Примечание: дробная часть значения куса отделяется от целой только точкой.
 <br/><br/><u>закрыть</u></div></div></th>
 <th></th>
</tr>
<tr>
<td>Валюта<br/>
<select id="cur_name" name="cur_name" class="sel_sy">
<?
foreach($ar_cur_list as $k=>$v) {
echo "<option value='".$k."'>".$v['name']."</option>";
}
?>
</select>
</td>
<td>Значение курса<br/><input type="text" id="cur_course" name="cur_course"  class="input_text" style="width:100px;"></td>
<td>Дата активности<br/><input type="text" id="cur_date" name="cur_date"  class="input_text" style="width:100px;"></td>

<td><input type="submit" name="add_course" value="Добавить"  class="buts" style="height:35px;"></td>
</tr>

</table>
</form>
</div>

<br/><br/> <br/><br/> <br/><br/> <br/><br/>
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>