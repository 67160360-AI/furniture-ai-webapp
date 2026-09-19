<?php
declare(strict_types=1);

/**
 * Universal Database Configuration for Furniture AI
 * Supports both Local (XAMPP/WAMP) and Docker Environments
 */

$db_host = getenv('DB_HOST') ?: '127.0.0.1';
$db_port = (int)(getenv('DB_PORT') ?: 3306);
$db_name = getenv('DB_NAME') ?: 'furniture_db';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') !== false ? (string)getenv('DB_PASS') : '';

// 1. PDO Connection (Preferred for API endpoints)
try {
    $dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
    $pdo = new PDO(
        $dsn,
        $db_user,
        $db_pass,
        [
            PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES     => false,
            PDO::MYSQL_ATTR_INIT_COMMAND   => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
        ]
    );
} catch (PDOException $e) {
    // Keep $pdo null so callers can handle gracefully
    $pdo = null;
    error_log("Database PDO Connection Error: " . $e->getMessage());
}

// 2. MySQLi Helper Function (For legacy pages index.php, furniture-designer.php)
function get_mysqli_connection(): ?mysqli {
    global $db_host, $db_port, $db_name, $db_user, $db_pass;
    
    // PHP 8+ throws mysqli_sql_exception on connection failure.
    // We must wrap in try-catch to prevent fatal errors.
    try {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
        $conn->set_charset("utf8mb4");
        $conn->query("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
        return $conn;
    } catch (\Exception $e) {
        error_log("Database MySQLi Connection Error: " . $e->getMessage());
        return null;
    }
}
