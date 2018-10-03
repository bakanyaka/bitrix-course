<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<h4>
    <?= GetMessage("VACANCIES_RESPONSE_TEMPLATE_HEADER") ?>
</h4>
<? if(!empty($arResult["ITEMS"])): ?>
<div class="vacancy-response-form">
    <? if (!empty($arResult["ERROR_MESSAGE"])) {
        foreach ($arResult["ERROR_MESSAGE"] as $v)
            ShowError($v);
    }
    if (strlen($arResult["OK_MESSAGE"]) > 0) {
        ?>
        <p class="text-success">
            <?= $arResult["OK_MESSAGE"] ?>
        </p>
    <? } ?>
    <form action="<?= POST_FORM_ACTION_URI ?>" method="POST" role="form">
        <?= bitrix_sessid_post() ?>
        <div class="form-group">
            <label for="resume">
                <?= GetMessage("VACANCIES_RESPONSE_TEMPLATE_RESUME") ?>
            </label>
            <select id="resume" name="RESUME_ID" class="form-control">
                <? foreach ($arResult["ITEMS"] as $resume): ?>
                    <option value="<?= $resume["ID"] ?>"><?= "[{$resume["ID"]}] {$resume["NAME"]}" ?></option>
                <? endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="message">
                <?= GetMessage("VACANCIES_RESPONSE_TEMPLATE_MESSAGE") ?>
            </label>
            <textarea id="message" name="MESSAGE" placeholder="" rows="5"
                      class="form-control" <? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])): ?> required<? endif ?>><?= $arResult["MESSAGE"] ?></textarea>
        </div>
        <? if ($arParams["USE_CAPTCHA"] == "Y"): ?>
            <div class="mf-captcha">
                <div class="mf-text"><?= GetMessage("VACANCIES_RESPONSE_TEMPLATE_CAPTCHA") ?></div>
                <input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180" height="40"
                     alt="CAPTCHA">
                <div class="mf-text"><?= GetMessage("VACANCIES_RESPONSE_TEMPLATE_CAPTCHA_CODE") ?><span class="mf-req">*</span></div>
                <input type="text" name="captcha_word" size="30" maxlength="50" value="">
            </div>
        <? endif; ?>
        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
        <button class="btn btn-info" type="submit" name="submit" value="<?= GetMessage("VACANCIES_RESPONSE_TEMPLATE_SUBMIT") ?>">
            <?= GetMessage("VACANCIES_RESPONSE_TEMPLATE_SUBMIT") ?>
        </button>
    </form>
</div>
<? else: ?>
<p>
    У вас отсутсвуют опубликованные резюме. Опубликуйте резюме для отклика на вакансию.
</p>
<? endif;?>