<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."/local/php_interface/classes/Mobile-Detect/Mobile_Detect.php"), false);

$detect = new Mobile_Detect; 
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
//echo $deviceType;
if ($deviceType == 'phone'){
	$ss="?";
	if(strpos($APPLICATION->GetCurPageParam(),"?")) $ss="&";

	LocalRedirect($APPLICATION->GetCurPageParam().$ss."type=pda");
	exit();
} 
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>" xmlns:og="http://ogp.me/ns#">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="/js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" href="/js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />

<?$APPLICATION->ShowMeta("robots")?>
<?$APPLICATION->ShowMeta("keywords")?>
<?$APPLICATION->ShowMeta("description")?>
<title><?$APPLICATION->ShowTitle()?></title>
<?//$APPLICATION->SetAdditionalCSS("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");?>
<?$APPLICATION->SetAdditionalCSS("/icons_css/font-awesome.min.css");?>

<?$APPLICATION->ShowHead();?>

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
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter51125276 = new Ya.Metrika2({
                    id:51125276,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/51125276" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>
<body>	
<?IncludeTemplateLangFile(__FILE__);?>
<div class="div_body">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		<?/*$APPLICATION->IncludeComponent("cc:lang", "", array(
			"IBLOCK_TYPE" => "translation",
			"IBLOCK_ID" => "10",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "360000"
			),
			false
		);*/?>
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
			
			<div id="site-name">
				<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include_areas/site_name.php",Array(),Array("MODE"=>"html"));?>
			</div>
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