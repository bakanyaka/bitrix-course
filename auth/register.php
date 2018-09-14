<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:main.register",
    "",
    Array(
        "AUTH" => "Y",
        "REQUIRED_FIELDS" => array("EMAIL", "NAME", "SECOND_NAME", "LAST_NAME", "PERSONAL_GENDER", "PERSONAL_CITY", "PERSONAL_COUNTRY"),
        "SET_TITLE" => "Y",
        "SHOW_FIELDS" => array("EMAIL", "NAME", "SECOND_NAME", "LAST_NAME", "PERSONAL_GENDER", "PERSONAL_CITY", "PERSONAL_COUNTRY"),
        "SUCCESS_PAGE" => "",
        "USER_PROPERTY" => array("UF_USERTYPE"),
        "USER_PROPERTY_NAME" => "",
        "USE_BACKURL" => "Y"
    )
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>