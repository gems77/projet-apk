<?php
$db_config = [
    'host' => 'localhost',
    'dbname' => 'apk_downloads',
    'username' => 'root',
    'password' => 'Elodie22.'           
];

function getPDO() {
    global $db_config;
    try {
        return new PDO(
            "mysql:host={$db_config['host']};dbname={$db_config['dbname']}",
            $db_config['username'],
            $db_config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        die("Erreur DB: " . $e->getMessage());
    }
}
?>