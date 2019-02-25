<?define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Региональная рассылка");
global $USER;

?>
<link rel="stylesheet" type="text/css" href="./mailing.css" />
<?
global $USER;
// Если не в группе "Региональные рассылки"(24) переход в личный кабинет
//if (!CSite::InGroup (array(24)) && !($USER->IsAdmin())) LocalRedirect("/ru/user/"); 
?>
<script>

$(document).ready(function(){

	$(".img_min").hover(
		function(){$(this).next(".img_big").css("display","block");},
		function() {$(this).next(".img_big").css("display","none");}
	);

	$("input[type=file]").on("change",function(){
		if($(this).val()!="") $(this).next(".res_file").css({"display":"inline-block"});
		else $(this).next(".res_file").css({"display":"none"});
	});
	$(".posting .add_file .res_file ").on("click",function(){
		var input=$(this).prev("input");
		input.replaceWith(input = input.val('').clone(true));
		$(this).css({"display":"none"});
	});
});
	function f_submit() {
		var ter="";
		var subject=$("#SUBJECT").val();
		var bcc_field=$("#BCC_FIELD").val();
		var body_posting=$("#BODY_POSTING").val();
		if(!subject || !bcc_field || !body_posting) {
			var er_po=$("#er_po").val();
			alert(er_po);
			return false;
		}
		else return true;
	}
	
</script>
<Br><br>
<!--<h1><?$APPLICATION->ShowTitle();?></h1>-->

<div class="border-top"></div>
<!--
  <div class="left" style="width:230px;">
<?

if ($USER->IsAuthorized()):
?>
		<?
		// включаемая область для раздела
		$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."../../user/sect_inc.php", Array(), Array(
			"MODE"      => "html",                                           // будет редактировать в веб-редакторе
			"NAME"      => "Редактирование включаемой области раздела",      // текст всплывающей подсказки на иконке
			"TEMPLATE"  => "sect_inc.php"                    // имя шаблона для нового файла
			));
		?>
<?endif?>
	</div>
	-->
<div class="right" style="width:650px; min-height:350px;margin-left:100px;">

<div>
<div class="title" style="float:left;">Создание выпуска для рассылки</div>
<div class="" style="float:right;"><a href="posting_list.php">мои выпуски</a></div>
</div>
<br /><br/>

<?
global $USER;
echo "<h3>Автор: <span class='mm_g'>".$USER->GetFullName()."</span></h3>";
?>
<br/>
<?
	$dir="./template_posting/templates/"; // папка с шаблонами
	$cf=3; // допустимое количество вложенных файлов
	
	CModule::IncludeModule("subscribe");
	$posting = new CPosting;
	
