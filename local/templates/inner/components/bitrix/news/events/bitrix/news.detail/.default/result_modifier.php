<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult['TAGS'])) {
    $tags = explode(',',$arResult['TAGS']);
    $arResult['TAGS'] = array_map('trim', $tags);
}

if (!empty($arResult["PREVIEW_TEXT"])) {
    $arResult["META_DESCRIPTION"] = trim(substr(strip_tags($arResult["PREVIEW_TEXT"]), 0, 50));
    $this->getComponent()->setResultCacheKeys(['META_DESCRIPTION']);
}

if (!empty($arResult["CREATED_BY"])) {
    $user = CUser::GetByID($arResult["CREATED_BY"]);
    $userArr = $user->Fetch();
    $arResult['CREATED_USER_LOGIN'] = $userArr["LOGIN"];
    $this->getComponent()->setResultCacheKeys(['CREATED_USER_LOGIN']);
}
