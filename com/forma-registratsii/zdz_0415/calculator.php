<?

///////////////////// калькулятор //////////////////////////////////////

$date1 = fGetResultValues("day_hotel_start"); // начало проживания
$date2 = fGetResultValues("day_hotel_finish"); // окончание проживания
$arr1 = explode('.', $date1);
$arr2 = explode('.', $date2);
$time1 = mktime(0,0,0,$arr1[1],$arr1[0],$arr1[2]);
$time2 = mktime(0,0,0,$arr2[1],$arr2[0],$arr2[2]);
$dif = ($time2 - $time1) / 86400;                   // кол-во дней проживания
//echo $dif;


// индекс места в зале
/*
if(trim(fGetResultValues("mesto_index"))!='') $i_mesto=trim(fGetResultValues("mesto_index")); // проверка наличия индекса
else { //если индекса нет - обращаемся к таблице и подставляем
include "functions.php"; 
$i_mesto=trim(opr_index(1,$_GET['RESULT_ID']));
}
*/

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

$fr=@fopen("manager_scripts/base_currency.txt","r");
	$str_base_curency=@fgets($fr,255);
	@fclose($fr);
$ar_base_curency=explode("@",$str_base_curency);
$id_base_curency=trim($ar_base_curency[0]);

$kbvm=$id_base_curency;   // код базовой валюты мероприятия

$za="SELECT `code` FROM currency_list WHERE `currency_number`='".$kbvm."'";
	//if(!($z=mysql_query($za))) {echo "Не могу выполнить запрос $za";}
	//else{ 
	//$pa=mysql_fetch_array($z);
	//}
	$res = $DB->Query($za);
	while ($pa = $res->Fetch())
	{
		$tiv=$pa['code']; //обозначение базовой валюты мероприятия
	}


$za="SELECT `code` FROM currency_list WHERE `currency_number`='".$knvm."'";
	//if(!($z=mysql_query($za))) {echo "Не могу выполнить запрос $za";}
	//else{ 
	//$pa=mysql_fetch_array($z);
	//}
	$res = $DB->Query($za);
	while ($pa = $res->Fetch())
	{
		$tnv=$pa['code']; //обозначение национальной валюты мероприятия
	}


$cena_e=0; // общая стоимость в у. е.
$cena_n=0; // общая стоимость в нац валюте

if($kbvm==$knvm) $kp=1;
else {
$mv=time();

$za="SELECT `course`,`time_stamp` FROM currency_course WHERE `currency_course`.`activity`=1 AND `code_m`='".$code_m."' AND `currency_number`='".$knvm."' AND `time_stamp`<='".$mv."'";
	//if(!($z=mysql_query($za))) {echo "Не могу выполнить запрос $za";}
	//else{ 
	//$rows=mysql_num_rows($z);
	//for($i=0;$i<$rows;$i++) 
	//   {
    //   $pa=mysql_fetch_array($z);
	//   $course[$pa["time_stamp"]]=$pa["course"];
	 //  }
	//}
	$res = $DB->Query($za);
	while ($pa = $res->Fetch())
	{
		$course[$pa["time_stamp"]]=$pa["course"];
	}
	$kc= max(array_keys($course));
	//echo "<pre>";print_r($course);echo "</pre>";
$kp=$course[$kc];  // курс нац.валюты к базовой

}

$ctext='';  // текст расшифровки калькуляции в базовой валюте
$ctext_n='';  // текст расшифровки калькуляции в нац. валюте


$cage=0; // ключ привязки к возрасту участника
if(fGetResultValues("age")==fGetValue("age",0)) $cage=0;
if(fGetResultValues("age")==fGetValue("age",1)) $cage=1;
if(fGetResultValues("age")==fGetValue("age",2)) $cage=2;
if(fGetResultValues("age")==fGetValue("age",3)) $cage=3;


