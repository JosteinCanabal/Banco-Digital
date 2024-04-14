<?php
// Parámetros de conexión a la base de datos
$host = 'localhost';
$dbname = 'jcbank_bd';

// Conexión a la base de datos usando PDO
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", 'root', ''); // Usuario: 'root', Contraseña: ''
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
?>
