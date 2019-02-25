<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?global $t_step // Шаг регистрации?>

<? include "var_config.php"; // Конфигурация мероприятия?>
<? include "functions.php";  // Функции PHP?>


<? include "../config/exchange.php"; // массив обозначений валют ?> 

<? //include_once "functions_leadership.php"; // фкнкции для leadership?>


<? include "header_form.php"; // Шапка формы ?>
<? include "note_error.php"; // Ошибки заполнения ?>
<div id="ti_form">
<!--
<form action="/ru/registration_event/step_4.php" method="POST" enctype="multipart/form-data" onsubmit="return sub_form()">
-->
<? 
$ar_head_form=explode(" ",$arResult["FORM_HEADER"],2);
$head_form=$ar_head_form[0]." onsubmit=\"return sub_form()\"  onreset=\"res_form()\" ".$ar_head_form[1];
echo $head_form;
//echo $arResult["FORM_HEADER"];
?>
<?=bitrix_sessid_post()?>

<table id="cont_t">

<tr valign="top">

<td>

<div  class="right_b">



<div class="title_step">
<div id="title_step2">&nbsp;&nbsp;<?=getMessage('TITLE_STEP6')?> &nbsp;<?=getMessage('TITLE_PR6')?></div>

</div>
<div id="tr"></div>


<? include "calculator.php"; // калькулятор ?>
<?


//echo $ctext;
//echo "<br><br>".$ctext_n;
?>

<!--  Если предыдущий шаг не пройден возврат на начало  -->
<?if(fGetResultValues("step")<>($t_step-1)){?>
<meta http-equiv="Refresh" content="0; URL=<?=$dir_event?>index.php">
<?}?>

<?if (fGetResultValues("status")==fGetValue("status",0)):?>
<input id="hiscer" type="hidden" value="0">
<div class="tipetu"><span class="tpt"><?=getMessage("status");?>:</span> <span class="npt"><?=getMessage("status_0");?></span></div>
<div class="tipetu"><span class="tpt"><?=getMessage("chk");?>:</span> <span class="npt"><?=fGetResultValues("chk")?> - <?=fGetResultValues("family")?> <?=fGetResultValues("name")?></span></div>
<?endif?>
<?if (fGetResultValues("status")==fGetValue("status",1)):?>
<input id="hiscer" type="hidden" value="1">
<div class="tipetu"><span class="tpt"><?=getMessage("status");?>:</span> <span class="npt"><?=getMessage("status_1");?></span></div>
<div class="tipetu"><span class="tpt"><?=getMessage("kem_priglashen_chk");?>:</span> <span class="npt"><?=fGetResultValues("kem_priglashen_chk")?> - <?=fGetResultValues("kem_priglashen_family")?> <?=fGetResultValues("kem_priglashen_name")?></span></div>
<?endif?>
<?if (fGetResultValues("status")==fGetValue("status",2)):?>
<input id="hiscer" type="hidden" value="2">
<div class="tipetu"><span class="tpt"><?=getMessage("status");?>:</span> <span class="npt"><?=getMessage("status_2");?></span></div>
<div class="tipetu"><span class="tpt"><?=getMessage("kem_priglashen_chk");?>:</span> <span class="npt"><?=fGetResultValues("kem_priglashen_chk")?> - <?=fGetResultValues("kem_priglashen_family")?> <?=fGetResultValues("kem_priglashen_name")?></span></div>
<?$spl_chk=fGetResultValues("kem_priglashen_chk"); $spl_family=fGetResultValues("kem_priglashen_family"); $spl_name=fGetResultValues("kem_priglashen_name");?>
<?endif?>

<?include "../passport_member/view.php"?>

<!-- Скрытые поля  -->
<div class="nevid">
<? include "field_form.php"; // Все поля формы?>

<!-- Скрытые поля для перезаписи значений  -->
<!--  Шаг регистрации  -->
<input id="t_step" name="<?=fGetName("step",0)?>" value="<?=$t_step?>"  type="text">

<!--  Скидка %  -->
<input  name="<?=fGetName("discount",0)?>" value="<?=$discount?>"  type="text">

<!--  Наценка %  -->
<input  name="<?=fGetName("markup",0)?>" value="<?=$markup?>"  type="text">

<!--  Минус  -->
<input  name="<?=fGetName("minus",0)?>" value="<?=$minus?>"  type="text">

<!--  Плюс  -->
<input  name="<?=fGetName("plus",0)?>" value="<?=$plus?>"  type="text">

<!--  Стоимость мероприятия в у. е.  -->
<input  name="<?=fGetName("money",0)?>" value="<?=$cena_e?>"  type="text">

<!--  Стоимость в Вашей валюте  -->
<input  name="<?=fGetName("money_2",0)?>" value="<?=$cena_n?>"  type="text">

<!--  Сумма задолженности  -->
<input  name="<?=fGetName("sum_debt",0)?>" value="<?=$cena_n?>"  type="text">

<!--  Калькуляция стоимости мероприятия в у. е.  -->
<textarea name="<?=fGetName("money_calc",0)?>"><?=$ctext;?></textarea>

<!--  Калькуляция стоимости мероприятия в нац. валюте  -->
<textarea name="<?=fGetName("money_2_calc",0)?>"><?=$ctext_n;?></textarea>

<!--  Индекс места  -->
<input  name="<?=fGetName("mesto_index",0)?>" value="<?=$i_mesto?>"  type="text">

<!--  Копия  -->
<input  name="<?=fGetName("copy",0)?>" value="0"  type="text">

</div>
<?
$cts=str_replace("\n","<br/>",$ctext_n);
?>

<div class="ctext">
<?=$cts?>
</div>

<div class="not_f" onmouseout="sub_but()"><img src="/images/registration_event/info_24.png"><div class="luch"></div><?=getMessage("NV_OPLATA")?></div>

<!--  	ФИО соседа по номеру -->

<?if(fGetActive("hotel_frend")):?>
<div class="ti_blo" id="ti_blo_hotel_frend">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("hotel_frend")?></div><textarea name="<?=fGetName("hotel_frend",0)?>"><?=fGetResultValues("hotel_frend", 0);?></textarea></div>
<?if(fGetComments("hotel_frend")):?><div class="qm"><div class="qm_text"><?=getMessage("hotel_frend_comment")?></div></div><?endif?>
</div>
<?endif?>



<!--  	Комментарий -->
<?if(fGetActive("comments")):?>
<div class="ti_blo" id="ti_blo_comments">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("comments")?></div><textarea name="<?=fGetName("comments",0)?>"><?=fGetResultValues("comments", 0);?></textarea></div>
<?if(fGetComments("comments")):?><div class="qm"><div class="qm_text"><?=getMessage("comments_comment")?></div></div><?endif?>
</div>
<?endif?>
 
</div>
</td></tr></table>

<? include "button_step.php"; // Кнопки перехода к следующему шагу ?>

 </form>
 </div>

<br/><br/><br/><br/><br/>