$chotel=''; // ключ привязки к отелю
if(fGetResultValues("hotel")==fGetValue("hotel",0)) $chotel=0;
if(fGetResultValues("hotel")==fGetValue("hotel",1)) $chotel=1;
if(fGetResultValues("hotel")==fGetValue("hotel",2)) $chotel=2;
if(fGetResultValues("hotel")==fGetValue("hotel",3)) $chotel=3;

$cnomer=''; // ключ привязки к номеру
if(fGetResultValues("nomer")==fGetValue("nomer",0)) $cnomer=0;
if(fGetResultValues("nomer")==fGetValue("nomer",1)) $cnomer=1;
if(fGetResultValues("nomer")==fGetValue("nomer",2)) $cnomer=2;
if(fGetResultValues("nomer")==fGetValue("nomer",3)) $cnomer=3;
if(fGetResultValues("nomer")==fGetValue("nomer",4)) $cnomer=4;
if(fGetResultValues("nomer")==fGetValue("nomer",5)) $cnomer=5;
if(fGetResultValues("nomer")==fGetValue("nomer",6)) $cnomer=6;
if(fGetResultValues("nomer")==fGetValue("nomer",7)) $cnomer=7;
if(fGetResultValues("nomer")==fGetValue("nomer",8)) $cnomer=8;
if(fGetResultValues("nomer")==fGetValue("nomer",9)) $cnomer=9;
if(fGetResultValues("nomer")==fGetValue("nomer",10)) $cnomer=10;
if(fGetResultValues("nomer")==fGetValue("nomer",11)) $cnomer=11;
if(fGetResultValues("nomer")==fGetValue("nomer",12)) $cnomer=12;
if(fGetResultValues("nomer")==fGetValue("nomer",13)) $cnomer=13;
if(fGetResultValues("nomer")==fGetValue("nomer",14)) $cnomer=14;

$cfly_1=-1; // ключ привязки к перелёту туда
if(fGetResultValues("fly_1")==fGetValue("fly_1",0)) $cfly_1=0;
if(fGetResultValues("fly_1")==fGetValue("fly_1",1)) $cfly_1=1;
if(fGetResultValues("fly_1")==fGetValue("fly_1",2)) $cfly_1=2;
if(fGetResultValues("fly_1")==fGetValue("fly_1",3)) $cfly_1=3;
if(fGetResultValues("fly_1")==fGetValue("fly_1",4)) $cfly_1=4;
if(fGetResultValues("fly_1")==fGetValue("fly_1",5)) $cfly_1=5;
if(fGetResultValues("fly_1")==fGetValue("fly_1",6)) $cfly_1=6;
if(fGetResultValues("fly_1")==fGetValue("fly_1",7)) $cfly_1=7;
if(fGetResultValues("fly_1")==fGetValue("fly_1",8)) $cfly_1=8;
if(fGetResultValues("fly_1")==fGetValue("fly_1",9)) $cfly_1=9;

$cfly_2=-2; // ключ привязки к перелёту обратно
if(fGetResultValues("fly_2")==fGetValue("fly_2",0)) $cfly_2=0;
if(fGetResultValues("fly_2")==fGetValue("fly_2",1)) $cfly_2=1;
if(fGetResultValues("fly_2")==fGetValue("fly_2",2)) $cfly_2=2;
if(fGetResultValues("fly_2")==fGetValue("fly_2",3)) $cfly_2=3;
if(fGetResultValues("fly_2")==fGetValue("fly_2",4)) $cfly_2=4;
if(fGetResultValues("fly_2")==fGetValue("fly_2",5)) $cfly_2=5;
if(fGetResultValues("fly_2")==fGetValue("fly_2",6)) $cfly_2=6;
if(fGetResultValues("fly_2")==fGetValue("fly_2",7)) $cfly_2=7;
if(fGetResultValues("fly_2")==fGetValue("fly_2",8)) $cfly_2=8;
if(fGetResultValues("fly_2")==fGetValue("fly_2",9)) $cfly_2=9;

