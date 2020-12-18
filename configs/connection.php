<?php

$ini = parse_ini_file("config.ini");
try {
    $connection = new PDO("mysql:host=".$ini['host'].";dbname=".$ini['dbname'], $ini['user'], $ini['password']);
} catch (PDOException $e) {
    die('No DB connection!');
}
session_start();

