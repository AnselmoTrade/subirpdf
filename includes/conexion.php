<?php
$serverName = "tcp:sqlserver-portafolio.database.windows.net,1433;Database=db_portafolio";
$connectionOptions = [
    "Database" => "db_portafolio",
    "Uid" => "Anselmo",
    "PWD" => "@71almercO",
    "Encrypt" => true,
    "TrustServerCertificate" => false
];

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=" . $connectionOptions["Database"], $connectionOptions["Uid"], $connectionOptions["PWD"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
