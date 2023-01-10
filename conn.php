<?php
// Connect to the database
$dsn = 'mysql:host=localhost;dbname=prod-rating';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>