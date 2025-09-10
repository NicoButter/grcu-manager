<?php
$dbhost = 'localhost';
$dbuser = 'c2621905_valru';
$dbpass = 'fi68diZEfi';
$dbname = 'c2621905_valru';

// Conexión con mysqli (tu estilo)
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error al conectar: ' . mysqli_connect_error());
mysqli_set_charset($conn, 'utf8mb4');

// También PDO para consultas más modernas (opcional)
try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión PDO: " . $e->getMessage());
}
?>