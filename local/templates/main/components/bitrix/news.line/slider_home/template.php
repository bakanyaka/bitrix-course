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
$this->addExternalJs('/local/templates/.default/vendor/jquery/jquery.parallax-1.1.3.js');
$this->addExternalJs('/local/templates/.default/vendor/parallax-slider/jquery.cslider.js');
$this->addExternalJs('/local/templates/.default/vendor/parallax-slider/modernizr.custom.28468.js');
$this->addExternalCss('/local/templates/.default/vendor/parallax-slider/parallax-slider.css');
?>
<!-- Sequence Modern Slider -->
<div id="da-slider" class="da-slider">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="da-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>
                            <i><?= $arItem["NAME"] ?></i>
                        </h2>
                        <p>
                            <i><?= $arItem["PREVIEW_TEXT"] ?></i>
                        </p>
                        <? if($arItem["PROPERTY_URL_TO_VALUE"]): ?>
                            <a href="<?= $arItem["PROPERTY_URL_TO_VALUE"] ?>" class="btn btn-info btn-lg da-link">
                                <?= Loc::getMessage('READ_MORE') ?>
                            </a>
                        <? endif; ?>
                        <div class="da-img">
                            <img src="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" alt="image01"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>

    <nav class="da-arrows">
        <span class="da-arrows-prev">
        </span>
        <span class="da-arrows-next">
        </span>
    </nav>
</div>