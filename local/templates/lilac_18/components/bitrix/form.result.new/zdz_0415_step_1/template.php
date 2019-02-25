<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
global $t_step; // Шаг регистрации
 include "var_config.php"; // Конфигурация мероприятия
 include "functions.php";  // Функции PHP
?>

<? include "header_form.php"; // Шапка формы ?>
<? include "note_error.php"; // Ошибки заполнения ?>

<div id="ti_form">
<form action="<?=$dir_event?>step_2.php" method="POST" onsubmit="return sub_form()">
<div class="title_step">
<div id="title_step1">&nbsp;&nbsp;<?//=ft('TITLE_STEP1')?><?=getMessage('TITLE_STEP1')?> &nbsp;<?//=ft('TITLE_PR1')?><?=getMessage('TITLE_PR1')?></div>

</div>
<? include "../passport_member/choice.php"; // Выбор карточки участника ?>
<table id="cont_t">

<tr valign="top">

<td>

<div id="mess_js" style="color:red;font-size:14pt;"><br /><?=getMessage('MESS_NO_JS')?></div>
<div  class="right_b" style="display:none">




<div id="tr"></div>


<div class="form-required">
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>


<?=$arResult["FORM_NOTE"]?>
</div>



<input type="hidden" name="forpa" value="1">
<!-- Скрытые поля  -->
<div class="nevid">

<!--  Шаг регистрации  -->
<input id="t_step" name="<?=fGetName("step",0)?>" value="<?=$t_step?>"  type="text">

</div>

<!--  индикатор javascript  -->
<?if(fGetActive("java")):?>
<div class="ti_blo_none" id="ti_blo_java">
<div class="ti_di"><?=fGetQuestion("java")?></div>
<div class="ti_pol">
	<div class="ti_dip"><input id="jsy" class="" name="<?=fGetName("java")?>" value="<?=fGetValue("java",0)?>" type="radio" > <?=fGetAnswer("java", 0);?></div>
	<div class="nich"></div>
    <div class="ti_dip"><input id="jsn" class="" name="<?=fGetName("java")?>" value="<?=fGetValue("java",1)?>" type="radio" checked> <?=fGetAnswer("java", 1);?></div>
</div>

</div>
<?endif?>


		
<style>

#gde_volna table {
	width:800px;
	cursor:pointer;
}
#gde_volna table tr {
	border:solid 1px #e2e2e2;

}
#gde_volna table tr:nth-child(odd) {
	background-color:#f2f2f2;
}
#gde_volna table td {
	padding:10px;
}
#gde_volna table td img {

	-moz-border-radius: 50px; /* Firefox */
  -webkit-border-radius: 50px; /* Safari, Chrome */
  -khtml-border-radius: 50px; /* KHTML */
  border-radius: 50px; /* CSS3 */ 
}
</style>
<?//CModule::IncludeModule("iblock");?>
<?

$i=0;
$res = CIBlockElement::GetList(array("SORT"=>"ASC","NAME"=>"ASC"), array('IBLOCK_CODE' => 'events_rsa','SECTION_CODE' => "zdz_0415", 'ACTIVE' => 'Y','PROPERTY_NAME_'.$_SESSION["f_lang"]=>"%"), false, false, /*Array("nPageSize"=>10),*/ $arSelect);
while($ob = $res->GetNextElement()) {

	$arFields = $ob->GetFields();
	 $arProps = $ob->GetProperties();
	 $ar_vlm[$i]["IBLOCK_ID"]=$arFields["IBLOCK_ID"];
	 $ar_vlm[$i]["ID"]=$arFields["ID"];
	 $ar_vlm[$i]["type"]=$arFields["IBLOCK_NAME"];
	 $ar_vlm[$i]["CODE"]=$arFields["CODE"];
	 $ar_vlm[$i]["PREVIEW_PICTURE"]= CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
	 $ar_vlm[$i]["name"]=$arProps["name_".$_SESSION["f_lang"]]["VALUE"];
	 $ar_vlm[$i]["text"]=$arProps["text_".$_SESSION["f_lang"]]["VALUE"]["TEXT"];
	 $ar_vlm[$i]["datemin"]=$arProps["datemin_".$_SESSION["f_lang"]]["VALUE"];
	 
	 $i++;
	 //echo"<pre>";print_r($arFields);echo"</pre>";
	 //echo"<pre>";print_r($arProps);echo"</pre>";
}

