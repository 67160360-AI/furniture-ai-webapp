<?php
declare(strict_types=1);

session_start();
header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/../config/db.php';
    if (!$pdo) {
        throw new RuntimeException('Database connection failed');
    }

    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(['error' => 'กรุณาเข้าสู่ระบบก่อน'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $statement = $pdo->prepare('SELECT id, username, created_at FROM users WHERE id = ? LIMIT 1');
        $statement->execute([(int)$_SESSION['user_id']]);
        $user = $statement->fetch();
        if (!$user) {
            throw new RuntimeException('ไม่พบข้อมูลผู้ใช้');
        }
        echo json_encode($user, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }

    $input = json_decode(file_get_contents('php://input'), true) ?: [];
    $username = trim((string)($input['username'] ?? ''));
    $password = (string)($input['password'] ?? '');

    if (mb_strlen($username) < 3) {
        throw new InvalidArgumentException('ชื่อผู้ใช้ต้องมีอย่างน้อย 3 ตัวอักษร');
    }

    $check = $pdo->prepare('SELECT id FROM users WHERE username = ? AND id <> ? LIMIT 1');
    $check->execute([$username, (int)$_SESSION['user_id']]);
    if ($check->fetch()) {
        throw new InvalidArgumentException('ชื่อผู้ใช้นี้ถูกใช้งานแล้ว');
    }

    if ($password !== '') {
        if (strlen($password) < 6) {
            throw new InvalidArgumentException('รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร');
        }
        $statement = $pdo->prepare('UPDATE users SET username = ?, password = ? WHERE id = ?');
        $statement->execute([$username, password_hash($password, PASSWORD_DEFAULT), (int)$_SESSION['user_id']]);
    } else {
        $statement = $pdo->prepare('UPDATE users SET username = ? WHERE id = ?');
        $statement->execute([$username, (int)$_SESSION['user_id']]);
    }

    $_SESSION['username'] = $username;
    echo json_encode(['success' => true, 'username' => $username], JSON_UNESCAPED_UNICODE);
} catch (InvalidArgumentException $error) {
    http_response_code(422);
    echo json_encode(['error' => $error->getMessage()], JSON_UNESCAPED_UNICODE);
} catch (Throwable $error) {
    http_response_code(500);
    echo json_encode(['error' => 'ไม่สามารถแก้ไขข้อมูลได้'], JSON_UNESCAPED_UNICODE);
}
