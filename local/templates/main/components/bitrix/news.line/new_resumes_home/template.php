<?
use \Bitrix\Main\Localization\Loc;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <article class="media" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a class="pull-left thumb p-thumb">
            <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt=""/>
        </a>
        <div class="media-body b-btm">
            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class=" p-head">
                <?= $arItem["NAME"] ?>
            </a>
            <p>
                <?= Loc::getMessage('TOTAL_EXPERIENCE') . ' ' . ($arItem['PROPERTY_ATT_EXPERIENCE_VALUE'] ?? 'Не указан') ?> <br/>
                <?= Loc::getMessage('EXPECTED_SALARY') . ' ' . ($arItem['PROPERTY_ATT_SALARY_VALUE'] ?? 'Не указано') ?>
            </p>
        </div>
    </article>
<? endforeach; ?>

