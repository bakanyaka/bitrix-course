<?php
foreach ($arResult['ITEMS'] as $index => $arItem) {
    if (!empty($arItem['TAGS'])) {
        $tags = explode(',',$arItem['TAGS']);
        $arResult['ITEMS'][$index]['TAGS'] = array_map('trim', $tags);
    }
}