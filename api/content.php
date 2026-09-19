<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/../config/db.php';
    if (!$pdo) {
        throw new RuntimeException('Database connection failed');
    }

    $page = trim((string)($_GET['page'] ?? ''));
    $allowedPages = ['services', 'promo', 'devices'];
    if (!in_array($page, $allowedPages, true)) {
        http_response_code(400);
        echo json_encode(['error' => 'หน้าที่ระบุไม่ถูกต้อง'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $statement = $pdo->prepare('SELECT content_key, title, description FROM site_content WHERE page_name = ? ORDER BY sort_order, id');
    $statement->execute([$page]);
    echo json_encode($statement->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
} catch (Throwable $error) {
    http_response_code(500);
    echo json_encode(['error' => 'โหลดเนื้อหาไม่สำเร็จ'], JSON_UNESCAPED_UNICODE);
}
