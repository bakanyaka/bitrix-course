<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?><!--container start-->
<div class="container">
	<div class="row">
		<div class="col-lg-5 col-sm-5 address">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/include/about/contacts/address.php"
	)
);?>
		</div>
		<div class="col-lg-7 col-sm-7 address">
			 <?$APPLICATION->IncludeComponent(
	"my:contact.form",
	"",
	Array(
		"EMAIL_TO" => "bakayaroshka@gmail.com",
		"EVENT_MESSAGE_ID" => array("31"),
		"HIGHLOAD_BLOCK_ID" => "3",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array("NAME","EMAIL","PHONE","MESSAGE"),
		"USE_CAPTCHA" => "Y"
	)
);?>
		</div>
	</div>
</div>
 <!--container end--> <!--google map start-->
<div class="contact-map">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:map.google.view",
	"",
	Array(
		"API_KEY" => "",
		"CONTROLS" => array("SMALL_ZOOM_CONTROL","TYPECONTROL","SCALELINE"),
		"INIT_MAP_TYPE" => "ROADMAP",
		"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:59.93153482051581;s:10:\"google_lon\";d:30.42077665031752;s:12:\"google_scale\";i:17;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:16:\"Бестранк\";s:3:\"LON\";d:30.420454785235734;s:3:\"LAT\";d:59.93195142046271;}}}",
		"MAP_HEIGHT" => "400",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array("ENABLE_DBLCLICK_ZOOM","ENABLE_DRAGGING","ENABLE_KEYBOARD")
	)
);?>
</div>
 <!--google map end-->
<div class="container">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"reviews_slider",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array("NAME","DETAIL_TEXT","DETAIL_PICTURE","CREATED_USER_NAME",""),
		"IBLOCKS" => array("11"),
		"IBLOCK_TYPE" => "about",
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
</div>
 <br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>