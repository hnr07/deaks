<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?IncludePublicLangFile(__FILE__);?>
<html>
<head>
 
 <script charset="utf-8" type="text/javascript" src="/js/jquery/jquery-1.9.1.js"></script>
<!-- <script charset="utf-8" type="text/javascript" src="000/js/jquery/jquery-2.1.4.js"></script>-->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?$APPLICATION->ShowHead()?>
<title><?$APPLICATION->ShowTitle()?></title>

<!--
<link rel="stylesheet" href="/js/jquery_mobile/themes/default/jquery.mobile-1.4.5.min.css">
-->




 <script type="text/javascript" src="/js/fancybox/jquery.fancybox.js"></script>
	<link rel="stylesheet" href="/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
 
</head>

<body>


<?$APPLICATION->ShowPanel();?>

<?
global $USER;
/*if ($USER->IsAuthorized()) {?>
<div class="planka_user">
<div class="div_l"><?=$USER->GetFullName()?></div>
<div class="div_r"><a href="<?=$APPLICATION->GetCurPage();?>?logout=yes"><?=GetMessage('exit')?></a></div>
<div class="div_r"><a href="/com/user/"><?=GetMessage('private_office')?></a></div>
</div>
<?}*/?>

<div id="container">

<div id="header">

</div>
<!--<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false)?></h1>-->