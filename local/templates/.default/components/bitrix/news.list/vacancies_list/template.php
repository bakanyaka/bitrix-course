<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
use Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);
?>
<div class="row">
    <div class="col-sm-12">
        <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
            <?= $arResult["NAV_STRING"] ?><br/>
        <? endif; ?>
    </div>
</div>
<div class="row">
    <? foreach (array_chunk($arResult["ITEMS"], ceil(count($arResult["ITEMS"]) / 2)) as $colIndex => $column): ?>
        <div class="col-md-6">
            <? foreach ($column as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="candidate wow <?= $colIndex === 0 ? 'fadeInLeft' : 'fadeInRight' ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <h1><? echo $arItem["NAME"] ?></h1>
                    <div class="align-left preview-text">
                        <?= $arItem["PREVIEW_TEXT"]; ?>
                    </div>
                    <ul class="list-unstyled">
                    <? foreach ($arItem['DISPLAY_PROPERTIES'] as $displayProperty): ?>
                        <li><i class="fa fa-angle-right pr-10"></i><?= "{$displayProperty['NAME']}: {$displayProperty['VALUE']}" ?></li>
                    <? endforeach; ?>
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="btn btn-info"><?= Loc::getMessage('READ_MORE') ?></a>
                </div>
                <hr>
            <? endforeach; ?>
        </div>
    <? endforeach; ?>
</div>
<div class="row">
    <div class="col-sm-12">
        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
            <br/><?= $arResult["NAV_STRING"] ?>
        <? endif; ?>
    </div>
</div>