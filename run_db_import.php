<?php
// run_db_import.php
try {
    $pdo = new PDO("mysql:host=localhost", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = file_get_contents(__DIR__ . '/database.sql');
    $pdo->exec($sql);
    echo "DATABASE IMPORT SUCCESSFUL! Default supervisor account updated to Workplace Supervisor.\n";
} catch (Exception $e) {
    echo "DB IMPORT WARNING: " . $e->getMessage() . "\n";
}
