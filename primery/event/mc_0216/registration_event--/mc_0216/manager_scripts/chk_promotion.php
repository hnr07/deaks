<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"]."/ccws/sum_models/class_event.php");
$ccws= new ccws_event();
 include_once "../../filter/CheckPerson.php"; //Подключение CheckPerson
 
include "../var_config.php";
$APPLICATION->SetTitle($title_m);
?> 
<?
global $APPLICATION, $USER,$ccws;

function filter_chk($s_id, $cond, $chk, $family, $name) {
	$arCh=Person_check(array(  
        'SummitId' => $s_id,
		'QuestionId' => $cond, //ИД ВОПРОСА
		'PersonId' => $chk,
		'PersonFirstName' => $name,
		'PersonLastName' => $family
		));
		
	return $arCh;
}

?>
<link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" />
<script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"></script>
<br/>
<div class="manager_scripts">
<div class="a_vozo"><a href="./">Все служебные обработчики</a><div id="sz"><div><img src="/images/registration_event/d.gif"></div></div></div>
<h2><?$APPLICATION->ShowTitle();?></h2>
<br/>
<div class="chte"><b>Страница проверки члена клуба.</b> <span onclick="f_ps('txt2')"><u>Что это? >>></u></span><div id="txt2" class="txt" onclick="f_us('txt2')">
Данная страница позволяет проверить ЧК для возможности участия на мероприятии "<?$APPLICATION->ShowTitle();?>".<br/>

 <br/><br/><u>закрыть</u></div></div>

  <form method="POST">
 <div class="chte">№ ЧК &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="chk" value="<?=$_POST['chk']?>" class="input_text"> </div>
 
  <div class="chte">Фамилия <input type="text" name="family" value="<?=$_POST['family']?>" class="input_text"> </div>
 
   <div class="chte">Имя  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" value="<?=$_POST['name']?>" class="input_text">  </div>



 <input class="buts" type="submit" name="proverit" value="Проверить" onclick="f_sz()">
 </form>
 <?
 if(isset($_POST['proverit'])) {
	 if($_POST['chk'] && $_POST['family'] && $_POST['name']) {
	 ?>
	 <table class="tmbl">
	 <tr><td><i>Есть ли проверяемый ЧК в БД: &nbsp;&nbsp;&nbsp;</i></td><td><b>
	 <?
	 //Есть ли ЧК в БД
	 //echo $summit_id;
		$cond=$condition_chk;   // id проверяемого условия
		$arCheck_p = filter_chk($summit_id,$cond,$_POST['chk'],$_POST['family'],$_POST['name']);  // Есть ли такой пользователь

		if($arCheck_p["Result"]) {$op=1;$email = $arCheck_p["Result"]["Email"];}
		else {$op=0;$errors["CHK"]=$arCheck_p["ErrorText"]."(".$arCheck_p["ErrorCode"].")";}
	 if($errors["CHK"]) echo $errors["CHK"];
	 else echo "Да - ".$arCheck_p["Result"]["Email"];
	 ?>
	 </b></td></tr>
	  <?
		 
	if($op) {
	?>
	 <tr><td><i>Возможность участия ЧК в мероприятии: &nbsp;&nbsp;&nbsp;</i></td><td><b>
	<?
		// Проверка на возможность участия ЧК
		$cond=$condition_member;   // id проверяемого условия
		$arCheck = filter_chk($summit_id,$cond,$_POST['chk'],$_POST['family'],$_POST['name']);  // Условие участия в мероприятии
		
		if($arCheck["Result"]) { 
		if($arCheck["Partner"]=='') $arCheck["Partner"]=0;
		$partner=$arCheck["Partner"];
		}
		else {
			$errors["MEMBER"]="НЕТ";
			$partner="";
			}
		if($errors["MEMBER"]) echo $errors["MEMBER"];
		else echo "Да";
		?>
		</b></td></tr>
		<tr><td><i>Партнёр: &nbsp;&nbsp;&nbsp;</i></td><td><b>
		<?
		echo $arCheck["Partner"];
		
		?>
		</b></td></tr>
		<tr><td><i>Может ли участник приглашать гостей-ЧК: &nbsp;&nbsp;&nbsp;</i></td><td><b>
		<?
		//Может ли участник приглашать гостей-ЧК
	  $cond=$condition_guest_chk;   // id проверяемого условия
		$arCheck_gck = filter_chk($summit_id,$cond,$_POST['chk'],$_POST['family'],$_POST['name']);  // Возможность приглашения гостей-ЧК

		if(!$arCheck_gck["Result"]) $errors["LIMIT_MEMBER"]=$arCheck_gck["ErrorText"]."НЕТ";
		if($errors["LIMIT_MEMBER"]) echo $errors["LIMIT_MEMBER"];
		else echo "Да";
		?>
		</b></td></tr>
		<tr><td><i>Проверка ЧК, как плательщика: &nbsp;&nbsp;&nbsp;</i></td><td><b>
		<?
		 //Проверка плательщика
		$cond=$condition_payment;   // id проверяемого условия
		$arCheck_p = filter_chk($summit_id,$cond,$_POST['chk'],$_POST['family'],$_POST['name']);  // Проверка плательщика
		//$error_p = $oWS->ShowError(); // Ошибка, если Не может быть плательщиком
		if(!$arCheck_p["Result"]) $errors["PAYER"]=$arCheck_p["ErrorText"]."НЕТ";
		if($errors["PAYER"]) echo $errors["PAYER"]; 
		else {
		//if ($arCheck_p["Result"]["Extended"]=="1") echo "ДА ".$arCheck_p["Result"]["Extended"];
		//if ($arCheck_p["Result"]["Extended"]=="БД") echo "ДА ".$arCheck_p["Result"]["Extended"];
		if (!$arCheck_p["Result"]["Extended"]) echo "ДА, за одного приглашённого";
		/*if ($arCheck_p["Result"]["Extended"]=="ИД") 
		if (($arCheck_p["Result"]["Extended"]=="ИД")) $arCheck_p["Result"]["Extended"]="2"; else $arCheck_p["Result"]["Extended"]="Без ограничений";
		echo "Да - ".$arCheck_p["Result"]["Currency"]."<br/>Может оплатить заявок - ".$arCheck_p["Result"]["Extended"];*/
		}
		?>
		</b></td></tr>
	<!--	<tr><td><i>Проверка ЧК, как гаранта: &nbsp;&nbsp;&nbsp;</i></td><td><b>-->
		<?
		//Проверка гаранта
		/*
		$cond=$condition_payment;   // id проверяемого условия
		$arCheck_g = filter_chk($summit_id,$cond,$_POST['chk'],$_POST['family'],$_POST['name']);  //Проверка гаранта
		
		if($error_g) $errors["GARANT"]=$arCheck_g["ErrorText"]."(".$arCheck_p["ErrorCode"].")";
		if($errors["GARANT"]) echo $errors["GARANT"];
		else echo "Да - ".$arCheck_g["Result"]["Currency"];//."<br/>Может ufhf оплатить заявок - ".$arCheck_g["OPTION"];
		*/
	}
	 ?>
	
	 </table>
	 <?//echo "<pre>";print_r($errors);echo "</pre>";?>
	 <?
	 }
	else echo "Все поля должны быть заполнены!";
 }
 
 ?>

</div>
<br/><br/> <br/><br/> <br/><br/> <br/><br/>
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>