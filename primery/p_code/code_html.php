&lt;?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?&gt;
&lt;?global $t_step; // Шаг регистрации?&gt;
&lt;? include "var_config.php"; // Конфигурация мероприятия?&gt;
&lt;? include "functions.php";  // Функции PHP?&gt;


&lt;? include "header_form.php"; // Шапка формы ?&gt;
&lt;? include "note_error.php"; // Ошибки заполнения ?&gt;
&lt;?
global $APPLICATION, $USER, $CCIExternalAuth;

/*$oWS = new CCI_PDPWS();
// ОПРЕДЕЛЯЕМ СЕССИЮ
$iDSesison = $APPLICATION-&gt;get_cookie("BX_AUTH_SESSION_ID");
if(empty($iDSesison)) {$iDSesison = $USER-&gt;GetLogin();};
if(empty($iDSesison)) {$iDSesison = "SOS";}
*/
?&gt;

&lt;script src="/js/chosen/chosen.jquery.min.js" type="text/javascript"&gt;&lt;/script&gt;
&lt;link rel="stylesheet" href="/js/chosen/chosen.css" /&gt;

&lt;?
// переменные для проверки ЧК и гостей ЧК

// Входящие данные для проверки участника  /////////////
$p_chk=$_POST[fGetName("chk")];  // № ЧК
$p_family=$_POST[fGetName("family")]; // фамилия
$p_name=$_POST[fGetName("name")];  // имя
$p_kem_priglashen_chk=$_POST[fGetName("kem_priglashen_chk")]; // Кем приглашён № ЧК
$p_kem_priglashen_family=$_POST[fGetName("kem_priglashen_family")]; // Кем приглашён фамилия
$p_kem_priglashen_name=$_POST[fGetName("kem_priglashen_name")]; // Кем приглашён имя
$p_status=$_POST[fGetName("status")];   // статус участника
$id_venue=$_POST[fGetName("id_venue")];   // id площадки

$a_status[0]=fGetValue("status",0);
$a_status[1]=fGetValue("status",1);
$a_status[2]=fGetValue("status",2);

//include "filter_chk.php"; // Подключаем проверки ЧК и гостей ЧК
include "methods/CheckPerson.php"; //Подключение CheckPerson
include "methods/filter_chk.php"; // Подключаем проверки ЧК и гостей ЧК

//include "methods/CheckPerson.php"; //Подключение CheckPerson
//include "methods/filter_chk.php"; // Подключаем проверки ЧК и гостей ЧК
/*
echo "Проверка на существование ЧК: ";
print_r (Person_check(array(  //Если положительный - true иначе false
        'SummitId' =&gt; "303",
		'QuestionId' =&gt; 0, //ИД ВОПРОСА
		'PersonId' =&gt; "4203777",
		'PersonFirstName' =&gt; "Евгений",
		'PersonLastName' =&gt; "Попков"
		)));

*/

?&gt;

&lt;?if($erk) : // Если проверки не пройдены /// ?&gt; 
&lt;div class="dicer"&gt;
&lt;?
$fu=0;   
foreach($errors as $key=&gt;$val) {
		echo "&lt;div class='mess_rey'&gt;&lt;div class='luch'&gt;&lt;/div&gt;&lt;div&gt;".ft('GER_TIT_2')."&lt;/div&gt;".$val; // Текст ошибки
		if($key=="MEMBER" and count($errors) == 1) $fu=1;                // Разрешить регистрацию даже, если не пройдено условие участия
		else echo "&lt;br&gt;&lt;br&gt; &lt;a href='step_1.php?pravila=1'&gt;".ft('GER_VER')."&lt;/a&gt;"; // Ссылка "Вернуться"
		echo "&lt;/div&gt;";
	}
?&gt;
&lt;/div&gt;
&lt;?endif;?&gt;

&lt;?if($ignor_filter_chk) $fu=1; // Игнорировать проверку участника?&gt;