$cguest_card=-1; // ключ привязки к Гостевой карте
if(fGetResultValues("guest_card")==fGetValue("guest_card",0)) $cguest_card=0;
if(fGetResultValues("guest_card")==fGetValue("guest_card",1)) $cguest_card=1;

$cp_hotel=0; // ключ привязки к Варианту проживания
if(fGetResultValues("p_hotel")==fGetValue("p_hotel",0)) $cp_hotel=0;
if(fGetResultValues("p_hotel")==fGetValue("p_hotel",1)) $cp_hotel=1;

/*
$cd_eat_1=0; // ключ привязки к Питание в гостинице
if(fGetResultValues("d_eat_1")==fGetValue("d_eat_1",0)) $cd_eat_1=0;
if(fGetResultValues("d_eat_1")==fGetValue("d_eat_1",1)) $cd_eat_1=1;
if(fGetResultValues("d_eat_1")==fGetValue("d_eat_1",2)) $cd_eat_1=2;
if(fGetResultValues("d_eat_1")==fGetValue("d_eat_1",3)) $cd_eat_1=3;
*/
/*
$cd_eat_2=0; // ключ привязки к Питание на конференции
if(fGetResultValues("d_eat_2")==fGetValue("d_eat_2",0)) $cd_eat_2=0;
if(fGetResultValues("d_eat_2")==fGetValue("d_eat_2",1)) $cd_eat_2=1;
if(fGetResultValues("d_eat_2")==fGetValue("d_eat_2",2)) $cd_eat_2=2;
if(fGetResultValues("d_eat_2")==fGetValue("d_eat_2",3)) $cd_eat_2=3;
*/



/*
$cena_viza=0;  //стоимость оформления визы
$cena_n_viza=0;  //стоимость оформления визы в нац валюте
if(fGetResultValues("p_viza")==fGetValue("p_viza",0)) {
$cena_viza=round($arc_viz[$cage]*$k_dt*$k_mp,2); 
$cena_n_viza=round($arc_viz[$cage]*$kp*$k_dt*$k_mp,2);
$ctext.=getMessage("p_viza")." - ".$cena_viza." ".$tiv."\n";
$ctext_n.=getMessage("p_viza")." - ".$cena_n_viza." ".$tnv."\n";
}
*/
$cena_fly_1=0;  //стоимость перелёта туда
$cena_n_fly_1=0;  //стоимость перелёта в нац валюте туда
$cena_fly_2=0;  //стоимость перелёта обратно
$cena_n_fly_2=0;  //стоимость перелёта в нац валюте обратно
if(fGetResultValues("p_fly")==fGetValue("p_fly",0)) {
	//if($cfly_1>0 && $cfly_2>0) {
	//$cena_fly=round($arc_fly_to[$cfly_1][$cage]*$k_dt*$k_mp,2); 
	//$cena_n_fly=round($arc_fly_to[$cfly_1][$cage]*$kp*$k_dt*$k_mp,2);
	//$ctext.=getMessage("fly_1")." & ".getMessage("fly_2")." - ".$cena_fly." ".$tiv."\n";
	//$ctext_n.=getMessage("fly_1")." & ".getMessage("fly_2")." - ".$cena_n_fly." ".$tnv."\n";
	
	//} else {
	

		if($cfly_1>0) {
		$cena_fly_1=round($arc_fly_t[$cfly_1][$cage]*$k_dt*$k_mp,2); 
		$cena_n_fly_1=round($arc_fly_t[$cfly_1][$cage]*$kp*$k_dt*$k_mp,2);
		$ctext.=getMessage("fly_1")." - ".$cena_fly_1." ".$tiv."\n";
		$ctext_n.=getMessage("fly_1")." - ".$cena_n_fly_1." ".$tnv."\n";
		}
		if($cfly_2>0) {
		$cena_fly_2=round($arc_fly_o[$cfly_2][$cage]*$k_dt*$k_mp,2); 
		$cena_n_fly_2=round($arc_fly_o[$cfly_2][$cage]*$kp*$k_dt*$k_mp,2);
		$ctext.=getMessage("fly_2")." - ".$cena_fly_2." ".$tiv."\n";
		$ctext_n.=getMessage("fly_2")." - ".$cena_n_fly_2." ".$tnv."\n";
		}
	//}
}
$cena_tran=0;  //стоимость оформления Транcфер
$cena_n_tran=0;  //стоимость оформления Транcфер в нац валюте
if(fGetResultValues("p_transfer")==fGetValue("p_transfer",0)) {

// Если выбрано участие или соучастие в Leader Ship, цена трансфера уменьшается в два раза
if(fGetResultValues("d_leader_ship")==fGetValue("d_leader_ship",0) || fGetResultValues("s_leader_ship")==fGetValue("s_leader_ship",0)) {$arc_tran[$cage]=$arc_tran[$cage]/2;}

$cena_tran=round($arc_tran[$cage]*$k_dt*$k_mp,2); 
$cena_n_tran=round($arc_tran[$cage]*$kp*$k_dt*$k_mp,2);

$ctext.=getMessage("p_transfer")." - ".$cena_tran." ".$tiv."\n";
$ctext_n.=getMessage("p_transfer")." - ".$cena_n_tran." ".$tnv."\n";
}

