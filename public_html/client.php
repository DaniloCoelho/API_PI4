<?php

    $url = 'http://localhost/PI_api/public_html/api';

    $class = '/estacionamento';
    $param = '';

    $response = file_get_contents($url.$class.$param);

    echo $response;

    //
    //$response = json_decode($response, 1);
    //var_dump($response['data'][1]['email']);