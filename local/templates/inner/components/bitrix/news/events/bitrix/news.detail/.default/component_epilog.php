<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult["META_DESCRIPTION"])) {
    $APPLICATION->SetPageProperty('description', $arResult["META_DESCRIPTION"]);
}