if(!$cp_hotel) { //выбор варианта проживания Через компанию
	$cena_hotel=0;  //стоимость Проживания
	$cena_n_hotel=0;  //стоимость Проживания в нац валюте
	if(fGetResultValues("p_hotel")==fGetValue("p_hotel",0)) {
	$cena_hotel=round($arc_nom[$chotel][$cnomer][$cage]*$dif*$k_dt*$k_mp,2); 
	$cena_n_hotel=round($arc_nom[$chotel][$cnomer][$cage]*$kp*$dif*$k_dt*$k_mp,2);
	$ctext.=getMessage("hotel")." & ".getMessage("nomer")." - ".$cena_hotel." ".$tiv."\n".$date1." - ".$date2." = ".GetMessage("DIF")." ".$dif."\n";
	$ctext_n.=getMessage("hotel")." & ".getMessage("nomer")." - ".$cena_n_hotel." ".$tnv."\n".$date1." - ".$date2." = ".GetMessage("DIF")." ".$dif."\n";
	}

	}
	
	else { //выбор варианта проживания Самостоятельно
	/*
	if($cguest_card>=0){
		$cena_guest_card=0;  //стоимость Гостевой карты
		$cena_n_guest_card=0;  //стоимость  Гостевой карты в нац валюте
		if(fGetResultValues("guest_card")) {

		$cena_guest_card=round($arc_g_card[$cguest_card][$cage]*$ar_kguest_card[$cguest_card]*$k_dt*$k_mp,2); 
		$cena_n_guest_card=round($arc_g_card[$cguest_card][$cage]*$kp*$ar_kguest_card[$cguest_card]*$k_dt*$k_mp,2);
		$ctext.=getMessage("guest_card")."(".getMessage("guest_card_".$cguest_card).") - ".$cena_guest_card." ".$tiv."\n";
		$ctext_n.=getMessage("guest_card")."(".getMessage("guest_card_".$cguest_card).") - ".$cena_n_guest_card." ".$tnv."\n";
		}
	}
	*/
}

$cena_konf=0;  //стоимость Участие в конференции
$cena_n_konf=0;  //стоимость Участие в конференции в нац валюте
if(fGetResultValues("d_konf")==fGetValue("d_konf",0)) {
$cena_konf=round($arc_konf[$cage]*$k_dt*$k_mp,2); 
$cena_n_konf=round($arc_konf[$cage]*$kp*$k_dt*$k_mp,2);
$ctext.=getMessage("d_konf")." - ".$cena_konf." ".$tiv."\n";
$ctext_n.=getMessage("d_konf")." - ".$cena_n_konf." ".$tnv."\n";
}


