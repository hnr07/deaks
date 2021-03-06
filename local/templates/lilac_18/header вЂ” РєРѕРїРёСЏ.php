<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="/js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" href="/js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?$APPLICATION->ShowMeta("robots")?>
<?$APPLICATION->ShowMeta("keywords")?>
<?$APPLICATION->ShowMeta("description")?>
<title><?$APPLICATION->ShowTitle()?></title>
<?$APPLICATION->SetAdditionalCSS("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");?>
<?$APPLICATION->ShowHead();?>
<?IncludeTemplateLangFile(__FILE__);?>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/colors.css" />
<?if(LANGUAGE_ID != "ru"):?>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/colors_<?=LANGUAGE_ID?>.css" />
<?endif;?>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/print.css" media="print" />

<script>
$(document).ready(function(){
	//jQuery("a.fancy").fancybox();
	$("a.fancy").fancybox();
	
	/*	
	// hide #back-top first
	$(".back-top").hide();
	// fade in #back-top
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {$('.back-top').fadeIn();}
		else {$('.back-top').fadeOut();}
	});
	*/
	$('.back-top').click(function () {$('body,html').animate({scrollTop: 0}, 800); return false;});
	
	// При высоте страницы меньше высоты окна footer прижат книзу
	var dh = $(document).height();
	var wh=$("#header").outerHeight();
	var wf=$("#footer").outerHeight();
	var hb=dh-wh-wf;
	$("#content-wrapper").css({"min-height":hb+"px"});
});
</script>
</head>
<body>	
<div class="div_body">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		<?$APPLICATION->IncludeComponent("cc:lang", "", array(
			"IBLOCK_TYPE" => "directory",
			"IBLOCK_ID" => "22",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "360000"
			),
			false
		);?>
		<div id="header">
			<div class="top-menu">
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu", 
					"personal_tab", 
					Array(
						"ROOT_MENU_TYPE"	=>	"top",
						"MAX_LEVEL"	=>	"1",
						"USE_EXT"	=>	"N"
					)
				);?>
			</div>
			<div id="site-name"><?$APPLICATION->IncludeFile(
				SITE_TEMPLATE_PATH."/include_areas/site_name.php",
				Array(),
				Array("MODE"=>"html")
			);?></div>
			<?if($APPLICATION->GetCurPage(true) != SITE_DIR."index.php"){?><a href="<?=SITE_DIR?>"><?}?>
				<div id="site-logo"></div>
			<?if($APPLICATION->GetCurPage(true) != SITE_DIR."index.php") {?></a><?}?>
			<div id="login">
				<?if($USER->IsAuthorized()) {?>
				<?echo $USER->GetFirstName()." ".$USER->GetLastName();?> <a href="/?logout=yes" title="выход"><img src="/images/login.gif"></a>
				<?}else{?>
				<a href="/auth/" class="fancy" id="login_id"><img src="/images/login.gif"> вход</a>
				<!--<a href="#auth_w" class="fancy" id="login_id"><img src="/images/login.gif"> вход</a> -->
				<?}?>
				<div id="auth_w" style="display:none;">
					<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "auth_w", Array(
						"REGISTER_URL"	=>	"/auth/",
						"PROFILE_URL"	=>	"/personal/profile/",
						)
					);?>
					</div>
				
			</div>	
			<div id="search">
				<?$APPLICATION->IncludeComponent("bitrix:search.form", "personal", Array(
					"PAGE"	=>	SITE_DIR."search.php"
					)
				);?>
			</div>			
		</div>
		<div id="search-layer">
			
		</div>
		<div id="content-wrapper">
			<div id="content">
				<div id="work-area">
					<?if($APPLICATION->GetCurPage(true) != SITE_DIR."index.php")
					{
						echo "<h1>";
						$APPLICATION->ShowTitle(false);
						echo "</h1>";
					}
					?>	