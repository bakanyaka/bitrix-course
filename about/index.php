<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>

    <!--container start-->
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/protected/slider_about.php"
                    )
                ); ?>
            </div>
            <div class="col-lg-7 about wow fadeInRight">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/about/about_company.php"
                    )
                ); ?>
            </div>
        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:news.line",
            "advantages",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "300",
                "CACHE_TYPE" => "A",
                "DETAIL_URL" => "",
                "FIELD_CODE" => array("NAME", "PREVIEW_TEXT", "PROPERTY_ICON"),
                "IBLOCKS" => array("9"),
                "IBLOCK_TYPE" => "about",
                "NEWS_COUNT" => "4",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC"
            )
        ); ?>

        <? $APPLICATION->IncludeComponent(
            "bitrix:news.line",
            "instructors",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "300",
                "CACHE_TYPE" => "A",
                "DETAIL_URL" => "",
                "FIELD_CODE" => array(
                    "NAME",
                    "PREVIEW_TEXT",
                    "PREVIEW_PICTURE",
                    "PROPERTY_URL_FACEBOOK",
                    "PROPERTY_URL_TWITTER",
                    "PROPERTY_URL_PINTEREST",
                    "PROPERTY_URL_LINKEDIN",
                    "PROPERTY_URL_GOOGLE_PLUS",
                    "PROPERTY_URL_GITHUB",
                ),
                "IBLOCKS" => array("7"),
                "IBLOCK_TYPE" => "training",
                "NEWS_COUNT" => "4",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC"
            )
        ); ?>
    </div>
    <!--container end-->

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>