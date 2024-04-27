<?php

require_once __DIR__ . '/rest/services/ContestsService.class.php';

$contests_service = new ContestsService();
$contestId = $_GET['contestId'];
$contest = $contests_service->get_contest_details($contestId);
echo json_encode($contest);