$cena_ujin=0;  //стоимость Участие в гала ужине
$cena_n_ujin=0;  //стоимость Участие в гала ужине в нац валюте
if(fGetResultValues("d_ujin")==fGetValue("d_ujin",0)) {
$cena_ujin=round($arc_ujin[$cage]*$k_dt*$k_mp,2); 
$cena_n_ujin=round($arc_ujin[$cage]*$kp*$k_dt*$k_mp,2);
$ctext.=getMessage("d_ujin")." - ".$cena_ujin." ".$tiv."\n";
$ctext_n.=getMessage("d_ujin")." - ".$cena_n_ujin." ".$tnv."\n";
}

/*
$cena_eat_1=0;  //стоимость Питание в гостинице
$cena_n_eat_1=0;  //стоимость Питание в гостинице в нац валюте
if(fGetResultValues("d_eat_1")) {
$cena_eat_1=round($arc_eat_1[$cd_eat_1][$cage]*$dif*$k_dt*$k_mp,2); 
$cena_n_eat_1=round($arc_eat_1[$cd_eat_1][$cage]*$kp*$dif*$k_dt*$k_mp,2);
$ctext.=getMessage("d_eat_1")." - ".$cena_eat_1." ".$tiv."\n";
$ctext_n.=getMessage("d_eat_1")." - ".$cena_n_eat_1." ".$tnv."\n";
}
*/
/*
$cena_eat_2=0;  //стоимость Питание на конференции
$cena_n_eat_2=0;  //стоимость Питание на конференции в нац валюте
if(fGetResultValues("d_eat_2")) {
$cena_eat_2=round($arc_eat_2[$cd_eat_2][$cage]*$k_dt*$k_mp,2); 
$cena_n_eat_2=round($arc_eat_2[$cd_eat_2][$cage]*$kp*$k_dt*$k_mp,2);
$ctext.=getMessage("d_eat_2")." - ".$cena_eat_2." ".$tiv."\n";
$ctext_n.=getMessage("d_eat_2")." - ".$cena_n_eat_2." ".$tnv."\n";
}
*/
/*
$cena_tour_1=0;  //стоимость Участие в экскурсии 1
$cena_n_tour_1=0;  //стоимость Участие в экскурсии 1 в нац валюте
if(fGetResultValues("tour_1")==fGetValue("tour_1",0)) {
$cena_tour_1=round($arc_tour_1[$cage]*$k_dt*$k_mp,2); 
$cena_n_tour_1=round($arc_tour_1[$cage]*$kp*$k_dt*$k_mp,2);
$ctext.=getMessage("tour_1")." - ".$cena_tour_1." ".$tiv."\n";
$ctext_n.=getMessage("tour_1")." - ".$cena_n_tour_1." ".$tnv."\n";
}

$cena_tour_2=0;  //стоимость Участие в экскурсии 2
$cena_n_tour_2=0;  //стоимость Участие в экскурсии 2 в нац валюте
if(fGetResultValues("tour_2")==fGetValue("tour_2",0)) {
$cena_tour_2=round($arc_tour_2[$cage]*$k_dt*$k_mp,2); 
$cena_n_tour_2=round($arc_tour_2[$cage]*$kp*$k_dt*$k_mp,2);
$ctext.=getMessage("tour_2")." - ".$cena_tour_2." ".$tiv."\n";
$ctext_n.=getMessage("tour_2")." - ".$cena_n_tour_2." ".$tnv."\n";
}

$cena_tour_3=0;  //стоимость Участие в экскурсии 3
$cena_n_tour_3=0;  //стоимость Участие в экскурсии 3 в нац валюте
if(fGetResultValues("tour_3")==fGetValue("tour_3",0)) {
$cena_tour_3=round($arc_tour_3[$cage]*$k_dt*$k_mp,2); 
$cena_n_tour_3=round($arc_tour_3[$cage]*$kp*$k_dt*$k_mp,2);
$ctext.=getMessage("tour_3")." - ".$cena_tour_3." ".$tiv."\n";
$ctext_n.=getMessage("tour_3")." - ".$cena_n_tour_3." ".$tnv."\n";
}
*/

