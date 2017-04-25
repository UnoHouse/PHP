<?php
error_reporting( E_ALL );

header('Content-Type: application/json');
$swagger = file_get_contents('swagger.json');
echo $swagger;