if($_POST['start_posting'] || $_POST['edit_posting']) {
		
	$FROM_FIELD = "test@deaks.ru"; // e-mail от кого
	$TO_FIELD = $USER->GetId()."-".$USER->GetEmail(); // кому
	$BCC_FIELD = ""; // Дополнительные адреса получателей  hnr07@mail.ru a.demidov@atreid.ru
	$STATUS = "D"; // статус "Черновик" ("D"), "В процессе" ("P")
	$BODY_TYPE = "html"; // Формат текста письма
	$BODY = ""; // текст письма
	$RUB_ID = ""; //массив идентификаторов рассылок
	$GROUP_ID  = ""; //массив идентификаторов групп пользователей.
	$SUBJECT = ""; //Заголовок письма
	$DIRECT_SEND = "Y"; // Отправлять письмо персонально каждому получателю
	$SUBSCR_FORMAT = "html"; // Формат подписки
	$CHARSET="utf-8"; // Кодировка письма
	
	
	$SUBJECT=$_POST["SUBJECT"];
	
	$_POST["BCC_FIELD"]=str_replace(" ","\n", $_POST["BCC_FIELD"]);
	$ar_bcc_field_0=explode("\n",$_POST["BCC_FIELD"]);
	//$ar_bcc_field = array_diff($ar_bcc_field_0, array(''));
	$ca=count($ar_bcc_field_0);
	$err_mail="";
	for($i=0;$i<$ca;$i++) {
		$m=trim($ar_bcc_field_0[$i]);
		if($m) {
			if(preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $m)) { $ar_str_mail[]=$m;}
			else{$err_mail.=$m."<br />";}
		}
	}
	//echo " >>> ".$err_mail." >>> ".$str_mail;
	if($err_mail) {
		
		echo "<div class='errror_div'>Ошибка адреса<br />".$err_mail."</div>";
		
	}
	else {
		$str_mail=array_unique($ar_str_mail);
		$BCC_FIELD=implode("\n",$str_mail);
		
		$BODY=str_replace("\n","<br />",$_POST["BODY_POSTING"]);
		//$BODY=$_POST["BODY_POSTING"];
		
		if($_POST['TEMPLATE']) {
		 $filename = $dir.$_POST['TEMPLATE']; // Шаблон письма
				$handle = fopen($filename, "r");
				$contents = @fread($handle, @filesize($filename));
				fclose($handle);
				if($contents) {
					$contents = str_replace("#user-subject#", $SUBJECT, $contents);
					$contents = str_replace("#user-text#", $BODY, $contents);
					$BODY=$contents;
				}
		}			
		

		//echo "<pre>";print_r($_POST);echo "</pre>";
		//	echo "<pre>";print_r($_FILES);echo "</pre>";
		
		
		$arFields = Array(
			"FROM_FIELD" => $FROM_FIELD,
			"TO_FIELD" => $TO_FIELD,
			"BCC_FIELD" => $BCC_FIELD,
			"EMAIL_FILTER" => $EMAIL_FILTER,
			"SUBJECT" =>$SUBJECT,
			"BODY_TYPE" => ($BODY_TYPE <> "html"? "text":"html"),
			"BODY" => $BODY,
			"DIRECT_SEND" => ($DIRECT_SEND <> "Y"? "N":"Y"),
			"CHARSET" => $CHARSET,
			"SUBSCR_FORMAT" => ($SUBSCR_FORMAT<>"html" && $SUBSCR_FORMAT<>"text"?
				false:$SUBSCR_FORMAT),
			"RUB_ID" => $RUB_ID,

		);
		if($STATUS <> "")
		{
			if($STATUS<>"S" && $STATUS<>"E" && $STATUS<>"P")
				$STATUS = "D";
			$arFields["STATUS"] = $STATUS;
			if($STATUS == "D")
			{
				$arFields["DATE_SENT"] = false;
				$arFields["SENT_BCC"] = "";
				$arFields["ERROR_EMAIL"] = "";
			}
		}
		
		
		
		if($_POST['start_posting']) {
			$ID = $posting->Add($arFields);
			$id_flaf=$ID;
		}
		if($_POST['edit_posting']) {
			$ID=$_SESSION["POSTING"]["post_id"];
			$ID_edit = $posting->Update($ID, $arFields);
			$id_flaf=$ID_edit;
			if(isset($_POST['edit_posting_file'])) {
				foreach($_POST['edit_posting_file'] as $file_id) {
					CPosting::DeleteFile($ID, $file_id);
				}
			}
		}
		if($id_flaf == false) {
			echo $posting->LAST_ERROR;
		}
		else {
			for($i=0;$i<$cf;$i++) {
				if($_FILES["FILE_POSTING"]["error"][$i]==0) {
					$ar_file_attach[$i]=array("name" =>$_FILES["FILE_POSTING"]["name"][$i],"size" =>$_FILES["FILE_POSTING"]["size"][$i], "type" =>$_FILES["FILE_POSTING"]["type"][$i], "tmp_name" =>$_FILES["FILE_POSTING"]["tmp_name"][$i]);
					$file_id = $posting->SaveFile($ID, $ar_file_attach[$i]);
					if($file_id===false) $strError .= "Ошибка при сохранении вложения.";
				}
			}
			
			$_SESSION["POSTING"]["post_id"]=$ID;
			
			$_SESSION["POSTING"]["SUBJECT"]=$SUBJECT;
			$_SESSION["POSTING"]["BCC_FIELD"]=$BCC_FIELD;
			$_SESSION["POSTING"]["BODY_POSTING"]=$_POST["BODY_POSTING"];
			$_SESSION["POSTING"]["TEMPLATE"]=$_POST["TEMPLATE"];
			header("Location: posting_run.php");			
		}

		$rsPosting = CPosting::GetByID($ID);
		$arPosting = $rsPosting->Fetch();
		if($arPosting) {
			//echo "<pre>"; echo htmlspecialchars(print_r($arPosting, true)); echo "</pre>";
			//echo "<pre>"; print_r($arPosting); echo "</pre>";
		}
		else echo "Not found";
	}
}
//echo "<pre>"; print_r($_SESSION); echo "</pre>";
if($_POST['run_posting']) {
	$_POST["SUBJECT"]=$_SESSION["POSTING"]["SUBJECT"];
	$_POST["BCC_FIELD"]=$_SESSION["POSTING"]["BCC_FIELD"];
	$_POST["BODY_POSTING"]=$_SESSION["POSTING"]["BODY_POSTING"];
	$_POST["TEMPLATE"]=$_SESSION["POSTING"]["TEMPLATE"];
	$ID=$_POST['posting_id'];
	$p_edit=true;
	/* // Рабочий вариант
	$change=$posting->ChangeStatus($ID, "P");
	$posting->AutoSend($ID);
	if($change) echo "<div class='ok_div'>Выпуск № ".$ID." добавлен в рассылку.</div>";
	else echo "<div class='errror_div'>Выпуск № ".$ID." - ошибка добавления в рассылку.</div>";
	*/
	 // Тестовый вариант
	 echo "<div class='ok_div'>Это тестовый вариант рассылки. Выпуск № ".$ID." добавлен в рассылку, но не будет отправлен.</div>";
}
if($_POST['del_posting']) {
	$_POST["SUBJECT"]=$_SESSION["POSTING"]["SUBJECT"];
	$_POST["BCC_FIELD"]=$_SESSION["POSTING"]["BCC_FIELD"];
	$_POST["BODY_POSTING"]=$_SESSION["POSTING"]["BODY_POSTING"];
	$_POST["TEMPLATE"]=$_SESSION["POSTING"]["TEMPLATE"];
	$ID=$_POST['posting_id'];
	$res = CPosting::Delete($ID);
	if($res) echo "<div class='ok_div'>Выпуск № ".$ID." удалён из рассылки.</div>";
	else echo "<div class='errror_div'>Выпуск № ".$ID." - ошибка удаления.</div>";
}
?>


