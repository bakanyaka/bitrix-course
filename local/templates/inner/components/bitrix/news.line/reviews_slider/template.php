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
$this->setFrameMode(true);
?>
<div class="row">
    <div class='col-md-offset-2 col-md-8 text-center'>
        <h2>
            <?= GetMessage("BLOCK_NAME") ?>
        </h2>
    </div>
</div>
<div class="row">
    <div class="col-md-offset-2 col-md-8 mar-b-30">
        <div class="carousel slide" data-ride="carousel" id="quote-carousel">
            <!-- Bottom Carousel Indicators -->
            <ol class="carousel-indicators">
                <? for ($i = 0; $i < count($arResult["ITEMS"]); $i++): ?>
                    <li data-target="#quote-carousel" data-slide-to="<?= $i ?>"
                        class="<?= ($i == 0 ? "active" : "") ?>">
                    </li>
                <? endfor; ?>
            </ol>

            <!-- Carousel Slides / Quotes -->
            <div class="carousel-inner">

                <? foreach ($arResult["ITEMS"] as $index => $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
                         class="item <?= ($index == 0 ? "active" : "") ?>">
                        <blockquote>
                            <div class="row">
                                <div class="col-sm-3 text-center">
                                    <img class="img-circle" src=" <?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                         style="width: 100px;height:100px;" alt="">
                                </div>
                                <div class="col-sm-9">
                                    <p>
                                        <?= $arItem["PREVIEW_TEXT"]; ?>
                                    </p>
                                    <small>
                                        <?= $arItem["CREATED_USER_NAME"] ?>
                                    </small>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                <? endforeach; ?>

            </div>

        </div>

    </div>
</div>