<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['ITEMS'] as $index => $arItem) {
    // Split comma separated tags
    if (!empty($arItem['TAGS'])) {
        $tags = explode(',',$arItem['TAGS']);
        $arResult['ITEMS'][$index]['TAGS'] = array_map('trim', $tags);
    }
    // Generate preview picture from detail picture
    if (!empty($arItem['DETAIL_PICTURE'])) {
        $fileTemp = CFile::ResizeImageGet(
            $arItem['DETAIL_PICTURE'],
            ['width' => 700, 'height' => 438],
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $fileTemp['src'] = CUtil::GetAdditionalFileURL($fileTemp['src'], true);
        $arResult['ITEMS'][$index]['PREVIEW_PICTURE'] = array_change_key_case($fileTemp, CASE_UPPER);
    }
}