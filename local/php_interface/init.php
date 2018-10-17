<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/includes/helpers.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/includes/event_handlers.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/includes/agents.php';

$arJsConfig = array(
    'chart' => array(
        'js' => '/local/js/Chart.bundle.min.js',
        'css' => '',
        'rel' => [],
    )
);

foreach ($arJsConfig as $ext => $arExt) {
    \CJSCore::RegisterExt($ext, $arExt);
}