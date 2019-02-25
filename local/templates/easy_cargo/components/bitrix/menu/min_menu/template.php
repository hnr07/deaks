<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
$(document).ready(function(){
	
	$(".min_menu .gbut_min_menu").click(function(){
		$(".call-form, .order-form, .box_list_orders").css({"display":"none"});
		//$(".call-form").slideUp();	
		$(".w_menu").slideToggle(300,function(){if($(".call-form").is(':hidden') && $(".w_menu").is(':hidden')) {$(".order-form, .box_list_orders").slideToggle();}});	
	}); 
});
</script>
<?if (!empty($arResult)){?>

<div class="min_menu">
	<div class="gbut_min_menu dico dico_menu_8"></div>
	<div class="w_menu b_shadow">
		 <ul class="t_menu">
            <?
            $previousLevel = 0;
            if (($_SERVER['SCRIPT_NAME'] == '/news/index.php') || ($_SERVER['REAL_FILE_PATH'] == '/news/index.php')) $news = true; else $news = false;

            foreach($arResult as $arItem){?>

                <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel){?>
                    <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                <?}?>

                <?if ($arItem["IS_PARENT"]){?>
                    <?if ($arItem["DEPTH_LEVEL"] == 1){?>
						<li class="<?if ($arItem["SELECTED"] && !$news):?>current<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                            <ul>
                    <?}else{?>
                        <li><a class="<?if ($arItem["SELECTED"] && !$news):?>current<?endif?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                            <ul>
                    <?}?>

                <?}else{?>

                    <?if ($arItem["PERMISSION"] > "D"){?>
                        <?if ($arItem["DEPTH_LEVEL"] == 1){?>
                            <li><a class="<?if ($arItem["SELECTED"] && !$news){?>current<?}?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                        <?}else{?>
                            <li><a class="<?if ($arItem["SELECTED"] && !$news){?>current<?}?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                        <?}?>
                    <?}else{?>
                        <?if ($arItem["DEPTH_LEVEL"] == 1){?>
                            <li class="denied"><a title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>" href=""><?=$arItem["TEXT"]?></a></li>
                        <?}else{?>
                            <li class="denied"><a title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>" href=""><?=$arItem["TEXT"]?></a></li>
                        <?}?>
                    <?}?>
                <?}?>
                <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
            <?}?>

            <?if ($previousLevel > 1){//close last item tags?>
                <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
            <?}?>

        </ul>
		<div class="box_ss">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH."/include/join_us.php"), false, array("HIDE_ICONS" => "Y"));?>
		</div>
	</div>
</div>

<?}?>		