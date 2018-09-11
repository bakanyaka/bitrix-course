<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои вакансии");
?><?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add",
	"",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALLOW_DELETE" => "Y",
		"ALLOW_EDIT" => "Y",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "Дата начала активности",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "Дата завершения активности",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "Подробное описание вакансии",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "Раздел",
		"CUSTOM_TITLE_NAME" => "Название",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "Краткое описание вакансии",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array("1","6","8"),
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "vacancies",
		"LEVEL_LAST" => "Y",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"NAV_ON_PAGE" => "10",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array("20","21","22","23","24","NAME","DATE_ACTIVE_FROM","DATE_ACTIVE_TO","IBLOCK_SECTION","PREVIEW_TEXT","DETAIL_TEXT"),
		"PROPERTY_CODES_REQUIRED" => array("NAME","DATE_ACTIVE_FROM","DATE_ACTIVE_TO","IBLOCK_SECTION"),
		"RESIZE_IMAGES" => "N",
		"SEF_FOLDER" => "/employers/my-vacancies/",
		"SEF_MODE" => "Y",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>