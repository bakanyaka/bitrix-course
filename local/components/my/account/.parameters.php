<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Iblock\PropertyTable;
use Bitrix\Main;
use Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__);

try {
    if (!Main\Loader::includeModule('iblock'))
        throw new Main\LoaderException(Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_IBLOCK_MODULE_NOT_INSTALLED'));

    // IBlock types
    $iBlockTypes = \CIBlockParameters::GetIBlockTypes();

    // IBlock view list
    $viewIBlocks = [0 => ""];
    if (isset($arCurrentValues['VIEW_IBLOCK_TYPE']) && strlen($arCurrentValues['VIEW_IBLOCK_TYPE'])) {
        $filter = [
            'TYPE' => $arCurrentValues['VIEW_IBLOCK_TYPE'],
            'ACTIVE' => 'Y'
        ];
        $iterator = \CIBlock::GetList(['SORT' => 'ASC'], $filter);
        while ($iblock = $iterator->GetNext()) {
            $viewIBlocks[$iblock['ID']] = $iblock['NAME'];
        }
    }

    // IBlock add list
    $addIBlocks = [0 => ""];
    if (isset($arCurrentValues['ADD_IBLOCK_TYPE']) && strlen($arCurrentValues['ADD_IBLOCK_TYPE'])) {
        $filter = [
            'TYPE' => $arCurrentValues['ADD_IBLOCK_TYPE'],
            'ACTIVE' => 'Y'
        ];
        $iterator = \CIBlock::GetList(['SORT' => 'ASC'], $filter);
        while ($iblock = $iterator->GetNext()) {
            $addIBlocks[$iblock['ID']] = $iblock['NAME'];
        }
    }

    $sortFields = [
        'ID' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_SORT_ID'),
        'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_SORT_NAME'),
        'ACTIVE_FROM' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_SORT_ACTIVE_FROM'),
        'SORT' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_SORT_SORT')
    ];

    $sortDirection = [
        'ASC' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_SORT_ASC'),
        'DESC' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_SORT_DESC')
    ];

    // Element list templates
    $arTemplateInfo = CComponentUtil::GetTemplatesList('bitrix:news.list');
    $newsListTemplates = [];
    foreach ($arTemplateInfo as $template) {
        $name = $template["NAME"];
        $newsListTemplates[$name] = $name;
    }

    // Element detail templates
    $arTemplateInfo = CComponentUtil::GetTemplatesList('bitrix:news.detail');
    $newsDetailTemplates = [];
    foreach ($arTemplateInfo as $template) {
        $name = $template["NAME"];
        $newsDetailTemplates[$name] = $name;
    }

    // Element list properties
    $elementListProperties = [];
    $elementListPropertiesCollection = PropertyTable::getList([
        'select' => ['ID', 'CODE', 'NAME'],
        'filter' => [
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $arCurrentValues['VIEW_IBLOCK_ID'],
        ],
        'order' => [
            "SORT" => 'ASC',
            'NAME' => 'ASC'
        ]
    ])->fetchCollection();
    foreach ($elementListPropertiesCollection as $property) {
        $elementListProperties[$property['CODE']] = "[{$property['CODE']}] {$property['NAME']}";
    }

    // Element add properties
    $elementAddProperties = [];
    $elementAddPropertiesCollection = PropertyTable::getList([
        'select' => ['ID', 'CODE', 'NAME'],
        'filter' => [
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $arCurrentValues['ADD_IBLOCK_ID'],
        ],
        'order' => [
            "SORT" => 'ASC',
            'NAME' => 'ASC'
        ]
    ])->fetchCollection();
    foreach ($elementAddPropertiesCollection as $property) {
        $elementAddProperties[$property['CODE']] = "[{$property['CODE']}] {$property['NAME']}";
    }

    // Element add form properties
    $elementAddFormProperties = CIBlockParameters::GetFieldCode("", "")["VALUES"];
    foreach ($elementAddPropertiesCollection as $property) {
        $elementAddFormProperties[$property['ID']] = "[{$property['CODE']}] {$property['NAME']}";
    }

    // User group list
    $groups = array();
    $rsGroups = CGroup::GetList($by = "c_sort", $order = "asc", Array("ACTIVE" => "Y"));
    while ($arGroup = $rsGroups->Fetch()) {
        $groups[$arGroup["ID"]] = $arGroup["NAME"];
    }

    $arComponentParameters = [
        'GROUPS' => [
            "ACCESS" => [
                "SORT" => 100,
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_GROUPS_ACCESS')
            ],
            "PAGE_NAMES" => [
                "SORT" => 100,
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_GROUPS_PAGE_NAMES')
            ],
            "VIEW_SETTINGS" => [
                "SORT" => 100,
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_GROUPS_VIEW_SETTINGS')
            ],
            "VIEW_LIST_SETTINGS" => [
                "SORT" => 100,
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_GROUPS_VIEW_LIST_SETTINGS')
            ],
            "VIEW_DETAIL_SETTINGS" => [
                "SORT" => 100,
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_GROUPS_VIEW_DETAIL_SETTINGS')
            ],
            "ADD_SETTINGS" => [
                "SORT" => 100,
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_GROUPS_ADD_SETTINGS')
            ],
            "ADDED_LIST_SETTINGS" => [
                "SORT" => 100,
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_GROUPS_ADDED_LIST_SETTINGS')
            ]
        ],
        'PARAMETERS' => [
            "GROUPS" => [
                "PARENT" => "ACCESS",
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_GROUPS'),
                "TYPE" => "LIST",
                "MULTIPLE" => "Y",
                "ADDITIONAL_VALUES" => "N",
                "VALUES" => $groups,
            ],
            "ACCESS_DENIED_MESSAGE" => [
                "PARENT" => "ACCESS",
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_ACCESS_DENIED_MESSAGE_NAME'),
                "TYPE" => "STRING",
                "DEFAULT" => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_ACCESS_DENIED_MESSAGE_DEFAULT')
            ],
            'PAGE_NAME_ACCOUNT' => [
                'PARENT' => 'PAGE_NAMES',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_PAGE_NAME_ACCOUNT_NAME'),
                'TYPE' => 'STRING',
                'DEFAULT' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_PAGE_NAME_ACCOUNT_DEFAULT'),
            ],
            'PAGE_NAME_LIST' => [
                'PARENT' => 'PAGE_NAMES',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_PAGE_NAME_LIST_NAME'),
                'TYPE' => 'STRING',
                'DEFAULT' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_PAGE_NAME_LIST_DEFAULT'),
            ],
            'PAGE_NAME_DETAIL' => [
                'PARENT' => 'PAGE_NAMES',
                'NAME' =>  Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_PAGE_NAME_DETAIL_NAME'),
                'TYPE' => 'STRING',
                'DEFAULT' =>  Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_PAGE_NAME_DETAIL_DEFAULT')
            ],
            'PAGE_NAME_ADD' => [
                'PARENT' => 'PAGE_NAMES',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_PAGE_NAME_ADD_NAME'),
                'TYPE' => 'STRING',
                'DEFAULT' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_PAGE_NAME_ADD_DEFAULT')
            ],
            'PAGE_NAME_ADDED' => [
                'PARENT' => 'PAGE_NAMES',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_PAGE_NAME_ADDED_NAME'),
                'TYPE' => 'STRING',
                'DEFAULT' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_PAGE_NAME_ADDED_DEFAULT')
            ],
            'VIEW_IBLOCK_TYPE' => [
                'PARENT' => 'VIEW_SETTINGS',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_VIEW_IBLOCK_TYPE'),
                'TYPE' => 'LIST',
                'VALUES' => $iBlockTypes,
                'DEFAULT' => '',
                'REFRESH' => 'Y'
            ],
            'VIEW_IBLOCK_ID' => [
                'PARENT' => 'VIEW_SETTINGS',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_VIEW_IBLOCK_ID'),
                'TYPE' => 'LIST',
                'VALUES' => $viewIBlocks,
                'REFRESH' => 'Y'
            ],
            'VIEW_ELEMENTS_COUNT' => [
                'PARENT' => 'VIEW_LIST_SETTINGS',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_VIEW_ELEMENTS_COUNT'),
                'TYPE' => 'STRING',
                'DEFAULT' => '0'
            ],
            "LIST_TEMPLATE" => [
                "PARENT" => "VIEW_LIST_SETTINGS",
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_LIST_TEMPLATE_NAME'),
                "TYPE" => "LIST",
                "VALUES" => $newsListTemplates,
                "DEFAULT" => ".default",
            ],
            "LIST_FIELD_CODE" => CIBlockParameters::GetFieldCode(GetMessage("ACCOUNT_COMPONENT_PARAMETERS_LIST_FIELDS"), "VIEW_LIST_SETTINGS"),
            "LIST_PROPERTY_CODE" => [
                "PARENT" => "VIEW_LIST_SETTINGS",
                "NAME" => GetMessage("ACCOUNT_COMPONENT_PARAMETERS_LIST_PROPERTIES"),
                "TYPE" => "LIST",
                "MULTIPLE" => "Y",
                "VALUES" => $elementListProperties,
                "ADDITIONAL_VALUES" => "Y",
            ],
            "DETAIL_TEMPLATE" => [
                "PARENT" => "VIEW_DETAIL_SETTINGS",
                "NAME" => GetMessage("ACCOUNT_COMPONENT_PARAMETERS_DETAIL_TEMPLATE_NAME"),
                "TYPE" => "LIST",
                "VALUES" => $newsDetailTemplates,
                "DEFAULT" => ".default",
            ],
            "DETAIL_FIELD_CODE" => CIBlockParameters::GetFieldCode(GetMessage("ACCOUNT_COMPONENT_PARAMETERS_DETAIL_FIELDS"), "VIEW_DETAIL_SETTINGS"),
            "DETAIL_PROPERTY_CODE" => array(
                "PARENT" => "VIEW_DETAIL_SETTINGS",
                "NAME" => GetMessage("ACCOUNT_COMPONENT_PARAMETERS_DETAIL_PROPERTIES"),
                "TYPE" => "LIST",
                "MULTIPLE" => "Y",
                "VALUES" => $elementListProperties,
                "ADDITIONAL_VALUES" => "Y",
            ),
            'ADD_IBLOCK_TYPE' => [
                'PARENT' => 'ADD_SETTINGS',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_ADD_IBLOCK_TYPE'),
                'TYPE' => 'LIST',
                'VALUES' => $iBlockTypes,
                'DEFAULT' => '',
                'REFRESH' => 'Y'
            ],
            'ADD_IBLOCK_ID' => [
                'PARENT' => 'ADD_SETTINGS',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_ADD_IBLOCK_ID'),
                'TYPE' => 'LIST',
                'VALUES' => $addIBlocks,
                'REFRESH' => 'Y'
            ],
            "ADD_FORM_PROPERTY_CODES" => array(
                "PARENT" => "ADD_SETTINGS",
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_ADD_FORM_PROPERTY_CODES'),
                "TYPE" => "LIST",
                "MULTIPLE" => "Y",
                "VALUES" => $elementAddFormProperties,
            ),
            "ADD_FORM_PROPERTY_CODES_REQUIRED" => array(
                "PARENT" => "ADD_SETTINGS",
                "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_ADD_FORM_PROPERTY_CODES_REQUIRED'),
                "TYPE" => "LIST",
                "MULTIPLE" => "Y",
                "ADDITIONAL_VALUES" => "N",
                "VALUES" => $elementAddFormProperties,
            ),
            'SHOW_NAV' => [
                'PARENT' => 'BASE',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_SHOW_NAV'),
                'TYPE' => 'CHECKBOX',
                'DEFAULT' => 'N'
            ],
            'MY_ELEMENTS_COUNT' => [
                'PARENT' => 'ADDED_LIST_SETTINGS',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_MY_ELEMENTS_COUNT'),
                'TYPE' => 'STRING',
                'DEFAULT' => '0'
            ],
            'SORT_FIELD1' => [
                'PARENT' => 'BASE',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_SORT_FIELD1'),
                'TYPE' => 'LIST',
                'VALUES' => $sortFields
            ],
            'SORT_DIRECTION1' => [
                'PARENT' => 'BASE',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_SORT_DIRECTION1'),
                'TYPE' => 'LIST',
                'VALUES' => $sortDirection
            ],
            'SORT_FIELD2' => [
                'PARENT' => 'BASE',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_SORT_FIELD2'),
                'TYPE' => 'LIST',
                'VALUES' => $sortFields
            ],
            'SORT_DIRECTION2' => [
                'PARENT' => 'BASE',
                'NAME' => Loc::getMessage('ACCOUNT_COMPONENT_PARAMETERS_SORT_DIRECTION2'),
                'TYPE' => 'LIST',
                'VALUES' => $sortDirection
            ],
            'SEF_MODE' => [
                'account' => [
                    'NAME' => GetMessage('ACCOUNT_COMPONENT_PARAMETERS_ACCOUNT_PAGE'),
                    'DEFAULT' => 'me/',
                    'VARIABLES' => []
                ],
                'list' => [
                    "NAME" => GetMessage('ACCOUNT_COMPONENT_PARAMETERS_LIST_PAGE'),
                    "DEFAULT" => 'list/',
                    "VARIABLES" => []
                ],
                'detail' => [
                    "NAME" => GetMessage('ACCOUNT_COMPONENT_PARAMETERS_DETAIL_PAGE'),
                    "DEFAULT" => 'list/#ID#/',
                    "VARIABLES" => ['ID']
                ],
                'add' => [
                    "NAME" => GetMessage('ACCOUNT_COMPONENT_PARAMETERS_ADD_PAGE'),
                    "DEFAULT" => 'me/add/',
                    "VARIABLES" => []
                ],
                'added' => [
                    "NAME" => GetMessage('ACCOUNT_COMPONENT_PARAMETERS_MY_ELEMENTS_PAGE'),
                    "DEFAULT" => 'me/my_elements/',
                    "VARIABLES" => []
                ],
            ],
            'CACHE_TIME' => [
                'DEFAULT' => 31536000
            ]
        ]
    ];
} catch (Main\LoaderException $e) {
    ShowError($e->getMessage());
}
