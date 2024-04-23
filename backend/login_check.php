<?php

session_start();
require_once __DIR__ . '/rest/services/UsersService.class.php';


$user_service = new UsersService();
$response = array('logged_in' => $user_service->logged_in());

header('Content-Type: application/json');
echo json_encode($response);
