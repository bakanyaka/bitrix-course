<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc as Loc;
use Bitrix\Main\Type\DateTime;

Loader::includeModule("highloadblock");

Loc::loadMessages(__FILE__);

class VacanciesResponseComponent extends CBitrixComponent
{

    /**
     * arResult keys to cache
     * @var array
     */
    protected $cacheKeys = ['RESUMES', 'VACANCY', 'PARAMS_HASH', 'VACANCY_AUTHOR_EMAIL'];

    /**
     * Prepares all the parameters passed.
     * @param mixed[] $params List of unchecked parameters
     * @return mixed[] Cleaned up parameters
     */
    public function onPrepareComponentParams($params)
    {
        $params['CACHE_TIME'] = intval($params['CACHE_TIME']) > 0 ? intval($params['CACHE_TIME']) : 3600;
        $params['VACANCY_ID'] = intval($params['VACANCY_ID']);
        $params['USER_ID'] = intval($params['USER_ID']) > 1 ? intval($params['USER_ID']) : $this->getUserId();
        $params["HIGHLOAD_BLOCK_ID"] = intval($params["HIGHLOAD_BLOCK_ID"]);
        $params['RESUMES_IBLOCK_TYPE'] = trim($params['RESUMES_IBLOCK_TYPE']);
        $params['RESUMES_IBLOCK_ID'] = intval($params['RESUMES_IBLOCK_ID']);
        $params["USE_CAPTCHA"] = ($params["USE_CAPTCHA"] == "Y" ? "Y" : "N");
        $params["EVENT_NAME"] = trim($params["EVENT_NAME"]);
        if ($params["EVENT_NAME"] == '') {
            $params["EVENT_NAME"] = "VACANCY_RESPONSE";
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
                $this->endResultCache();
            }
            $this->executeAfterCaching();
            $this->processRequest();
            $this->includeComponentTemplate();
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
        if (!Main\Loader::includeModule('iblock')) {
            throw new Main\LoaderException(Loc::getMessage('VACANCIES_RESPONSE_CLASS_IBLOCK_MODULE_NOT_INSTALLED'));
        }
    }

    /**
     * Validates parameters
     * @throws Main\ArgumentNullException
     */
    protected function checkParams()
    {
        if ($this->arParams['VACANCY_ID'] < 1) {
            throw new Main\ArgumentNullException('VACANCY_ID');
        }
        if ($this->arParams['USER_ID'] < 1) {
            throw new Main\ArgumentNullException('USER_ID');
        }
        if ($this->arParams['HIGHLOAD_BLOCK_ID'] < 1) {
            throw new Main\ArgumentNullException('HIGHLOAD_BLOCK_ID');
        }
        if (strlen($this->arParams['RESUMES_IBLOCK_TYPE']) < 1) {
            throw new Main\ArgumentNullException('RESUMES_IBLOCK_ID');
        }
        if ($this->arParams['RESUMES_IBLOCK_ID'] < 1) {
            throw new Main\ArgumentNullException('RESUMES_IBLOCK_ID');
        }
    }

    /**
     *  Executes actions before caching
     */
    protected function executeBeforeCaching()
    {
        $this->arResult["PARAMS_HASH"] = md5(serialize($this->arParams) . $this->GetTemplateName());
    }

    protected function readCache()
    {
        global $USER;

        return !$this->startResultCache(false, $USER->GetGroups());
    }

    /**
     * @throws Main\ArgumentNullException
     */
    protected function getResult()
    {
        $this->arResult['RESUMES'] = $this->getUsersResumes();
        $this->arResult['VACANCY'] = $this->getVacancy();
        $this->arResult['VACANCY_AUTHOR_EMAIL'] = $this->getUser($this->arResult['VACANCY']['CREATED_BY'])['EMAIL'];
    }

