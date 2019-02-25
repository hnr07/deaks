<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Копирование формы и папки мероприятия.");

/*
 Копирование папок a la xcopy 
 (с перезаписью более старых файлов) 
*/

//setlocale(LC_ALL, 'ru_RU.cp1251');
//date_default_timezone_set('Asia/Irkutsk');

function copy_folder($d1, $d2, $upd = true, $force = true) {
    if ( is_dir( $d1 ) ) {
        $d2 = mkdir_safe( $d2, $force );
        if (!$d2) {fs_log("!!fail $d2"); return;}
        $d = dir( $d1 );
        while ( false !== ( $entry = $d->read() ) ) {
            if ( $entry != '.' && $entry != '..' ) 
                copy_folder( "$d1/$entry", "$d2/$entry", $upd, $force );
        }
        $d->close();
    }
    else {
        $ok = copy_safe( $d1, $d2, $upd );
        $ok = ($ok) ? "ok-- " : " -- ";
        fs_log("{$ok}$d1"); //Логирование копирования
    }
}

function mkdir_safe( $dir, $force ) {
    if (file_exists($dir)) {
        if (is_dir($dir)) return $dir;
        else if (!$force) return false;
        unlink($dir);
    }
    return (mkdir($dir, 0777, true)) ? $dir : false;
} //function mkdir_safe

function copy_safe ($f1, $f2, $upd) {
    $time1 = filemtime($f1);
    if (file_exists($f2)) {
        $time2 = filemtime($f2);
        if ($time2 >= $time1 && $upd) return false;
    }
    $ok = copy($f1, $f2);
    if ($ok) touch($f2, $time1);
    return $ok;
} //function copy_safe 

function fs_log($str) {
    $log = fopen("./fs_log.txt", "a");
    $time = date("Y-m-d H:i:s");
    fwrite($log, "$str ($time)\n");
    fclose($log);
} 
?>
<br><br>
<h2><?$APPLICATION->ShowTitle();?></h2>

<div>
При копировании формы, создаётся новая форма с заданными параметрами. Одновременно копируется папка мероприятия, имя папки должно быть такое же, как и символьный идентификатор(SID) формы. Имя новой папки будет такое же, как и символьный идентификатор(SID) новой формы. Для того, чтобы форма попадала в список копируемых форм в наименовании формы должно присутствовать слово "регистрация"
</div>

<style>
#s_copy_form input, select {
border:solid 1px #b2b2b2;
width:200px;
}
#s_copy_form div {
margin:20px;
}
</style>
<div id="s_copy_form">
<?
if(CModule::IncludeModule("form")){ 

// сформируем массив фильтра
$arFilter = Array(
 "ID"                      => "",          // 
 "ID_EXACT_MATCH"          => "Y",              // точное совпадение по ID
 "NAME"                    => "Регистрация",         // в заголовке веб-формы есть слово 
 "NAME_EXACT_MATCH"        => "N",              // не точное совпадение по NAME
 "SID"                     => "",         // символьный идентификатор равен 
 "SID_EXACT_MATCH"         => "",              // точное совпадение по SID
 "DESCRIPTION"             => "",      // в описании есть слово 
 "DESCRIPTION_EXACT_MATCH" => "N",              // не точное совпадение по DESCRIPTION
 "SITE"                    => array("s1") // веб-форма приписана и к сайтам 
);

// получим список всех форм у которых у текущего пользователя есть право на заполнение
$rsForms = CForm::GetList($by="s_id", $order="desc", $arFilter, $is_filtered);
?>

<form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
<div>
<select name="id_form">
<?
while ($arForm = $rsForms->Fetch())
{
	echo "<option value='".$arForm["ID"]."'>".$arForm["NAME"]."</option>";
}
?>
</select>
Выбор копируемой формы
</div>
<div>

<input type="text" name="n_name">
Наименование новой формы
</div>
<div>

<input type="text" name="n_sid">
Символьный идентификатор(SID) новой формы
</div>
<div>
 <input type="submit" value="Копировать" name="sub_but">
 </div>
</form>


<?
	if(isset($_GET["sub_but"])){
	if($_GET["n_name"] && $_GET["id_form"] && $_GET["n_sid"]) {
	$FORM_SID = $_GET["n_sid"];
	$rsForm = CForm::GetBySID($FORM_SID);
	$arForm = $rsForm->Fetch();
	
	
	if(!$arForm){
		$FORM_ID = $_GET["id_form"];
		//echo $FORM_ID;
		// скопируем веб-форму
		
		if ($NEW_FORM_ID=CForm::Copy($FORM_ID))
		{
		$arFields = array(
    "NAME"              => $_GET["n_name"],
    "SID"               => $_GET["n_sid"],
	"arMENU"            => array("ru" => $_GET["n_name"], "en" => $_GET["n_name"]),

    );
echo "<div>Веб-форма ID=".$FORM_ID." успешно скопирована в новую веб-форму ID=".$NEW_FORM_ID."</div>";
// изменим новую веб-форму
$res = CForm::Set($arFields,$NEW_FORM_ID);
if ($res>0) echo "<div>В новую форму успешно внесены изменения.</div>";
else // ошибка
{
    // выводим текст ошибки
    global $strError;
    echo $strError;
}

echo '<div>В систему добавлен новый тип почтового события - Заполнена web-форма "'.$_GET["n_sid"].'" [FORM_FILLING_'.$_GET["n_sid"].']</div>';

// копируем папку мероприятия
$rsForm = CForm::GetByID($FORM_ID);
$arForm = $rsForm->Fetch();
	copy_folder($arForm["SID"], $_GET["n_sid"], $upd = true, $force = true);
echo "<div>Если всё прошло успешно, создана папка \"".$_GET["n_sid"]."\", точная копия папки \"".$arForm["SID"]."\". Для правильной работы новой формы регистрации необходимо отредактировать файл \"".$_GET["n_sid"]."/var_config.php\"</div>";
		}
		else
		{
			// выведем текст ошибки
			global $strError;
			echo $strError;
		}
	}
else {echo "<div>Форма с таким символьным идентификатором уже существует.</div>";}	

	}
	
else {echo "<div>Все поля обязательны для заполнения.</div>";}	

	}
}


?>
</div>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>