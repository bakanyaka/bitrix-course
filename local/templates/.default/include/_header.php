<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
$assets = \Bitrix\Main\Page\Asset::getInstance();
?>

<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <?
    /**
     * CSS
     */
    // Bootstrap core CSS
    $assets->addCss('/local/templates/.default/vendor/bootstrap/bootstrap-reset.css');
    $assets->addCss('/local/templates/.default/vendor/bootstrap/bootstrap.min.css');
    $assets->addCss('/local/templates/.default/vendor/bootstrap/theme.css');
    // Vendor CSS
    $assets->addCss('/local/templates/.default/vendor/font-awesome/css/font-awesome.css');
    /*    $assets->addCss('/local/templates/.default/vendor/flexslider/flexslider.css');
        $assets->addCss('/local/templates/.default/vendor/bxslider/jquery.bxslider.css');*/
    $assets->addCss('/local/templates/.default/vendor/animate/animate.css');
    //    $assets->addCss('/local/templates/.default/vendor/owlcarousel/owl.carousel.css');
    //    $assets->addCss('/local/templates/.default/vendor/owlcarousel/owl.theme.css');
    //    $assets->addCss('/local/templates/.default/vendor/superfish/superfish.css');


    // Template CSS
    $assets->addCss('/local/templates/.default/css/component.css');
    $assets->addCss('/local/templates/.default/css/style.css');
    $assets->addCss('/local/templates/.default/css/style-responsive.css');

    // Strings
    $assets->addString("<link rel='shortcut icon' href='/images/favicon.png'>");
    $assets->addString("<meta name='viewport' content='width=device-width, initial-scale=1.0'>");
    $assets->addString("<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>");

    // HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries
    $assets->addString("
<!--[if lt IE 9]>
<script src='/local/templates/.default/js/html5shiv.js'>
</script>
<![endif]-->
    ");

    /**
     * JS
     */
    $assets->addJs('/local/templates/.default/vendor/jquery/jquery-1.8.3.min.js');
    $assets->addJs('/local/templates/.default/vendor/bootstrap/bootstrap.min.js');
    $assets->addJs('/local/templates/.default/vendor/bootstrap/hover-dropdown.js');
    //    $assets->addJs('/local/templates/.default/vendor/jquery/jquery.flexslider.js');
    //    $assets->addJs('/local/templates/.default/vendor/bxslider/jquery.bxslider.js');
    $assets->addJs('/local/templates/.default/vendor/wow/wow.min.js');
    //    $assets->addJs('/local/templates/.default/vendor/owlcarousel/owl.carousel.js');
    //    $assets->addJs('/local/templates/.default/vendor/jquery/jquery.easing.min.js');
    //    $assets->addJs('/local/templates/.default/vendor/jquery/link-hover.js');
    //    $assets->addJs('/local/templates/.default/vendor/superfish/superfish.js');

    $assets->addJs('/local/templates/.default/js/common-scripts.js');

    $APPLICATION->ShowHead();
    ?>

    <title><? $APPLICATION->ShowTitle() ?></title>
</head>

<body>
<? $APPLICATION->ShowPanel(); ?>
<!--header start-->
<header class="head-section">
    <div class="navbar navbar-default navbar-static-top container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/logo.php"
                )
            ); ?>
        </div>
        <div class="navbar-collapse collapse">
            <? $APPLICATION->IncludeComponent(
                "bitrix:search.form",
                "header_search",
                array(
                    "COMPONENT_TEMPLATE" => "header_search",
                    "PAGE" => "#SITE_DIR#search/index.php",
                    "USE_SUGGEST" => "N"
                ),
                false
            ); ?>
            <? $APPLICATION->IncludeComponent("bitrix:menu", "header_menu", Array(
                "ROOT_MENU_TYPE" => "top",    // Тип меню для первого уровня
                "MAX_LEVEL" => "2",    // Уровень вложенности меню
                "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                "COMPONENT_TEMPLATE" => "header_menu",
                "MENU_THEME" => "site",    // Тема меню
                "DELAY" => "N",    // Откладывать выполнение шаблона меню
                "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
            ),
                false,
                array(
                    "ACTIVE_COMPONENT" => "Y"
                )
            ); ?>

        </div>
    </div>
</header>
<!--header end-->