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
$this->addExternalJs('/local/templates/.default/vendor/owlcarousel/owl.carousel.js');
$this->addExternalCss('/local/templates/.default/vendor/owlcarousel/owl.carousel.css');
$this->addExternalCss('/local/templates/.default/vendor/owlcarousel/owl.theme.css');
$this->addExternalJs('/local/templates/.default/vendor/lightbox/js/lightbox.min.js');
$this->addExternalCss('/local/templates/.default/vendor/lightbox/css/lightbox.min.css');
?>

<? if ($arResult["DETAIL_PICTURE"]): ?>
    <div class="row">
        <div class="col-md-12">
            <div>
                <img
                        class="detail_picture"
                        border="0"
                        src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                        width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                        height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>"
                        alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                        title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                />
            </div>
        </div>
    </div>
<? endif; ?>

    <div class="row">
        <!--portfolio-single start-->

        <div class="col-lg-9 ">
            <div class="title">
                <h3><?= $arResult["NAME"] ?></h3>
                <hr>
            </div>
            <div class="pf-detail">
                <? echo $arResult["DETAIL_TEXT"]; ?>
            </div>
            <p>
                <button class="btn bg-maroon margin"><i
                            class="fa fa-file pr-5"></i> <?= Loc::getMessage('DOWNLOAD_PDF') ?></button>
            </p>
        </div>

        <div class="col-lg-3">
            <div class="title">
                <h3>
                    <? if (!empty($arResult['PROPERTIES']['ATT_SURNAME']['VALUE'])) {
                        echo "{$arResult['PROPERTIES']['ATT_SURNAME']['VALUE']} {$arResult['PROPERTIES']['ATT_FIRST_NAME']['VALUE']} {$arResult['PROPERTIES']['ATT_MIDDLE_NAME']['VALUE']}";
                    } elseif (!empty($arResult['PROPERTIES']['ATT_SALARY']['VALUE'])) {
                        echo $arResult['PROPERTIES']['ATT_SALARY']['VALUE'];
                        unset($arResult['DISPLAY_PROPERTIES']['ATT_SALARY']);
                    } ?>
                </h3>
                <hr>
            </div>
            <ul class="list-unstyled pf-list">
                <? if (!empty($arResult['DISPLAY_PROPERTIES']['ATT_PHONE']['VALUE'])): ?>
                    <li><i class="fa fa-phone pr-10"></i><b><?= Loc::getMessage('PHONE') ?>: </b>
                        <span><?= $arResult['DISPLAY_PROPERTIES']['ATT_PHONE']['VALUE']; unset($arResult['DISPLAY_PROPERTIES']['ATT_PHONE']) ?></span>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult['DISPLAY_PROPERTIES']['ATT_MAIL']['VALUE'])): ?>
                    <li>
                        <i class="fa fa-envelope pr-10"></i><b><?= Loc::getMessage('EMAIL') ?>
                            : </b><span><?= $arResult['DISPLAY_PROPERTIES']['ATT_MAIL']['VALUE']; unset($arResult['DISPLAY_PROPERTIES']['ATT_MAIL']) ?></span>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult['DISPLAY_PROPERTIES']['ATT_BIRTHDATE']['VALUE'])): ?>
                    <li>
                        <i class="fa fa-calendar pr-10"></i><b><?= Loc::getMessage('DATE_OF_BIRTH') ?>
                            : </b><span><?= $arResult['DISPLAY_PROPERTIES']['ATT_BIRTHDATE']['VALUE']; unset($arResult['DISPLAY_PROPERTIES']['ATT_BIRTHDATE']) ?></span>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult['DISPLAY_PROPERTIES']['ATT_EXPERIENCE']['VALUE'])): ?>
                    <li>
                        <i class="fa fa-briefcase pr-10"></i><b><?= Loc::getMessage('EXPERIENCE') ?>
                            : </b><span><?= $arResult['DISPLAY_PROPERTIES']['ATT_EXPERIENCE']['VALUE']; unset($arResult['DISPLAY_PROPERTIES']['ATT_EXPERIENCE']) ?></span>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult['DISPLAY_PROPERTIES']['ATT_SALARY']['VALUE'])): ?>
                    <i class="fa fa-money pr-10"></i><b><?= Loc::getMessage('EXPECTED_SALARY') ?>: </b>
                    <span><?= $arResult['DISPLAY_PROPERTIES']['ATT_SALARY']['VALUE']; unset($arResult['DISPLAY_PROPERTIES']['ATT_SALARY']) ?></span>
                <? endif; ?>
                <? foreach ($arResult['DISPLAY_PROPERTIES'] as $property): ?>

                    <li>
                        <i class="fa fa-check pr-10">
                        </i>
                        <span>
                            <?= $property['NAME'] ?>:
                            <? if(!empty($property["VALUE"])): ?>
                                <?if(is_array($property["VALUE"])):?>
                                    <?= implode(", ", $property["VALUE"]); ?>
                                <?else:?>
                                    <?= $property["VALUE"]; ?>
                                <?endif?>
                            <? else: ?>
                                Не указано
                            <? endif; ?>
                        </span>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
    <ul class="pager">
        <li class="previous"><a href="#"><?= Loc::getMessage('PREVIOUS') ?></a></li>
        <li class="next"><a href="#"><?= Loc::getMessage('NEXT') ?></a></li>
    </ul>
    <hr>

<? if (!empty($arResult["ACHIEVEMENTS"])): ?>
    <!--recent work start-->
    <div class="row">
        <div class="col-lg-12 recent">
            <h3><?= Loc::getMessage('MY_ACHIEVEMENTS_TITLE') ?></h3>
            <p><?= Loc::getMessage('MY_ACHIEVEMENTS_DESCRIPTION') ?></p>
            <div id="owl-demo" class="owl-carousel owl-theme wow fadeIn">
                <? foreach ($arResult["ACHIEVEMENTS"] as $achievementFile): ?>
                    <div class="item view view-tenth">
                        <a href="<?= $achievementFile["SRC"] ?>" data-lightbox="achievements"
                           data-title="<?= $achievementFile["DESCRIPTION"] ?>">
                            <img src="<?= $achievementFile["PREVIEW_SRC"] ?>"
                                 alt="<?= $achievementFile["DESCRIPTION"] ?>">
                        </a>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
    <!--recent work end-->
<? endif; ?>