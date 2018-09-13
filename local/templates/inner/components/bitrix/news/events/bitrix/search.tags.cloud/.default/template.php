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

if ($arParams["SHOW_CHAIN"] != "N" && !empty($arResult["TAGS_CHAIN"])): ?>
    <noindex>
        <div class="tags">
            <h3>
                <?= Loc::getMessage('TAGS') ?>
            </h3>
            <? foreach ($arResult["TAGS_CHAIN"] as $tags):?>
                <li>
                    <a href="<?= $tags["TAG_PATH"] ?>" rel="nofollow">
                        <i class="fa fa-tags pr-5">
                        </i>
                        <?= $tags["TAG_NAME"]  ?>
                    </a>
                </li>
            <? endforeach; ?>
        </div>
    </noindex>
<? endif; ?>

<? if (is_array($arResult["SEARCH"]) && !empty($arResult["SEARCH"])): ?>
    <noindex>
        <div class="tags">
            <h3>
                <?= Loc::getMessage('TAGS') ?>
            </h3>
            <ul class="tag">
                <? foreach ($arResult["SEARCH"] as $key => $res): ?>
                    <li>
                        <a href="<?= $res["URL"] ?>" rel="nofollow">
                            <i class="fa fa-tags pr-5">
                            </i>
                            <?= $res["NAME"] ?>
                        </a>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    </noindex>
<? endif; ?>