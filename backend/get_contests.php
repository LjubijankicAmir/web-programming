<?php

require_once __DIR__ . '/rest/services/ContestsService.class.php';

$contests_service = new ContestsService();
$contests = $contests_service->get_contests();
echo json_encode($contests);
