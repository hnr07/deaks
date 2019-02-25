<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
$cpt = new CCaptcha();
$captchaPass = COption::GetOptionString("main", "captcha_password", "");
if(strlen($captchaPass) <= 0)
{
   $captchaPass = randString(10);
   COption::SetOptionString("main", "captcha_password", $captchaPass);
}
$cpt->SetCodeCrypt($captchaPass);
?>
<input name="captcha_code" value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>" type="hidden">
<div id="new_capcha" title="Обновить код"></div>
<img src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt());?>" style="">
<input id="captcha_word" name="captcha_word" type="text" placeholder="Проверочный код">
<?require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";?>