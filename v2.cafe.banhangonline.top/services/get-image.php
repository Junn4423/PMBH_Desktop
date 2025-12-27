<?php

declare(strict_types=1);

require_once __DIR__ . '/image-storage-helpers.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['status' => 1008];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new RuntimeException('Method not allowed.');
    }

    $productId = isset($_GET['id']) ? trim((string)$_GET['id']) : '';
    if ($productId === '') {
        throw new InvalidArgumentException('Thiếu mã sản phẩm.');
    }

    $documentsDb = documents_db_connect();
    $columnsMeta = fetch_documents_table_columns($documentsDb);

    $imageBlob = fetch_latest_product_image($documentsDb, $productId, $columnsMeta);
    if ($imageBlob === null) {
        $response['message'] = 'Không tìm thấy hình ảnh.';
    } else {
        $response['status'] = 2002;
        $response['image'] = base64_encode($imageBlob);
    }
} catch (Throwable $exception) {
    $response['message'] = $exception->getMessage();
}

echo json_encode($response);
