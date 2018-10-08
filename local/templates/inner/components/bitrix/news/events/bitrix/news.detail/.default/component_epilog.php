<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult["META_DESCRIPTION"])) {
    $APPLICATION->SetPageProperty('description', $arResult["META_DESCRIPTION"]);
}

if (!empty($arResult["CREATED_USER_LOGIN"])) {
    $APPLICATION->SetPageProperty('title', "{$arResult["NAME"]} (добавил {$arResult["CREATED_USER_LOGIN"]})");
}
