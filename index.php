<?php
require_once __DIR__ . '/vendor/autoload.php';

$pdo = \App\PDO::pdo();

$mapper = new \App\UserMapper($pdo);

$user = new \App\User('Paul Smith');
$user->addPhoto('family1', '/path/to/photo/family1');
$user->addPhoto('party1', '/path/to/photo/party1');
$user->addPhoto('friends1', '/path/to/photo/friends1');

$mapper = new \App\UserMapper($pdo);
$mapper->save($user);

echo 'Ok';