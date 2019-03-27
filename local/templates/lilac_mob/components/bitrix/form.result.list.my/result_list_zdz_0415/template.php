
<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (count($arResult['FORMS']) <= 0)
{
	ShowNote(GetMessage('FRLM_NO_RESULTS'));
	return;
}
?>

<?
global $APPLICATION, $USER, $CCIExternalAuth;

//$oWS = new CCI_PDPWS();
// ОПРЕДЕЛЯЕМ СЕССИЮ
$iDSesison = $APPLICATION->get_cookie("BX_AUTH_SESSION_ID");
if(empty($iDSesison)) {$iDSesison = $USER->GetLogin();};
if(empty($iDSesison)) {$iDSesison = "SOS";}

?>

<? 
include "var_config.php";  // Конфигурация мероприятия
include "functions.php";  // Функции PHP
include "meter_hotel.php"; // Статистика отелей
//include "meter_hotel_ls.php"; //  Статистика отелей Leadership

$ceq=200/$q_activ;
$peq=100/$q_activ;
?>
<!--<script src="/jquery/jquery-1.6.2.js" type="text/javascript"></script> -->
<script type="text/javascript">

function confirmDelete(id) {
var text_confirm=$("#but_del_"+id).attr("title");
	if (confirm(text_confirm+"?")) {
		show_status_del(id);
	} 
}

  function show_status_del(id)  
        {  
            $.ajax({  
                url: "zayavka_del.php?id_del="+id,  
                cache: false,  
                success: function(html){  
                    $("#t_status_"+id).html(html);		
                }  
            }); 
            $("#but_del_"+id).css("visibility","hidden");
			$("#regi_"+id).css("display","none");
			$("#nde_1_"+id).css("text-decoration","line-through");			
        } 
</script>

<div class="bx-mylist-layout">
<div id="tr"></div>
<?
//echo '<pre>'; print_r($arResult[RESULTS]); echo '</pre>';
?>

<?
foreach ($arResult['FORMS'] as $FORM_ID => $arForm):
?>
	<div class="bx-mylist-form" id="bx_mylist_form_<?echo $FORM_ID?>">
		<div class="bx-mylist-form-info">
			<!--<b><?echo $arForm['NAME']?></b>-->
		</div>
		<div class="bx-mylist-form-results">
		<table id="tit"><tr>
		<td><div id="tit1"><?echo GetMessage('TIT_2')?></div></td>
		<td><div id="tit2"><?echo GetMessage('TIT_1')?></div></td>
		<td><div id="tit3"><?echo GetMessage('TIT_3')?></div></td>
		<td><div id="tit4"><?//echo GetMessage('TIT_4')?></div></td>
		<td><div id="tit5"><?echo GetMessage('TIT_5')?></div></td>
		<td><div id="tit6"><?echo GetMessage('TIT_6')?></div></td>
		<td><div id="tit7"><?//echo GetMessage('TIT_7')?></div></td>
		</tr></table>
<?

	$i = 0;
	foreach ($arResult['RESULTS'][$FORM_ID] as $arRes):
	$windi=ceil($arRes['__TITLE']*$ceq);
	$sindi=ceil($arRes['__TITLE']*$peq);
	$i++;
	
	//echo "<pre>";print_r($arRes);echo "</pre>";
			// смена статуса с 'поступила' на 'не подтверждена' или 'Ожидает промоушен' на финише заполнения заявки
			

	// получим данные по всем вопросам
$ar_Answer = CFormResult::GetDataByID(
	$arRes['ID'], 
	array('chk','family','name','kem_priglashen_chk','kem_priglashen_family','kem_priglashen_name','sum_debt','money_2_calc','currency','promotion_1','fly_1','fly_2','hotel','nomer','p_hotel','d_leader_ship','s_leader_ship','hotel_ls','nomer_ls','status','comments_admin'), 
	$ar_Result, 
	$ar_Answer2);
	//echo $ar_Answer['status']." ";
	//echo '<pre>'; print_r($ar_Answer['status']); echo '</pre>';
	//echo $ar_Answer['family'][0][USER_TEXT];
	
