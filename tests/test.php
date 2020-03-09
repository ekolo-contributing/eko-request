<?php

    require_once __DIR__.'/../vendor/autoload.php';

    use Ekolo\Components\EkoRequest\APIRequest;

    APIRequest::post('http://localhost:3000/admins/login', ['username' => 'josue', 'password' => '123456789'], null, function ($results) {
        debug($results);
    });