<?

use Bitrix\Main\Localization\Loc;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Онлайн-сервис \"Биржа труда\"");
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:news.line",
    "slider_home",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "300",
        "CACHE_TYPE" => "A",
        "DETAIL_URL" => "",
        "FIELD_CODE" => array("NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "PROPERTY_URL_TO"),
        "IBLOCKS" => array("10"),
        "IBLOCK_TYPE" => "sliders",
        "NEWS_COUNT" => "20",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC"
    )
); ?>

    <div class="container">
        <div class="row mar-b-50">
            <div class="col-md-12">
                <div class="text-center feature-head wow fadeInDown">
                    <h1 class="">
                        <? $APPLICATION->ShowTitle(false) ?>
                    </h1>

                </div>


                <div class="feature-box">
                    <div class="col-md-4 col-sm-4 text-center wow fadeInUp">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/home/feature_box_1.php"
                            )
                        ); ?>
                    </div>
                    <div class="col-md-4 col-sm-4 text-center wow fadeInUp">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/home/feature_box_2.php"
                            )
                        ); ?>
                    </div>
                    <div class="col-md-4 col-sm-4 text-center wow fadeInUp">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/home/feature_box_3.php"
                            )
                        ); ?>
                    </div>
                </div>

                <!--feature end-->
            </div>
        </div>
    </div>


    <!--property start-->
    <div class="property gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 text-center wow fadeInLeft">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/home/featured_image.php"
                        )
                    ); ?>
                </div>
                <div class="col-lg-6 col-sm-6 wow fadeInRight">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/home/featured_text.php"
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
    <!--property end-->

    <div class="container">

        <div class="row mar-b-60">
            <div class="col-lg-6">
                <!--tab start-->
                <section class="tab wow fadeInLeft">
                    <header class="panel-heading tab-bg-dark-navy-blue">
                        <ul class="nav nav-tabs nav-justified ">
                            <li class="active">
                                <a data-toggle="tab" href="#new-resumes">
                                    <?= Loc::getMessage('NEW_RESUMES') ?>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#events">
                                    <?= Loc::getMessage('CURRENT_EVENTS') ?>
                                </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#notice-board">
                                    <?= Loc::getMessage('NEW_VACANCIES') ?>
                                </a>
                            </li>
                        </ul>
                    </header>
                    <div class="panel-body">
                        <div class="tab-content tasi-tab">
                            <div id="new-resumes" class="tab-pane fade in active">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:news.line",
                                    "new_resumes_home",
                                    array(
                                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "31536000",
                                        "CACHE_TYPE" => "A",
                                        "DETAIL_URL" => "",
                                        "FIELD_CODE" => array(
                                            0 => "NAME",
                                            1 => "PREVIEW_PICTURE",
                                            2 => "PROPERTY_ATT_EXPERIENCE",
                                            3 => "PROPERTY_ATT_SALARY",
                                            4 => "",
                                        ),
                                        "IBLOCKS" => array(
                                            0 => "5",
                                        ),
                                        "IBLOCK_TYPE" => "resume",
                                        "NEWS_COUNT" => "3",
                                        "SORT_BY1" => "TIMESTAMP_X",
                                        "SORT_BY2" => "SORT",
                                        "SORT_ORDER1" => "DESC",
                                        "SORT_ORDER2" => "ASC",
                                        "COMPONENT_TEMPLATE" => "new_resumes_home"
                                    ),
                                    false
                                ); ?>
                            </div>
                            <div id="events" class="tab-pane fade">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:news.line",
                                    "current_events_home",
                                    array(
                                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "31536000",
                                        "CACHE_TYPE" => "A",
                                        "DETAIL_URL" => "",
                                        "FIELD_CODE" => array(
                                            0 => "NAME",
                                            1 => "",
                                        ),
                                        "IBLOCKS" => array(
                                            0 => "6",
                                        ),
                                        "IBLOCK_TYPE" => "events",
                                        "NEWS_COUNT" => "4",
                                        "SORT_BY1" => "TIMESTAMP_X",
                                        "SORT_BY2" => "SORT",
                                        "SORT_ORDER1" => "DESC",
                                        "SORT_ORDER2" => "ASC",
                                        "COMPONENT_TEMPLATE" => "current_events_home"
                                    ),
                                    false
                                ); ?>
                            </div>
                            <div id="notice-board" class="tab-pane fade">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:news.line",
                                    "new_vacancies_home",
                                    Array(
                                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "31536000",
                                        "CACHE_TYPE" => "A",
                                        "DETAIL_URL" => "",
                                        "FIELD_CODE" => array(
                                            0 => "NAME",
                                            1 => "PREVIEW_PICTURE",
                                            3 => "PROPERTY_ATT_SALARY",
                                        ),
                                        "IBLOCKS" => array("8"),
                                        "IBLOCK_TYPE" => "vacancies",
                                        "NEWS_COUNT" => "3",
                                        "SORT_BY1" => "TIMESTAMP_X",
                                        "SORT_BY2" => "SORT",
                                        "SORT_ORDER1" => "DESC",
                                        "SORT_ORDER2" => "ASC",
                                        "COMPONENT_TEMPLATE" => "new_vacancies_home"
                                    )
                                ); ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!--tab end-->
            </div>

        </div>
    </div>
    <!--container end-->

<? $APPLICATION->IncludeComponent(
    "bitrix:news.line",
    "instructors_list_home",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "31536000",
        "CACHE_TYPE" => "A",
        "DETAIL_URL" => "",
        "FIELD_CODE" => array("NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", ""),
        "IBLOCKS" => array("7"),
        "IBLOCK_TYPE" => "training",
        "NEWS_COUNT" => "3",
        "SORT_BY1" => "NAME",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "COMPONENT_TEMPLATE" => "instructors_list_home"
    )
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>