//echo"<pre>";print_r($ar_vlm);echo"</pre>";
?>
<div id="gde_volna" style="display:none;">

	<table title="<?=getMessage("vibrat");?>">
		<?foreach($ar_vlm as $item) {?>
		<tr>
			<td><?=$item["ID"]?></td>
			<td style="font-weight: bold;"><?=$item["name"]?></td>
			<td><?=$item["datemin"]?></td>
			<td><?=$item["text"]?></td>
			<td width="100">
				<?if($item["PREVIEW_PICTURE"]["ID"]) {
					 $file_img = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width'=>100, 'height'=>100), BX_RESIZE_IMAGE_EXACT, true); //BX_RESIZE_IMAGE_PROPORTIONAL
					?>
					<div class="img"><img src="<?= $file_img["src"]?>" width="<?= $file_img["width"]?>" height="<?= $file_img["height"]?>"></div>
				<?}?>
				<?//else echo "&nbsp;";?>
			</td>
		</tr>
		<?}?>
	</table>
</div>
<script>
$(document).ready(function(){
	$("#gde_volna table tr").click(function(){
		var id_venue=$(this).children("td:eq(0)").html();
		var name_venue=$(this).children("td:eq(1)").html();
		$("#id_venue").val(id_venue);
		$("#name_venue").val(name_venue);
		$(".fancybox-close").click();
		$("#fancybox-close").click();
		sub_but();
	});
});
</script>

	

<!--  Площадка  -->
<?if(fGetActive("venue")):?>
<div class="ti_blo" id="ti_blo_venue">
	
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("venue");?><span class="zred"> *</span> <a href='#gde_volna' class='gallery' ><img src="/images/registration_event/direction.png" align="bottom" title="<?=getMessage("vibrat");?>" alt="<?=getMessage("vibrat");?>"></div><div class="nich"></div><input id="name_venue" name="<?=fGetName("venue",0)?>" value="" class="" type="text" readonly style="width:500px;"></a></div>
	
	<?if(fGetComments("venue")):?><div class="qm"><div class="qm_text"><?=getMessage("venue_comment")?></div></div><?endif?>
	
</div>
<?endif?>

<!--  ID площадки  -->
<?if(fGetActive("id_venue")):?>
<div class="ti_blo" id="ti_blo_id_venue">
<input id="id_venue" name="<?=fGetName("id_venue",0)?>" value="" class="" type="hidden">
</div>
<?endif?>

<div class="tinot"><?=getMessage('TINOT_1')?><span class="zred"> *</span></div>
<!--  Статус  -->

<?if(fGetActive("status")):?>
<div class="ti_blo" id="ti_blo_status">

	<!--<div class="tiqa"> <?=fGetQuestion("status")?><span class="zred"> *</span></div>-->

	<div class="ti_dig"><input id="stat_1" name="<?=fGetName("status")?>" value="<?=fGetValue("status",0)?>" class="radio_status" type="radio" <?if(fGetAnswerCode("status",0)==$_SESSION["passport_member"]["status"]) echo "checked"?>><label for="stat_1"> <?=getMessage("status_0");?></label></div>
	<div class="ti_dig" style="display:none;"><input id="stat_2" name="<?=fGetName("status")?>" value="<?=fGetValue("status",1)?>" class="radio_status" type="radio" <?if(fGetAnswerCode("status",1)==$_SESSION["passport_member"]["status"]) echo "checked"?>><label for="stat_2"> <?=getMessage("status_1");?></label></div>
	<div class="ti_dig"><input id="stat_3" name="<?=fGetName("status")?>" value="<?=fGetValue("status",2)?>" class="radio_status" type="radio" <?if(fGetAnswerCode("status",2)==$_SESSION["passport_member"]["status"]) echo "checked"?>><label for="stat_3"> <?=getMessage("status_2");?></label></div>
 
	<?if(fGetComments("status")):?><div class="qm"><div class="qm_text"><?=getMessage("status_comment");?></div></div><?endif;?>
