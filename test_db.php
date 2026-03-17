<?php
$host = '192.168.254.254';
$port = '6543';
$db   = 'postgres';
$user = 'postgres.fsmgygpzsiidkcmolkjp';
$pass = 'Gardo@5476030303';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_TIMEOUT => 10,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "Connected successfully!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}