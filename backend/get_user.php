<?php

session_start();

require_once __DIR__ . '/rest/services/UsersService.class.php';

$user_service = new UsersService();    
$user = $user_service->get_user($_SESSION['user_id']);
 echo json_encode($user);
?>



