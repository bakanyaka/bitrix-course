<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
if (!CModule::IncludeModule("iblock"))
    return false;

$iBlocks = [];

$dbIBlock  = CIBlock::GetList(
    [
        "SORT" => "ASC",
        "NAME" => "ASC"
    ],
    [
        "CHECK_PERMISSIONS" => "Y",
    ]
);

while ($arIBlock = $dbIBlock->GetNext()) {
    $iBlocks[$arIBlock["ID"]] = "[" . $arIBlock["ID"] . "] " . $arIBlock["NAME"];
}

$periodOptions = [
    1 => 'Сутки',
    7 => 'Неделя',
    30 => 'Месяц',
    120 => 'Квартал',
    365 => 'Год',
    0 => 'Все время'
];

$arParameters = [
    "PARAMETERS" => [
    ],
    "USER_PARAMETERS" => [
        "IBLOCK_ID" => [
            "NAME" => GetMessage("GD_RESUME_PARAM_IBLOCK_ID"),
            "TYPE" => "LIST",
            "VALUES" => $iBlocks,
            "MULTIPLE" => "N",
            "DEFAULT" => '',
            "REFRESH" => "Y"
        ],
        "PERIOD_DAYS" => [
            "NAME" => GetMessage("GD_RESUME_PARAM_PERIOD"),
            "TYPE" => "LIST",
            "VALUES" => $periodOptions,
            "MULTIPLE" => "N",
            "DEFAULT" => 7
        ],
    ]
];