if($_GET['formresult']=="editok" && $_GET['RESULT_ID']==$arRes['ID'] && $arRes['STATUS_ID']==$status_new) {

	
	// переменные для проверки ЧК и гостей ЧК
	// Входящие данные для проверки участника  /////////////
	
	$p_chk=$ar_Answer['chk'][0]['USER_TEXT'];  // № ЧК
	$p_family=$ar_Answer['family'][0]['USER_TEXT']; // фамилия
	$p_name=$ar_Answer['name'][0]['USER_TEXT'];  // имя
	$p_kem_priglashen_chk=$ar_Answer['kem_priglashen_chk'][0]['USER_TEXT']; // Кем приглашён № ЧК
	$p_kem_priglashen_family=$ar_Answer['kem_priglashen_family'][0]['USER_TEXT']; // Кем приглашён фамилия
	$p_kem_priglashen_name=$ar_Answer['kem_priglashen_name'][0]['USER_TEXT']; // Кем приглашён имя
	$p_status=$ar_Answer['status'][0]['ANSWER_ID'];   // статус участника
		$rsAnswers_d = CFormAnswer::GetList(
		$ar_Answer['status'][0]['FIELD_ID'], 
		$by="s_id", 
		$order="asc", 
		$arFilter_d, 
		$is_filtered_d
		);
		$i=0;
	while ($arAnswer_d = $rsAnswers_d->Fetch())
	{
		$a_status[$i]=$arAnswer_d["ID"];
		$i++;
	}
	
	include "filter_chk.php"; // Подключаем проверки ЧК и гостей ЧК
	?>
	<?
	///////////////////////
		if($erk) : // Если проверки не пройдены /// 
	?>
		<div class="dicer_list">
	<?	
		$fu=0;  
		$str_error="";		
		foreach($errors as $key=>$val) {
				$str_error.=$val." ";
				echo "<div class='mess_rey'><div><i><b>№".$arRes['ID'].":</b> ".getMessage('GER_TIT_2')."</i></div>".$val."</div>"; // Текст ошибки

				if($key=="MEMBER" and count($errors) == 1) $fu=1;                // Разрешить регистрацию даже, если не пройдено условие участия
			}
		?>
		</div>
		<? endif;?>

<?$fu=1;
	// Установка статуса для новой заявки
	
	if($fu) { // Проверка пройдена
	
		//	$mz=f_nor($ar_Answer["hotel"][0]["ANSWER_ID"],$ar_Answer["nomer"][0]["ANSWER_ID"]);// мест
		if($ar_Answer['p_hotel'][0]['ANSWER_VALUE']=="r_comp") {
		$kmo=array_search($ar_Answer["hotel"][0]["ANSWER_ID"],$ar_hot);
		$mo=$ar_onor[$kmo];// остаток мест по отелю
		}
		else $mo=1;
		
		if($ar_Answer['d_leader_ship'][0]['ANSWER_VALUE']=="yes" || $ar_Answer['s_leader_ship'][0]['ANSWER_VALUE']=="yes") {
		$kmo_ls=array_search($ar_Answer["hotel_ls"][0]["ANSWER_ID"],$ar_hot_ls);
		$mo_ls=$ar_onor_ls[$kmo_ls];// остаток мест по отелю для Leader Ship
		}
		else $mo_ls=1;

		if($mo>0 && $mo_ls>0){
			if($ar_Answer['promotion_1'][0][USER_TEXT]) {
				CFormResult::SetStatus($arRes['ID'], $status_opl,"Y");  //Если промоушен пройден заявка в статус Ожидает оплаты
				$rsStatus = CFormStatus::GetByID($status_opl);
				$arStatus = $rsStatus->Fetch();
				$arRes["STATUS_TITLE"]=$arStatus["TITLE"];
				$arRes["STATUS_CSS"]=$arStatus["CSS"];
				$arRes['STATUS_ID']=$arStatus['STATUS_ID'];
			}
			else {
				CFormResult::SetStatus($arRes['ID'], $status_nepr,"Y");   //Если промоушен не пройден заявка в статус Ожидает промоушен
				$rsStatus = CFormStatus::GetByID($status_nepr);
				$arStatus = $rsStatus->Fetch();
				$arRes["STATUS_TITLE"]=$arStatus["TITLE"];
				$arRes["STATUS_CSS"]=$arStatus["CSS"];
				$arRes['STATUS_ID']=$arStatus['STATUS_ID'];
			}
		}	
		else {
		CFormResult::SetStatus($arRes['ID'], $status_rz,"Y");  //Если мест в отеле нет заявка в статус Резерв
				$rsStatus = CFormStatus::GetByID($status_rz);
				$arStatus = $rsStatus->Fetch();
				$arRes["STATUS_TITLE"]=$arStatus["TITLE"];
				$arRes["STATUS_CSS"]=$arStatus["CSS"];
				$arRes['STATUS_ID']=$arStatus['STATUS_ID'];
		}
		if($force_status) {
			CFormResult::SetStatus($arRes['ID'], $force_status,"Y");      // Если задан id принудительной установки статуса будет установлен статус с этим id
			$rsStatus = CFormStatus::GetByID($force_status);
			$arStatus = $rsStatus->Fetch();
			$arRes["STATUS_TITLE"]=$arStatus["TITLE"];
			$arRes["STATUS_CSS"]=$arStatus["CSS"];
			$arRes['STATUS_ID']=$arStatus['STATUS_ID'];
		}
			//echo $ar_Answer['promotion_1'][0][USER_TEXT]." >> ".$arRes["STATUS_TITLE"];
	}
	else {
		/*
		CFormResult::SetStatus($arRes['ID'], $status_no,"Y");      // Если не пройдена повторная проверка заявка в статус Не подтверждена
		$rsStatus = CFormStatus::GetByID($status_no);
		$arStatus = $rsStatus->Fetch();
		$arRes["STATUS_TITLE"]=$arStatus["TITLE"];
		$arRes["STATUS_CSS"]=$arStatus["CSS"];
		$arRes['STATUS_ID']=$arStatus['STATUS_ID'];
		*/
		CFormResult::SetField( $arRes['ID'], "comments_admin", array ($ar_Answer['comments_admin'][0]["ANSWER_ID"] => $str_error));// Добавляем текст ошибки проверки в комментарий администратора
	}
}
	
	if($ar_Answer['sum_debt'][0]['USER_TEXT']) $sum_debt=$ar_Answer['sum_debt'][0]['USER_TEXT'];
	else $sum_debt=0;
	$money_2_calc=str_replace("\n","<br/>",$ar_Answer['money_2_calc'][0]['USER_TEXT']);
	$fly_1=$ar_Answer['fly_1'][0]['ANSWER_TEXT'];
	$fly_2=$ar_Answer['fly_2'][0]['ANSWER_TEXT'];
	$hotel=$ar_Answer['hotel'][0]['ANSWER_TEXT'];
	$nomer=$ar_Answer['nomer'][0]['ANSWER_TEXT'];
	$hotel_ls=$ar_Answer['hotel_ls'][0]['ANSWER_TEXT'];
	$nomer_ls=$ar_Answer['nomer_ls'][0]['ANSWER_TEXT'];

