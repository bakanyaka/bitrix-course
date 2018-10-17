<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->SetTitle($arParams["PAGE_NAME_ADDED"]);
$APPLICATION->AddChainItem($arParams["PAGE_NAME_ADDED"]);
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:iblock.element.add.list",
    "",
    Array(
        "ALLOW_DELETE" => "Y",
        "ALLOW_EDIT" => "Y",
        "EDIT_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["add"],
        "ELEMENT_ASSOC" => "CREATED_BY",
        "GROUPS" => $arParams['GROUPS'],
        "IBLOCK_ID" => $arParams['ADD_IBLOCK_ID'],
        "IBLOCK_TYPE" => $arParams['ADD_IBLOCK_TYPE'],
        "MAX_USER_ENTRIES" => "100000",
        "NAV_ON_PAGE" => $arParams['MY_ELEMENTS_COUNT'],
        "SEF_MODE" => $arParams["SEF_MODE"],
        "STATUS" => "ANY"
    ),
    $component
);?>
