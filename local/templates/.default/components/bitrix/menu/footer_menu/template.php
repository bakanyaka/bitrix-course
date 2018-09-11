<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <ul class="page-footer-list">
        <? foreach ($arResult as $arItem):
            if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            ?>
            <li>
                <i class="fa fa-angle-right"></i>
                <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
            </li>
        <? endforeach ?>
    </ul>
<? endif ?>