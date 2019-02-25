<?
IncludePublicLangFile(__FILE__);
///////////////// калькулятор /////////////////////////

//$id_venue=fGetResultValues("id_venue");// id площадки
$code_m=fGetResultValues("code_m");
//echo $code_m;
//Изменяем некоторые переменные при редактировании заявки
if($edit_z) {
	/////// значения скидок и наценок из результата заявки /////////
	$discount=fGetResultValues("discount");
	$markup=fGetResultValues("markup");
	$minus=fGetResultValues("minus");
	$plus=fGetResultValues("plus");
	//////////////////////
}	
	
	$k_dt=(100-$discount)/100;  // скидка в %

	$k_mp=(100+$markup)/100;  // наценка в %
	
	$knvm=trim(fGetResultValues("currency_id")); // код национальной валюты мероприятия
	$knvm = preg_replace("/[^0-9]/", '', $knvm);
//echo ">>>>> ".$knvm;

if($edit_z) $fr=@fopen("../manager_scripts/base_currency.txt","r");
else $fr=@fopen("../../../../com/registration_event/".$code_m."/manager_scripts/base_currency.txt","r");

	$str_base_curency=@fgets($fr,255);
	@fclose($fr);
$ar_base_curency=explode("@",$str_base_curency);
$id_base_curency=trim($ar_base_curency[0]);

$kbvm=$id_base_curency;   // код базовой валюты мероприятия
//echo ">>>>> ".$kbvm;

// Форма с курсами валют для примера не используется
//CModule::IncludeModule("form");
$FORM_ID_c = 1;
		$arFilter_c = array();
		$arFields_c = array();
		$arFields_c[0] = array(
			"CODE"              => "currency_number",     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
			"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
			"VALUE"             => $kbvm,        // значение по которому фильтруем
			"EXACT_MATCH"       => "Y"              // ищем точное совпадение
		);
		$arFilter_c["FIELDS"] = $arFields_c;
		$rsResults_c = CFormResult::GetList($FORM_ID_c, 
			($by="s_timestamp"), 
			($order="asc"), 
			$arFilter_c, 
			$is_filtered, 
			"N", 
			false);

		$arResult_c = $rsResults_c->GetNext();
			$RESULT_ID_c=$arResult_c['ID'];
			$arAnswer_c = CFormResult::GetDataByID(
			$RESULT_ID_c, 
			array('code'),  // массив символьных кодов необходимых вопросов
			$ar_Res_c, 
			$ar_Answer2_c);
		$tiv=$arAnswer_c['code'][0]['USER_TEXT']; //обозначение базовой валюты мероприятия
		//echo $tiv;
		
		$arFields_c[0] = array(
			"CODE"              => "currency_number",     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
			"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
			"VALUE"             => $knvm,        // значение по которому фильтруем
			"EXACT_MATCH"       => "Y"              // ищем точное совпадение
		);
		$arFilter_c["FIELDS"] = $arFields_c;
		$rsResults_c = CFormResult::GetList($FORM_ID_c, 
			($by="s_timestamp"), 
			($order="asc"), 
			$arFilter_c, 
			$is_filtered, 
			"N", 
			false);
		$arResult_c = $rsResults_c->GetNext();
		
		
			$RESULT_ID_c=$arResult_c['ID'];
			$arAnswer_c = CFormResult::GetDataByID(
			$RESULT_ID_c, 
			array('code'),  // массив символьных кодов необходимых вопросов
			$ar_Res_c, 
			$ar_Answer2_c);
		$tnv=$arAnswer_c['code'][0]['USER_TEXT'];//обозначение национальной валюты мероприятия
		//echo $tnv;
	

