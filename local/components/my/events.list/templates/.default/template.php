<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="media" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <? if(!empty($arItem["THUMBNAIL_PICTURE"])): ?>
        <a class="pull-left gs" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
            <img src="<?= $arItem["THUMBNAIL_PICTURE"]["SRC"] ?>" alt="">
        </a>
        <? endif; ?>
        <div class="media-body">
            <h5 class="media-heading">
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
                    <?echo $arItem["NAME"]?>
                </a>
            </h5>
            <p>
                <?echo $arItem["DISPLAY_ACTIVE_FROM"]?>
            </p>
        </div>
    </div>
<?endforeach;?>