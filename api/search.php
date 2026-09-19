<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/../config/db.php';
    if (!$pdo) {
        throw new RuntimeException('Database connection failed');
    }

    $keyword = trim((string)($_GET['keyword'] ?? ''));
    if ($keyword === '') {
        echo json_encode([], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        exit;
    }

    $statement = $pdo->prepare(
        'SELECT id, name, price, image, description, badge, category
         FROM products
         WHERE name LIKE :name_keyword OR description LIKE :description_keyword
         ORDER BY id ASC'
    );
    $searchValue = "%{$keyword}%";
    $statement->execute([
        'name_keyword' => $searchValue,
        'description_keyword' => $searchValue,
    ]);
    echo json_encode($statement->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
} catch (Throwable $error) {
    http_response_code(500);
    echo json_encode(['error' => 'ค้นหาสินค้าไม่สำเร็จ'], JSON_UNESCAPED_UNICODE);
}
