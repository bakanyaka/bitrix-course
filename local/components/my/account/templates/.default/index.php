<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<ul class="list-unstyled">
    <li>
        <i class="fa fa-angle-right pr-10"></i>
        <a href="<?= $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["account"] ?>"><?= $arParams["PAGE_NAME_ACCOUNT"] ?></a>
    </li>
    <li>
        <i class="fa fa-angle-right pr-10"></i>
        <a href="<?= $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["list"] ?>"><?= $arParams["PAGE_NAME_LIST"] ?></a>
    </li>
    <li>
        <i class="fa fa-angle-right pr-10"></i>
        <a href="<?= $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["add"] ?>"><?= $arParams["PAGE_NAME_ADD"] ?></a>
    </li>
    <li>
        <i class="fa fa-angle-right pr-10"></i>
        <a href="<?= $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["added"] ?>"><?= $arParams["PAGE_NAME_ADDED"] ?></a>
    </li>
</ul>