&lt;?if($fu) {  // Регистрация доступна ?&gt;

&lt;div id="ti_form"&gt;
&lt;form action="&lt;?=$dir_event?&gt;step_3.php" method="POST" onsubmit="return sub_form()"&gt;
&lt;input type="hidden" name="forpa" value="1"&gt;

&lt;table id="cont_t"&gt;

&lt;tr valign="top"&gt;

&lt;td&gt;

&lt;div  class="right_b"&gt;



&lt;div class="title_step"&gt;
&lt;div id="title_step2"&gt;&nbsp;&nbsp;&lt;?=ft('TITLE_STEP2')?&gt; &nbsp;&lt;?=ft('TITLE_PR2')?&gt;&lt;/div&gt;

&lt;/div&gt;
&lt;div id="tr"&gt;&lt;/div&gt;


&lt;div class="form-required"&gt;
&lt;?if ($arResult["isFormErrors"] == "Y"):?&gt;&lt;?=$arResult["FORM_ERRORS_TEXT"];?&gt;&lt;?endif;?&gt;


&lt;?=$arResult["FORM_NOTE"]?&gt;
&lt;/div&gt;




&lt;?if ($_POST[fGetName("status")]==fGetValue("status",0)):?&gt;
&lt;input id="hiscer" type="hidden" value="0"&gt;
&lt;div class="tipetu"&gt;&lt;span class="tpt"&gt;&lt;?=ft("status");?&gt;:&lt;/span&gt; &lt;span class="npt"&gt;&lt;?=ft("status_0");?&gt;&lt;/span&gt;&lt;/div&gt;
&lt;div class="tipetu"&gt;&lt;span class="tpt"&gt;&lt;?=ft("chk");?&gt;:&lt;/span&gt; &lt;span class="npt"&gt;&lt;?=$_POST[fGetName("chk")]?&gt; - &lt;?=$_POST[fGetName("family")]?&gt; &lt;?=$_POST[fGetName("name")]?&gt;&lt;/span&gt;&lt;/div&gt;
&lt;?endif?&gt;
&lt;?if ($_POST[fGetName("status")]==fGetValue("status",1)):?&gt;
&lt;input id="hiscer" type="hidden" value="1"&gt;
&lt;div class="tipetu"&gt;&lt;span class="tpt"&gt;&lt;?=ft("status");?&gt;:&lt;/span&gt; &lt;span class="npt"&gt;&lt;?=ft("status_1");?&gt;&lt;/span&gt;&lt;/div&gt;
&lt;div class="tipetu"&gt;&lt;span class="tpt"&gt;&lt;?=ft("kem_priglashen_chk");?&gt;:&lt;/span&gt; &lt;span class="npt"&gt;&lt;?=$_POST[fGetName("kem_priglashen_chk")]?&gt; - &lt;?=$_POST[fGetName("kem_priglashen_family")]?&gt; &lt;?=$_POST[fGetName("kem_priglashen_name")]?&gt;&lt;/span&gt;&lt;/div&gt;
&lt;?endif?&gt;
&lt;?if ($_POST[fGetName("status")]==fGetValue("status",2)):?&gt;
&lt;input id="hiscer" type="hidden" value="2"&gt;
&lt;div class="tipetu"&gt;&lt;span class="tpt"&gt;&lt;?=ft("status");?&gt;:&lt;/span&gt; &lt;span class="npt"&gt;&lt;?=ft("status_2");?&gt;&lt;/span&gt;&lt;/div&gt;
&lt;div class="tipetu"&gt;&lt;span class="tpt"&gt;&lt;?=ft("kem_priglashen_chk");?&gt;:&lt;/span&gt; &lt;span class="npt"&gt;&lt;?=$_POST[fGetName("kem_priglashen_chk")]?&gt; - &lt;?=$_POST[fGetName("kem_priglashen_family")]?&gt; &lt;?=$_POST[fGetName("kem_priglashen_name")]?&gt;&lt;/span&gt;&lt;/div&gt;
&lt;?$spl_chk=$_POST[fGetName("kem_priglashen_chk")]; $spl_family=$_POST[fGetName("kem_priglashen_family")]; $spl_name=$_POST[fGetName("kem_priglashen_name")];?&gt;
&lt;?endif?&gt;


&lt;!-- Скрытые поля  --&gt;
&lt;div class="nevid"&gt;

&lt;!--  Шаг регистрации  --&gt;
&lt;input id="t_step" name="&lt;?=fGetName("step",0)?&gt;" value="&lt;?=$t_step?&gt;"  type="text"&gt;

&lt;!--  Java  --&gt;
&lt;input name="&lt;?=fGetName("java")?&gt;" value="&lt;?=fGetValue("java",0)?&gt;" type="radio" &lt;?if($_POST[fGetName("java")]==fGetValue("java",0)) echo "checked";?&gt; &gt;
&lt;input name="&lt;?=fGetName("java")?&gt;" value="&lt;?=fGetValue("java",1)?&gt;" type="radio" &lt;?if($_POST[fGetName("java")]==fGetValue("java",1)) echo "checked";?&gt; &gt;

&lt;!--  Площадка  --&gt;
&lt;input  name="&lt;?=fGetName("venue",0)?&gt;" value="&lt;?=$_POST[fGetName("venue")]?&gt;"  type="text"&gt;
&lt;!--  ID площадки  --&gt;
&lt;input  name="&lt;?=fGetName("id_venue",0)?&gt;" value="&lt;?=$_POST[fGetName("id_venue")]?&gt;"  type="text"&gt;

&lt;!--  Статус  --&gt;
&lt;input name="&lt;?=fGetName("status")?&gt;" value="&lt;?=fGetValue("status",0)?&gt;" type="radio" &lt;?if($_POST[fGetName("status")]==fGetValue("status",0)) echo "checked";?&gt; &gt;
&lt;input name="&lt;?=fGetName("status")?&gt;" value="&lt;?=fGetValue("status",1)?&gt;" type="radio" &lt;?if($_POST[fGetName("status")]==fGetValue("status",1)) echo "checked";?&gt; &gt;
&lt;input name="&lt;?=fGetName("status")?&gt;" value="&lt;?=fGetValue("status",2)?&gt;" type="radio" &lt;?if($_POST[fGetName("status")]==fGetValue("status",2)) echo "checked";?&gt; &gt;


&lt;!--  Кем приглашен № ЧК  --&gt;
&lt;input  name="&lt;?=fGetName("kem_priglashen_chk",0)?&gt;" value="&lt;?=$_POST[fGetName("kem_priglashen_chk")]?&gt;"  type="text"&gt;
&lt;!--  Кем приглашен имя  --&gt;
&lt;input  name="&lt;?=fGetName("kem_priglashen_name",0)?&gt;" value="&lt;?=$_POST[fGetName("kem_priglashen_name")]?&gt;"  type="text"&gt;
&lt;!--  Кем приглашен фамилия  --&gt;
&lt;input  name="&lt;?=fGetName("kem_priglashen_family",0)?&gt;" value="&lt;?=$_POST[fGetName("kem_priglashen_family")]?&gt;"  type="text"&gt;
&lt;!--  № ЧК  --&gt;
&lt;input  name="&lt;?=fGetName("chk",0)?&gt;" value="&lt;?=$_POST[fGetName("chk")]?&gt;"  type="text"&gt;
&lt;!--  Имя  --&gt;
&lt;input  name="&lt;?=fGetName("name",0)?&gt;" value="&lt;?=$_POST[fGetName("name")]?&gt;"  type="text"&gt;
&lt;!--  Фамилия  --&gt;
&lt;input  name="&lt;?=fGetName("family",0)?&gt;" value="&lt;?=$_POST[fGetName("family")]?&gt;"  type="text"&gt;
&lt;!--  промоушен приглашение  --&gt;
&lt;input  name="&lt;?=fGetName("promotion_1",0)?&gt;" value="&lt;?=$promotion_1?&gt;"  type="text"&gt;
&lt;!--  промоушен гала-ужин  --&gt;
&lt;input  name="&lt;?=fGetName("promotion_2",0)?&gt;" value="&lt;?=$promotion_2?&gt;"  type="text"&gt;
&lt;!--промоушн оплата --&gt;
&lt;input id="promotion_3" name="&lt;?=fGetName("promotion_3")?&gt;" value="&lt;?=$promotion_3?&gt;"&gt;
&lt;!--ID вылюты заявки --&gt;
&lt;input id="currency_id" name="&lt;?=fGetName("currency_id",0)?&gt;" value=""&gt;
&lt;!--Вылюта заявки --&gt;
&lt;input id="currency" name="&lt;?=fGetName("currency",0)?&gt;" value=""&gt;

&lt;!--  	e-mail из БД  --&gt;
&lt;input  name="&lt;?=fGetName("em_bd",0)?&gt;" value="&lt;?=$email?&gt;"  type="text"&gt;
&lt;!--  	Дата рождения из БД  --&gt;
&lt;input  name="&lt;?=fGetName("dr_bd",0)?&gt;" value=""  type="text"&gt;
&lt;!--  	Проверка пройдена  --&gt;
&lt;input  name="&lt;?=fGetName("proverka",0)?&gt;" value="&lt;?=date("d.m.Y H:i:s")." ".$_SESSION["f_lang"]?&gt;"  type="text"&gt;

&lt;/div&gt;


&lt;!--  Отчество  --&gt;
&lt;?if(fGetActive("middle_name")):?&gt;
&lt;div class="ti_blo" id="ti_blo_middle_name"&gt;
	 &lt;div class="ti_dig"&gt;&lt;div class="tiqa"&gt;&lt;?=ft("middle_name")?&gt;&lt;/div&gt;&lt;input id="" name="&lt;?=fGetName("middle_name")?&gt;" value="&lt;?=$_SESSION["passport_member"]["middle_name"]?&gt;" class="" type="text"&gt;&lt;/div&gt;
&lt;?if(fGetComments("middle_name")):?&gt;&lt;div class="qm"&gt;&lt;div class="qm_text"&gt;&lt;?=ft("middle_name_comment")?&gt;&lt;/div&gt;&lt;/div&gt;
&lt;?endif?&gt;
&lt;/div&gt;
&lt;?endif?&gt;

&lt;div id="pvs"&gt;
&lt;!--  E-mail  --&gt;
&lt;?if(fGetActive("email")):?&gt;
&lt;div class="ti_blo" id="ti_blo_email"&gt;
	 &lt;div class="ti_dig"&gt;&lt;div class="tiqa"&gt;&lt;?=ft("email")?&gt;&lt;span class="zred"&gt; *&lt;/span&gt;&lt;/div&gt;&lt;input id="" name="&lt;?=fGetName("email")?&gt;" value="&lt;?=$_SESSION["passport_member"]["email"]?&gt;" class="" type="text"&gt;&lt;/div&gt;
&lt;?if(fGetComments("email")):?&gt;&lt;div class="qm"&gt;&lt;div class="qm_text"&gt;&lt;?=ft("email_comment")?&gt;&lt;/div&gt;&lt;/div&gt;&lt;?endif?&gt;
&lt;div class="ti_dil"&gt;&lt;input id="pr0" class="" name="&lt;?=fGetName("prioritet")?&gt;" value="&lt;?=fGetValue("prioritet",0)?&gt;" type="radio" onchange="sub_but()" &lt;?if(fGetAnswerCode("prioritet",0)==$_SESSION["passport_member"]["prioritet"]) echo "checked"?&gt;&gt; &lt;label for="pr0"&gt;&lt;?=ft("prioritet");?&gt;&lt;/label&gt;&lt;/div&gt; 
&lt;/div&gt;
&lt;?endif?&gt;

&lt;!--  Телефон  --&gt;
&lt;?if(fGetActive("tel")):?&gt;
&lt;div class="ti_blo" id="ti_blo_tel"&gt;
	 &lt;div class="ti_dig"&gt;&lt;div class="tiqa"&gt;&lt;?=ft("tel")?&gt;&lt;span class="zred"&gt; *&lt;/span&gt;&lt;/div&gt;&lt;input id="" name="&lt;?=fGetName("tel")?&gt;" value="&lt;?=$_SESSION["passport_member"]["tel"]?&gt;" class="" type="text"&gt;&lt;/div&gt;
&lt;?if(fGetComments("tel")):?&gt;&lt;div class="qm"&gt;&lt;div class="qm_text"&gt;&lt;?=ft("tel_comment")?&gt;&lt;/div&gt;&lt;/div&gt;&lt;?endif?&gt;
&lt;div class="ti_dil"&gt;&lt;input id="pr1" class="" name="&lt;?=fGetName("prioritet")?&gt;" value="&lt;?=fGetValue("prioritet",1)?&gt;" type="radio" onchange="sub_but()" &lt;?if(fGetAnswerCode("prioritet",1)==$_SESSION["passport_member"]["prioritet"] || !$_SESSION["passport_member"]["prioritet"]) echo "checked"?&gt;&gt; &lt;label for="pr1"&gt;&lt;?=ft("prioritet");?&gt;&lt;/label&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;?endif?&gt;

&lt;!--  Скайп  --&gt;
&lt;?if(fGetActive("skype")):?&gt;
&lt;div class="ti_blo" id="ti_blo_skype"&gt;
	 &lt;div class="ti_dig"&gt;&lt;div class="tiqa"&gt;&lt;?=ft("skype")?&gt;&lt;/div&gt;&lt;input id="" name="&lt;?=fGetName("skype")?&gt;" value="&lt;?=$_SESSION["passport_member"]["skype"]?&gt;" class="" type="text"&gt;&lt;/div&gt;
&lt;?if(fGetComments("skype")):?&gt;&lt;div class="qm"&gt;&lt;div class="qm_text"&gt;&lt;?=ft("skype_comment")?&gt;&lt;/div&gt;&lt;/div&gt;&lt;?endif?&gt;
&lt;div class="ti_dil"&gt;&lt;input id="pr2" class="" name="&lt;?=fGetName("prioritet")?&gt;" value="&lt;?=fGetValue("prioritet",2)?&gt;" type="radio" onchange="sub_but()" &lt;?if(fGetAnswerCode("prioritet",2)==$_SESSION["passport_member"]["prioritet"]) echo "checked"?&gt;&gt; &lt;label for="pr2"&gt;&lt;?=ft("prioritet");?&gt;&lt;/label&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;?endif?&gt;

&lt;!--  Доп. e-mail  --&gt;
&lt;?if(fGetActive("email_2")):?&gt;
&lt;div class="ti_blo" id="ti_blo_email_2"&gt;
	 &lt;div class="ti_dig"&gt;&lt;div class="tiqa"&gt;&lt;?=ft("email_2")?&gt;&lt;/div&gt;&lt;input id="" name="&lt;?=fGetName("email_2")?&gt;" value="&lt;?=$_SESSION["passport_member"]["email_2"]?&gt;" class="" type="text"&gt;&lt;/div&gt;
&lt;?if(fGetComments("email_2")):?&gt;&lt;div class="qm"&gt;&lt;div class="qm_text"&gt;&lt;?=ft("email_2_comment")?&gt;&lt;/div&gt;&lt;/div&gt;&lt;?endif?&gt;
&lt;/div&gt;
&lt;?endif?&gt;

&lt;!--  Доп. телефон  --&gt;
&lt;?if(fGetActive("tel_2")):?&gt;
&lt;div class="ti_blo" id="ti_blo_tel_2"&gt;
	 &lt;div class="ti_dig"&gt;&lt;div class="tiqa"&gt;&lt;?=ft("tel_2")?&gt;&lt;span class="zred"&gt; *&lt;/span&gt;&lt;/div&gt;&lt;input id="" name="&lt;?=fGetName("tel_2")?&gt;" value="&lt;?=$_SESSION["passport_member"]["tel_2"]?&gt;" class="" type="text"&gt;&lt;/div&gt;
&lt;?if(fGetComments("tel_2")):?&gt;&lt;div class="qm"&gt;&lt;div class="qm_text"&gt;&lt;?=ft("tel_2_comment")?&gt;&lt;/div&gt;&lt;/div&gt;&lt;?endif?&gt;
&lt;/div&gt;
&lt;?endif?&gt;
&lt;/div&gt;

&lt;!--  Пол  --&gt;
&lt;?if(fGetActive("sex")):?&gt;
&lt;div class="ti_blo" id="ti_blo_sex"&gt;


&lt;div class="ti_dig"&gt;

&lt;div class="tiqa"&gt; &lt;?=ft("sex")?&gt;&lt;span class="zred"&gt; *&lt;/span&gt;&lt;/div&gt;

&lt;div class="vsta"&gt;

	&lt;div class="ti_dis" id="sx_0"&gt;&lt;input name="&lt;?=fGetName("sex")?&gt;" value="&lt;?=fGetValue("sex",0)?&gt;" class="" id="sx0" type="radio" &lt;?if(fGetAnswerCode("sex",0)==$_SESSION["passport_member"]["sex"]) echo "checked"?&gt;&gt;&lt;label for="sx0"&gt; &lt;?=ft("sex_0");?&gt;&lt;/label&gt;&lt;/div&gt;

	&lt;div class="ti_dis" id="sx_1"&gt;&lt;input name="&lt;?=fGetName("sex")?&gt;" value="&lt;?=fGetValue("sex",1)?&gt;" class="" id="sx1" type="radio" &lt;?if(fGetAnswerCode("sex",1)==$_SESSION["passport_member"]["sex"]) echo "checked"?&gt;&gt;&lt;label for="sx1"&gt; &lt;?=ft("sex_1");?&gt;&lt;/label&gt;&lt;/div&gt;

&lt;/div&gt;


&lt;/div&gt;
&lt;?if(fGetComments("sex")):?&gt;&lt;div class="qm"&gt;&lt;div class="qm_text"&gt;&lt;?=ft("sex_comment")?&gt;&lt;/div&gt;&lt;/div&gt;&lt;?endif?&gt;
&lt;/div&gt;
&lt;?endif?&gt;



&lt;!--  Дата рождения  --&gt;
&lt;?$ar_birthday_s=explode(".",$_SESSION["passport_member"]["birthday"]);// Разбиение даты рождения из паспорта участника на составляющие?&gt;
&lt;?if(fGetActive("birthday")):?&gt;
&lt;div class="ti_blo" id="ti_blo_birthday"&gt;
	 &lt;div class="ti_dig"&gt;&lt;div class="tiqa"&gt;&lt;?=ft("birthday")?&gt;&lt;span class="zred"&gt; *&lt;/span&gt;&lt;/div&gt;
	 &lt;input id="date_b" name="&lt;?=fGetName("birthday")?&gt;" value="&lt;?=fGetValue("birthday")?&gt;" style="display:none;" type="text" readonly&gt;
	 &lt;div class="vida" id="vida"&gt; 
&lt;?=ft("number")?&gt;
&lt;select id="b_d_birthday" class="b_d"&gt;
&lt;option value=''&gt;---&lt;/option&gt;
&lt;?
for($i=1;$i&lt;=31;$i++){
echo "&lt;option value='".$i."'";
if((int)$ar_birthday_s[0]==$i) echo " selected";
echo "&gt;".$i."&lt;/option&gt;";
}
?&gt;
&lt;/select&gt;

&lt;?=ft("month")?&gt;
&lt;select id="b_m_birthday" class="b_m"&gt;
&lt;option value=''&gt;---&lt;/option&gt;
&lt;?
$ar_month=array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
for($i=0;$i&lt;12;$i++){
$to=ft($ar_month[$i]);
echo "&lt;option value='".($i+1)."'";
if((int)$ar_birthday_s[1]==($i+1)) echo " selected";
echo "&gt;".$to."&lt;/option&gt;";
}
?&gt;
&lt;/select&gt;


&lt;?=ft("year")?&gt;
&lt;select id="b_y_birthday" class="b_y"&gt;
&lt;option value=''&gt;---&lt;/option&gt;
&lt;?
for($i=1915;$i&lt;=2015;$i++){
echo "&lt;option value='".$i."'";
if((int)$ar_birthday_s[2]==$i) echo " selected";
echo "&gt;".$i."&lt;/option&gt;";
}
?&gt;
&lt;/select&gt;
&lt;!--&lt;div class="but_vida" onclick="f_vida()"&gt;выбрать&lt;/div&gt;--&gt;
&lt;/div&gt;
	 &lt;/div&gt;
&lt;?if(fGetComments("birthday")):?&gt;&lt;div class="qm"&gt;&lt;div class="qm_text"&gt;&lt;?=ft("birthday_comment")?&gt;&lt;/div&gt;&lt;/div&gt;&lt;?endif?&gt;
&lt;/div&gt;


&lt;?endif?&gt;

&lt;!--  Возраст  --&gt;

&lt;?if(fGetActive("age")):?&gt;
&lt;div class="ti_blo" id="ti_blo_age" style="display:none;"&gt;


&lt;div class="ti_dig"&gt;

&lt;div class="tiqa"&gt; &lt;?=ft("age")?&gt;&lt;span class="zred"&gt; *&lt;/span&gt;&lt;/div&gt;

&lt;div class="vsta"&gt;

	&lt;div class="ti_dis" id="ag_0"&gt;&lt;input name="&lt;?=fGetName("age")?&gt;" value="&lt;?=fGetValue("age",0)?&gt;" answercode="&lt;?=fGetAnswerCode("age",0)?&gt;" class="" id="ag0" type="radio"&gt;&lt;label for="ag0"&gt; &lt;?=ft("age_0");?&gt;&lt;/label&gt;&lt;/div&gt;

	&lt;div class="ti_dis" id="ag_1"&gt;&lt;input name="&lt;?=fGetName("age")?&gt;" value="&lt;?=fGetValue("age",1)?&gt;" answercode="&lt;?=fGetAnswerCode("age",1)?&gt;" class="" id="ag1" type="radio"&gt;&lt;label for="ag1"&gt; &lt;?=ft("age_1");?&gt;&lt;/label&gt;&lt;/div&gt;

	&lt;div class="ti_dis" id="ag_2"&gt;&lt;input name="&lt;?=fGetName("age")?&gt;" value="&lt;?=fGetValue("age",2)?&gt;" answercode="&lt;?=fGetAnswerCode("age",2)?&gt;" class="" id="ag2" type="radio"&gt;&lt;label for="ag2"&gt; &lt;?=ft("age_2");?&gt;&lt;/label&gt;&lt;/div&gt;

	&lt;div class="ti_dis" id="ag_3"&gt;&lt;input name="&lt;?=fGetName("age")?&gt;" value="&lt;?=fGetValue("age",3)?&gt;" answercode="&lt;?=fGetAnswerCode("age",3)?&gt;" class="" id="ag3" type="radio"&gt;&lt;label for="ag3"&gt; &lt;?=ft("age_3");?&gt;&lt;/label&gt;&lt;/div&gt;
&lt;!--
	&lt;div class="ti_dis" id="ag_4"&gt;&lt;input name="&lt;?=fGetName("age")?&gt;" value="&lt;?=fGetValue("age",4)?&gt;" answercode="&lt;?=fGetAnswerCode("age",4)?&gt;" class="" id="ag4" type="radio"&gt;&lt;label for="ag4"&gt; &lt;?=ft("age_4");?&gt;&lt;/label&gt;&lt;/div&gt;
--&gt;
&lt;/div&gt;


&lt;/div&gt;
&lt;?if(fGetComments("age")):?&gt;&lt;div class="qm"&gt;&lt;div class="qm_text"&gt;&lt;?=ft("age_comment")?&gt;&lt;/div&gt;&lt;/div&gt;&lt;?endif?&gt;
&lt;/div&gt;
&lt;?endif?&gt;

&lt;!--  Гражданство  --&gt;
&lt;?if(fGetActive("country")):?&gt;
&lt;? include "../list_countries.php"; ?&gt;
&lt;div class="ti_blo" id="ti_blo_country"&gt;

&lt;div class="ti_dig"&gt;&lt;div class="tiqa"&gt;&lt;?=ft("country")?&gt;&lt;span class="zred"&gt; *&lt;/span&gt;&lt;/div&gt;
&lt;div class="vsta_s"&gt;

&lt;select name="&lt;?=fGetName("country",0)?&gt;" id="sel_country" class='chzn-select'&gt;
&lt;?php

$coc=count($ar_part_world[$_SESSION["f_lang"]]);
for($i=0;$i&lt;$coc;$i++)
	{
	echo "&lt;optgroup label='".$ar_part_world[$_SESSION["f_lang"]][$i]."'&gt;";
	$v_ar_c=@explode(";",$ar_country[$_SESSION["f_lang"]][$i]);
	asort($v_ar_c);
		foreach($v_ar_c as $val) {
		echo "&lt;option";
		if($_SESSION["passport_member"]["country"]){if($_SESSION["passport_member"]["country"]==$val) echo " selected";}
		else {if($ar_select_default[$_SESSION["f_lang"]]==$val) echo " selected";}
		
		echo "&gt;".$val."&lt;/option&gt;";
		}
	echo "&lt;/optgroup&gt;";
	}
?&gt;
&lt;/select&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;?if(fGetComments("country")):?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&lt;div class="qm"&gt;&lt;div class="qm_text"&gt;&lt;?=ft("country_comment")?&gt;&lt;/div&gt;&lt;/div&gt;&lt;?endif?&gt;
&lt;script type="text/javascript"&gt; 
// Инициализация плагина для select
$(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
 &lt;/script&gt;

 &lt;/div&gt;
&lt;?endif?&gt; 
 
 &lt;!--  Город проживания  --&gt;
&lt;?if(fGetActive("city")):?&gt;
&lt;div class="ti_blo" id="ti_blo_city"&gt;
	 &lt;div class="ti_dig"&gt;&lt;div class="tiqa"&gt;&lt;?=ft("city")?&gt;&lt;span class="zred"&gt; *&lt;/span&gt;&lt;/div&gt;&lt;input id="" name="&lt;?=fGetName("city")?&gt;" value="&lt;?=$_SESSION["passport_member"]["city"]?&gt;" class="" type="text"&gt;&lt;/div&gt;
&lt;?if(fGetComments("city")):?&gt;&lt;div class="qm"&gt;&lt;div class="qm_text"&gt;&lt;?=ft("city_comment")?&gt;&lt;/div&gt;&lt;/div&gt;&lt;?endif?&gt;
&lt;/div&gt;
&lt;?endif?&gt;
 

 
&lt;/div&gt;
&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;

&lt;? include "button_step.php"; // Кнопки перехода к следующему шагу ?&gt;

 &lt;/form&gt;
 &lt;/div&gt;
&lt;?}?&gt;
&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;



