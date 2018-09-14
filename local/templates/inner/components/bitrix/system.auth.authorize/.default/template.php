<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

?>

<!--container start-->
<div class="login-bg">
    <div class="container">
        <div class="form-wrapper">
            <form class="form-signin wow fadeInUp" name="form_auth" method="post" target="_top"
                  action="<?= $arResult["AUTH_URL"] ?>">
                <h2 class="form-signin-heading"><?= GetMessage("AUTH_PLEASE_AUTH") ?></h2>
                <div class="login-wrap">
                    <?
                    if (!empty($arParams["~AUTH_RESULT"])):
                        $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
                        ?>
                        <div class="alert alert-danger"><?= nl2br(htmlspecialcharsbx($text)) ?></div>
                    <? endif ?>

                    <?
                    if ($arResult['ERROR_MESSAGE'] <> ''):
                        $text = str_replace(array("<br>", "<br />"), "\n", $arResult['ERROR_MESSAGE']);
                        ?>
                        <div class="alert alert-danger"><?= nl2br(htmlspecialcharsbx($text)) ?></div>
                    <? endif ?>

                    <input type="hidden" name="AUTH_FORM" value="Y"/>
                    <input type="hidden" name="TYPE" value="AUTH"/>
                    <? if (strlen($arResult["BACKURL"]) > 0): ?>
                        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                    <? endif ?>
                    <? foreach ($arResult["POST"] as $key => $value): ?>
                        <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                    <? endforeach ?>
                    <input type="text" class="form-control" placeholder="<?= GetMessage("AUTH_LOGIN") ?>" autofocus
                           name="USER_LOGIN" maxlength="255" value="<?= $arResult["LAST_LOGIN"] ?>">
                    <div class="password-wrapper">
                        <input type="password" class="form-control" placeholder="<?= GetMessage("AUTH_PASSWORD") ?>"
                               name="USER_PASSWORD" maxlength="255" autocomplete="off">
                        <? if ($arResult["SECURE_AUTH"]): ?>
                            <i class="fa fa-lock" data-toggle="tooltip" data-placement="right"
                               title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>"></i>
                        <? endif ?>
                    </div>

                    <? if ($arResult["CAPTCHA_CODE"]): ?>
                        <input type="hidden" name="captcha_sid" value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                        <div class="bx-captcha">
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>"
                                 width="180" height="40" alt="CAPTCHA"/>
                        </div>
                        <input type="text" class="form-control" name="captcha_word" maxlength="50" value=""
                               autocomplete="off" placeholder="<? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>"/>
                    <? endif; ?>

                    <? if ($arResult["STORE_PASSWORD"] == "Y"): ?>
                        <label class="checkbox">
                            <input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y"> <?= GetMessage("AUTH_REMEMBER_ME") ?>
                            <? if ($arParams["NOT_SHOW_LINKS"] != "Y"): ?>
                                <noindex>
                                <span class="pull-right">
                                    <a data-toggle="modal" href="<?= $arResult["AUTH_FORGOT_PASSWORD_URL"] ?>" rel="nofollow">
                                        <?= GetMessage("AUTH_FORGOT_PASSWORD_2") ?>
                                    </a>
                                </span>
                                </noindex>
                            <? endif ?>
                        </label>
                    <? endif ?>

                    <input type="submit" class="btn btn-lg btn-login btn-block" name="Login" value="<?= GetMessage("AUTH_AUTHORIZE") ?>"/>

                    <? if ($arResult["AUTH_SERVICES"]): ?>
                        <?
                        $APPLICATION->IncludeComponent("bitrix:socserv.auth.form",
                            "flat",
                            array(
                                "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                                "AUTH_URL" => $arResult["AUTH_URL"],
                                "POST" => $arResult["POST"],
                            ),
                            $component,
                            array("HIDE_ICONS" => "Y")
                        );
                        ?>
                    <? endif ?>

                    <? if ($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"): ?>
                        <div class="registration">
                            <noindex>
                                <?= GetMessage("AUTH_FIRST_ONE") ?>
                                <a class="" href="<?= $arResult["AUTH_REGISTER_URL"] ?>">
                                    <?= GetMessage("AUTH_REGISTER") ?>
                                </a>
                            </noindex>
                        </div>
                    <? endif ?>
                </div>
            </form>
        </div>
    </div>
</div>
<!--container end-->

<script type="text/javascript">
    <?if (strlen($arResult["LAST_LOGIN"]) > 0):?>
    try {
        document.form_auth.USER_PASSWORD.focus();
    } catch (e) {
    }
    <?else:?>
    try {
        document.form_auth.USER_LOGIN.focus();
    } catch (e) {
    }
    <?endif?>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

