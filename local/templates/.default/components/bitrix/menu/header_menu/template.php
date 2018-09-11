<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <ul id="top-menu" class="nav navbar-nav">
    <?
    $previousLevel = 0;
    foreach ($arResult as $arItem): ?>
        <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
            <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
        <? endif ?>
        <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
            <? if ($arItem["IS_PARENT"]): ?>
                <li class="dropdown">
                    <a href="<?= $arItem["LINK"] ?>"
                       data-close-others="false"
                       data-delay="0"
                       data-hover="dropdown"
                       <? if ($arItem['PARAMS']['DISABLED']): ?>
                        data-toggle="dropdown"
                       <? endif ?>
                       class="dropdown-toggle">
                        <?= $arItem["TEXT"] ?>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
            <? else: ?>
                <li>
                    <a href="<?= $arItem["LINK"] ?>">
                        <?= $arItem["TEXT"] ?>
                    </a>
            <? endif ?>

        <? elseif ($arItem["DEPTH_LEVEL"] == 2): ?>
            <li>
            <a href="<?= $arItem["LINK"] ?>">
                <?= $arItem["TEXT"] ?>
            </a>
            </li>
        <? endif ?>

        <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

    <? endforeach ?>

    <? if ($previousLevel > 1)://close last item tags?>
        <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
    <? endif ?>

    </ul>
<? endif ?>