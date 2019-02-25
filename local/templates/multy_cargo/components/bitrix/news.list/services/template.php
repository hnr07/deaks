<?foreach($arResult["ITEMS"] as $arItem):?>
<?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <article class="<?if ($curPage == SITE_DIR."index.php"):?>grid_4<?php endif;?>">
        <div class="box-border">
            <div class="page1 box maxheight">
                <div class="padding-box">
                       <h3 class="prev-indent-bot"><?echo $arItem["NAME"]?></h3>
                            <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                                <h5 class="p1"><?echo $arItem["PREVIEW_TEXT"];?></h5>
                            <?endif;?>
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="button"><strong><strong><?php echo GetMessage("READ_MORE")?></strong></strong></a>
                    </div>
                </div>
            </div>
        </article>
<?endforeach;?>