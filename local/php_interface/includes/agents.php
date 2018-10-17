<?php
use Bitrix\Main\Entity;
use Bitrix\Main\Type\DateTime;

const REGISTERED_USERS_REPORT_EVENT_NAME = "WEEKLY_REGISTERED_USERS_REPORT";
const EMPLOYERS_GROUP_ID = 6;
const APPLICANTS_GROUP_ID = 7;

function AgentSendRegisteredUsersReport() {

    $resAdminsAndModerators = \Bitrix\Main\UserTable::getList([
        "select" => ["ID", "EMAIL"],
        "filter" => [
            "UserGroup:USER.GROUP_ID" => [1, 8]
        ]
    ])->fetchCollection();

    $mailTo = $resAdminsAndModerators->getEmailList();

    if(count($mailTo) < 1) {
        return "AgentSendRegisteredUsersReport();";
    }

    $registeredLastWeek = [];
    $currentDateTime = new DateTime();
    for ($i=1; $i <= 7; $i++) {
        $date = $currentDateTime->add("-1 day")->format("Y-m-d");
        $registeredLastWeek[$date] = [
            'dayofweek' => $currentDateTime->format('D'),
            'employers' => 0,
            'applicants' => 0
        ];
    }

    $resLastWeekEmployers = \Bitrix\Main\UserTable::getList([
        "select" => ["DATE_R", "COUNT", "UserGroup:USER.GROUP_ID"],
        "filter" => [
            "UserGroup:USER.GROUP_ID" => [APPLICANTS_GROUP_ID, EMPLOYERS_GROUP_ID],
            ">=DATE_REGISTER" => (new DateTime())->add("-7 days"),
            "<DATE_REGISTER" => new DateTime()
        ],
        "group" => ["DATE_R", "UserGroup:USER.GROUP_ID"],
        'runtime' => [
            new Entity\ExpressionField('COUNT', 'COUNT(*)'),
            new Entity\ExpressionField('DATE_R', 'DATE(DATE_REGISTER)'),
        ]
    ]);

    dd($resLastWeekEmployers->fetchAll());

    foreach ($resLastWeekEmployers->fetchAll() as $employersPerDate) {
        $date = $employersPerDate["DATE_R"]->format("Y-m-d");
        $registeredLastWeek[$date]["employers"] = $employersPerDate["COUNT"];
    }

    $resLastWeekApplicants = \Bitrix\Main\UserTable::getList([
        "select" => ["DATE_R", "COUNT"],
        "filter" => [
            "UserGroup:USER.GROUP_ID" => APPLICANTS_GROUP_ID,
            ">=DATE_REGISTER" => (new DateTime())->add("-7 days"),
            "<DATE_REGISTER" => new DateTime()
        ],
        "group" => ["DATE_R"],
        'runtime' => [
            new Entity\ExpressionField('COUNT', 'COUNT(*)'),
            new Entity\ExpressionField('DATE_R', 'DATE(DATE_REGISTER)'),
        ]
    ]);

    foreach ($resLastWeekApplicants->fetchAll() as $applicantsPerDate) {
        $date = $applicantsPerDate["DATE_R"]->format("Y-m-d");
        $registeredLastWeek[$date]["applicants"] = $applicantsPerDate["COUNT"];
    }

    $eventFields = [
        "EMAIL" => implode(", ", $mailTo),
    ];

    foreach ($registeredLastWeek as $date => $data) {
        $dayOfWeek = strtoupper($data["dayofweek"]);
        $eventFields["{$dayOfWeek}_DATE"] = $date;
        $eventFields["{$dayOfWeek}_EMPLOYERS"] = $data["employers"];
        $eventFields["{$dayOfWeek}_APPLICANTS"] = $data["applicants"];
    }

    CEvent::Send(REGISTERED_USERS_REPORT_EVENT_NAME, "s1", $eventFields);

    return "AgentSendRegisteredUsersReport();";
}