<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
global $USER;
//echo "<pre>";print_r($_POST);echo "</pre>";
//echo "<pre>";print_r($_SESSION["order"]["add_elem"]);echo "</pre>";
// Подключаем функции php
		$APPLICATION->IncludeFile(
			SITE_DIR."fibrovolokno/catalog/functions.php",
			Array(),
			Array("MODE"=>"html")
		);

// Подключаем капчу
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
$cpt = new CCaptcha();
$captchaPass = COption::GetOptionString("main", "captcha_password", "");
if(strlen($captchaPass) <= 0)
{
   $captchaPass = randString(10);
   COption::SetOptionString("main", "captcha_password", $captchaPass);
}
$cpt->SetCodeCrypt($captchaPass);

if(count($_SESSION["order"]["add_elem"])>0) {
	foreach($_SESSION["order"]["add_elem"] as $ear) {
		?>
		<div class="orow"><div class="img" style="background-image: url('<?=$ear["src_elem"]?>')"></div><div class="name_box"><div class="before"><?=$ear["name_before_elem"]?></div><div class="name_elem"><?=$ear["name_elem"]?></div><div class="size"><?=$ear["size_elem"]?> мм</div></div><div class="sum_box"><div class="sum"><?=nfn($ear["sum"])?> <div class="rur">q</div></div><div class="weight"><?=nfn($ear["weight"],3)?> <span class="weight_nt"><?=$ear["unit_elem"]?></span></div></div><div class="price_box"><div class="price"><?=nfn($ear["price"])?> <div class="rur">q</div> <span class="price_nt">/<?=$ear["unit_elem"]?></span></div><div class="price_packing"><?=nfn($ear["price_packing"],2)?> <div class="rur">q</div> <span class="price_packing_nt">/уп</span></div></div><div class="qty"><?=$ear["qty"]?></div></div>
		<?
	}?>
	<div class="foot_table">
	<?//if (!$USER->IsAuthorized()) {?>
		<div class="div_capcha">
			
			<input name="captcha_code" value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>" type="hidden">
			<div id="new_capcha" title="Обновить код"></div>
			<img src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt());?>" title="Введите проверочный код">
			<input id="captcha_word" name="captcha_word" type="text" placeholder="Проверочный код" title="Введите проверочный код">
			
		</div>
	<?//}?>
	<div class="tit_foot">Итого:</div><div class="qty_itogo"><?=$_POST["itogo_qty"]?></div><div class="box_price_itogo"><div class="price_itogo"><?=nfn($_POST["itogo"])?> <div class="rur">q</div></div><div class="itogo_weight"><?=nfn($_POST["itogo_weight"],3)?> <span class="weight_nt"><?=$ear["unit_elem"]?></span></div></div></div>
	
	<button type="button" class="d_add">Оформить <div></div></button>
<?}else {?>
	<div>Товар не выбран</div>
<?}?>
<div id="res_ajax"></div>
<?require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";?>