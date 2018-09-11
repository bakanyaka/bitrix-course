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
<div class="row">
    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="col-md-6" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="blog-left wow fadeInLeft">
                <div class="blog-img">
                    <img src="img/blog/img8.jpg" alt=""/>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-two-info">
                            <p>
                                <i class="fa fa-user">
                                </i>
                                <?= Loc::getMessage('BY') ?>
                                <a href="#">
                                    <?= $arItem["CREATED_USER_NAME"] ?>
                                </a>
                                |
                                <i class="fa fa-calendar">
                                </i>
                                <?= $arItem["DISPLAY_ACTIVE_FROM"] ?>
                                <br>
                                <i class="fa fa-tags">
                                </i>
                                Tags :
                                <? foreach ($arItem["TAGS"] as $tag): ?>
                                <a href="/search/?tags=<?= $tag ?>">
                                  <span class="label label-info">
                                    <?= $tag ?>
                                  </span>
                                </a>
                                <? endforeach; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="blog-content">
                    <h3>
                        <?= $arItem["NAME"] ?>
                    </h3>
                    <div>
                        <?= $arItem["PREVIEW_TEXT"]; ?>
                    </div>
                </div>
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="btn btn-primary">
                    <?= Loc::getMessage('READ_MORE') ?>
                </a>

            </div>
        </div>
    <? endforeach; ?>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
</div>