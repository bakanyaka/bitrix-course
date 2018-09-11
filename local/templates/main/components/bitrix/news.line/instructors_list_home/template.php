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
<div id="home-services">
    <div class="container">
        <h2>
            <?= Loc::getMessage('OUR_INSTRUCTORS') ?>
        </h2>
        <div class="row">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="col-md-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="h-service">
                        <img class="instructor-portrait img-circle wow fadeInDown"
                             src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="100px" height="100px" alt=""/>
                        <div class="h-service-content wow fadeInUp">
                            <h3>
                                <?= $arItem["NAME"] ?>
                            </h3>
                            <p>
                                <?= $arItem["PREVIEW_TEXT"] ?>
                            </p>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <!-- /row -->

    </div>
    <!-- /container -->
</div>
<!-- service end -->