$cena_futb=0;  //стоимость Футболки
$cena_n_futb=0;  //стоимость Футболки в нац валюте

if(fGetResultValues("d_futbolka")) {
$cena_futb=round($arc_fut[$cage]*$k_dt*$k_mp,2); 
$cena_n_futb=round($arc_fut[$cage]*$kp*$k_dt*$k_mp,2);
$ctext.=getMessage("d_futbolka")." - ".$cena_futb." ".$tiv."\n";
$ctext_n.=getMessage("d_futbolka")." - ".$cena_n_futb." ".$tnv."\n";
}


$cena_insurance=0;  //стоимость Страховки
$cena_n_insurance=0;  //стоимость Страховки в нац валюте
/*
// выбран перелёт
if(fGetResultValues("p_fly")==fGetValue("p_fly",0)) {
	if($cfly_1==0 || $cfly_2==0)  // для варианта перелёта 1
	{
	$cena_insurance=$insurance_fly_1;
	$cena_n_insurance=$insurance_fly_1*$kp;
	}
	if($cfly_1==1 || $cfly_2==1)  // для варианта перелёта 2
	{
	$cena_insurance=$insurance_fly_2;
	$cena_n_insurance=$insurance_fly_2*$kp;
	}
if($cfly_1==2 || $cfly_2==2)  // для варианта перелёта 3
	{
	$cena_insurance=$insurance_fly_1;
	$cena_n_insurance=$insurance_fly_1*$kp;
	}
if($cfly_1==3 || $cfly_2==3)  // для варианта перелёта 4
	{
	$cena_insurance=$insurance_fly_2;
	$cena_n_insurance=$insurance_fly_2*$kp;
	}
}
// не выбран перелёт, выбрано проживание
if(fGetResultValues("p_fly")<>fGetValue("p_fly",0) && fGetResultValues("p_hotel")==fGetValue("p_hotel",0)) {

	$cena_insurance=$insurance_dey*$dif;
	$cena_n_insurance=$insurance_dey*$dif*$kp;
}
$ctext.=getMessage('INSURANCE')." - ".$cena_insurance." ".$tiv."\n";
$ctext_n.=getMessage('INSURANCE')." - ".$cena_n_insurance." ".$tnv."\n";
*/



/*
$cena_mesto=0;  //стоимость Места на форуме
$cena_n_mesto=0;  //стоимость Места на форуме в нац валюте
$cena_mesto=round($arc_mesto[$i_mesto]*$k_dt*$k_mp,2); 
$cena_n_mesto=round($arc_mesto[$i_mesto]*$kp*$k_dt*$k_mp,2);
$ctext.=getMessage("d_konf")." - ".$cena_mesto." ".$tiv."\n";
$ctext_n.=getMessage("d_konf")." - ".$cena_n_mesto." ".$tnv."\n";
*/

