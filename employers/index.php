<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Для работодателей");
?><div class="container">
	<div class="row">
		 <?$APPLICATION->IncludeComponent(
	"my:account",
	"",
	Array(
		"ACCESS_DENIED_MESSAGE" => "Вы не имеете доступа к данному разделу",
		"ADD_FORM_PROPERTY_CODES" => array("20","21","22","23","24","NAME","PREVIEW_TEXT","DETAIL_TEXT","DATE_ACTIVE_FROM","DATE_ACTIVE_TO"),
		"ADD_FORM_PROPERTY_CODES_REQUIRED" => array("NAME","PREVIEW_TEXT","DETAIL_TEXT","DATE_ACTIVE_FROM","DATE_ACTIVE_TO"),
		"ADD_IBLOCK_ID" => "8",
		"ADD_IBLOCK_TYPE" => "vacancies",
		"CACHE_TIME" => "31536000",
		"CACHE_TYPE" => "A",
		"DETAIL_FIELD_CODE" => array("NAME","DETAIL_TEXT","DETAIL_PICTURE","DATE_CREATE",""),
		"DETAIL_PROPERTY_CODE" => array("ATT_SURNAME","ATT_FIRST_NAME","ATT_MIDDLE_NAME","ATT_PHONE","ATT_MAIL","ATT_BIRTHDATE","ATT_EXPERIENCE","ATT_SALARY","ATT_GRADUATED_FROM","ATT_CATEGORY","ATT_ACHIEVEMENTS",""),
		"DETAIL_TEMPLATE" => "resume_vacancy",
		"GROUPS" => array("6"),
		"LIST_FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE",""),
		"LIST_PROPERTY_CODE" => array("ATT_SURNAME","ATT_FIRST_NAME","ATT_MIDDLE_NAME","ATT_PHONE","ATT_MAIL","ATT_BIRTHDATE","ATT_EXPERIENCE","ATT_SALARY","ATT_GRADUATED_FROM","ATT_CATEGORY",""),
		"LIST_TEMPLATE" => "resume_list",
		"MY_ELEMENTS_COUNT" => "10",
		"PAGE_NAME_ACCOUNT" => "Личный кабинет",
		"PAGE_NAME_ADD" => "Добавление вакансии",
		"PAGE_NAME_ADDED" => "Мои вакансии",
		"PAGE_NAME_DETAIL" => "Детальная информация о резюме",
		"PAGE_NAME_LIST" => "Список резюме",
		"SEF_FOLDER" => "/employers/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("account"=>"lk/","add"=>"lk/add/","added"=>"lk/my_vacancies/","detail"=>"resume/#ID#/","list"=>"resume/"),
		"SHOW_NAV" => "Y",
		"SORT_DIRECTION1" => "ASC",
		"SORT_DIRECTION2" => "ASC",
		"SORT_FIELD1" => "ID",
		"SORT_FIELD2" => "ID",
		"VIEW_ELEMENTS_COUNT" => "6",
		"VIEW_IBLOCK_ID" => "5",
		"VIEW_IBLOCK_TYPE" => "resume"
	)
);?>
	</div>
</div>
 <br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>