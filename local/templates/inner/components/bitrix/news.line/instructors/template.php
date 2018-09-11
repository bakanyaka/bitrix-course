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
<div class="row">
    <div class="profile">
        <h2>
            <?= Loc::getMessage('OUR_INSTRUCTORS') ?>
        </h2>
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col-xs-12 col-sm-6 col-md-3" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="thumbnail wow fadeInUp" data-wow-delay=".1s">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                         alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                         title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">
                    <div class="caption">
                        <h4>
                            <?= $arItem["NAME"] ?>
                        </h4>
                        <p>
                            <?= $arItem["PREVIEW_TEXT"] ?>
                        </p>
                        <div class="team-social-link">
                            <? if ($arItem["PROPERTY_URL_FACEBOOK_VALUE"]): ?>
                                <a href="<?= $arItem["PROPERTY_URL_FACEBOOK_VALUE"] ?>">
                                    <i class="fa fa-facebook">
                                    </i>
                                </a>
                            <? endif; ?>
                            <? if ($arItem["PROPERTY_URL_TWITTER_VALUE"]): ?>
                                <a href="<?= $arItem["PROPERTY_URL_TWITTER_VALUE"] ?>">
                                    <i class="fa fa-twitter">
                                    </i>
                                </a>
                            <? endif; ?>
                            <? if ($arItem["PROPERTY_URL_PINTEREST_VALUE"]): ?>
                                <a href="<?= $arItem["PROPERTY_URL_PINTEREST_VALUE"] ?>">
                                    <i class="fa fa-pinterest">
                                    </i>
                                </a>
                            <? endif; ?>
                            <? if ($arItem["PROPERTY_URL_LINKEDIN_VALUE"]): ?>
                                <a href="<?= $arItem["PROPERTY_URL_LINKEDIN_VALUE"] ?>">
                                    <i class="fa fa-linkedin">
                                    </i>
                                </a>
                            <? endif; ?>
                            <? if ($arItem["PROPERTY_URL_GOOGLE_PLUS_VALUE"]): ?>
                                <a href="<?= $arItem["PROPERTY_URL_GOOGLE_PLUS_VALUE"] ?>">
                                    <i class="fa fa-google-plus">
                                    </i>
                                </a>
                            <? endif; ?>
                            <? if ($arItem["PROPERTY_URL_GITHUB_VALUE"]): ?>
                                <a href="<?= $arItem["PROPERTY_URL_GITHUB_VALUE"] ?>">
                                    <i class="fa fa-github">
                                    </i>
                                </a>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
