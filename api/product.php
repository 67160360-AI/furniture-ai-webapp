<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/../config/db.php';
    if (!$pdo) {
        throw new RuntimeException('Database connection failed');
    }

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if (!$id) {
        http_response_code(400);
        echo json_encode(['error' => 'รหัสสินค้าไม่ถูกต้อง'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $statement = $pdo->prepare('SELECT id, name, price, image, description, badge, category FROM products WHERE id = ? LIMIT 1');
    $statement->execute([$id]);
    $product = $statement->fetch();
    
    if (!$product) {
        http_response_code(404);
        echo json_encode(['error' => 'ไม่พบสินค้านี้'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    echo json_encode($product, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
} catch (Throwable $error) {
    http_response_code(500);
    echo json_encode(['error' => 'เชื่อมต่อฐานข้อมูลไม่สำเร็จ'], JSON_UNESCAPED_UNICODE);
}
