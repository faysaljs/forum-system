<?php 
$host = "localhost";
$user = "root";
$dbName = "forum";
$password = "";
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbName",$user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "connection failed." . $e->getMessage();
}