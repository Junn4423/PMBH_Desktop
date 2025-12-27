<?php

declare(strict_types=1);

require_once __DIR__ . '/image-storage-helpers.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['status' => 1008];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new RuntimeException('Method not allowed.');
    }

    $productId = isset($_POST['id']) ? trim((string)$_POST['id']) : '';
    if ($productId === '') {
        throw new InvalidArgumentException('Thiếu mã sản phẩm.');
    }

    if (
        !isset($_FILES['image']) ||
        !isset($_FILES['image']['error']) ||
        $_FILES['image']['error'] !== UPLOAD_ERR_OK ||
        !is_uploaded_file($_FILES['image']['tmp_name'])
    ) {
        throw new InvalidArgumentException('Không tìm thấy dữ liệu hình ảnh hợp lệ.');
    }

    $imageContent = file_get_contents($_FILES['image']['tmp_name']);
    if ($imageContent === false || $imageContent === '') {
        throw new RuntimeException('Không thể đọc dữ liệu hình ảnh.');
    }

    $documentsDb = documents_db_connect();
    $columnsMeta = fetch_documents_table_columns($documentsDb);

    $username = isset($_SESSION['ERPSOFV2RUserID']) ? (string)$_SESSION['ERPSOFV2RUserID'] : 'system';
    $timestamp = date('Y-m-d H:i:s');

    $payload = build_image_insert_payload($columnsMeta, $productId, $imageContent, $username, $timestamp);

    if (!insert_document_image($documentsDb, $payload)) {
        throw new RuntimeException('Không thể lưu hình ảnh sản phẩm.');
    }

    $response['status'] = 2002;
} catch (Throwable $exception) {
    $response['message'] = $exception->getMessage();
}

echo json_encode($response);
