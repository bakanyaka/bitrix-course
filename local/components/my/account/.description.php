<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_DESCRIPTION_NAME'),
    "DESCRIPTION" => Loc::getMessage('ACCOUNT_COMPONENT_DESCRIPTION_DESCRIPTION'),
    "SORT" => 10,
    "PATH" => [
        "ID" => 'account',
        "NAME" => Loc::getMessage('ACCOUNT_COMPONENT_DESCRIPTION_GROUP'),
        "SORT" => 10,
    ],
];

?>