<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc as Loc;

if (!CModule::IncludeModule("iblock"))
    return;

Loc::loadMessages(__FILE__);

$site = ($_REQUEST["site"] <> '' ? $_REQUEST["site"] : ($_REQUEST["src_site"] <> '' ? $_REQUEST["src_site"] : false));
$arFilter = [
    "TYPE_ID" => "CONTACT_FORM",
    "ACTIVE" => "Y"];
if ($site !== false) {
    $arFilter["LID"] = $site;
}

$arEvent = [];
$dbType = CEventMessage::GetList($by = "ID", $order = "DESC", $arFilter);
while ($arType = $dbType->GetNext()) {
    $arEvent[$arType["ID"]] = "[{$arType["ID"]}] {$arType["SUBJECT"]}";
}

$iBlockTypes = CIBlockParameters::GetIBlockTypes();
$iBlocks = [];
$db_iblock = CIBlock::GetList(
    ["SORT" => "ASC"],
    [
        "SITE_ID" => $_REQUEST["site"],
        "TYPE" => ($arCurrentValues["IBLOCK_TYPE"] != "-" ? $arCurrentValues["IBLOCK_TYPE"] : "")
    ]
);
while ($arRes = $db_iblock->Fetch())
    $iBlocks[$arRes["ID"]] = "[{$arRes["ID"]}] {$arRes["NAME"]}";


$arComponentParameters = [
    "GROUPS" => [
    ],
    "PARAMETERS" => [
        "RESUMES_IBLOCK_TYPE" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("VACANCIES_RESPONSE_PARAMETERS_RESUMES_IBLOCK_TYPE"),
            "TYPE" => "LIST",
            "VALUES" => $iBlockTypes,
            "DEFAULT" => "resume",
            "REFRESH" => "Y",
        ],
        "RESUMES_IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("VACANCIES_RESPONSE_PARAMETERS_RESUMES_IBLOCK_ID"),
            "TYPE" => "LIST",
            "VALUES" => $iBlocks,
            "DEFAULT" => '',
            "MULTIPLE" => "Y",
        ],
        "VACANCY_ID" => [
            "NAME" => GetMessage("VACANCIES_RESPONSE_PARAMETERS_VACANCY_ID"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
            "DEFAULT" => '={$_REQUEST["VACANCY_ID"]}',
        ],
        "HIGHLOAD_BLOCK_ID" => [
            "NAME" => GetMessage("VACANCIES_RESPONSE_PARAMETERS_HIGHLOAD_BLOCK_ID"),
            "TYPE" => "STRING",
            "DEFAULT" => "",
            "PARENT" => "BASE",
        ],
        "EVENT_MESSAGE_ID" => [
            "NAME" => GetMessage("VACANCIES_RESPONSE_PARAMETERS_EMAIL_TEMPLATES"),
            "TYPE" => "LIST",
            "VALUES" => $arEvent,
            "DEFAULT" => "",
            "MULTIPLE" => "Y",
            "COLS" => 25,
            "PARENT" => "BASE",
        ],
        "CACHE_TIME" => ["DEFAULT" => "0"],
    ]
];