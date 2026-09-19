<?php
declare(strict_types=1);

session_start();
header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/../config/db.php';
    if (!$pdo) {
        throw new RuntimeException('Database connection failed');
    }

    $input = json_decode(file_get_contents('php://input'), true) ?: [];
    $username = trim((string)($input['username'] ?? ''));
    $password = (string)($input['password'] ?? '');
    $confirmPassword = (string)($input['confirm_password'] ?? '');

    if ($username === '' || $password === '') {
        http_response_code(400);
        echo json_encode(['error' => 'กรุณากรอกชื่อผู้ใช้และรหัสผ่าน'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($password !== $confirmPassword) {
        http_response_code(400);
        echo json_encode(['error' => 'รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // ตรวจสอบว่ามีชื่อผู้ใช้นี้อยู่ในระบบแล้วหรือยัง
    $check = $pdo->prepare('SELECT id FROM users WHERE username = ? LIMIT 1');
    $check->execute([$username]);
    if ($check->fetch()) {
        http_response_code(400);
        echo json_encode(['error' => 'ชื่อผู้ใช้นี้ถูกใช้งานแล้ว กรุณาใช้ชื่ออื่น'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // บันทึกข้อมูลผู้ใช้ใหม่ลงฐานข้อมูลพร้อมเข้ารหัสรหัสผ่าน
    $statement = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $statement->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);

    echo json_encode(['success' => true, 'message' => 'สมัครสมาชิกสำเร็จ'], JSON_UNESCAPED_UNICODE);
} catch (Throwable $error) {
    http_response_code(500);
    echo json_encode(['error' => 'เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล'], JSON_UNESCAPED_UNICODE);
}
