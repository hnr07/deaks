<?define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Региональная рассылка");

if(isset($_GET["lp_id"])) $ID=$_GET["lp_id"];
else $ID=$_SESSION["POSTING"]["post_id"];
?>
<link rel="stylesheet" type="text/css" href="./mailing.css" />
<?
global $USER;
// Если не в группе "Региональные рассылки"(24) переход в личный кабинет
//if (!CSite::InGroup (array(24)) && !($USER->IsAdmin())) LocalRedirect("/ru/user/"); 
?>

<?
CModule::IncludeModule("subscribe");
	//$posting = new CPosting;
	
	
	$rsPosting = CPosting::GetByID($ID);
		$arPosting = $rsPosting->Fetch();
		if($arPosting) {
			//echo "<pre>"; echo htmlspecialchars(print_r($arPosting, true)); echo "</pre>";
			//echo "<pre>"; print_r($arPosting); echo "</pre>";
			$t_file='';
			$rsFile = CPosting::GetFileList($ID);
			while($arFile = $rsFile->Fetch()) $t_file.=$arFile["ORIGINAL_NAME"]." |";
			if($t_file) $t_file=" | ".$t_file;
		}
		else echo "Not found";
		
?>
<?if(!isset($_GET["lp_id"])) {?>
<Br><br>
<h1><?$APPLICATION->ShowTitle();?></h1>

<div class="border-top"></div>

<?}?>
	
<div class="" >
<div class="title">Региональная рассылка: выпуск № <?=$ID?></div>
<br />

<br/>
<?if(isset($_GET["lp_id"])) {?>
<b><i>Просмотр</i></b><br /><br/>
<?} else {?>
<div class="run_div">
	<form action="./index.php" method="POST">
	<input type="hidden" name="posting_id" value="<?=$ID?>">
	<input type="submit" id="run_posting" name="run_posting" value="Отправить"> <input type="submit" id="del_posting" name="del_posting" value="Отменить">
	</form>
</div>
<?}?>
<div><b>Тема: <?=$arPosting["SUBJECT"]?></b></div><br />
<div><b>Получатели: <?=$arPosting["BCC_FIELD"]?></b></div>
<?if($t_file) {?>
<br />
	<div><b>Прикреплённые файлы: <?=$t_file?></b></div>
	
<?}?>
<br /><br />
<div>
<?=$arPosting["BODY"]?>
</div>


<div class="clear-all"></div><Br><br><Br><br>
	</div>
	<div class="clear-all"></div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>