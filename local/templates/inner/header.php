<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
require __DIR__ . '/../.default/include/_header.php';

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<!--breadcrumbs start-->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <h1>
                    <? $APPLICATION->ShowTitle() ?>
                </h1>
            </div>
            <div class="col-lg-8 col-sm-8">
                <ol class="breadcrumb pull-right">
                    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", Array(
                        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                    ),
                        false
                    ); ?>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->
