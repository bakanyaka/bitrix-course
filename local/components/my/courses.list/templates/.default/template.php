<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
$this->setFrameMode(true);
?>
<div class="courses-list">
    <ul class="list-unstyled">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <li>
                <i class="fa fa-angle-right pr-10"></i>
                <a style="vertical-align:middle;" href="<?=$arItem["LIST_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
            </li>
        <?endforeach?>
    </ul>
</div>