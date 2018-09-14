<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$previewWidth = 300;
$previewHeight = 260;

// Generate preview pictures for achievements
$achievements = [];
if (isset($arResult['DISPLAY_PROPERTIES']['ATT_ACHIEVEMENTS']['FILE_VALUE'])) {
    foreach ($arResult['DISPLAY_PROPERTIES']['ATT_ACHIEVEMENTS']['FILE_VALUE'] as $file) {

        $previewFile = \CFile::ResizeImageGet(
            $file,
            ['width' => $previewWidth, 'height' => $previewHeight],
            BX_RESIZE_IMAGE_EXACT,
            true
        );

        $file['PREVIEW_SRC'] = $previewFile['src'];
        $file['PREVIEW_WIDTH'] = $previewFile['width'];
        $file['PREVIEW_HEIGHT'] = $previewFile['height'];
        $file['PREVIEW_SIZE'] = $previewFile['size'];

        $achievements[] = $file;
    }
    unset($arResult['DISPLAY_PROPERTIES']['ATT_ACHIEVEMENTS']);
}
$arResult['ACHIEVEMENTS'] = $achievements;