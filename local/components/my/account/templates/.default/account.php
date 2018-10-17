<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->SetTitle($arParams["PAGE_NAME_ACCOUNT"]);
$APPLICATION->AddChainItem($arParams["PAGE_NAME_ACCOUNT"]);
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.profile",
    "",
    Array(),
    $component
);?>
<br>
<?$APPLICATION->IncludeComponent(
    "bitrix:subscribe.form",
    "",
    Array(
        "CACHE_TIME" => $arParams["CACHE_TYPE"],
        "CACHE_TYPE" => $arParams["CACHE_TIME"],
    ),
    $component
);?>