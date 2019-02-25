<?define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Региональная рассылка");
?>
<link rel="stylesheet" type="text/css" href="./mailing.css" />
<?
global $USER;
// Если не в группе "Региональные рассылки"(24) переход в личный кабинет
//if (!CSite::InGroup (array(24)) && !($USER->IsAdmin())) LocalRedirect("/ru/user/"); 
?>


<Br><br>
<h1><?$APPLICATION->ShowTitle();?></h1>

<div class="border-top"></div>
<!--
  <div class="left" style="width:230px;">
<?
global $USER;
if ($USER->IsAuthorized()):
?>
		<?
		// включаемая область для раздела
		$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."/../../user/sect_inc.php", Array(), Array(
			"MODE"      => "html",                                           // будет редактировать в веб-редакторе
			"NAME"      => "Редактирование включаемой области раздела",      // текст всплывающей подсказки на иконке
			"TEMPLATE"  => "sect_inc.php"                    // имя шаблона для нового файла
			));
		?>
<?endif?>
	</div>
-->	
<div class="right" style="width:650px; min-height:350px;margin-left:100px;">
<div class="title" style="float:left;">Список моих выпусков рассылок</div>
<div class="" style="float:right;"><a href="index.php">новый выпуск</a></div>
<br /><br/>



<h3>Автор выпусков: <span class='mm_g'><?=$USER->GetFullName()?></span></h3>

<br/>

<style>

</style>
<div class="list_posting">
<?
CModule::IncludeModule("subscribe");
$posting = new CPosting;

if($_POST['run_posting']) {
	$ID=$_POST['posting_id'];
	$change=$posting->ChangeStatus($ID, "D"); // перевод в статус "черновик"
	/*// Рабочий вариант
	$change=$posting->ChangeStatus($ID, "P");  // перевод в статус "в процессе"
	$posting->AutoSend($ID);
	if($change) echo "<div class='ok_div'>Выпуск № ".$ID." добавлен в рассылку.</div>";
	else echo "<div class='errror_div'>Выпуск № ".$ID." - ошибка добавления в рассылку.</div>";
	*/
	 // Тестовый вариант
	 echo "<div class='ok_div'>Это тестовый вариант рассылки. Выпуск № ".$ID." добавлен в рассылку, но не будет отправлен.</div>";
}

?>

	<table>
		<?
		
			$arFilter = Array(
			   "FROM" => "test@deaks.ru",
			  // "TO" => $USER->GetId()."-".$USER->GetEmail(), // действует только для отправленных
			 
			);
			
		$rsPosting = $posting->GetList(array($by=>"TIMESTAMP"), $arFilter);

		$rsPosting->NavStart(50);
		echo $rsPosting->NavPrint("Выпуск")."<br /><br />";
		while($rsPosting->NavNext(true, "lp_")) { ?>
			<?if($lp_TO_FIELD==$USER->GetId()."-".$USER->GetEmail()) {?>
				<tr>
				<td>
					<b><?=$lp_ID?></b>
				</td>
				<td>
						<?if($lp_STATUS<>"P") {?>
							<form action='posting_list.php' method="POST">
								<input type="hidden" name="posting_id" value="<?=$lp_ID?>">
								<button  name="run_posting" value="1" onclick="this.form.submit();" title="Отправить выпуск"><img src="/images/mailing/mail32.png"></button>
							</form>
						<?} else echo "&nbsp;";?>
				</td>
				<td>
				<div><?=$lp_SUBJECT?> </div>
				</td>
				<td>
					<a href="posting_run.php?lp_id=<?=$lp_ID?>&print=Y" target="_blank" title="Просмотр / печать"><img src="/images/mailing/page_white_text_width.png" alt="Просмотр / печать"></a>
				</td>	
				</tr>
			<?}?>
		<?}?>

	</table>
</div>
 <?// echo "<pre>";print_r($rsPosting->arResult);echo "</pre>";?>
<div class="clear-all"></div><Br><br><Br><br>
	</div>
	<div class="clear-all"></div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>