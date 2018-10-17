<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->SetTitle($arParams["PAGE_NAME_ADD"]);
$APPLICATION->AddChainItem($arParams["PAGE_NAME_ADD"]);
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:iblock.element.add.form",
    "",
    Array(
//        "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
//        "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
//        "CUSTOM_TITLE_DETAIL_PICTURE" => "",
//        "CUSTOM_TITLE_DETAIL_TEXT" => "",
//        "CUSTOM_TITLE_IBLOCK_SECTION" => "",
//        "CUSTOM_TITLE_NAME" => "",
//        "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
//        "CUSTOM_TITLE_PREVIEW_TEXT" => "",
//        "CUSTOM_TITLE_TAGS" => "",
//        "DEFAULT_INPUT_SIZE" => "30",
//        "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
//        "ELEMENT_ASSOC" => "CREATED_BY",
        "GROUPS" => $arParams["GROUPS"],
        "IBLOCK_ID" => $arParams["ADD_IBLOCK_ID"],
        "IBLOCK_TYPE" => $arParams["ADD_IBLOCK_TYPE"],
//        "LEVEL_LAST" => "Y",
        "LIST_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["added"],
//        "MAX_FILE_SIZE" => "0",
//        "MAX_LEVELS" => "100000",
//        "MAX_USER_ENTRIES" => "100000",
//        "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
        "PROPERTY_CODES" => $arParams["ADD_FORM_PROPERTY_CODES"],
        "PROPERTY_CODES_REQUIRED" => $arParams["ADD_FORM_PROPERTY_CODES_REQUIRED"],
//        "RESIZE_IMAGES" => "N",
        "SEF_MODE" => $arParams["SEF_MODE"],
//        "STATUS" => "ANY",
//        "STATUS_NEW" => "N",
//        "USER_MESSAGE_ADD" => "",
//        "USER_MESSAGE_EDIT" => "",
//        "USE_CAPTCHA" => "N"
    )
);?><br>
