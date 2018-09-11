<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<!--footer start-->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3 address wow fadeInUp" data-wow-duration="2s" data-wow-delay=".1s">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/footer_col_1.php"
                    )
                ); ?>
            </div>
            <div class="col-lg-3 col-sm-3 wow fadeInUp" data-wow-duration="2s" data-wow-delay=".3s">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/footer_col_2.php"
                    )
                ); ?>
            </div>
            <div class="col-lg-3 col-sm-3">
                <div class="page-footer wow fadeInUp" data-wow-duration="2s" data-wow-delay=".5s">
                    <? $APPLICATION->IncludeComponent("bitrix:menu", "footer_menu", Array(
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "",    // Тип меню для остальных уровней
                        "DELAY" => "N",    // Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                        "MENU_THEME" => "site",
                        "ROOT_MENU_TYPE" => "bottom",    // Тип меню для первого уровня
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                        false
                    ); ?>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/footer_col_4.php"
                    )
                ); ?>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->
<!--small footer start -->
<footer class="footer-small">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6 pull-right">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/social.php"
                    )
                ); ?>
            </div>
            <div class="col-md-4">
                <div class="copyright">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/copyright.php"
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    new WOW().init();
</script>