/////////////////////////// Leader Ship ////////////////////////////////////////////////////
/*
if($ka_lsh || $so_lsh) {

$cd_leader_ship=1; // ключ привязки к участию в Leader Ship
if($ka_lsh) {
	if(fGetResultValues("d_leader_ship")==fGetValue("d_leader_ship",0)) $cd_leader_ship=0;
	if(fGetResultValues("d_leader_ship")==fGetValue("d_leader_ship",1)) $cd_leader_ship=1;
}

$cs_leader_ship=1; // ключ привязки к соучастию в Leader Ship
if($so_lsh) {
	if(fGetResultValues("s_leader_ship")==fGetValue("s_leader_ship",0)) $cs_leader_ship=0;
	if(fGetResultValues("s_leader_ship")==fGetValue("s_leader_ship",1)) $cs_leader_ship=1;
}

$chotel_ls=''; // ключ привязки к отелю для Leader Ship
if(fGetResultValues("hotel_ls")==fGetValue("hotel_ls",0)) $chotel_ls=0;
if(fGetResultValues("hotel_ls")==fGetValue("hotel_ls",1)) $chotel_ls=1;
if(fGetResultValues("hotel_ls")==fGetValue("hotel_ls",2)) $chotel_ls=2;
if(fGetResultValues("hotel_ls")==fGetValue("hotel_ls",3)) $chotel_ls=3;

$cnomer_ls=''; // ключ привязки к номеру для Leader Ship
if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",0)) $cnomer_ls=0;
if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",1)) $cnomer_ls=1;
if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",2)) $cnomer_ls=2;
if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",3)) $cnomer_ls=3;
if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",4)) $cnomer_ls=4;
if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",5)) $cnomer_ls=5;
if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",6)) $cnomer_ls=6;
if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",7)) $cnomer_ls=7;
if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",8)) $cnomer_ls=8;
if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",9)) $cnomer_ls=9;
if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",10)) $cnomer_ls=10;

	$date1_2 = fGetResultValues("day_hotel_start_ls"); // начало проживания для Leader Ship
	$date2_2 = fGetResultValues("day_hotel_finish_ls"); // окончание проживания для Leader Ship
	$arr1_2 = explode('.', $date1_2);
	$arr2_2 = explode('.', $date2_2);
	$time1_2 = mktime(0,0,0,$arr1_2[1],$arr1_2[0],$arr1_2[2]);
	$time2_2 = mktime(0,0,0,$arr2_2[1],$arr2_2[0],$arr2_2[2]);
	$dif_2 = ($time2_2 - $time1_2) / 86400;                   // кол-во дней проживания для Leader Ship

$ctext.="\n***** Leadership *****\n";
$ctext_n.="\n***** Leadership *****\n";
	
if(!$cd_leader_ship || !$cs_leader_ship) { //выбор варианта для участия в Leader Ship
	$cena_hotel_ls=0;  //стоимость Проживания для Leader Ship
	$cena_n_hotel_ls=0;  //стоимость Проживания в нац валюте для Leader Ship
	
	$cena_hotel_ls=round($arc_nom_ls[$chotel_ls][$cnomer_ls][$cage]*$dif_2*$k_dt*$k_mp,2); 
	$cena_n_hotel_ls=round($arc_nom_ls[$chotel_ls][$cnomer_ls][$cage]*$kp*$dif_2*$k_dt*$k_mp,2);
	$ctext.=getMessage("hotel_ls")." & ".getMessage("nomer_ls")." - ".$cena_hotel_ls." ".$tiv."\n".$date1_2." - ".$date2_2." = ".getMessage("DIF")." ".$dif_2."\n";
	$ctext_n.=getMessage("hotel_ls")." & ".getMessage("nomer_ls")." - ".$cena_n_hotel_ls." ".$tnv."\n".$date1_2." - ".$date2_2." = ".getMessage("DIF")." ".$dif_2."\n";
	}

	
$ctext.="***** ************** *****\n";
$ctext_n.="***** ************** *****\n";	
}
*/
////////////////////////////////////////////////////////////////////////////////////////////////
$cena_insurance=0; //стоимость Медицинской страховки
$cena_n_insurance=0; //стоимость Медицинской страховки в нац валюте 
if(fGetResultValues("medical_insurance")==fGetValue("medical_insurance",0)) {
	$cena_insurance=$insurance_dey*($dif+$dif_2+1);
	$cena_n_insurance=$insurance_dey*($dif+$dif_2+1)*$kp;
	$ctext.=getMessage("medical_insurance")." - ".$cena_insurance." ".$tiv."\n";
	$ctext_n.=getMessage("medical_insurance")." - ".$cena_n_insurance." ".$tnv."\n";
	}


