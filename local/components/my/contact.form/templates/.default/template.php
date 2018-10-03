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
    <?= GetMessage("MFT_HEADER") ?>
</h4>
<div class="contact-form">
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
            <label for="name">
                <?= GetMessage("MFT_NAME") ?>
            </label>
            <input name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>" type="text" placeholder="" id="name"
                   class="form-control"<? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])): ?> required<? endif ?>>
        </div>
        <div class="form-group">
            <label for="email">
                <?= GetMessage("MFT_EMAIL") ?>
            </label>
            <input name="user_email" value="<?= $arResult["AUTHOR_EMAIL"] ?>" type="text" placeholder="" id="email"
                   class="form-control"<? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])): ?> required<? endif ?>>
        </div>
        <div class="form-group">
            <label for="phone">
                <?= GetMessage("MFT_PHONE") ?>
            </label>
            <input name="user_phone" value="<?= $arResult["AUTHOR_PHONE"] ?>" type="text" placeholder="" id="phone"
                   class="form-control"<? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])): ?> required<? endif ?>>
        </div>
        <div class="form-group">
            <label for="message">
                <?= GetMessage("MFT_MESSAGE") ?>
            </label>
            <textarea id="message" name="MESSAGE" placeholder="" rows="5"
                      class="form-control" <? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])): ?> required<? endif ?>><?= $arResult["MESSAGE"] ?></textarea>
        </div>
        <? if ($arParams["USE_CAPTCHA"] == "Y"): ?>
            <div class="mf-captcha">
                <div class="mf-text"><?= GetMessage("MFT_CAPTCHA") ?></div>
                <input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180" height="40"
                     alt="CAPTCHA">
                <div class="mf-text"><?= GetMessage("MFT_CAPTCHA_CODE") ?><span class="mf-req">*</span></div>
                <input type="text" name="captcha_word" size="30" maxlength="50" value="">
            </div>
        <? endif; ?>
        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
        <button class="btn btn-info" type="submit" name="submit" value="<?= GetMessage("MFT_SUBMIT") ?>">
            <?= GetMessage("MFT_SUBMIT") ?>
        </button>
    </form>
</div>