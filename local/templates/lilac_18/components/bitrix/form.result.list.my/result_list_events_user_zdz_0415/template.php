<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

?>
<?
if (count($arResult['FORMS']) <= 0)
{
	ShowNote(t('FRLM_NO_RESULTS'));
	return;
}
?>


<? 
global $status_new;
global $status_no;
global $status_ok;
global $status_nepr;
global $status_opl;
global $status_nopl;
global $status_rz;
global $status_del;
global $dir_event;

$del_app=0; // Разрешить пользователю удалять свою заявку 1 - Да, 0 - Нет
?>
<!--<script src="/jquery/jquery-1.6.2.js" type="text/javascript"></script> -->


<div class="bx-mylist-layout">
<div id="tr"></div>
<input type="hidden" id="open_d" value="<?=t("open_d")?>"><input type="hidden" id="open_c" value="<?=t("open_c")?>">
<?
//echo '<pre>'; print_r($arResult); echo '</pre>';





foreach ($arResult['FORMS'] as $FORM_ID => $arForm):
?>
	<div class="bx-mylist-form" id="bx_mylist_form_<?echo $FORM_ID?>">
		<div class="bx-mylist-form-info">
			<!--<b><?echo $arForm['NAME']?></b>-->
		</div>
		<div class="bx-mylist-form-results">

		
		<table id="tit" style=""><tr>
		<td><div id="tit1"><?echo t('TIT_2')?></div></td>
		<td><div id="tit2"><?echo t('TIT_1')?></div></td>
		<td><div id="tit3"><?echo t('TIT_3')?></div></td>
		<td><div id="tit4"><?echo t('TIT_4')?></div></td>
		<td><div id="tit5"><?echo t('TIT_5')?></div></td>

		</tr></table>
<?

	$i = 0;
	foreach ($arResult['RESULTS'][$FORM_ID] as $arRes):

	$i++;
	
	// получим данные по всем вопросам
$ar_Answer = CFormResult::GetDataByID(
	$arRes['ID'], 
	array('family','name','sum_debt','money_2_calc','currency','promotion_1','fly_1','fly_2','hotel','nomer','hotel_ls','nomer_ls'), 
	$ar_Result, 
	$ar_Answer2);

	if($ar_Answer['sum_debt'][0]['USER_TEXT']) $sum_debt=$ar_Answer['sum_debt'][0]['USER_TEXT'];
	else $sum_debt=0;
	//$money_2_calc=str_replace("\n","<br/>",$ar_Answer['money_2_calc'][0]['USER_TEXT']);
	$ar_money_2_calc=explode("___",$ar_Answer['money_2_calc'][0]['USER_TEXT']); // убираем итог, оставляем только позиции
	$money_2_calc=str_replace("\n","<br/>",$ar_money_2_calc[0]);
	$fly_1=$ar_Answer['fly_1'][0]['ANSWER_TEXT'];
	$fly_2=$ar_Answer['fly_2'][0]['ANSWER_TEXT'];
	$hotel=$ar_Answer['hotel'][0]['ANSWER_TEXT'];
	$nomer=$ar_Answer['nomer'][0]['ANSWER_TEXT'];
	$hotel_ls=$ar_Answer['hotel_ls'][0]['ANSWER_TEXT'];
	$nomer_ls=$ar_Answer['nomer_ls'][0]['ANSWER_TEXT'];
?>
<div style="position:relative;">
<?if($arRes['STATUS_ID']<>$status_new):?>
						<div class="orad">
						<div class="vurad">

