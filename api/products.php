<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/../config/db.php';
    if (!$pdo) {
        throw new RuntimeException('Database connection failed');
    }
    
    $stmt = $pdo->query('SELECT id, name, price, image, description, badge, category FROM products ORDER BY id ASC');
    $products = $stmt->fetchAll();
    
    echo json_encode($products, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
} catch (Throwable $error) {
    http_response_code(500);
    echo json_encode(['error' => 'เชื่อมต่อฐานข้อมูลไม่สำเร็จ: ' . $error->getMessage()], JSON_UNESCAPED_UNICODE);
}
