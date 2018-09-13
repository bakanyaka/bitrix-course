<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_NAME"),
	"DESCRIPTION" => GetMessage("T_IBLOCK_DESC"),
	"ICON" => "/images/news_line.gif",
	"SORT" => 10,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => GetMessage("T_IBLOCK_CATEGORY"),
		"CHILD" => array(
			"ID" => "events",
			"NAME" => GetMessage("T_IBLOCK_FOLDER"),
			"SORT" => 10,
		)
	),
);

?>