</div>
<?endif?>


<div id="sipo_0">
<div class="tinot"><?=getMessage('TINOT_3')?></div>
<!--  Кем приглашен № ЧК  -->
<?if(fGetActive("kem_priglashen_chk")):?>
<div class="ti_blo" id="ti_blo_kem_priglashen_chk">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("kem_priglashen_chk");?><span class="zred"> *</span></div><input id="" name="<?=fGetName("kem_priglashen_chk",0)?>" value="<?=$_SESSION["passport_member"]["kem_priglashen_chk"]?>" class="" type="text"> </div>
	<div class="qm"><div class="qm_text"><?=getMessage("kem_priglashen_chk_comment")?> (6-7 цифр)</div></div>
</div>
<?endif?>

<!--  Кем приглашен имя  -->
<?if(fGetActive("kem_priglashen_name")):?>
<div class="ti_blo" id="ti_blo_kem_priglashen_name">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("kem_priglashen_name");?><span class="zred"> *</span></div><input id="" name="<?=fGetName("kem_priglashen_name",0)?>" value="<?=$_SESSION["passport_member"]["kem_priglashen_name"]?>" class="" type="text"> </div>
	<div class="qm"><div class="qm_text"><?=getMessage("kem_priglashen_name_comment")?></div></div>
</div>
<?endif?>

<!--  Кем приглашен фамилия  -->
<?if(fGetActive("kem_priglashen_family")):?>
<div class="ti_blo" id="ti_blo_kem_priglashen_family">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("kem_priglashen_family");?><span class="zred"> *</span></div><input id="" name="<?=fGetName("kem_priglashen_family",0)?>" value="<?=$_SESSION["passport_member"]["kem_priglashen_family"]?>" class="" type="text"> </div>
	<div class="qm"><div class="qm_text"><?=getMessage("kem_priglashen_family_comment")?></div></div>
</div>
<?endif?>

</div>

<div id="titu" class="tinot"><?=getMessage('TINOT_2')?></div>
<div id="sipo_1">

<!--  № ЧК  -->
<?if(fGetActive("chk")):?>
<div class="ti_blo" id="ti_blo_chk">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("chk");?><span class="zred"> *</span></div><input id="" name="<?=fGetName("chk")?>" value="<?=$_SESSION["passport_member"]["chk"]?>" class="" type="text"></div>
<div class="qm"><div class="qm_text"><?=getMessage("chk_comment")?></div></div>
</div>
<?endif?>
<div class="nich"></div>

</div>

<div id="sipo_2">
<!--  Имя  -->
<?if(fGetActive("name")):?>
<div class="ti_blo" id="ti_blo_name">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("name")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("name")?>" value="<?=$_SESSION["passport_member"]["name"]?>" class="" type="text"></div>
<div class="qm"><div class="qm_text"><?=getMessage("name_comment")?></div></div>
</div>
<?endif?>

<!--  Фамилия  -->
<?if(fGetActive("family")):?>
<div class="ti_blo" id="ti_blo_family">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("family")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("family")?>" value="<?=$_SESSION["passport_member"]["family"]?>" class="" type="text"></div>
<div class="qm"><div class="qm_text"><?=getMessage("family_comment")?></div></div>
</div>
<?endif?>


</div>

</div>
</td></tr></table>

<? include "button_step.php"; // Кнопки перехода к следующему шагу ?>

</form>
</div>
<br/><br/><br/><br/><br/>
<script type="text/javascript">
		$(document).ready(function() {
			$("a.gallery").fancybox();
		});
		</script>
<script type="text/javascript">
$('#jsy').attr("checked","checked");$("#mess_js").css("display","none");$(".right_b").css("display","block");
</script>


