<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
    'NAME' => Loc::getMessage('COURSES_LIST_COMPONENT_NAME'),
    'DESCRIPTION' => Loc::getMessage('COURSES_LIST_COMPONENT_DESCRIPTION'),
    'SORT' => 10,
    'PATH' => array(
        'ID' => 'courses',
        'NAME' => Loc::getMessage('COURSES_LIST_COMPONENT_GROUP'),
        'SORT' => 10,
    )
);