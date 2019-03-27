<?
CModule::IncludeModule("weblooter.langfile");

if (isset ($_GET['type'])){
	switch ($_GET['type']) {
		case 'pda':
		setcookie('siteType', 'pda', time()+3600*24*30,'/');
		define('siteType','pda');
		break;

		default:
		setcookie('siteType', 'original', time()+3600*24*30,'/');
		define('siteType','original');
	}
}
else{
$checkType='';
	if (isset($_COOKIE['siteType'])) $checkType=$_COOKIE['siteType'];
	switch ($checkType) {
	case 'pda':
	define('siteType','pda');
	break;

	default:
	define('siteType','');
	}
}

?>