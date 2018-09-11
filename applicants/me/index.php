<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет соискателя");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"",
Array()
);?><br>
<?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.form",
	"",
Array(),
false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>