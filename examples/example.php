<?php

require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$response = $client->get('http://localhost:8080/v1/villages');
$options = json_decode($response->getBody(), true);

foreach ($options as $option) {
    echo $option['label'] . PHP_EOL;
}
