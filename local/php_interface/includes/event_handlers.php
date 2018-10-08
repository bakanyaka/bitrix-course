<?php
$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler("main", "OnBeforeUserRegister", function (&$arFields) {
    if (isset($arFields["UF_USERTYPE"]) && $arFields["UF_USERTYPE"] == 1) {
        $groupStringId = 'applicants';
    } elseif (isset($arFields["UF_USERTYPE"]) && $arFields["UF_USERTYPE"] == 2) {
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