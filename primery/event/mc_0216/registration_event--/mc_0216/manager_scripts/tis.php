<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
include "../var_config.php";
$APPLICATION->SetTitle($title_m);
?> 

<link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" />
<script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"></script>
<br/>
<div class="manager_scripts">
<div class="a_vozo"><a href="./">Все служебные обработчики</a><div id="sz"><div><img src="/images/registration_event/d.gif"></div></div></div>
<h2><?$APPLICATION->ShowTitle();?><br/>Выборочное, разовое изменение суммы заявки</h2>
<br/>
<style>
#t_tis {
border:solid 1px #b5b5b5;
}
#t_tis td, #t_tis th{
padding:5px;
}
#t_tis tr:nth-child(odd) {
background:#eee;
}
</style>
<form><input type="submit" name="sb" value="Изменить" style="border:solid 1px green;margin:10px;padding:5px;"></form>
<?
CModule::IncludeModule("form");
$za="SELECT * FROM `tis`";
if(!($z=@mysql_query($za))) {echo "Не могу выполнить запрос"; exit;} //не выполнен запрос
else {
$rows=mysql_num_rows($z);
echo "<table id='t_tis'>";
echo "<tr><th>Мероприятие</th><th>№ заявки</th><th>Сумма заявки</th><th>Новая сумма заявки</th><td>&nbsp;</td></tr>";
	for($i=0;$i<$rows;$i++) 
	   {
	   echo "<tr>";
       $pa=mysql_fetch_array($z);
	   $RESULT_ID=$pa['id'];
	   $NAmount=str_replace(",",".",$pa['NAmount']);
	   echo "<td>".$pa['SummitId']."</td>";
	   echo "<td>".$RESULT_ID."</td>";
	   $arAnswer = CFormResult::GETDataByID(
	$RESULT_ID, 
	array('money_2',"key_edit"),  // массив символьных кодов необходимых вопросов
	$ar_Res, 
	$ar_Answer2);
	if($arAnswer) {
		if(isset($_GET["sb"])) {
		CFormResult::SetField( $RESULT_ID, "key_edit", array ($arAnswer["key_edit"][0]["ANSWER_ID"] => "0"));// изменяем Ключ редактирования для участия заявки в передаче данных в базу
		CFormResult::SetField( $RESULT_ID, "money_2", array ($arAnswer["money_2"][0]["ANSWER_ID"] => $NAmount)); // изменяем стоимость заявки в нац. валюте
		echo "<td><span style='text-decoration:line-through;'>".$arAnswer['money_2'][0]['USER_TEXT']."</span></td>";
		$in="<span style='color:green'>Изменено</span>";
		}
		else {
		echo "<td>".$arAnswer['money_2'][0]['USER_TEXT']."</td>";
		$in="Просмотр";
		}
	
	echo "<td>".$NAmount."</td>";
	echo "<td>".$in."</td>";
	}
	else echo "<td colspan='2'><span style='color:red;'>Заявка не найдена</span></td>";
	echo "</tr>";
		}
		echo "</table>";
		echo "<br>Всего обработано заявок - ".$rows." шт.<br>";
}
?>

</div>
<br/><br/> <br/><br/> <br/><br/> <br/><br/>
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>