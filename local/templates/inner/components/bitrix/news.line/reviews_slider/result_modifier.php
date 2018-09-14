<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['ITEMS'] as $index => $arItem) {
    // Generate preview picture from detail picture
    if (!empty($arItem['DETAIL_PICTURE'])) {
        $fileTemp = CFile::ResizeImageGet(
            $arItem['DETAIL_PICTURE'],
            ['width' => 100, 'height' => 100],
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $fileTemp['src'] = CUtil::GetAdditionalFileURL($fileTemp['src'], true);
        $arResult['ITEMS'][$index]['PREVIEW_PICTURE'] = array_change_key_case($fileTemp, CASE_UPPER);
    }

    if (empty($arItem['PREVIEW_TEXT'])) {
        if (strlen($arItem['DETAIL_TEXT']) > 200) {
            $arResult['ITEMS'][$index]['PREVIEW_TEXT'] = substr($arItem['DETAIL_TEXT'], 0, 200) . "...";
        } else {
            $arResult['ITEMS'][$index]['PREVIEW_TEXT'] = $arItem['DETAIL_TEXT'];
        }
    }
}