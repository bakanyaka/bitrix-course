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
$this->setFrameMode(true);
?>
<div class="row">
    <div class="col-md-12">
        <div>
            <img
                    class="detail_picture"
                    border="0"
                    src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                    width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
                    height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
                    alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                    title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
            />
        </div>
    </div>
</div>

<div class="row">
    <!--portfolio-single start-->

    <div class="col-lg-9 ">
        <div class="title">
            <h3><?= $arResult["NAME"] ?></h3>
            <hr>
        </div>
        <div class="pf-detail">
            <?echo $arResult["DETAIL_TEXT"];?>
        </div>
        <p><button class="btn bg-maroon margin"><i class="fa fa-file pr-5"></i>Скачать в PDF</button></p>
    </div>

    <div class="col-lg-3">
        <div class="title">
            <h3><?= "{$arResult['DISPLAY_PROPERTIES']['ATT_SURNAME']['VALUE']} {$arResult['DISPLAY_PROPERTIES']['ATT_FIRST_NAME']['VALUE']} {$arResult['DISPLAY_PROPERTIES']['ATT_MIDDLE_NAME']['VALUE']}" ?></h3>
            <hr>
        </div>
        <ul class="list-unstyled pf-list">
            <li><i class="fa fa-arrow-circle-right pr-10"></i><b>Client: </b> <span><a href="#">wrapbootstrap</a></span></li>
            <li><i class="fa fa-arrow-circle-right pr-10"></i><b>Skills: </b><span><a href="#">WordPress</a>, <a href="#">HTML5</a></span></li>
            <li><i class="fa fa-arrow-circle-right pr-10"></i><b>Colors: </b><span>blue, gray, purple</span></li>
            <li><i class="fa fa-arrow-circle-right pr-10"></i><b>Release Date: </b><span>06 January, 2014</span></li>
            <li><i class="fa fa-arrow-circle-right pr-10"></i><b>Launch Project: </b><span><a href="www.wrapbootstrap.com">wrapbootstrap</a></span></li>
        </ul>
    </div>
</div>
<ul class="pager">
    <li class="previous"><a href="#">&larr; Older</a></li>
    <li class="next"><a href="#">Newer &rarr;</a></li>
</ul>
<hr>

<!--recent work start-->
<div class="row">
    <div class="col-lg-12 recent">
        <h3>Related Work</h3>
        <p>Some of our work we have done earlier</p>
        <div id="owl-demo" class="owl-carousel owl-theme wow fadeIn">

            <div class="item view view-tenth">
                <img src="img/works/img8.jpg" alt="work Image">
                <div class="mask">
                    <a href="portfolio-single-image.html" class="info" data-toggle="tooltip" data-placement="top" title="Details">
                        <i class="fa fa-link"></i>
                    </a>
                </div>
            </div>
            <div class="item view view-tenth">
                <img src="img/works/img9.jpg" alt="work Image">
                <div class="mask">
                    <a href="portfolio-single-image.html" class="info" data-toggle="tooltip" data-placement="top" title="Details">
                        <i class="fa fa-link"></i>
                    </a>
                </div>
            </div>
            <div class="item view view-tenth">
                <img src="img/works/img10.jpg" alt="work Image">
                <div class="mask">
                    <a href="portfolio-single-image.html" class="info" data-toggle="tooltip" data-placement="top" title="Details">
                        <i class="fa fa-link"></i>
                    </a>
                </div>
            </div>
            <div class="item view view-tenth">
                <img src="img/works/img11.jpg" alt="work Image">
                <div class="mask">
                    <a href="portfolio-single-image.html" class="info" data-toggle="tooltip" data-placement="top" title="Details">
                        <i class="fa fa-link"></i>
                    </a>
                </div>
            </div>
            <div class="item view view-tenth">
                <img src="img/works/img12.jpg" alt="work Image">
                <div class="mask">
                    <a href="blog_detail.html" class="info" data-toggle="tooltip" data-placement="top" title="Details">
                        <i class="fa fa-link"></i>
                    </a>
                </div>
            </div>
            <div class="item view view-tenth">
                <img src="img/works/img13.jpg" alt="work Image">
                <div class="mask">
                    <a href="blog_detail.html" class="info" data-toggle="tooltip" data-placement="top" title="Details">
                        <i class="fa fa-link"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--recent work end-->

<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>

	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>