<?php

use Zzc\Chat\Controller\AuthController;

return array(
    'auth.login' => array(new AuthController(),'login'),
    'test' => array(new AuthController(),'test')
);