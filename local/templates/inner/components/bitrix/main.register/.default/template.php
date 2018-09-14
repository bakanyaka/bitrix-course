<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
?>

<!--container start-->
<div class="registration-bg">
    <div class="container">

        <? if ($USER->IsAuthorized()): ?>
            <p><? echo GetMessage("MAIN_REGISTER_AUTH") ?></p>
        <? else: ?>
            <form class="form-signin wow fadeInUp" method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform"
                  enctype="multipart/form-data">
                <? if ($arResult["USE_EMAIL_CONFIRMATION"] === "Y"): ?>
                    <p><? echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT") ?></p>
                <? endif ?>
                <? if ($arResult["BACKURL"] <> ''): ?>
                    <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                <? endif; ?>
                <h2 class="form-signin-heading"><?= GetMessage("AUTH_REGISTER") ?></h2>
                <div class="login-wrap">

                    <? foreach ($arResult["SHOW_FIELDS"] as $FIELD): ?>
                        <? if ($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true): ?>

                        <? elseif ($FIELD == "PASSWORD"): ?>
                        <input type="password" class="form-control" name="REGISTER[<?= $FIELD ?>]"
                               value="<?= $arResult["VALUES"][$FIELD] ?>"
                               autocomplete="off"
                               placeholder="<?= GetMessage("REGISTER_FIELD_" . $FIELD) ?>"/>
                        <? if ($arResult["SECURE_AUTH"]): ?>
                            <span class="bx-auth-secure" id="bx_auth_secure" title="<?= GetMessage("AUTH_SECURE_NOTE") ?>">
                                <div class="bx-auth-secure-icon"></div>
                            </span>
                            <noscript>
                                <span class="bx-auth-secure" title="<?= GetMessage("AUTH_NONSECURE_NOTE") ?>">
                                    <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                </span>
                            </noscript>
                        <? endif ?>
                        <? elseif ($FIELD == "CONFIRM_PASSWORD"): ?>
                            <input type="password" class="form-control" name="REGISTER[<?= $FIELD ?>]"
                                   value="<?= $arResult["VALUES"][$FIELD] ?>"
                                   autocomplete="off"
                                   placeholder="<?= GetMessage("REGISTER_FIELD_" . $FIELD) ?>"/>
                            <p class="help-block"><? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?></p>
                        <? elseif ($FIELD == "PERSONAL_GENDER"): ?>
                            <div class="radios">
                                <label class="label_radio col-lg-6 col-sm-6" for="gender-male">
                                    <input name="REGISTER[<?= $FIELD ?>]" id="gender-male" value="M" type="radio"
                                           checked="">
                                    <?= GetMessage("USER_MALE") ?>
                                </label>
                                <label class="label_radio col-lg-6 col-sm-6" for="gender-female">
                                    <input name="REGISTER[<?= $FIELD ?>]" id="gender-female" value="F" type="radio">
                                    <?= GetMessage("USER_FEMALE") ?>
                                </label>
                            </div>
                        <? elseif ($FIELD == "PERSONAL_COUNTRY" || $FIELD == "WORK_COUNTRY"): ?>
                            <div class="form-group">
                                <label for="email-address"><?= GetMessage("REGISTER_FIELD_" . $FIELD) ?></label>
                                <select class="form-control" id="email-address" name="REGISTER[<?= $FIELD ?>]">
                                    <? foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value) { ?>
                                        <option value="<?= $value ?>"<?
                                        if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<? endif ?>> <?= $arResult["COUNTRIES"]["reference"][$key] ?>
                                        </option>
                                    <? } ?>
                                </select>
                            </div>
                        <? elseif ($FIELD == "PERSONAL_PHOTO" || $FIELD == "WORK_LOGO"): ?>
                            <div class="form-group">
                                <label for="REGISTER_FILES_<?= $FIELD ?>"><?= GetMessage("REGISTER_FIELD_" . $FIELD) ?></label>
                                <input class="form-control" size="30" type="file" id="REGISTER_FILES_<?= $FIELD ?>" name="REGISTER_FILES_<?= $FIELD ?>" />
                            </div>
                        <? elseif ($FIELD == "PERSONAL_NOTES" || $FIELD == "WORK_NOTES"): ?>
                            <div class="form-group">
                                <label for="REGISTER[<?= $FIELD ?>]"><?= GetMessage("REGISTER_FIELD_" . $FIELD) ?></label>
                                <textarea cols="30" rows="5" id="REGISTER[<?= $FIELD ?>]" name="REGISTER[<?= $FIELD ?>]">
                                    <?= $arResult["VALUES"][$FIELD] ?>
                                </textarea>
                            </div>
                        <? else: ?>
                            <? if ($FIELD == "PERSONAL_BIRTHDAY"): ?>
                                <small><?= $arResult["DATE_FORMAT"] ?></small><br/>
                            <? endif; ?>
                            <input type="text" class="form-control" name="REGISTER[<?= $FIELD ?>]"
                                   value="<?= $arResult["VALUES"][$FIELD] ?>"
                                   placeholder="<?= GetMessage("REGISTER_FIELD_" . $FIELD) ?>"/>
                            <? if ($FIELD == "PERSONAL_BIRTHDAY") {
                                $APPLICATION->IncludeComponent(
                                    'bitrix:main.calendar',
                                    '',
                                    array(
                                        'SHOW_INPUT' => 'N',
                                        'FORM_NAME' => 'regform',
                                        'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
                                        'SHOW_TIME' => 'N'
                                    ),
                                    null,
                                    array("HIDE_ICONS" => "Y")
                                );
                            } ?>
                        <? endif; ?>
                        <? if (is_set($arResult["ERRORS"][$FIELD])): ?>
                            <? ShowError(str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $FIELD) . "&quot;", $arResult["ERRORS"][$FIELD]), 'error'); ?>
                        <? endif; ?>
                    <? endforeach; ?>
                    <? // ********************* User properties ***************************************************?>
                    <? if ($arResult["USER_PROPERTIES"]["SHOW"] == "Y"): ?>
                        <p class="section">
                            <?= strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB") ?>
                        </p>
                        <? foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField): ?>
                            <div class="form-group">
                                <label for="<?= $FIELD_NAME ?>">
                                    <?=  $arUserField["EDIT_FORM_LABEL"]?>
                                    <? if ($arUserField["MANDATORY"] == "Y"): ?>
                                        <span class="starrequired">*</span>
                                    <? endif; ?>
                                    :
                                </label>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:system.field.edit",
                                    $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                    array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS" => "Y"));
                                ?>
                            </div>

                        <? endforeach; ?>
                    <? endif; ?>
                    <? // ******************** /User properties ***************************************************?>
                    <?
                    /* CAPTCHA */
                    if ($arResult["USE_CAPTCHA"] == "Y") {
                        ?>
                        <p style="text-align: left">
                            <?= GetMessage("REGISTER_CAPTCHA_TITLE") ?>:<br/>
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                 width="180" height="40" alt="CAPTCHA"/>
                        </p>
                        <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                        <div class="form-group">
                            <label for="captcha"><?= GetMessage("REGISTER_CAPTCHA_PROMT") ?></label>
                            <input class="form-control" type="text" id="captcha" name="captcha_word" maxlength="50" value=""/>
                        </div>
                        <? if (is_set($arResult["ERRORS"][1])): ?>
                            <? ShowError($arResult["ERRORS"][1], 'error'); ?>
                        <? endif; ?>
                        <?
                    }
                    /* !CAPTCHA */
                    ?>
                    <input class="btn btn-lg btn-login btn-block" type="submit" name="register_submit_button"
                           value="<?= GetMessage("AUTH_REGISTER") ?>"/>
                    <div class="registration">
                        Уже рарегистрированы ?
                        <a rel="nofollow" href="/auth/">
                            <?=GetMessage("AUTH_AUTH")?>
                        </a>
                    </div>
                </div>
            </form>
        <? endif ?>
    </div>
</div>
<!--container end-->