if($kbvm==$knvm) $kp=1;
else {
	/*
	if($edit_z) { 
               $kp=fGetResultValues("m_course");
	}
	else {
		/
		$mv=time();
		//echo $mv;
		$FORM_ID_c = 9;
		$arFilter_c = array();
		$arFields_c = array();
		$arFields_c[0] = array(
			"CODE"              => "code_m",     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
			"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
			"VALUE"             => $code_m,        // значение по которому фильтруем
			"EXACT_MATCH"       => "Y"              // ищем точное совпадение
		);
	
		
		$arFilter_c["FIELDS"] = $arFields_c;
				// выберем (первые) все результатов
		$rsResults_c = CFormResult::GetList($FORM_ID_c, 
			($by="s_timestamp"), 
			($order="asc"), 
			$arFilter_c, 
			$is_filtered, 
			"N", 
			false);
		
		while ($arResult_c = $rsResults_c->Fetch())
		{
				$RESULT_ID_c=$arResult_c['ID'];
				$arAnswer_c = CFormResult::GetDataByID(
				$RESULT_ID_c, 
				array('currency_number','time_stamp','course'),  // массив символьных кодов необходимых вопросов
				$ar_Res_c, 
				$ar_Answer2_c);
				if($arAnswer_c['currency_number'][0]['USER_TEXT']==$knvm && $arAnswer_c['time_stamp'][0]['USER_TEXT']<=$mv) {
					$course[$arAnswer_c["time_stamp"][0]['USER_TEXT']]=$arAnswer_c["course"][0]['USER_TEXT'];
				}
		}
		//echo "<pre>";print_r($course);echo "</pre>";
		$kc= max(array_keys($course));
			
		$kp=$course[$kc];  // курс нац.валюты к базовой
	}
	*/
$kp=64; // для примера
$tnv=fGetResultValues("currency"); // для примера
}



$date1 = fGetResultValues("day_hotel_start"); // начало проживания
$date2 = fGetResultValues("day_hotel_finish"); // окончание проживания
$dif = fGetResultValues("day_hotel");                   // кол-во дней проживания

$cage=0; // ключ привязки к возрасту участника
foreach($age_frame as $val) {
	if(fGetResultValues("age")>=$val) $cage++;
}
//echo $cage;
$chotel=fGetResultValues("id_hotel"); // ключ привязки к отелю

$cnomer=fGetResultValues("id_nomer");// ключ привязки к номеру

$cfly_1=fGetResultValues("id_fly_1"); // ключ привязки к перелёту туда

$cfly_2=fGetResultValues("id_fly_2"); // ключ привязки к перелёту обратно
//echo $chotel;
$cena_e=0; // общая стоимость в у. е.
$cena_n=0; // общая стоимость в нац валюте
$ctext='';  // текст расшифровки калькуляции в базовой валюте
$ctext_n='';  // текст расшифровки калькуляции в нац. валюте

$cage=0; // ключ привязки к возрасту участника
foreach($age_frame as $k=>$v) {
	if(fGetResultValues("age")>=$v) $cage=$k+1;
}
//echo $chotel." > ".$cnomer." > ".$cage;
//echo "<pre>";print_r($arc_nom);echo "</pre>";
$cena_hotel=0;  //стоимость Проживания
$cena_n_hotel=0;  //стоимость Проживания в нац валюте
	if(fGetResultValues("p_hotel")==fGetValue("p_hotel",0)) {
	$cena_hotel=round($arc_nom[$chotel][$cnomer][$cage]*$dif*$k_dt*$k_mp,2); 
	$cena_n_hotel=round($arc_nom[$chotel][$cnomer][$cage]*$kp*$dif*$k_dt*$k_mp,2);
	$ctext.=GetMessage("hotel")." & ".GetMessage("nomer")." - ".$cena_hotel." ".$tiv."\n".$date1." - ".$date2." = ".GetMessage("DIF")." ".$dif."\n";
	$ctext_n.=GetMessage("hotel")." & ".GetMessage("nomer")." - ".$cena_n_hotel." ".$tnv."\n".$date1." - ".$date2." = ".GetMessage("DIF")." ".$dif."\n";
	}

$cena_konf=0;  //стоимость Участие в конференции
$cena_n_konf=0;  //стоимость Участие в конференции в нац валюте
if(fGetResultValues("d_konf")==fGetValue("d_konf",0)) {
	$cena_konf=round($arc_konf[$cage]*$k_dt*$k_mp,2); 
	$cena_n_konf=round($arc_konf[$cage]*$kp*$k_dt*$k_mp,2);
	$ctext.=GetMessage("d_konf")." - ".$cena_konf." ".$tiv."\n";
	$ctext_n.=GetMessage("d_konf")." - ".$cena_n_konf." ".$tnv."\n";
}
	
