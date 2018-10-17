<?php
$eventManager = \Bitrix\Main\EventManager::getInstance();

const APPLICANTS_USER_TYPE = 1;
const EMPLOYERS_USER_TYPE = 2;

$eventManager->addEventHandler("main", "OnBeforeUserRegister", function (&$arFields) {

    if (isset($arFields["UF_USERTYPE"]) && $arFields["UF_USERTYPE"] == APPLICANTS_USER_TYPE) {
        $groupStringId = 'applicants';
    } elseif (isset($arFields["UF_USERTYPE"]) && $arFields["UF_USERTYPE"] == EMPLOYERS_USER_TYPE) {
        $groupStringId = 'employers';
    } else {
        return false;
    }

    $rsGroup = CGroup::GetList($by = "c_sort", $order = "asc", ["STRING_ID" => $groupStringId]);
    if (!$group = $rsGroup->GetNext()) {
        return false;
    }
    $arFields["GROUP_ID"][] = $group['ID'];
    return true;
});