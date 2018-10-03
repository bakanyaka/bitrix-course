<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
    'NAME' => Loc::getMessage('VACANCIES_RESPONSE_COMPONENT_NAME'),
    'DESCRIPTION' => Loc::getMessage('VACANCIES_RESPONSE_COMPONENT_DESCRIPTION'),
    'SORT' => 10,
    'PATH' => array(
        'ID' => 'vacancies',
        'NAME' => Loc::getMessage('VACANCIES_RESPONSE_COMPONENT_GROUP'),
        'SORT' => 10,
    )
);