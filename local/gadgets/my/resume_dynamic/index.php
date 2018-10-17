<?php
/** @var array $arGadgetParams */

use Bitrix\Main\Type\DateTime;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

CUtil::InitJSCore(['chart']);


if (!CModule::IncludeModule("iblock")) {
    ShowMessage(GetMessage("GD_RESUME_ERROR_IBLOCK_NOT_INSTALLED"));
    return false;
}

if (!isset($arGadget["SETTINGS"]["IBLOCK_ID"])) {
    ShowMessage(GetMessage("GD_RESUME_ERROR_IBLOCK_NOT_SPECIFIED"));
    return false;
}

$arGadgetParams["IBLOCK_ID"] = intval($arGadgetParams["IBLOCK_ID"]);
if ($arGadgetParams["IBLOCK_ID"] <= 0) {
    return false;
}

$arGadgetParams["PERIOD_DAYS"] = intval($arGadgetParams["PERIOD_DAYS"]);
if ($arGadgetParams["PERIOD_DAYS"] < 0) {
    $arGadgetParams["PERIOD_DAYS"] = 7;
}

$periodDays = $arGadgetParams["PERIOD_DAYS"];

$obCache = new CPageCache;
$cacheTime = 0;
$cacheId = $arGadgetParams["IBLOCK_ID"] . $arGadgetParams["PERIOD_DAYS"];

if ($obCache->StartDataCache($cacheTime, $cacheId, "/")) {

    $data = [];
    $totalResumesPerPeriod = 0;

    $order = ["DATE_CREATE" => 'asc'];
    $select = ["DATE_CREATE_UNIX"];
    $filter = [
        "IBLOCK_ID" => $arGadgetParams["IBLOCK_ID"]
    ];

    if ($periodDays > 0) {
        $filter[">DATE_CREATE"] = (new DateTime())->add("- $periodDays days");
    }

    $result = \CIBlockElement::GetList([], $filter, false, [], $select);

    while ($item = $result->GetNext()) {
        $objDateTime = DateTime::createFromTimestamp($item["DATE_CREATE_UNIX"]);
        $date = $objDateTime->format("Y-m-d");
        $data[$date] += 1;
        $totalResumesPerPeriod++;
    }

    // Fill missing dates with zero count
    $currentDateTime = new DateTime();
    if (!isset($data[$currentDateTime->format("Y-m-d")])) {
        $data[$currentDateTime->format("Y-m-d")] = 0;
    }
    for ($i = 1; $i < $periodDays; $i++) {
        $date = $currentDateTime->add("-1 day")->format("Y-m-d");
        if (!isset($data[$date])) {
            $data[$date] = 0;
        }
    }

    ksort($data);

    // Transform to chartjs compatible array
    $dataXY = [];
    foreach ($data as $date => $count) {
        $dataXY[] = ['x' => $date, 'y' => $count];
    }

    ?>

    <div style="width: 99%">
        <p>
            Всего резюме за период: <?= $totalResumesPerPeriod ?>
        </p>
        <canvas id="myChart"></canvas>
    </div>
    <script>
      BX.ready(function () {
        var timeFormat = 'YYYY-MM-DD';
        var color = Chart.helpers.color;
        var data = <?= json_encode($dataXY) ?>;
        var config = {
          type: 'line',
          data: {
            datasets: [{
              label: 'Резюме',
              backgroundColor: color('red').alpha(0.5).rgbString(),
              borderColor: 'red',
              fill: false,
              data: data
            }]
          },
          options: {
            responsive: true,
            title: {
              text: 'Chart.js Time Scale'
            },
            scales: {
              xAxes: [{
                type: 'time',
                time: {
                  parser: timeFormat,
                  minUnit: 'day',
                  tooltipFormat: 'll',
                },
                ticks: {
                  source: 'auto'
                },
                scaleLabel: {
                  display: true,
                  labelString: 'Дата'
                }
              }],
              yAxes: [{
                scaleLabel: {
                  display: true,
                  labelString: 'Количество'
                },
                ticks: {
                  stepSize: 1
                }
              }]
            },
          }
        };

        var ctx = document.getElementById('myChart').getContext('2d');
        window.myLine = new Chart(ctx, config);
      })
    </script>
    <?
    $obCache->EndDataCache();
}