<?
	use Bitrix\Main\Localization\Loc;
//\Bitrix\Main\Page\Asset::getInstance()->addCss("/bitrix/themes/.default/sale.css");
\Bitrix\Main\Page\Asset::getInstance()->addCss("/bitrix/templates/cargo/payment/yandex/template/style.css");
	Loc::loadMessages(__FILE__);

	$sum = roundEx($params['PAYMENT_SHOULD_PAY'], 2);
?>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/payment/yandex/template/style.css" type="text/css" media="screen">
<div class="sale-paysystem-wrapper">
	
		<?//=Loc::getMessage('SALE_HANDLERS_PAY_SYSTEM_YANDEX_DESCRIPTION')." ".SaleFormatCurrency($params['PAYMENT_SHOULD_PAY'], $payment->getField('CURRENCY'));?>
		<?$sum=str_replace("руб.","&#8381;",SaleFormatCurrency($params['PAYMENT_SHOULD_PAY'], $payment->getField('CURRENCY')));?>
		<?=Loc::getMessage('SALE_HANDLERS_PAY_SYSTEM_YANDEX_DESCRIPTION')?>
		<div class="tesum"><?=$sum?></div>
	<form name="ShopForm" action="<?=$params['URL'];?>" method="post" target="_blank" onsubmit="primer(this);return false;">

		<input name="ShopID" value="<?=htmlspecialcharsbx($params['YANDEX_SHOP_ID']);?>" type="hidden">
		<input name="scid" value="<?=htmlspecialcharsbx($params['YANDEX_SCID']);?>" type="hidden">
		<input name="customerNumber" value="<?=htmlspecialcharsbx($params['PAYMENT_BUYER_ID']);?>" type="hidden">
		<input name="orderNumber" value="<?=htmlspecialcharsbx($params['PAYMENT_ID']);?>" type="hidden">
		<input name="Sum" value="<?=number_format($sum, 2, '.', '')?>" type="hidden">
		<input name="paymentType" value="<?=htmlspecialcharsbx($params['PS_MODE'])?>" type="hidden">
		<input name="cms_name" value="1C-Bitrix" type="hidden">
		<input name="BX_HANDLER" value="YANDEX" type="hidden">
		<input name="BX_PAYSYSTEM_CODE" value="<?=$params['BX_PAYSYSTEM_CODE']?>" type="hidden">

		<div class="sale-paysystem-yandex-button-container">
			<span class="sale-paysystem-yandex-button">
				<input class="sale-paysystem-yandex-button-item" name="BuyButton" value="<?=Loc::getMessage('SALE_HANDLERS_PAY_SYSTEM_YANDEX_BUTTON_PAID')?>" type="submit">
			</span><!--sale-paysystem-yandex-button-->
			<span class="sale-paysystem-yandex-button-descrition"><?=Loc::getMessage('SALE_HANDLERS_PAY_SYSTEM_YANDEX_REDIRECT_MESS');?></span><!--sale-paysystem-yandex-button-descrition-->
		</div><!--sale-paysystem-yandex-button-container-->

		<!--<p>
			<span class="tablebodytext sale-paysystem-description"><?=Loc::getMessage('SALE_HANDLERS_PAY_SYSTEM_YANDEX_WARNING_RETURN');?></span>
		</p>-->
	</form>
</div><!--sale-paysystem-wrapper-->
<script>
function primer(form) {
	alert("Это пример.\nЗаказы не обрабатываются.\nОплаты нет.");
	return false;
	
}
</script>