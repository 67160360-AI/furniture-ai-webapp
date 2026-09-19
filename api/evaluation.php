<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$storageDir = __DIR__ . '/../database';
$storageFile = $storageDir . '/evaluation_data.json';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (file_exists($storageFile)) {
            $content = file_get_contents($storageFile);
            $data = json_decode($content, true);
            echo json_encode([
                'success' => true,
                'data' => $data,
                'source' => 'storage_file'
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            echo json_encode([
                'success' => true,
                'data' => null,
                'message' => 'ยังไม่มีข้อมูลการประเมินที่บันทึกไว้'
            ], JSON_UNESCAPED_UNICODE);
        }
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rawInput = file_get_contents('php://input');
        $payload = json_decode($rawInput, true);

        if (!$payload || !is_array($payload)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'รูปแบบข้อมูล JSON ไม่ถูกต้อง'], JSON_UNESCAPED_UNICODE);
            exit;
        }

        // Validate basic fields
        $studentId = trim((string)($payload['student_id'] ?? ''));
        $studentName = trim((string)($payload['student_name'] ?? ''));
        $projectTitle = trim((string)($payload['project_title'] ?? 'Maison Forme - Furniture & Smart Home WebApp'));
        $percentage = (float)($payload['percentage'] ?? 0.0);
        $totalScore = (float)($payload['total_score'] ?? 0.0);
        $grade = (string)($payload['grade'] ?? 'In Progress');
        $status = (string)($payload['status'] ?? 'Draft');
        $rubrics = $payload['rubrics'] ?? [];
        $reflections = trim((string)($payload['reflections'] ?? ''));

        // Clamp percentage between 0 and 100
        $percentage = max(0.0, min(100.0, $percentage));
        $totalScore = max(0.0, min(100.0, $totalScore));

        $record = [
            'student_id' => $studentId,
            'student_name' => $studentName,
            'project_title' => $projectTitle,
            'github_url' => trim((string)($payload['github_url'] ?? '')),
            'demo_url' => trim((string)($payload['demo_url'] ?? '')),
            'total_score' => $totalScore,
            'percentage' => $percentage,
            'grade' => $grade,
            'status' => $status,
            'rubrics' => $rubrics,
            'reflections' => $reflections,
            'updated_at' => date('Y-m-d H:i:s'),
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
        ];

        // Ensure database directory exists
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0777, true);
        }

        // Save to JSON storage file
        file_put_contents($storageFile, json_encode($record, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        // Optionally attempt to log into MySQL if database connection is available
        try {
            if (file_exists(__DIR__ . '/../config/db.php')) {
                require_once __DIR__ . '/../config/db.php';
                if (isset($pdo) && $pdo instanceof PDO) {
                    $pdo->exec("CREATE TABLE IF NOT EXISTS student_evaluations (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        student_id VARCHAR(50) NULL,
                        student_name VARCHAR(150) NULL,
                        project_title VARCHAR(255) NULL,
                        percentage DECIMAL(5,2) NOT NULL DEFAULT 0.00,
                        grade VARCHAR(20) NULL,
                        status VARCHAR(50) NULL,
                        evaluation_json LONGTEXT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

                    $stmt = $pdo->prepare("INSERT INTO student_evaluations 
                        (student_id, student_name, project_title, percentage, grade, status, evaluation_json) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        $studentId,
                        $studentName,
                        $projectTitle,
                        $percentage,
                        $grade,
                        $status,
                        json_encode($record, JSON_UNESCAPED_UNICODE)
                    ]);
                }
            }
        } catch (Throwable $dbErr) {
            // Non-blocking fallback: JSON storage already succeeded
        }

        echo json_encode([
            'success' => true,
            'message' => 'บันทึกผลการประเมินตนเองของนิสิตเรียบร้อยแล้ว',
            'percentage' => $percentage,
            'grade' => $grade,
            'status' => $status,
            'updated_at' => $record['updated_at']
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method Not Allowed'], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'เกิดข้อผิดพลาดในการประมวลผล: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