$cena_ujin=0;  //стоимость Участие в гала ужине
$cena_n_ujin=0;  //стоимость Участие в гала ужине в нац валюте
if(fGetResultValues("d_ujin")==fGetValue("d_ujin",0)) {
	$cena_ujin=round($arc_ujin[$cage]*$k_dt*$k_mp,2); 
	$cena_n_ujin=round($arc_ujin[$cage]*$kp*$k_dt*$k_mp,2);
	$ctext.=GetMessage("d_ujin")." - ".$cena_ujin." ".$tiv."\n";
	$ctext_n.=GetMessage("d_ujin")." - ".$cena_n_ujin." ".$tnv."\n";
}

$cena_tour_1=0;  //стоимость Участия в экскурсии
$cena_n_tour_1=0;  //стоимость Участия в экскурсии в нац валюте
if(fGetResultValues("tour_1")==fGetValue("tour_1",0)) {
	$cena_tour_1=round($arc_tour_1[$cage]*$k_dt*$k_mp,2); 
	$cena_n_tour_1=round($arc_tour_1[$cage]*$kp*$k_dt*$k_mp,2);
	$ctext.=GetMessage("tour_1")." - ".$cena_tour_1." ".$tiv."\n";
	$ctext_n.=GetMessage("tour_1")." - ".$cena_n_tour_1." ".$tnv."\n";
}

$cena_training=0;  //стоимость Участия в тренинге
$cena_n_training=0;  //стоимость Участия в тренинге в нац валюте
if(fGetResultValues("training")==fGetValue("training",0)) {
	$cena_training=round($arc_training[$cage]*$k_dt*$k_mp,2); 
	$cena_n_training=round($arc_training[$cage]*$kp*$k_dt*$k_mp,2);
	$ctext.=GetMessage("training")." - ".$cena_training." ".$tiv."\n";
	$ctext_n.=GetMessage("training")." - ".$cena_n_training." ".$tnv."\n";
}

/*
$cena_viza=0;  //стоимость оформления визы
$cena_n_viza=0;  //стоимость оформления визы в нац валюте
if(fGetResultValues("p_viza")==fGetValue("p_viza",0)) {
$cena_viza=round($arc_viz[$cage]*$k_dt*$k_mp,2); 
$cena_n_viza=round($arc_viz[$cage]*$kp*$k_dt*$k_mp,2);
$ctext.=GetMessage("p_viza")." - ".$cena_viza." ".$tiv."\n";
$ctext_n.=GetMessage("p_viza")." - ".$cena_n_viza." ".$tnv."\n";
}
*/

$cena_insurance=0; //стоимость Медицинской страховки
$cena_n_insurance=0; //стоимость Медицинской страховки в нац валюте 
if(fGetResultValues("medical_insurance")==fGetValue("medical_insurance",0)) {
	$cena_insurance=$insurance_dey[$cage]*($dif+1);
	$cena_n_insurance=$insurance_dey[$cage]*($dif+1)*$kp;
	$ctext.=GetMessage("medical_insurance")." - ".$cena_insurance." ".$tiv."\n";
	$ctext_n.=GetMessage("medical_insurance")." - ".$cena_n_insurance." ".$tnv."\n";
	}
//echo "<pre>";print_r($arc_fly_t);echo "</pre>";
$cena_fly_1=0;  //стоимость перелёта туда
$cena_n_fly_1=0;  //стоимость перелёта в нац валюте туда
$cena_fly_1=round($arc_fly_t[$cfly_1][$cage]*$k_dt*$k_mp,2); 
$cena_n_fly_1=round($arc_fly_t[$cfly_1][$cage]*$kp*$k_dt*$k_mp,2);
$ctext.=GetMessage("fly_1")." - ".$cena_fly_1." ".$tiv."\n";
$ctext_n.=GetMessage("fly_1")." - ".$cena_n_fly_1." ".$tnv."\n";

$cena_fly_2=0;  //стоимость перелёта обратно
$cena_n_fly_2=0;  //стоимость перелёта в нац валюте обратно
$cena_fly_2=round($arc_fly_o[$cfly_2][$cage]*$k_dt*$k_mp,2); 
$cena_n_fly_2=round($arc_fly_o[$cfly_2][$cage]*$kp*$k_dt*$k_mp,2);
$ctext.=GetMessage("fly_2")." - ".$cena_fly_2." ".$tiv."\n";
$ctext_n.=GetMessage("fly_2")." - ".$cena_n_fly_2." ".$tnv."\n";