?>
<?if($arRes['STATUS_ID']<>$status_new):?>
						<div class="orad">
						<div class="vurad">

<div class="noifi">
<span class="naki">&nbsp;&nbsp;&nbsp;&nbsp;<?echo GetMessage('FRLM_RESULT').$arRes['ID']?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
	<span class="date"><?echo $arRes['DATE_CREATE']?>&nbsp;&nbsp;</span>
	<? if($arRes['STATUS_ID']<>$status_del && $arRes['STATUS_ID']<>$status_ok && $arRes['STATUS_ID']<>$status_rz):?>
			<span id="nde_1_<?=$arRes['ID']?>"> <b><?echo $ar_Answer['family'][0]['USER_TEXT']?> <?echo $ar_Answer['name'][0]['USER_TEXT']?></b></span><span class="nde" id="nde_0_<?=$arRes['ID']?>"><?echo GetMessage('FRLM_RESULT').$arRes['ID']?> </span>
			<?else:?>
			<span <?if($arRes['STATUS_ID']==$status_del) echo "class='pech'"?>> <b><?echo $ar_Answer['family'][0]['USER_TEXT']?> <?echo $ar_Answer['name'][0]['USER_TEXT']?></b></span>
			<?endif;?>

</div>

<!--
<div class="bued">
<div class="indi" title="<?echo GetMessage('FRLM_COUNT_1').$arRes['__TITLE'].GetMessage('FRLM_COUNT_2').$q_activ.GetMessage('FRLM_COUNT_3')?>"><div class="peq"><?=$sindi?>%</div><div class="ceq" style="width:<?=$windi?>px;"></div></div>
			<? if($arRes['STATUS_ID']<>$status_del && $arRes['STATUS_ID']<>$status_ok):?>
			<div class="regi" id="regi_<?=$arRes['ID']?>"><a href="<?echo $arRes['__LINK']?>"><?echo GetMessage('FRLM_EDIT')?></a></div>
			<?endif;?>
