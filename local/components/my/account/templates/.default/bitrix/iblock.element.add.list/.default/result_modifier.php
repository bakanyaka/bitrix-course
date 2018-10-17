<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult["EDIT_URL"] = (new \Bitrix\Main\Web\Uri($arParams['EDIT_URL']))->addParams(["edit" => "Y"])->getUri();

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$uri = new \Bitrix\Main\Web\Uri($request->getRequestUri());
$arResult["DELETE_URL"] = $uri->addParams(["delete" => "Y"])->getUri();