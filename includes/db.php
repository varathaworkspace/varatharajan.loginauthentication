<?php
require __DIR__ . '/../vendor/autoload.php'; // Include Composer autoload

use MongoDB\Client;

function getMongoDB() {
    $client = new Client("mongodb://localhost:27017");
    return $client->selectDatabase('login_project');
}
?>