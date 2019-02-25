<?define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

IncludePublicLangFile(__FILE__);
 include "var_config.php"; 
$APPLICATION->SetTitle($title_m);

include "meter_hotel.php"; // Статистика отелей
include "meter_vm.php"; //  Статистика мест по площадкам мероприятия

	$FORM_ID=$_GET['WEB_FORM_ID'];
	$RESULT_ID=$_GET['RESULT_ID'];
?> 
<link rel="stylesheet" type="text/css" href="/com/registration_event/css/style_index.css" media="all">
<br/><br/>
<div class="dib"><h2><?$APPLICATION->ShowTitle();?> <?=($RESULT_ID)?" - ".GetMessage("saving")." #".$RESULT_ID:""?></h2>
<a href="<?="".$dir_event?>"><button class="but_gfg_a"><?=GetMessage("create")?></button></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/primery"><button class="but_gfg_a"><?=GetMessage("na_glavnuyu")?></button></a>
<br/><br/>
<?
	//echo "123";

if(CModule::IncludeModule("form")){ 
	

	$ar_Answer = CFormResult::GetDataByID(
			$RESULT_ID, 
			array('status','chk','name','family','kem_priglashen_chk','kem_priglashen_name','kem_priglashen_family','venue','id_venue','sum_debt','money_2_calc','p_hotel','id_hotel','mesto_index','promotion_1','currency'),  // массив символьных кодов необходимых вопросов
			$ar_Res, 
			$ar_Answer2);
			
			//echo "<pre>"; print_r($_); echo "</pre>";
			
	if($_GET['formresult']=="editok" && $RESULT_ID==$ar_Res['ID'] && $ar_Res['STATUS_ID']==$status_new) {
	

	
	
		$fir=1; // флаг для управления файлом проверки
		$p_chk=$ar_Answer['chk'][0]['USER_TEXT'];  // № ЧК
		$p_family=$ar_Answer['family'][0]['USER_TEXT']; // фамилия
		$p_name=$ar_Answer['name'][0]['USER_TEXT'];  // имя
		$p_kem_priglashen_chk=$ar_Answer['kem_priglashen_chk'][0]['USER_TEXT']; // Кем приглашён № ЧК
		$p_kem_priglashen_family=$ar_Answer['kem_priglashen_family'][0]['USER_TEXT']; // Кем приглашён фамилия
		$p_kem_priglashen_name=$ar_Answer['kem_priglashen_name'][0]['USER_TEXT']; // Кем приглашён имя
		
		switch($ar_Answer['status'][0]['VALUE']) {
			case "guest":$fpp="filter_guest.php";$tist=GetMessage("guest");break;
			case "guest_chk":$fpp="filter_guest_chk.php";$tist=GetMessage("guest_chk");break;
			default:$fpp="filter_chk.php";$tist=GetMessage("member");
		}
		include $_SERVER["DOCUMENT_ROOT"]."/com/registration_event/filter/".$fpp; //Подключение проверки 
		if($ignor_filter_chk) $fu=1; // Игнорировать проверку участника
		//$fu=1;
		if($fu=1) { // Проверка пройдена
			
			// Проверяем условия для установки статуса "Резерв"
			if($ar_Answer['p_hotel'][0]['ANSWER_VALUE']=="r_comp") {
				$mo=$sum_nom_os[$ar_Answer['id_venue'][0]['USER_TEXT']][$ar_Answer['id_hotel'][0]['USER_TEXT']]; // остаток мест по отелю
			}
			else $mo=1;
			
			if($ar_Answer['id_venue'][0]['USER_TEXT']) {
				$mo_ve=$ar_venue_mesto[$ar_Answer['id_venue'][0]['USER_TEXT']]["ostatok"];// Остаток мест для выбранной площадки
			}
			else $mo_ve=1;
			}
			
			if($choice_place && $ar_Answer['mesto_index'][0]['USER_TEXT']=="") {// Если подключен блок выбора места и нет места
				$mo_pl=0;
			}
			else $mo_pl=1;
			
			if($mo>0 && $mo_ve>0 && $mo_pl>0) $fls_rez=1; // флаг перевода в статус "Ожидает оплаты" или "Ожидает промоушен"
			else $fls_rez=0; // флаг перевода в статус "Резерв"
		
			if($fls_rez){
				if($ar_Answer['promotion_1'][0]['USER_TEXT']) {
					CFormResult::SetStatus($RESULT_ID,  $status_nepr,"Y");  //Если промоушен пройден заявка в статус Ожидает оплаты
					$rsStatus = CFormStatus::GetByID($status_opl);
					$arStatus = $rsStatus->Fetch();
					$arRes["STATUS_TITLE"]=$arStatus["TITLE"];
					$arRes["STATUS_CSS"]=$arStatus["CSS"];
					$arRes['STATUS_ID']=$arStatus['STATUS_ID'];
				}
				else {
					CFormResult::SetStatus($RESULT_ID, $status_nepr,"Y");   //Если промоушен не пройден заявка в статус Ожидает промоушен
					$rsStatus = CFormStatus::GetByID($status_nepr);
					$arStatus = $rsStatus->Fetch();
					$arRes["STATUS_TITLE"]=$arStatus["TITLE"];
					$arRes["STATUS_CSS"]=$arStatus["CSS"];
					$arRes['STATUS_ID']=$arStatus['STATUS_ID'];
				}
			}	
			else {
				CFormResult::SetStatus($RESULT_ID, $status_rz,"Y");  //Если мест в отеле нет заявка в статус Резерв
				$rsStatus = CFormStatus::GetByID($status_rz);
				$arStatus = $rsStatus->Fetch();
				$arRes["STATUS_TITLE"]=$arStatus["TITLE"];
				$arRes["STATUS_CSS"]=$arStatus["CSS"];
				$arRes['STATUS_ID']=$arStatus['STATUS_ID'];
			}
			
			if($force_status) {
				CFormResult::SetStatus($RESULT_ID, $force_status,"Y");      // Если задан id принудительной установки статуса будет установлен статус с этим id
				$rsStatus = CFormStatus::GetByID($force_status);
				$arStatus = $rsStatus->Fetch();
				$arRes["STATUS_TITLE"]=$arStatus["TITLE"];
				$arRes["STATUS_CSS"]=$arStatus["CSS"];
				$arRes['STATUS_ID']=$arStatus['STATUS_ID'];
			}
			
		?>		

		<?
		switch($arStatus['ID']) {
			case $status_ok: $title_status=GetMessage("status_ok"); break;
			case $status_nepr: $title_status=GetMessage("status_nepr"); break;
			case $status_opl: $title_status=GetMessage("status_opl"); break;
			case $status_nopl: $title_status=GetMessage("status_nopl"); break;
			case $status_rz: $title_status=GetMessage("status_rz"); break;
			case $status_del: $title_status=GetMessage("status_del"); break;
		}
		?>

		<br /><br />
		<h3><?=GetMessage("saving_ok")?> - <?=GetMessage("status_z")?>: <?=$title_status?></h3>
		<table class="tab_s"><tr valign="top">
			<td>
				<div class=""><?=$tist?> <?=($p_chk)?$p_chk:""?></div>	
				<div class=""><?=$p_family?> <?=$p_name?></div>	
				<?if($p_kem_priglashen_chk) {?>
				<div class=""><?=GetMessage("priglashen")?> <?=$p_kem_priglashen_chk?></div>	
				<div class=""><?=$p_kem_priglashen_family?> <?=$p_kem_priglashen_name?></div>	
				<?}?>
			</td><td>
				<div class=""><?=(str_replace("\n","<br />",$ar_Answer['money_2_calc'][0]['USER_TEXT']))?></div>	
			</td><td>
				<div class=""><?=GetMessage("dolg")?><br /><b><?=$ar_Answer['sum_debt'][0]['USER_TEXT']?> <?=$ar_Answer['currency'][0]['USER_TEXT']?></b></div>	
			</td>
		</tr></table>
<?		
//require("filter/request_2.php");
//Request();
	
	}
}
 ?>
</div>
 
<br /><br /><br /><br /><br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>