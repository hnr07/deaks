<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
include "../var_config.php"; 
global $USER;
if(!in_array($group_id, $USER->GetUserGroupArray())) echo "<meta http-equiv=\"refresh\" content=\"0;url=/\" />";
$APPLICATION->SetTitle($title_m);
?> 
<link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" />
<script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"></script>

<br/>

<div class="manager_scripts">
<div class="a_vozo"><a href="./">Все служебные обработчики</a></div>
<h2><?$APPLICATION->ShowTitle();?><br/> <br/>Список используемых валют.</h2>
<br/>
<a href="currency_course.php">Курсы валют >>></a>
<br/>

	<?
	if(CModule::IncludeModule("form")){ 
	$FORM_ID = 8;
			
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
		array('name','code','currency_number'),  // массив символьных кодов необходимых вопросов
		$ar_Res, 
		$ar_Answer2); 
			
		$ar_cur_list[$RESULT_ID]['name']=$arAnswer['name'][0]['USER_TEXT'];
		$ar_cur_list[$RESULT_ID]['code']=$arAnswer['code'][0]['USER_TEXT'];
		$ar_cur_list[$RESULT_ID]['currency_number']=$arAnswer['currency_number'][0]['USER_TEXT'];
		
		$ar_currency_number[$RESULT_ID]=$arAnswer['currency_number'][0]['USER_TEXT'];
		//echo "<pre>";print_r($arAnswer);echo "</pre>";
		}
	}
	
	?>

<?
if(isset($_POST['base_currency'])) {
$fr=@fopen("base_currency.txt","w");
$somecontent=$_POST['nid_base_currency']."@".date("d.m.Y H:i")."@".$USER->GetFullName()."[".$USER->GetID()."]";
if (fwrite($fr, $somecontent) === FALSE) {
        echo "Не могу изменить базовую валюту мероприятия!";
        exit;
    }
    echo "Базовая валюта мероприятия изменена!";
@fclose($fr);
}

if(isset($_POST['add_cur'])) {
	if($_POST['cur_name'] && $_POST['cur_code'] && $_POST['cur_id']) {
		$rid=array_search($_POST['cur_id'], $ar_currency_number);
		if($rid) {
			if(CFormResult::SetField( $rid, "name", array (269 => $_POST['cur_name']))) $ar_cur_list[$rid]['name']=$_POST['cur_name']; // 
			if(CFormResult::SetField( $rid, "code", array (270 => $_POST['cur_code']))) $ar_cur_list[$rid]['code']=$_POST['cur_code']; // 	
		}
		else {
			
			$arValues = array (
				"form_text_269" => $_POST['cur_name'],    // "наименование"
				"form_text_270" => $_POST['cur_code'],     // "Символьный код валюты"
				"form_text_271" => $_POST['cur_id'],      // "Код валюты"
			);
			if ($nr=CFormResult::Add($FORM_ID, $arValues))
			{
				echo "Валюта успешно создана";
				$ar_cur_list[$nr]['name']=$_POST['cur_name'];
				$ar_cur_list[$nr]['code']=$_POST['cur_code'];
				$ar_cur_list[$nr]['currency_number']=$_POST['cur_id'];
				
			}
			else
			{
				echo "Не могу создать валюту";
			}
		}
	}
	else echo "Все поля обязательны к заполнению!";
}

?>


<?
$fr=@fopen("base_currency.txt","r");
	$str_base_curency=@fgets($fr,255);
	@fclose($fr);

$ar_base_curency=explode("@",$str_base_curency);
$id_base_curency=trim($ar_base_curency[0]);
	
?>




	
	<?
	if(count($id_base_curency)!=1) echo ""
	?>
<table class="tmbl">
<tr>
<th>Валюта</th><th>Код</th><th>ID валюты</th><th>Базовая валюта</th>

<?
foreach($ar_cur_list as $k=>$v) {
	echo "<tr><td width='150'>".$v['name']."</td><td width='150'>".$v['code']."</td><td width='150'>".$v['currency_number']."</td><td><div class='radio_d'>";
			  if(trim($v['currency_number'])==$id_base_curency) echo "&#9673;";
			  else echo "<div><form method='POST' onsubmit=\"return f_base_currency('".$v['name']."')\"><input type='submit' name='base_currency' value='&#9678;'><input type='hidden' name='nid_base_currency' value='".(trim($v['currency_number']))."'></form></div>";
			 echo "</div></td></tr>";
}
?>


</tr>
	
</table>

<form method="POST">
<table class="tmbl">
<tr>
<th colspan="3"><div class="chte"><b>Добавить или изменить</b> <span onclick="f_ps('txt2')"><u>Что это? >>></u></span><div id="txt2" class="txt" onclick="f_us('txt2')">
Данная форма позволяет добавить новую валюту в существующий список.<br/>
Если валюта с таким ID есть в списке она будет изменена.
 <br/><br/><u>закрыть</u></div></div></th>
 <th></th>
</tr>
<tr>
<td>Валюта<br/><input type="text" name="cur_name" value="<?=$_POST['cur_name']?>" class="input_text"></td>
<td>Код<br/><input type="text" name="cur_code" value="<?=$_POST['cur_code']?>" class="input_text" style="width:100px;"></td>
<td>ID валюты<br/><input type="text" name="cur_id" value="<?=$_POST['cur_id']?>" class="input_text" style="width:100px;"></td>
<td><input type="submit" name="add_cur" value="Добавить или изменить" style="height:35px;"></td>
</tr>

</table>
</form>
</div>

<br/><br/> <br/><br/> <br/><br/> <br/><br/>
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>