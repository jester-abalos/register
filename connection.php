<?php
require 'vendor/autoload.php'; // Include Composer's autoloader

if ($client = new MongoDB\Client("mongodb://localhost:27017")) {
    $database = $client->selectDatabase("myfirstdb"); // Replace "myfirstdb" with your database name
   
} else {
    echo "Failed to connect to MongoDB: ";
}

