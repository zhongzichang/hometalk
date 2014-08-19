<?php

use Zzc\Chat\Controller\AuthController;
use Zzc\Chat\Controller\MessageController;

$authController = new AuthController();
$messageController = new MessageController();
return array(
    'auth.login' => array($authController,'login'),
    'test' => array($authController,'test'),
    'message' => array($messageController,'send'),
);