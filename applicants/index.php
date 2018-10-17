<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Для соискателей");
?>
    <div class="container">
        <div class="row">
            <? $APPLICATION->IncludeComponent(
                "my:account",
                "",
                Array(
                    "ACCESS_DENIED_MESSAGE" => "Вы не имеете доступа к данному разделу",
                    "ADD_FORM_PROPERTY_CODES" => array("9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "NAME", "PREVIEW_PICTURE", "DETAIL_TEXT", "DETAIL_PICTURE"),
                    "ADD_FORM_PROPERTY_CODES_REQUIRED" => array("9", "10", "11", "12", "13", "14", "NAME", "PREVIEW_PICTURE", "DETAIL_TEXT", "DETAIL_PICTURE"),
                    "ADD_IBLOCK_ID" => "5",
                    "ADD_IBLOCK_TYPE" => "resume",
                    "CACHE_TIME" => "31536000",
                    "CACHE_TYPE" => "A",
                    "DETAIL_FIELD_CODE" => array("", ""),
                    "DETAIL_PROPERTY_CODE" => array("ATT_JOB_TITLE", "ATT_SALARY", "ATT_EMPLOYMENT_TYPE", "ATT_EMPLOYMENT_FORM", ""),
                    "DETAIL_TEMPLATE" => "resume_vacancy",
                    "GROUPS" => array("7"),
                    "LIST_FIELD_CODE" => array("", ""),
                    "LIST_PROPERTY_CODE" => array("", ""),
                    "LIST_TEMPLATE" => ".default",
                    "MY_ELEMENTS_COUNT" => "10",
                    "PAGE_NAME_ACCOUNT" => "Личный кабинет",
                    "PAGE_NAME_ADD" => "Добавление резюме",
                    "PAGE_NAME_ADDED" => "Мои резюме",
                    "PAGE_NAME_DETAIL" => "Детали вакансии",
                    "PAGE_NAME_LIST" => "Список вакансий",
                    "SEF_FOLDER" => "/applicants/",
                    "SEF_MODE" => "Y",
                    "SEF_URL_TEMPLATES" => Array("account" => "me/", "add" => "me/add/", "added" => "me/my_resumes/", "detail" => "vacancies/#ID#/", "list" => "vacancies/"),
                    "SHOW_NAV" => "Y",
                    "SORT_DIRECTION1" => "ASC",
                    "SORT_DIRECTION2" => "ASC",
                    "SORT_FIELD1" => "ID",
                    "SORT_FIELD2" => "ID",
                    "VIEW_ELEMENTS_COUNT" => "0",
                    "VIEW_IBLOCK_ID" => "8",
                    "VIEW_IBLOCK_TYPE" => "vacancies"
                )
            ); ?>
        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>