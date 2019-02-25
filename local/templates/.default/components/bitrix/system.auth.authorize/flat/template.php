<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

//one css for all system.auth.* forms
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
?>
<script>
	function auth_guest() {
		$("input[name=USER_LOGIN]").val("visitor");
		$("input[name=USER_PASSWORD]").val("visitor");
		
		setTimeout(function(){$("input[name=Login]").click();}, 200);
	}
  </script>
<div class="authform">

<?
if(!empty($arParams["~AUTH_RESULT"])):
	$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
?>
	<div class="alert alert-danger"><?=nl2br(htmlspecialcharsbx($text))?></div>
<?endif?>

<?
if($arResult['ERROR_MESSAGE'] <> ''):
	$text = str_replace(array("<br>", "<br />"), "\n", $arResult['ERROR_MESSAGE']);
?>
	<div class="alert alert-danger"><?=nl2br(htmlspecialcharsbx($text))?></div>
<?endif?>

	<h3 class="bx-title"><?=GetMessage("AUTH_PLEASE_AUTH")?></h3>

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form",
	"flat",
	array(
		"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
		"AUTH_URL" => $arResult["AUTH_URL"],
		"POST" => $arResult["POST"],
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>

	<hr class="bxe-light">
<?endif?>

	<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>

<div class="bx-authform-formgroup-container">
			<button class="auth_guest" type="button" onclick="auth_guest();"/><?=GetMessage("AUTH_AUTHORIZE_GUEST")?></button>
		</div>

		<div class="bx-authform-formgroup-container">
			<!--<div class="bx-authform-label-container"><?=GetMessage("AUTH_LOGIN")?></div>-->
			<div class="bx-authform-input-container">
				<input type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>" />
			</div>
		</div>
		<div class="bx-authform-formgroup-container">
			<!--<div class="bx-authform-label-container"><?=GetMessage("AUTH_PASSWORD")?></div>-->
			<div class="bx-authform-input-container">
<?if($arResult["SECURE_AUTH"]):?>
				<div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none"><div class="bx-authform-psw-protected-desc"><span></span><?echo GetMessage("AUTH_SECURE_NOTE")?></div></div>

<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = '';
</script>
<?endif?>
				<input type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>" />
			</div>
		</div>

<?if($arResult["CAPTCHA_CODE"]):?>
		<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />

		<div class="bx-authform-formgroup-container dbg_captha">
			<div class="bx-authform-label-container">
				<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>
			</div>
			<div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></div>
			<div class="bx-authform-input-container">
				<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
			</div>
		</div>
<?endif;?>

<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
		<div class="bx-authform-formgroup-container">
			<div class="checkbox">
				<label class="bx-filter-param-label">
					<input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" />
					<span class="bx-filter-param-text"><?=GetMessage("AUTH_REMEMBER_ME")?></span>
				</label>
			</div>
		</div>
<?endif?>
		<div class="bx-authform-formgroup-container">
			<input type="submit" class="btn btn-primary" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
		</div>
	</form>
<div class="bx-authform-link-container" style="display:none;">
<?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
	

	
		
			<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></b></a>
		
	
<?endif?>

<?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
	
		
			<?//=GetMessage("AUTH_FIRST_ONE")?>
			<a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow" style="float:right;"><b><?=GetMessage("AUTH_REGISTER")?></b></a>
		
	
<?endif?>
</div>
</div>

<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