$mi=$minus;                 // скидка от общей суммы в у.е. 
$mi_n=round($kp*$minus,2);  // скидка от общей суммы в нац.валюте
$pl=$plus;                   //наценка к общей сумме в у.е. 
$pl_n=round($kp*$plus,2);  //наценка к общей сумме в нац.валюте 
if($mi) {
$ctext.="\n".getMessage("minus")." - ".$mi." ".$tiv."\n";
$ctext_n.="\n".getMessage("minus")." - ".$mi_n." ".$tnv."\n";
}
if($pl) {
$ctext.=getMessage("plus")." - ".$pl." ".$tiv."\n";
$ctext_n.=getMessage("plus")." - ".$pl_n." ".$tnv."\n";
}

$r_l="______________________"."\n";    // разделитель

$ctext.=$r_l;
$ctext_n.=$r_l;

	if($edit_z) {
		// Итоговая стоимость при редактировании заявки
		
		$cena_e=$cena_viza+$cena_fly_1+$cena_fly_2+$cena_fly+$cena_tran+$cena_hotel+$cena_konf+$cena_ujin+$cena_eat_1+$cena_eat_2+$cena_tour_1+$cena_tour_2+$cena_tour_3+$cena_futb+$cena_insurance+$cena_mesto-$mi+$pl+$cena_guest_card+$cena_hotel_ls;
		//$cena_n=$cena_n_viza+$cena_n_fly_1+$cena_n_fly_2+$cena_n_tran+$cena_n_hotel+$cena_n_konf+$cena_n_ujin+$cena_n_eat_1+$cena_n_eat_2+$cena_n_tour_1+$cena_n_tour_2+$cena_n_tour_3+$cena_n_futb+$cena_n_insurance+$cena_n_mesto-$mi_n+$pl_n+$cena_n_guest_card+$cena_n_hotel_ls;
		
		////////Это надо убрать, когда будет включён калькулятор///////////////////
		/*
		if(fGetResultValues("p_fly")==fGetValue("p_fly",0)) $cena_e=950;
		else $cena_e=540;
		*/
		///////////////////////////////////////////////////////////////////////////
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
		
		////////Это надо убрать, когда будет включён калькулятор///////////////////
		/*
		$ctext=GetMessage('K_OPLATE')." - ".($cena_e-fGetResultValues("t_money"))." ".$tiv."\n";
		$ctext_n=GetMessage('K_OPLATE')." - ".($cena_n-fGetResultValues("t_money_2"))." ".$tnv."\n";
		*/
		///////////////////////////////////////////////////////////////////////////
	}
	else {

		// Итоговая стоимость при регистрации заявки
		$cena_e=$cena_viza+$cena_fly_1+$cena_fly_2+$cena_fly+$cena_tran+$cena_hotel+$cena_konf+$cena_ujin+$cena_eat_1+$cena_eat_2+$cena_tour_1+$cena_tour_2+$cena_tour_3+$cena_futb+$cena_insurance+$cena_mesto-$mi+$pl+$cena_guest_card+$cena_hotel_ls;
		$cena_n=$cena_n_viza+$cena_n_fly_1+$cena_n_fly_2+$cena_n_fly+$cena_n_tran+$cena_n_hotel+$cena_n_konf+$cena_n_ujin+$cena_n_eat_1+$cena_n_eat_2+$cena_n_tour_1+$cena_n_tour_2+$cena_n_tour_3+$cena_n_futb+$cena_n_insurance+$cena_n_mesto-$mi_n+$pl_n+$cena_n_guest_card+$cena_n_hotel_ls;

		
		
		$ctext.=getMessage('K_OPLATE')." - ".$cena_e." ".$tiv."\n";
		$ctext_n.=getMessage('K_OPLATE')." - ".$cena_n." ".$tnv."\n";
		
		////////Это надо убрать, когда будет включён калькулятор///////////////////
		/*
		if(fGetResultValues("p_fly")==fGetValue("p_fly",0)) $cena_e=950;
		else $cena_e=540;
		$cena_n=$cena_e*$kp;
		$ctext=getMessage('K_OPLATE')." - ".$cena_e." ".$tiv."\n";
		$ctext_n=getMessage('K_OPLATE')." - ".$cena_n." ".$tnv."\n";
		*/
		////////////////////////////////////////////////////////////////////////////

	}
?>