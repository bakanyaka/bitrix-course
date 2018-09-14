<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
?>

<!--container start-->
<div class="login-bg">
    <div class="container">
        <div class="form-wrapper">
            <form class="form-signin wow fadeInUp" name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <h2 class="form-signin-heading"><?=GetMessage("AUTH_GET_CHECK_STRING")?></h2>
                <div class="login-wrap">
                    <?
                    if(!empty($arParams["~AUTH_RESULT"])):
                        $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
                        ?>
                        <div class="alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>"><?=nl2br(htmlspecialcharsbx($text))?></div>
                    <?endif?>
                    <p><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></p>

                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />

                    <input type="hidden" name="AUTH_FORM" value="Y">
                    <input type="hidden" name="TYPE" value="SEND_PWD">

                    <input type="text" class="form-control" placeholder="<?echo GetMessage("AUTH_LOGIN_EMAIL")?>" autofocus
                           name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>">
                    <input type="hidden" name="USER_EMAIL" />


                    <?if ($arResult["USE_CAPTCHA"]):?>
                    <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"]?>" />
                        <div class="bx-captcha">
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA" />
                        </div>
                        <input placeholder="<?echo GetMessage("system_auth_captcha")?>" class="form-control" type="text" name="captcha_word" maxlength="50" value="" autocomplete="off"/>
                    <?endif?>

                    <input type="submit" class="btn btn-lg btn-login btn-block" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />

                    <a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>

                </div>
            </form>
        </div>
    </div>
</div>
<!--container end-->

<script type="text/javascript">
document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
document.bform.USER_LOGIN.focus();
</script>
