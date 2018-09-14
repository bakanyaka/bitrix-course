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
    <div class="price-two-container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
                    <?= $arResult["NAV_STRING"] ?><br/>
                <? endif; ?>
            </div>
        </div>
        <? foreach (array_chunk($arResult["ITEMS"], 3) as $row): ?>
            <div class="row">
                <? foreach ($row as $index => $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="col-md-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="pricing-table-two wow fadeInUp">
                            <div class="inner">
                                <div class="title">
                                    <?= "{$arItem['DISPLAY_PROPERTIES']['ATT_SURNAME']['VALUE']} {$arItem['DISPLAY_PROPERTIES']['ATT_FIRST_NAME']['VALUE']} {$arItem['DISPLAY_PROPERTIES']['ATT_MIDDLE_NAME']['VALUE']}" ?>
                                    <? if (!empty($arItem['DISPLAY_PROPERTIES']['ATT_SALARY'])): ?>
                                        <div class="price">
                                            <?= $arItem['DISPLAY_PROPERTIES']['ATT_SALARY']['VALUE'] ?>
                                        </div>
                                    <? endif; ?>
                                </div>
                                <p class="desc">
                                    <?= $arItem['NAME'] ?>
                                </p>
                                <p class="desc text-error">
                                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="text-error">
                                        <?= Loc::getMessage('READ_MORE') ?>
                                    </a>
                                </p>
                                <ul class="items">
                                    <? foreach ($arItem['DISPLAY_PROPERTIES'] as $property): ?>

                                            <li class="available">
                                                <div class="icon-holder">
                                                    <i class="fa fa-check text-success ">
                                                    </i>
                                                </div>
                                                <div class="desc">
                                            <span class="text-black">
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
                                                </div>
                                            </li>
                                    <? endforeach; ?>
                                </ul>
                                <div class="price-actions">
                                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="btn">
                                        <?= Loc::getMessage('READ_MORE') ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        <? endforeach; ?>
        <div class="row">
            <div class="col-xs-12 text-center">
                <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                    <?= $arResult["NAV_STRING"] ?>
                <? endif; ?>
            </div>
        </div>
    </div>
