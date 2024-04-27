<?php

require_once __DIR__ . '/rest/services/UsersService.class.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$send_updates = $_POST['send_updates'];

$user = array(
    'username' => $username,
    'email' => $email,
    'password' => $hashed_password,
    'send_updates' => $send_updates
);

$user_service = new UsersService();
$user_service->add_user($user);
