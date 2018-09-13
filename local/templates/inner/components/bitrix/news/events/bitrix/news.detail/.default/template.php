<?

use Bitrix\Main\Localization\Loc;

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
<div class="blog-item">
    <div class="row">
        <div class="col-lg-2 col-sm-2">
            <? if (!empty($arResult['DATE_ACTIVE_FROM'])): ?>
                <div class="date-wrap">
                    <span class="date">
                        <?= FormatDateFromDB($arResult['DATE_ACTIVE_FROM'], 'd') ?>
                    </span>
                    <span class="month">
                        <?= FormatDateFromDB($arResult['DATE_ACTIVE_FROM'], 'F') ?>
                    </span>
                </div>
            <? endif; ?>
        </div>
        <div class="col-lg-10 col-sm-10">
            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
                <div class="blog-img gs">
                    <img
                            src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                            width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                            height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>"
                            alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                            title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                    />
                </div>
            <? endif ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2 col-sm-2 text-right">
            <? if (!empty($arResult['CREATED_USER_NAME'])): ?>
                <div class="author">
                    <?= Loc::getMessage('BY') ?>
                    <a href="#">
                        <?= $arResult['CREATED_USER_NAME'] ?>
                    </a>
                </div>
            <? endif; ?>
            <? if (!empty($arResult['TAGS'])): ?>
                <ul class="list-unstyled">
                    <? foreach ($arResult['TAGS'] as $tag): ?>
                        <li>
                            <a href="/search/?tags=<?= $tag ?>">
                                <em>
                                    <?= $tag ?>
                                </em>
                            </a>
                        </li>
                    <? endforeach; ?>
                </ul>
            <? endif; ?>
            <div class="st-view">
                <ul class="list-unstyled">
                    <? if (!empty($arResult['SHOW_COUNTER'])): ?>
                        <li>
                            Просмотров: <?= $arResult['SHOW_COUNTER'] ?>
                        </li>
                    <? endif; ?>
                    <? foreach ($arResult['DISPLAY_PROPERTIES'] as $displayProperty): ?>
                        <li>
                            <?= "{$displayProperty['NAME']}: {$displayProperty['VALUE']}" ?>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-10 col-sm-10">
            <? if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]): ?>
                <h1><?= $arResult["NAME"] ?></h1>
            <? endif; ?>
            <div>
                <? if (!empty($arResult["DETAIL_TEXT"])): ?>
                    <?= $arResult["DETAIL_TEXT"]; ?>
                <? elseif (!empty($arResult["PREVIEW_TEXT"])) : ?>
                    <?= $arResult["PREVIEW_TEXT"]; ?>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>