<div class="noifi" title="<?=$ar_Answer['family'][0]['USER_TEXT']?> <?=$ar_Answer['name'][0]['USER_TEXT']?>">
<span class="naki"><?echo $arRes['ID'];//echo t('FRLM_RESULT').$arRes['ID']?>&nbsp;&nbsp;</span>
	<span class="date"><?echo $arRes['DATE_CREATE']?>&nbsp;&nbsp;</span>
	<? if($arRes['STATUS_ID']<>$status_del && $arRes['STATUS_ID']<>$status_ok && $arRes['STATUS_ID']<>$status_rz):?>
			<span id="nde_1_<?=$arRes['ID']?>"> <b><?=$ar_Answer['family'][0]['USER_TEXT']?> <?=$ar_Answer['name'][0]['USER_TEXT']?></b></span><span class="nde" id="nde_0_<?=$arRes['ID']?>"><?echo t('FRLM_RESULT').$arRes['ID']?> </span>
			<?else:?>
			<span <?if($arRes['STATUS_ID']==$status_del) echo "class='pech'"?>> <b><?echo $ar_Answer['family'][0]['USER_TEXT']?> <?echo $ar_Answer['name'][0]['USER_TEXT']?></b></span>
			<?endif;?>

</div>


<div class="bued">
<div class="indu" ><div><?echo t('ZDPM')?> - <?echo $sum_debt." ".$ar_Answer['currency'][0]['USER_TEXT']?></div></div>

			<? if($arRes['STATUS_ID']==$status_no || $arRes['STATUS_ID']==$status_nepr):?>
			<!--<div class="regi" id="regi_<?=$arRes['ID']?>"><a href="<?echo $arRes['__LINK']?>"><?echo GetMessage('FRLM_EDIT')?></a></div>-->
			<?endif;?>
			
</div>

<div class="state">
<div id="t_status_<?echo $arRes['ID']?>"><span class="<?=$arRes["STATUS_CSS"]?>"><?=$arRes["STATUS_TITLE"]?></span></div>
</div>

<div class="but_razvorot" id="but_razvorot_<?=$arRes['ID']?>" onclick="f_tc('<?=$arRes['ID']?>')" title="<?=t("open_d")?>">
&#9660;
</div>

<div class="razvorot dinet">
<div class="text_calc" id="text_calc_<?=$arRes['ID']?>">
<table><tr><td><div><span class="no_tc"><?=t("calc_lk")?></span><br/><?echo $money_2_calc?></div></td><td><div style="margin-left:50px;"><?echo "<span class='no_tc'>".t("fly_lk").":</span><br/>".$fly_1."<br/>".$fly_2;?><br/><span class='no_nc'><?=t("note_fly_control")?></span><br/><br/><?echo "<span class='no_tc'>".t("hotel_lk").":</span><br/>".$hotel."<br/>".$nomer."<br/>".$hotel_ls."<br/>".$nomer_ls;?></div></td></tr></table>
</div>
</div>

</div>
<?if($del_app) { ?>

<div class="bude">
<? if($arRes['STATUS_ID']<>$status_del):?>
			<div class="but_del" id="but_del_<?=$arRes['ID']?>" title="<?echo t('FRLM_DELETE').$arRes['ID']?>" onclick="confirmDelete(<?=$arRes['ID']?>)" onMouseOver="f_del_p(1,'<?=$arRes['ID']?>')" onMouseOut="f_del_p(0,'<?=$arRes['ID']?>')">&#10006;<div id="img_<?=$arRes['ID']?>" class="img_sn"></div></div>
			<?else:?>
			<div class="but_del_0"></div>
			<?endif;?>
</div>	

<? } ?>	
			
			
			
			</div>
	<?endif?>		
			<?//if($money_2_calc):?>
<!--<div class="text_calc" id="text_calc_<?=$arRes['ID']?>"><div><?echo $money_2_calc?></div><br/><div><?echo t('fly_lk').":<br/>".$fly_1."<br/>".$fly_2;?></div><div><?echo t('hotel_lk').":<br/>".$hotel."<br/>".$nomer;?></div></div>-->
<?//endif?>
</div>
<?
	endforeach;
?>
		</div>

	</div>
<?
endforeach;
?>

<div id="del_del" class="del_del"><?echo GetMessage('FRLM_DEL_DELETE')?></div>
</div>


