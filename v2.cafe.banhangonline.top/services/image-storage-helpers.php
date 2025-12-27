<?php

declare(strict_types=1);

require_once __DIR__ . '/config.php';

function documents_db_connect(): mysqli
{
    static $connection = null;

    if ($connection instanceof mysqli) {
        return $connection;
    }

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PWD, 'all_gmac_documents_v3_0');

    if (!$connection) {
        throw new RuntimeException('Không thể kết nối tới cơ sở dữ liệu hình ảnh.');
    }

    mysqli_set_charset($connection, 'utf8mb4');

    return $connection;
}

function fetch_documents_table_columns(mysqli $connection): array
{
    $columns = [];
    $sql = "SHOW COLUMNS FROM `all_gmac_documents_v3_0`.`sl_lv0007`";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        throw new RuntimeException('Không thể đọc cấu trúc bảng lưu trữ hình ảnh.');
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $columns[$row['Field']] = $row;
    }
    mysqli_free_result($result);

    return $columns;
}

function should_fill_column(array $columnsMeta, string $column): bool
{
    if (!isset($columnsMeta[$column])) {
        return false;
    }

    $definition = $columnsMeta[$column];

    if (isset($definition['Extra']) && strpos($definition['Extra'], 'auto_increment') !== false) {
        return false;
    }

    return true;
}

function build_image_insert_payload(
    array $columnsMeta,
    string $productId,
    string $imageContent,
    string $username,
    string $timestamp
): array {
    $data = [];

    if (should_fill_column($columnsMeta, 'lv002')) {
        $data['lv002'] = $username;
    }

    if (should_fill_column($columnsMeta, 'lv003')) {
        $data['lv003'] = 'anhsanpham';
    }

    if (should_fill_column($columnsMeta, 'lv007')) {
        $data['lv007'] = $productId;
    }

    if (should_fill_column($columnsMeta, 'lv008')) {
        $data['lv008'] = $imageContent;
    }

    if (should_fill_column($columnsMeta, 'created_at')) {
        $data['created_at'] = $timestamp;
    }

    if (should_fill_column($columnsMeta, 'updated_at')) {
        $data['updated_at'] = $timestamp;
    }

    if (!isset($data['lv007']) || !isset($data['lv008'])) {
        throw new InvalidArgumentException('Thiếu cột bắt buộc khi lưu hình ảnh.');
    }

    return $data;
}

function insert_document_image(mysqli $connection, array $data): bool
{
    $columns = array_keys($data);
    $placeholders = implode(', ', array_fill(0, count($columns), '?'));
    $quotedColumns = implode(', ', array_map(static fn(string $column) => "`$column`", $columns));

    $sql = sprintf(
        'INSERT INTO `all_gmac_documents_v3_0`.`sl_lv0007` (%s) VALUES (%s)',
        $quotedColumns,
        $placeholders
    );

    $statement = mysqli_prepare($connection, $sql);
    if (!$statement) {
        throw new RuntimeException('Không thể chuẩn bị truy vấn lưu hình ảnh.');
    }

    $types = '';
    $values = [];

    foreach ($columns as $column) {
        if ($column === 'lv008') {
            $types .= 'b';
        } else {
            $types .= 's';
        }
        $values[] = $data[$column];
    }

    $bindParams = [$statement, $types];
    foreach ($values as $index => $value) {
        $bindParams[] = &$values[$index];
    }

    if (!call_user_func_array('mysqli_stmt_bind_param', $bindParams)) {
        mysqli_stmt_close($statement);
        throw new RuntimeException('Không thể gán tham số cho truy vấn lưu hình ảnh.');
    }

    $blobIndex = array_search('lv008', $columns, true);
    if ($blobIndex !== false) {
        mysqli_stmt_send_long_data($statement, $blobIndex, $data['lv008']);
    }

    $result = mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    return $result === true;
}

function determine_image_order_column(array $columnsMeta): ?string
{
    foreach ($columnsMeta as $name => $definition) {
        if (isset($definition['Extra']) && strpos($definition['Extra'], 'auto_increment') !== false) {
            return $name;
        }
    }

    if (isset($columnsMeta['created_at'])) {
        return 'created_at';
    }

    if (isset($columnsMeta['updated_at'])) {
        return 'updated_at';
    }

    if (isset($columnsMeta['lv009'])) {
        return 'lv009';
    }

    return null;
}

function fetch_latest_product_image(mysqli $connection, string $productId, array $columnsMeta): ?string
{
    if (!isset($columnsMeta['lv007']) || !isset($columnsMeta['lv008'])) {
        throw new RuntimeException('Bảng lưu trữ hình ảnh không có cấu trúc phù hợp.');
    }

    $orderColumn = determine_image_order_column($columnsMeta);
    $orderClause = $orderColumn !== null ? " ORDER BY `$orderColumn` DESC" : '';

    $sql = "SELECT `lv008` FROM `all_gmac_documents_v3_0`.`sl_lv0007` WHERE `lv007` = ?{$orderClause} LIMIT 1";
    $statement = mysqli_prepare($connection, $sql);

    if (!$statement) {
        throw new RuntimeException('Không thể chuẩn bị truy vấn lấy hình ảnh.');
    }

    mysqli_stmt_bind_param($statement, 's', $productId);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);

    if (mysqli_stmt_num_rows($statement) === 0) {
        mysqli_stmt_close($statement);
        return null;
    }

    mysqli_stmt_bind_result($statement, $imageBlob);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);

    return $imageBlob !== null ? (string)$imageBlob : null;
}
