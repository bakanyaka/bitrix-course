<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<div class="search-row">
    <form action="<?=$arResult["FORM_ACTION"]?>">
        <input type="text" name="q" maxlength="50" class="form-control" placeholder="<?=GetMessage("BSF_T_SEARCH_HERE");?>">
    </form>
</div>