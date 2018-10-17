<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class AccountComponent extends \CBitrixComponent
{
    /**
     * Default URL templates
     * @var array
     */
    protected $defaultUrlTemplates404 = [
        'account' => 'me/',
        'list' => 'list/',
        'detail' => 'list/#ID#/',
        'add' => 'me/add/',
        'added' => 'me/my_elements/'
    ];

    /**
     * Default variable aliases for SEF mode
     * @var array
     */
    protected $defaultVariableAliases404 = [];

    /**
     * Default variable aliases for no SEF mode
     * @var array
     */
    protected $defaultVariableAliases = [];

    /**
     * Component variables
     * @var array
     */
    protected $componentVariables = ["ID", "page"];

    /**
     *  Template page
     * @var string
     */
    protected $page = "index";

    /**
     * Execute component
     * @return mixed|void
     */
    public function executeComponent()
    {
        try {
            $this->checkPermissions();
            $this->getResult();
            $this->includeComponentTemplate($this->page);
        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }

    /**
     * @throws \Bitrix\Main\AccessDeniedException
     */
    protected function checkPermissions()
    {
        global $USER;
        $userGroups = $USER->GetUserGroupArray();
        $intersectGroup = array_intersect($this->arParams["GROUPS"], $userGroups);
        if (!$USER->IsAdmin() && count($intersectGroup) == 0) {
            throw new \Bitrix\Main\AccessDeniedException($this->arParams["ACCESS_DENIED_MESSAGE"]);
        }
    }

    protected function getResult()
    {
        global $APPLICATION;
        $urlTemplates = [];
        $variables = [];
        $folder = "";

        if ($this->arParams['SEF_MODE'] == 'Y') {
            $folder = $this->arParams['SEF_FOLDER'];

            $urlTemplates = \CComponentEngine::MakeComponentUrlTemplates(
                $this->defaultUrlTemplates404,
                $this->arParams['SEF_URL_TEMPLATES']
            );
            $engine = new CComponentEngine($this);
            if (CModule::IncludeModule('iblock')) {
                $engine->addGreedyPart("#SECTION_CODE_PATH#");
                $engine->setResolveCallback(["CIBlockFindTools", "resolveComponentEngine"]);
            }
            $this->page = $engine->guessComponentPath(
                $this->arParams['SEF_FOLDER'],
                $urlTemplates,
                $variables
            );
            if (strlen($this->page) <= 0)
                $this->page = 'index';

            $variableAliases = \CComponentEngine::MakeComponentVariableAliases(
                $this->defaultVariableAliases404,
                $this->arParams['VARIABLE_ALIASES']
            );
            \CComponentEngine::InitComponentVariables(
                $this->page,
                $this->componentVariables, $variableAliases,
                $variables
            );

        } else {
            $variableAliases = \CComponentEngine::MakeComponentVariableAliases(
                $this->defaultVariableAliases,
                $this->arParams['VARIABLE_ALIASES']
            );
            \CComponentEngine::InitComponentVariables(
                false,
                $this->componentVariables, $variableAliases,
                $variables
            );

            if(!empty($variables["page"]) && array_key_exists($variables["page"], $this->defaultUrlTemplates404)) {
                $this->page = $variables["page"];
            }  else {
                $this->page = 'index';
            }

            $urlTemplates = [
                'index' => htmlspecialcharsbx($APPLICATION->GetCurPage()),
                'account' => htmlspecialcharsbx($APPLICATION->GetCurPage()) . "?page=account",
                'list' => htmlspecialcharsbx($APPLICATION->GetCurPage()) . "?page=list",
                'detail' => htmlspecialcharsbx($APPLICATION->GetCurPage()) . "?page=detail" . "&ID=#ELEMENT_ID#",
                'add' => htmlspecialcharsbx($APPLICATION->GetCurPage()) . "?page=add",
                'added' => htmlspecialcharsbx($APPLICATION->GetCurPage()) . "?page=added",
            ];

        }

        $this->arResult = [
            'FOLDER' => $folder,
            'URL_TEMPLATES' => $urlTemplates,
            'VARIABLES' => $variables,
            'ALIASES' => $variableAliases
        ];
    }


}