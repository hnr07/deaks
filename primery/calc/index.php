<?
// CJSCore::Init();
IncludePublicLangFile(__FILE__);
//global $ar_pit;

		//echo"<pre>";print_r($_POST["in_cart"]);echo"</pre>";
		if(count($_POST["in_cart"])>0) {
			CModule::IncludeModule("catalog");
			
			foreach($_POST["in_cart"] as $id => $sht) {
				if($sht>0) {
					$id_c=Add2BasketByProductID(
						$id,
						$sht,
						array(),
						array(
							//array("NAME"=>"Упаковка","CODE" => "UPAKOVKA", "VALUE" => "100")	
						)
					);
					$_SESSION["in_cart"][]=$id_c;
				}
			}
			if(count($_SESSION["in_cart"])>0) $_SESSION["add_cart"]="Y";
			?>
		<?} //unset($_SESSION["add_cart"]);?>
<?
   $arCalcConfig = array(
			'calc_lib' => array(
				'js' => '/com/calc/script.js',
				'css' => '/com/calc/style.css',//если требуется подтянуть еще и CSS
				//'rel' => array('jquery'),//зависимые внутренние библиотеки Битрикс (тоже подключатся автоматически)
				//'lang' => '/com/calc/lang/ru/index.php',//языковые фразы, к которым можно будет обращаться через JS
				//'skip_core' => true,//пропустить подключение core.js
			),
		);
		foreach ($arCalcConfig as $ext => $arExt) {
			CJSCore::RegisterExt($ext, $arExt);
		}

CJSCore::Init (array('calc_lib'));
?>
<!--<script type="text/javascript" src="/js/jquery.maskedinput.js"></script>-->
<?//echo"<pre>";print_r($ar_pit);echo"</pre>";?>

<div class="box_calc"><a id="box_calc" name="box_calc"></a><div class="o_title"><?=GetMessage("calc_DLS")?></div>
		<div class="o_title_mob"><?=GetMessage("calc_DLS")?></div>
	
	<div class="calc_2">
		<div class="l_box"><div class="div_img"></div></div>
		<div class="r_box">
			<div id="field_area">
				<button class="itog" type="button"><?=GetMessage("rasschitat")?></button>
				<button class="addbutton" type="button" onclick="add_div_2();"><?=GetMessage("dobavit")?> <?//=GetMessage("novoye_pole")?><?=GetMessage("plitku")?></button>
				<div class="note_u"><?=GetMessage('ukladka');?></div>
				<div class="note"><div class="note_s"><span>A</span> <?=GetMessage("sm")?></div><div class="note_s"><span>B</span> <?=GetMessage("sm")?></div><div class="note_p"><?=GetMessage("ploschad")?> <?=GetMessage("m")?><sup>2</sup></div></div>
				
				<div  id="add1" class="add"><div class="npc">1</div><div class="but_ukladka"><input type="hidden" value="K"><div class="ku ku_a"></div><div class="tu tu_p"></div></div><input type="tel" class="aap" maxlength="3"><input type="tel" class="bbp" maxlength="3"><input type="tel" class="ssp" maxlength="8"></div>
			</div>
		</div>
	</div>
	
	
	<div class="list_itog_box" style="">
		
		
			<?//include "list_itog.php";?>
			<?include "list_itog_ep.php";?>
			
		
		
	</div>
		<input id="err_pole" type="hidden" value="<?=GetMessage("err_pole")?>"><input id="err_pole_2" type="hidden" value="<?=GetMessage("err_pole_2")?>">
</div>
	

	<!--<a href="/ru/?action=ADD2BASKET" rel="nofollow">Заказать</a>-->

	

 