<?php
$dbData = array(
    'server' => 'localhost',
    'port' => '3333',
    'name' => 'MRF',
    'user' => 'root',
    'password' => '',
);
$connection;
function createConnection()
{
    global $dbData, $connection;
    $dbDSN = "mysql://mysql:host=" . $dbData['server'] . ";port=" . $dbData['port'] . ";dbname=" . $dbData['name'] . ";charset=utf8mb4";
    $connection = new PDO($dbDSN, $dbData['user'], $dbData['password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

function createDB()
{
    global $dbData;
    $dbDSN = "mysql://mysql:host=" . $dbData['server'] . ";port=" . $dbData['port'] . ";charset=utf8mb4";
    $connection = new PDO($dbDSN, $dbData['user'], $dbData['password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $connection->exec(file_get_contents('./SQL/MRF-schema.sql'));
    $connection->exec(file_get_contents('./SQL/MRF-data.sql'));
}

//La base de datos existe
try {
    createConnection();

} //La base de datos no existe
catch (PDOException $e) {
    createDB();
    createConnection();
}
?>