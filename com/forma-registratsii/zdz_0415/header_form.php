<?CModule::IncludeModule("iblock");
/*
global $array_form_translation; 
// Построение массива переводов формы
	$ar_ft_filter=array("SECTION_CODE"=>"registration_form", "INCLUDE_SUBSECTIONS"=>"Y", "ACTIVE"=>"Y", "PROPERTY_lang_VALUE"=>$_SESSION["f_lang"]);
	$res=CIBlockElement::GetList(array(), $ar_ft_filter);
	while($ob = $res->GetNextElement()){ 
		$arFields = $ob->GetFields();  
		$arProps = $ob->GetProperties();

		$array_form_translation[$arFields["NAME"]]=$arProps["translation"]["VALUE"];
	}
	*/		
//echo"<pre>";print_r($array_form_translation);echo"</pre>";

?>
<br/>
<h2 class="attention">
<?=getMessage('VN_NOTE_Z')?>
</h2>

<br/>
<h1  class="htit">&nbsp;<?=getMessage('TITLE_PR_REG')?>&nbsp; </h1>
<div  class="htit_note">&nbsp;<?=getMessage('TITLE_PR_REG_NOTE')?>&nbsp; </div>
<br/><br/>

<div class="grafik">
<div class="prok"></div>
<div class="circ circ_1"><div class="cext"><?=getMessage('TITLE_STEP1')?></div></div>
<div class="circ circ_2"><div class="cext"><?=getMessage('TITLE_STEP2')?></div></div>
<div class="circ circ_3"><div class="cext"><?=getMessage('TITLE_STEP3')?></div></div>
<div class="circ circ_4"><div class="cext"><?=getMessage('TITLE_STEP4')?></div></div>
<div class="circ circ_5"><div class="cext"><?=getMessage('TITLE_STEP5')?></div></div>
<div class="circ circ_6"><div class="cext"><?=getMessage('TITLE_STEP6')?></div></div>
</div>