$cena_p_transfer=0;  //стоимость Участия в тренинге
$cena_n_p_transfer=0;  //стоимость Участия в тренинге в нац валюте
if(fGetResultValues("p_transfer")==fGetValue("p_transfer",0)) {
	$cena_p_transfer=round($arc_tran[$cage]*$k_dt*$k_mp,2); 
	$cena_n_p_transfer=round($arc_tran[$cage]*$kp*$k_dt*$k_mp,2);
	$ctext.=GetMessage("p_transfer")." - ".$cena_p_transfer." ".$tiv."\n";
	$ctext_n.=GetMessage("p_transfer")." - ".$cena_n_p_transfer." ".$tnv."\n";
}


$mi=$minus;                 // скидка от общей суммы в у.е. 
$mi_n=round($kp*$minus,2);  // скидка от общей суммы в нац.валюте
$pl=$plus;                   //наценка к общей сумме в у.е. 
$pl_n=round($kp*$plus,2);  //наценка к общей сумме в нац.валюте 
if($mi) {
$ctext.="\n".GetMessage("minus")." - ".$mi." ".$tiv."\n";
$ctext_n.="\n".GetMessage("minus")." - ".$mi_n." ".$tnv."\n";
}
if($pl) {
$ctext.=GetMessage("plus")." - ".$pl." ".$tiv."\n";
$ctext_n.=GetMessage("plus")." - ".$pl_n." ".$tnv."\n";
}

$r_l="______________________"."\n";    // разделитель

$ctext.=$r_l;
$ctext_n.=$r_l;

	if($edit_z) {
		// Итоговая стоимость при редактировании заявки
		
		$cena_e=$cena_hotel+$cena_konf+$cena_ujin+$cena_viza+$cena_fly_1+$cena_fly_2+$cena_tour_1+$cena_training+$cena_insurance+$cena_p_transfer-$mi+$pl;
		$cena_n=$cena_n_hotel+$cena_n_konf+$cena_n_ujin+$cena_n_viza+$cena_n_fly_1+$cena_n_fly_2+$cena_n_tour_1+$cena_n_training+$cena_n_insurance+$cena_n_p_transfer-$mi_n+$pl_n;
		

		if($kp<>1) $cena_n=floatval(fGetResultValues("t_money_2"))+round((($cena_e-floatval(fGetResultValues("t_money")))*$kp),2);
		else $cena_n=$cena_e;


		$ctext.="Счёт"." - ".$cena_e." ".$tiv."\n";
		$ctext_n.="Счёт"." - ".$cena_n." ".$tnv."\n";

		$ctext.="Оплачено"." - ".fGetResultValues("t_money")." ".$tiv."\n";
		if($kp<>1) $ctext_n.="Оплачено"." - ".fGetResultValues("t_money_2")." ".$tnv."\n";
		else $ctext_n.="Оплачено"." - ".fGetResultValues("t_money")." ".$tnv."\n";

		$ctext.=$r_l;
		$ctext_n.=$r_l;

		$ctext.=GetMessage('K_OPLATE')." - ".($cena_e-fGetResultValues("t_money"))." ".$tiv."\n";
		$ctext_n.=GetMessage('K_OPLATE')." - ".($cena_n-fGetResultValues("t_money_2"))." ".$tnv."\n";
		

	}
	else {

		// Итоговая стоимость при регистрации заявки
		$cena_e=$cena_hotel+$cena_konf+$cena_ujin+$cena_viza+$cena_fly_1+$cena_fly_2+$cena_tour_1+$cena_training+$cena_insurance+$cena_p_transfer-$mi+$pl;
		$cena_n=$cena_n_hotel+$cena_n_konf+$cena_n_ujin+$cena_n_viza+$cena_n_fly_1+$cena_n_fly_2+$cena_n_tour_1+$cena_n_training+$cena_n_insurance+$cena_n_p_transfer-$mi_n+$pl_n;

		
		
		$ctext.=GetMessage('K_OPLATE')." - ".$cena_e." ".$tiv."\n";
		$ctext_n.=GetMessage('K_OPLATE')." - ".$cena_n." ".$tnv."\n";
		


	}
?>
