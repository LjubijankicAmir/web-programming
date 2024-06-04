<?php

require __DIR__ . '/../../../vendor/autoload.php';

if($_SERVER['SERVER_NAME'] == 'localhost'){
    define('BASE_URL', 'http://localhost/project/backend/');
} else{
    define('BASE_URL', 'https://urchin-app-a78me.ondigitalocean.app/backend/');
}

error_reporting(0);

$openapi = \OpenApi\Generator::scan(['../../../rest/routes', './']);
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
?>
