<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
$curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?$APPLICATION->ShowHead();?>

<link href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" rel="shortcut icon">
	<!--[if lte IE 6]>
	<style type="text/css">
		
		#banner-overlay { 
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/overlay.png', sizingMethod = 'crop'); 
		}
		
		div.product-overlay {
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/product-overlay.png', sizingMethod = 'crop');
		}
		
	</style>
	<![endif]-->

	<title><?$APPLICATION->ShowTitle()?></title>
	<script src="/fibrovolokno/js/jquery-1.9.1.min.js"></script> 
	
	<link href="/fibrovolokno/js/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="/fibrovolokno/js/owl-carousel/owl.theme.css" rel="stylesheet">
	<link href="/fibrovolokno/js/owl-carousel/owl.transitions.css" rel="stylesheet">

	<script src="/fibrovolokno/js/owl-carousel/owl.carousel.js"></script>
</head>
<body>
	<div class="page-wrapper">
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		<div class="header">
			<?if ($curPage == SITE_DIR."fibrovolokno/index.php"){ 
				$APPLICATION->IncludeFile(
					SITE_DIR."fibrovolokno/include/top_slider.php",
					Array(),
					Array("MODE"=>"html")
				);
			}?>
		
		</div>
		
		<div class="content">
		
	
				