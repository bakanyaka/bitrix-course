<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class CoursesListComponent extends \CBitrixComponent
{
    /**
     * arResult keys to cache
     * @var array
     */
    protected $cacheKeys = ["ITEMS"];

    /**
     * Prepares all the parameters passed.
     * @param mixed[] $params List of unchecked parameters
     * @return mixed[] Cleaned up parameters
     */
    public function onPrepareComponentParams($params)
    {

        $params['CACHE_TIME'] = intval($params['CACHE_TIME']) > 0 ? intval($params['CACHE_TIME']) : 36000000;

        $params['TRAINING_IBLOCK_TYPE'] = trim($params['TRAINING_IBLOCK_TYPE']);

        if(!is_array($params["DO_NOT_DISPLAY_IBLOCK_ID"])) {
            $params["DO_NOT_DISPLAY_IBLOCK_ID"] = [$params["DO_NOT_DISPLAY_IBLOCK_ID"]];
        }
        foreach($params["DO_NOT_DISPLAY_IBLOCK_ID"] as $key=>$val) {
            if(intval($val) < 1) {
                unset($params["DO_NOT_DISPLAY_IBLOCK_ID"][$key]);
            }
        }
        return $params;
    }

    public function executeComponent()
    {
        try {
            $this->checkModules();
            $this->checkParams();
            $this->executeBeforeCaching();
            if (!$this->readCache()) {
                $this->getResult();
                $this->SetResultCacheKeys($this->cacheKeys);
                $this->includeComponentTemplate();
            }
            $this->executeAfterCaching();
        } catch (Exception $e) {
            $this->AbortResultCache();
            ShowError($e->getMessage());
        }
    }

    /**
     * Checks that all required modules are installed
     * @throws Main\LoaderException
     */
    protected function checkModules()
    {
        if (!Loader::includeModule('iblock')) {
            throw new Main\LoaderException(Loc::getMessage('COURSES_LIST_CLASS_IBLOCK_MODULE_NOT_INSTALLED'));
        }
    }

    /**
     * Validates parameters
     * @throws Main\ArgumentNullException
     */
    protected function checkParams()
    {
        if (strlen($this->arParams['TRAINING_IBLOCK_TYPE']) < 1) {
            throw new Main\ArgumentNullException('RESUMES_IBLOCK_ID');
        }
    }

    /**
     *  Executes actions before caching
     */
    protected function executeBeforeCaching()
    {
    }

    protected function readCache()
    {
        global $USER;

        return !$this->startResultCache(false, $USER->GetGroups());
    }

    protected function getResult()
    {

        $filter = [
            "TYPE" => $this->arParams["TRAINING_IBLOCK_TYPE"],
            "SITE_ID" => $this->getSiteId(),
            "!ID" => $this->arParams["DO_NOT_DISPLAY_IBLOCK_ID"],
            "ACTIVE" => "Y",
        ];

        $sort = [
            "SORT" => "ASC",
            "NAME" => "ASC",
        ];

        $rsIBlocks = CIBlock::GetList($sort, $filter);

        while($arIBlock = $rsIBlocks->GetNext())
        {
            $arIBlock["~LIST_PAGE_URL"] = str_replace(
                ["#SERVER_NAME#", "#SITE_DIR#", "#IBLOCK_TYPE_ID#", "#IBLOCK_ID#", "#IBLOCK_CODE#", "#IBLOCK_EXTERNAL_ID#", "#CODE#"],
                [SITE_SERVER_NAME, SITE_DIR, $arIBlock["IBLOCK_TYPE_ID"], $arIBlock["ID"], $arIBlock["CODE"], $arIBlock["EXTERNAL_ID"], $arIBlock["CODE"]],
                $arIBlock["~LIST_PAGE_URL"]
            );
            $arIBlock["~LIST_PAGE_URL"] = preg_replace("'/+'s", "/", $arIBlock["~LIST_PAGE_URL"]);
            $arIBlock["LIST_PAGE_URL"] = htmlspecialcharsbx($arIBlock["~LIST_PAGE_URL"]);
            $this->arResult["ITEMS"][] = array_filter(
                $arIBlock,
                function ($key) {
                    return in_array($key, ['ID', 'NAME', 'LIST_PAGE_URL', 'PICTURE']);
                },
                ARRAY_FILTER_USE_KEY
            );
        }

    }

    protected function executeAfterCaching()
    {
        global $APPLICATION, $USER;

        if(count($this->arResult["ITEMS"])>0 && $USER->IsAuthorized())
        {
            if($APPLICATION->GetShowIncludeAreas() && CModule::IncludeModule("iblock"))
                $this->AddIncludeAreaIcons(CIBlock::ShowPanel(0, 0, 0, $this->arParams["TRAINING_IBLOCK_TYPE"], true));
        }
    }


}