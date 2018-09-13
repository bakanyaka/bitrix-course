<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */

/** @global CMain $APPLICATION */

use Bitrix\Iblock;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\Date;

if (!isset($arParams["CACHE_TIME"]))
    $arParams["CACHE_TIME"] = 300;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
if (strlen($arParams["IBLOCK_TYPE"]) <= 0)
    $arParams["IBLOCK_TYPE"] = "news";
if ($arParams["IBLOCK_TYPE"] == "-")
    $arParams["IBLOCK_TYPE"] = "";

if (!is_array($arParams["IBLOCKS"]))
    $arParams["IBLOCKS"] = [$arParams["IBLOCKS"]];
foreach ($arParams["IBLOCKS"] as $k => $v)
    if (!$v)
        unset($arParams["IBLOCKS"][$k]);

if (!is_array($arParams["FIELD_CODE"]))
    $arParams["FIELD_CODE"] = [];
foreach ($arParams["FIELD_CODE"] as $key => $val)
    if (!$val)
        unset($arParams["FIELD_CODE"][$key]);

$arParams["SORT_BY1"] = trim($arParams["SORT_BY1"]);
if (strlen($arParams["SORT_BY1"]) <= 0)
    $arParams["SORT_BY1"] = "ACTIVE_FROM";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER1"]))
    $arParams["SORT_ORDER1"] = "DESC";

if (strlen($arParams["SORT_BY2"]) <= 0)
    $arParams["SORT_BY2"] = "SORT";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER2"]))
    $arParams["SORT_ORDER2"] = "ASC";

$arParams["NEWS_COUNT"] = intval($arParams["NEWS_COUNT"]);
if ($arParams["NEWS_COUNT"] <= 0)
    $arParams["NEWS_COUNT"] = 20;

$arParams["DETAIL_URL"] = trim($arParams["DETAIL_URL"]);

$arParams["ACTIVE_DATE_FORMAT"] = trim($arParams["ACTIVE_DATE_FORMAT"]);
if (strlen($arParams["ACTIVE_DATE_FORMAT"]) <= 0)
    $arParams["ACTIVE_DATE_FORMAT"] = $DB->DateFormatToPHP(CSite::GetDateFormat("SHORT"));

if ($this->startResultCache(false, ($arParams["CACHE_GROUPS"] === "N" ? false : $USER->GetGroups()))) {
    if (!Loader::includeModule("iblock")) {
        $this->abortResultCache();
        ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        return;
    }
    $arSelect = array_merge($arParams["FIELD_CODE"], [
        "ID",
        "IBLOCK_ID",
        "ACTIVE_FROM",
        "DETAIL_PAGE_URL",
        "NAME",
    ]);

    $arFilter = [
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCKS"],
        "ACTIVE" => "Y",
        "CHECK_PERMISSIONS" => "Y",
    ];
    if (!empty($arParams["LAST_DAYS"])) {
        $activeFrom = (new Date())->add($arParams["LAST_DAYS"] . ' days');
        $arFilter["<=DATE_ACTIVE_FROM"] = $activeFrom;
    }
    if ($arParams["SHOW_FINISHED"] !== "Y") {
        $arFilter[">=DATE_ACTIVE_FROM"] = new Date();
    }
    $arOrder = [
        $arParams["SORT_BY1"] => $arParams["SORT_ORDER1"],
        $arParams["SORT_BY2"] => $arParams["SORT_ORDER2"],
    ];
    if (!array_key_exists("ID", $arOrder))
        $arOrder["ID"] = "DESC";
    $arResult = [
        "ITEMS" => [],
    ];
    $rsItems = CIBlockElement::GetList($arOrder, $arFilter, false, ["nTopCount" => $arParams["NEWS_COUNT"]], $arSelect);
    $rsItems->SetUrlTemplates($arParams["DETAIL_URL"]);
    while ($arItem = $rsItems->GetNext()) {
        $arButtons = CIBlock::GetPanelButtons(
            $arItem["IBLOCK_ID"],
            $arItem["ID"],
            0,
            ["SECTION_BUTTONS" => false, "SESSID" => false]
        );
        $arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
        $arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

        if (strlen($arItem["ACTIVE_FROM"]) > 0)
            $arItem["DISPLAY_ACTIVE_FROM"] = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arItem["ACTIVE_FROM"], CSite::GetDateFormat()));
        else
            $arItem["DISPLAY_ACTIVE_FROM"] = "";

        $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arItem["IBLOCK_ID"], $arItem["ID"]);
        $arItem["IPROPERTY_VALUES"] = $ipropValues->getValues();

        Iblock\Component\Tools::getFieldImageData(
            $arItem,
            ['PREVIEW_PICTURE', 'DETAIL_PICTURE'],
            Iblock\Component\Tools::IPROPERTY_ENTITY_ELEMENT,
            'IPROPERTY_VALUES'
        );

        if (!empty($arItem["PREVIEW_PICTURE"])) {
            $thumbnailPicture = CFile::ResizeImageGet(
                $arItem['PREVIEW_PICTURE'],
                ['width' => $arParams["THUMBNAIL_WIDTH"] ?? 100, 'height' => $arParams["THUMBNAIL_HEIGHT"] ?? 100],
                BX_RESIZE_IMAGE_EXACT,
                true
            );
        } elseif (!empty($arItem["DETAIL_PICTURE"])) {
            $thumbnailPicture = CFile::ResizeImageGet(
                $arItem['DETAIL_PICTURE'],
                ['width' => $arParams["THUMBNAIL_WIDTH"] ?? 100, 'height' => $arParams["THUMBNAIL_HEIGHT"] ?? 100],
                BX_RESIZE_IMAGE_EXACT,
                true
            );
        }
        $arItem["THUMBNAIL_PICTURE"] =  isset($thumbnailPicture) ? array_change_key_case($thumbnailPicture, CASE_UPPER) : [];
        $arResult["ITEMS"][] = $arItem;
        $arResult["LAST_ITEM_IBLOCK_ID"] = $arItem["IBLOCK_ID"];
    }
    $this->setResultCacheKeys([
        "LAST_ITEM_IBLOCK_ID",
    ]);
    $this->includeComponentTemplate();
}

if (
    $arResult["LAST_ITEM_IBLOCK_ID"] > 0
    && $USER->IsAuthorized()
    && $APPLICATION->GetShowIncludeAreas()
    && CModule::IncludeModule("iblock")
) {
    $arButtons = CIBlock::GetPanelButtons($arResult["LAST_ITEM_IBLOCK_ID"], 0, 0, ["SECTION_BUTTONS" => false]);
    $this->addIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));
}