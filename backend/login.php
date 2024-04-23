<?php

require_once __DIR__ . '/rest/services/UsersService.class.php';

$email = $_POST['email'];
$password = $_POST['password'];

$user = array(
    'email' => $email,
    'password' => $password,
);

$user_service = new UsersService();
$user_service->login($user);