</div>
-->

<div class="bued">
<div class="indu"  onMouseOver="f_tc(1,'<?=$arRes['ID']?>')" onMouseOut="f_tc(0,'<?=$arRes['ID']?>')"><div><?echo GetMessage('ZDPM')?> - <?echo $sum_debt." ".$ar_Answer['currency'][0]['USER_TEXT']?></div></div>

			<? if($arRes['STATUS_ID']==$status_no || $arRes['STATUS_ID']==$status_nepr):?>
			<!--<div class="regi" id="regi_<?=$arRes['ID']?>"><a href="<?echo $arRes['__LINK']?>"><?echo GetMessage('FRLM_EDIT')?></a></div>-->
			<?endif;?>
			
</div>

<div class="state">
<div id="t_status_<?echo $arRes['ID']?>"><span class="<?=$arRes["STATUS_CSS"]?>"><?=$arRes["STATUS_TITLE"]?></span></div>
</div>
</div>
<!--
<div class="bude">
<? if($arRes['STATUS_ID']<>$status_del):?>
			<div class="but_del" id="but_del_<?=$arRes['ID']?>" title="<?echo GetMessage('FRLM_DELETE').$arRes['ID']?>" onclick="confirmDelete(<?=$arRes['ID']?>)" onMouseOver="f_del_p(1,'<?=$arRes['ID']?>')" onMouseOut="f_del_p(0,'<?=$arRes['ID']?>')"><div id="img_<?=$arRes['ID']?>" class="img_sn"></div></div>
			<?else:?>
			<div class="but_del_0"></div>
			<?endif;?>
</div>		
	-->		
			
			
			</div>
	<?endif?>		
			<?if($money_2_calc):?>
<div class="text_calc" id="text_calc_<?=$arRes['ID']?>"><div><?echo $money_2_calc?></div><br/><div><?echo GetMessage('FLY').":<br/>".$fly_1."<br/>".$fly_2;?></div><div><?echo GetMessage('HOTEL').":<br/>".$hotel."<br/>".$nomer."<br/>".$hotel_ls."<br/>".$nomer_ls;?></div></div>
<?endif?>

<?
	endforeach;
?>
		</div>
<?
	if ($arForm['__LINK']):
?>
		<!--<div class="bx-mylist-form-link">
			<a href="<?echo $arForm['__LINK']?>"><?echo GetMessage('FRLM_MORE_RESULTS')?></a>
		</div>-->
<?
	endif;
?>
	</div>
<?
endforeach;
?>

<div id="del_del" class="del_del"><?echo GetMessage('FRLM_DEL_DELETE')?></div>
</div>