<input type="hidden" id="er_po" value="Поля: Тема выпуска, Адреса получателей, Текст выпуска, Шаблон выпуска должны быть заполнены!">
	<div class="posting">
		<form action="index.php" method="POST" onsubmit="return f_submit()" enctype = 'multipart/form-data'>
		<table><tr valign="top"><td>
		
			<div class="tit_fo">Тема выпуска</div>
			<div><input type="text" name="SUBJECT" id="SUBJECT" value="<?=$_POST['SUBJECT']?>"></div>
			</td><td>
			
			</td></tr><tr><td>
			
			<div class="tit_fo">Адреса получателей(по одному в строке)</div>
			<div><textarea name="BCC_FIELD" id="BCC_FIELD"><?=$_POST['BCC_FIELD']?></textarea></div>
			
			<div class="tit_fo">Текст выпуска</div>
			<div><textarea name="BODY_POSTING" id="BODY_POSTING"><?=$_POST['BODY_POSTING']?></textarea></div>
			
			</td><td>
			
			<div class="tit_fo">Прикрепить файл</div>
			<?for($i=0;$i<$cf;$i++) {?>
				<div class="add_file"><input type="file" name="FILE_POSTING[<?=$i?>]"> &nbsp;<span class="res_file" title="очистить поле"></span></div>
			<?}?>
			
			<?if($p_edit) {
	
				$rsFile = CPosting::GetFileList($_SESSION["POSTING"]["post_id"]);
				while($arFile = $rsFile->Fetch()) {?>
					<div class="file_del"> <?=$arFile["ORIGINAL_NAME"]?> - <i>удалить</i> <input type="checkbox" name="edit_posting_file[]" value="<?=$arFile["ID"]?>"></div>
				<?}
		
			}?>
			
			<br /><br />
			
			<?
			$dir_templates = './template_posting/';
			$ar_files = scandir($dir_templates."templates");
			
			if(($key = array_search('.',$ar_files)) !== FALSE){ unset($ar_files[$key]);}
			if(($key = array_search('..',$ar_files)) !== FALSE){ unset($ar_files[$key]);}
			sort($ar_files);
			$c_ar_files=count($ar_files);
			?>
				<div class="tit_fo">Шаблон выпуска</div>
				<?
				for($i=1;$i<=$c_ar_files;$i++) { ?>
					<div><input type="radio" id="it_<?=$i?>" name="TEMPLATE" value="template_posting_<?=$i?>.php" <?if($_POST['TEMPLATE']=="template_posting_".$i.".php" || (!isset($_POST['TEMPLATE']) && $i==1)) echo "checked"?>> <label for="it_<?=$i?>"><img id="tm_<?=$i?>" class="img_min" src="<?=$dir_templates?>images/template_posting_<?=$i?>.jpg"> <img class="img_big" src="<?=$dir_templates?>images/template_posting_<?=$i?>_big.jpg"></label></div><br />
				<?	}?>
			
			<div><input type="radio" id="it_0" name="TEMPLATE" value="0" <?if($_POST['TEMPLATE']=="0") echo "checked"?>> <label for="it_0">без шаблона</label></div>
			
		
			
		
			</td></tr></table>
			<div><input type="submit" name="start_posting" id="start_posting" value="создать новый выпуск"></div>
			<?if($p_edit) {?>
				<div><input type="submit" name="edit_posting" id="edit_posting" value="изменить выпуск № <?=$_SESSION["POSTING"]["post_id"]?>"></div>
			<?}?>
		</form>
	</div>
<div class="clear-all"></div><Br><br><Br><br>
	</div>
	<div class="clear-all"></div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>