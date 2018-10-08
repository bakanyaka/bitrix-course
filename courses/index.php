<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Учебные курсы");
?>
    <div class="container">
        <div class="row">
            <? $APPLICATION->IncludeComponent(
                "my:courses.list",
                "",
                Array(
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "DO_NOT_DISPLAY_IBLOCK_ID" => array("7"),
                    "TRAINING_IBLOCK_TYPE" => "training"
                )
            ); ?>
        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>