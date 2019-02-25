		 <?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>
		 <!--  Курс заявки  -->
		<?
		$nc_id=$_POST['nc_id'];
		$code_m=$_POST['code_m'];
		
				$mv=time(); // метка текущего времени
		
		CModule::IncludeModule('form'); // подключаем модуль форма 
		
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
			"Y", 
			false);
		
		while ($arResult_c = $rsResults_c->Fetch())
		{
				$RESULT_ID_c=$arResult_c['ID'];
				$arAnswer_c = CFormResult::GetDataByID(
				$RESULT_ID_c, 
				array('currency_number','time_stamp','course'),  // массив символьных кодов необходимых вопросов
				$ar_Res_c, 
				$ar_Answer2_c);
				if($arAnswer_c['currency_number'][0]['USER_TEXT']==$nc_id && $arAnswer_c['time_stamp'][0]['USER_TEXT']<=$mv) {
					$course[$arAnswer_c["time_stamp"][0]['USER_TEXT']]=$arAnswer_c["course"][0]['USER_TEXT'];
				}
		}
		//echo "<pre>";print_r($course);echo "</pre>";
		$kc= max(array_keys($course));
		//echo $kc;	
		$kp=$course[$kc];  //текущий курс нац.валюты к базовой
		//echo $kp;
		//$c_ce=count($course);
		
		foreach($course as $val_c) {
			echo "<option value='".$val_c."'";
			//if(fGetResultValues("m_course",0)==$val_c) {echo " selected style='background-color:green;color:#fff;' title='курс в заявке'";}
			if($kp==$val_c) {echo " selected";}
			echo ">".$val_c;
			if($kp==$val_c) echo " -текущий";
			echo "</option>";
		}
		?>