<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc as Loc;

if (!CModule::IncludeModule("iblock"))
    return;

Loc::loadMessages(__FILE__);

$iBlockTypes = CIBlockParameters::GetIBlockTypes();
$iBlocks = [];
$db_iblock = CIBlock::GetList(
    ["SORT" => "ASC"],
    [
        "SITE_ID" => $_REQUEST["site"],
        "TYPE" => ($arCurrentValues["TRAINING_IBLOCK_TYPE"] != "-" ? $arCurrentValues["TRAINING_IBLOCK_TYPE"] : "")
    ]
);
while ($arRes = $db_iblock->Fetch())
    $iBlocks[$arRes["ID"]] = "[{$arRes["ID"]}] {$arRes["NAME"]}";


$arComponentParameters = [
    "GROUPS" => [
    ],
    "PARAMETERS" => [
        "TRAINING_IBLOCK_TYPE" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("COURSES_LIST_PARAMETERS_TRAINING_IBLOCK_TYPE"),
            "TYPE" => "LIST",
            "VALUES" => $iBlockTypes,
            "DEFAULT" => "resume",
            "REFRESH" => "Y",
        ],
        "DO_NOT_DISPLAY_IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("COURSES_LIST_PARAMETERS_DO_NOT_DISPLAY_IBLOCK_ID"),
            "TYPE" => "LIST",
            "VALUES" => $iBlocks,
            "DEFAULT" => '',
            "MULTIPLE" => "Y",
        ],
        "CACHE_TIME" => ["DEFAULT" => "36000000"],
    ]
];