<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<!--<div class="main">-->
<!--    <nav>-->
<!--        <ul class="sf-menu">-->
<!--            <li><a class="current" href="#">Home</a></li>-->
<!--            <li><a href="#">Services</a>-->
<!--                <ul>-->
<!--                    <li><a href="#">Airports</a></li>-->
<!--                    <li><a href="#">Hourly</a></li>-->
<!--                    <li><a href="#">City-to-CIty</a></li>-->
<!--                    <li><a href="#">Round Trips</a></li>-->
<!--                    <li><a href="#">Special Occasions</a></li>-->
<!--                    <li class="last-item"><a href="#">Limousines</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li><a href="#">Fares</a></li>-->
<!--            <li><a href="#">Booking</a></li>-->
<!--            <li><a href="#">Corporate account</a></li>-->
<!--            <li><a href="#">Contacts</a></li>-->
<!--        </ul>-->
<!--    </nav>-->
<!--</div>-->



<div class="main">
    <nav>
        <ul class="sf-menu">
            <?
            $previousLevel = 0;
            if (($_SERVER['SCRIPT_NAME'] == '/news/index.php') || ($_SERVER['REAL_FILE_PATH'] == '/news/index.php')) $news = true; else $news = false;

            foreach($arResult as $arItem):?>

                <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                    <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                <?endif?>

                <?if ($arItem["IS_PARENT"]):?>
                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <li class="<?if ($arItem["SELECTED"] && !$news):?>current<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                            <ul>
                    <?else:?>
                        <li><a class="<?if ($arItem["SELECTED"] && !$news):?>current<?endif?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                            <ul>
                    <?endif?>

                <?else:?>

                    <?if ($arItem["PERMISSION"] > "D"):?>
                        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                            <li><a class="<?if ($arItem["SELECTED"] && !$news):?>current<?endif?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                        <?else:?>
                            <li><a class="<?if ($arItem["SELECTED"] && !$news):?>current<?endif?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                        <?endif?>
                    <?else:?>
                        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                            <li class="denied"><a title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>" href=""><?=$arItem["TEXT"]?></a></li>
                        <?else:?>
                            <li class="denied"><a title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>" href=""><?=$arItem["TEXT"]?></a></li>
                        <?endif?>
                    <?endif?>
                <?endif?>
                <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
            <?endforeach?>

            <?if ($previousLevel > 1)://close last item tags?>
                <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
            <?endif?>

        </ul>
    </nav>
</div>
<?endif?>		