    /**
     * @throws Main\ArgumentException
     * @throws Main\ObjectException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    protected function processRequest()
    {
        global $APPLICATION;

        $request = \Bitrix\Main\Context::getCurrent()->getRequest();

        if (!$request->isPost() || (isset($request["PARAMS_HASH"]) && $this->arResult["PARAMS_HASH"] !== $request["PARAMS_HASH"])) {
            return;
        }

        // Cancel processing if validation failed
        if (!$this->validateRequest($request)) {
            return;
        }

        // Load resume data
        if (!isset($this->arResult['RESUMES'][$request["RESUME_ID"]])) {
            $this->arResult["ERROR_MESSAGE"][] = GetMessage("VACANCIES_RESPONSE_CLASS_REQ_RESUME_ID");
            return;
        }

        $resume = $this->arResult['RESUMES'][$request["RESUME_ID"]];

        $arFields = [
            "VACANCY_ID" => $this->arParams["VACANCY_ID"],
            "EMAIL_TO" => $this->arResult['VACANCY_AUTHOR_EMAIL'],
            "APPLICANT_NAME" => $resume["USER_NAME"],
            "VACANCY_NAME" => $this->arResult['VACANCY']["NAME"],
            "RESUME_ID" => $resume["ID"],
            "RESUME_URL" => $resume["DETAIL_PAGE_URL"],
            "RESPONSE_TEXT" => $request["MESSAGE"],
            "RESPONSE_DATE" => new DateTime(),
        ];

        $this->sendMailToVacancyAuthor($arFields);
        $this->saveDataToHighLoadBlock($arFields);

        LocalRedirect($APPLICATION->GetCurPageParam("success=" . $this->arResult["PARAMS_HASH"], Array("success")));
    }

    protected function executeAfterCaching()
    {
        global $APPLICATION;

        if ($_REQUEST["success"] == $this->arResult["PARAMS_HASH"]) {
            $this->arResult["OK_MESSAGE"] = GetMessage("VACANCIES_RESPONSE_CLASS_SEND_SUCCESS_MESSAGE");;
        }

        if ($this->arParams["USE_CAPTCHA"] == "Y")
            $this->arResult["capCode"] = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
    }

    protected function getUserId()
    {
        global $USER;
        if (isset($USER) && $USER instanceof CUser)
            return (int)$USER->getId();
        return 0;
    }

    protected function getUser($userId = null)
    {
        if (!$userId) {
            $userId = $this->arParams['USER_ID'];
        }
        $user = CUser::GetByID($userId);
        $userArr = $user->Fetch();
        unset($userArr['PASSWORD']);
        unset($userArr['CHECKWORD']);
        return $userArr;
    }

    protected function getUsersResumes()
    {
        $filter = [
            'IBLOCK_TYPE' => $this->arParams['RESUMES_IBLOCK_TYPE'],
            'IBLOCK_ID' => $this->arParams['RESUMES_IBLOCK_ID'],
            'CREATED_BY' => $this->arParams['USER_ID'],
            'ACTIVE' => 'Y'
        ];

        $select = [
            'ID',
            'NAME',
            'USER_NAME',
            'DETAIL_PAGE_URL'
        ];

        $iterator = \CIBlockElement::GetList([], $filter, false, array(), $select);
        $resumes = [];
        while ($element = $iterator->GetNext()) {
            $resumes[$element['ID']] = $element;
        }
        return $resumes;
    }


    /**
     *  Validates submitted post request data
     * @param $request
     * @return bool
     */
    protected function validateRequest($request)
    {
        $this->arResult["ERROR_MESSAGE"] = [];

        // Validate Form
        if (!check_bitrix_sessid()) {
            $this->arResult["ERROR_MESSAGE"][] = GetMessage("VACANCIES_RESPONSE_CLASS_SESS_EXP");
            return false;
        }

        if (strlen($request["MESSAGE"]) <= 3) {
            $this->arResult["ERROR_MESSAGE"][] = GetMessage("VACANCIES_RESPONSE_CLASS_REQ_MESSAGE");
        }

        if (intval($request["RESUME_ID"]) < 1) {
            $this->arResult["ERROR_MESSAGE"][] = GetMessage("VACANCIES_RESPONSE_CLASS_REQ_RESUME_ID");
        }

        if ($this->arParams["USE_CAPTCHA"] == "Y") {
            $captcha_code = $request["captcha_sid"];
            $captcha_word = $request["captcha_word"];
            $cpt = new CCaptcha();
            $captchaPass = COption::GetOptionString("main", "captcha_password", "");
            if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0) {
                if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
                    $this->arResult["ERROR_MESSAGE"][] = GetMessage("VACANCIES_RESPONSE_CLASS_CAPTCHA_WRONG");
            } else {
                $this->arResult["ERROR_MESSAGE"][] = GetMessage("VACANCIES_RESPONSE_CLASS_CAPTCHA_WRONG");
            }
        }

        if (!empty($this->arResult["ERROR_MESSAGE"])) {
            return false;
        }

        return true;
    }

    /**
     * @param $arFields
     * @return mixed
     */
    protected function sendMailToVacancyAuthor($arFields)
    {
        if (!empty($this->arParams["EVENT_MESSAGE_ID"])) {
            foreach ($this->arParams["EVENT_MESSAGE_ID"] as $v) {
                if (IntVal($v) > 0) {
                    CEvent::Send($this->arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v));
                }
            }
        } else {
            CEvent::Send($this->arParams["EVENT_NAME"], SITE_ID, $arFields);
        }
        return $this->arParams;
    }

    /**
     * @param $arFields
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    protected function saveDataToHighLoadBlock($arFields)
    {
        if ($this->arParams["HIGHLOAD_BLOCK_ID"] > 0) {
            $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById($this->arParams["HIGHLOAD_BLOCK_ID"])->fetch();
            $entity = HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();

            $data = array(
                "UF_VACANCY_ID" => $arFields["VACANCY_ID"],
                "UF_RESUME_ID" => $arFields["RESUME_ID"],
                "UF_RESPONSE_TEXT" => $arFields["RESPONSE_TEXT"],
                "UF_RESPONSE_DATE" => $arFields["RESPONSE_DATE"],
            );

            $result = $entity_data_class::add($data);
        }
    }

    /**
     * @return array
     * @throws Main\ArgumentNullException
     */
    protected function getVacancy()
    {
        $filter = [
            'ID' => $this->arParams["VACANCY_ID"],
        ];

        $select = [
            'ID',
            'NAME',
            'USER_NAME',
            'DETAIL_PAGE_URL'
        ];

        $iterator = \CIBlockElement::GetList([], $filter, false, array(), $select);
        if (!$vacancy = $iterator->GetNext()) {
            throw new Main\ArgumentNullException('VACANCY_ID');
        }

        return $vacancy;
    }


}