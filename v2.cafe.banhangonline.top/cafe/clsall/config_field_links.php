<?php

// config_field_links.php

return [
    'lv008' => [ 
        'table' => 'lv_lv0004',
        'key' => 'lv001',    
        'value' => 'lv002',   
    ],
    'lv009' => [ 
        'table' => 'hr_lv0022',
        'key' => 'lv001',    
        'value' => 'lv002',   
    ],
    'lv022'=>[
        'table' => 'hr_lv0014',
        'key' => 'lv001',
        'value' => 'lv002'
    ],
    'lv023'=>[
        'table' => 'hr_lv0016',
        'key' => 'lv001',
        'value' => 'lv002'
    ],
    'lv024'=>[
        'table' => 'hr_lv0017',
        'key' => 'lv001',
        'value' => 'lv002'
    ],
    'lv025' => [ 
        'table' => 'hr_lv0015',
        'key' => 'lv001',    
        'value' => 'lv002',   
    ],
    'lv026' => [ 
        'table' => 'hr_lv0007',
        'key' => 'lv001',    
        'value' => 'lv002',   
    ],
    'lv027' => [ 
        'table' => 'hr_lv0004',
        'key' => 'lv001',    
        'value' => 'lv002',   
    ],
    'lv028' => [ 
        'table' => 'hr_lv0005',
        'key' => 'lv001',    
        'value' => 'lv002',   
    ],
    'lv029' => [ 
        'table' => 'hr_lv0002',
        'key' => 'lv001',    
        'value' => 'lv003',   
    ],
    'lv031' => [ 
        'table' => 'hr_lv0014',
        'key' => 'lv001',    
        'value' => 'lv002',   
    ],
];

function resolve_foreign_keys(&$data, $config) {
    $foreignData = [];

    // Gom tất cả các mã cần truy vấn theo từng field (cột)
    foreach ($data as $row) {
        foreach ($config as $field => $meta) {
            $value = $row[$field] ?? null;
            if ($value !== '') {
                $foreignData[$field][$value] = true;
            }
        }
    }

    // Truy vấn lấy giá trị hiển thị từ các bảng liên quan
    $resolvedMaps = [];
    foreach ($foreignData as $field => $ids) {
        $meta = $config[$field];
        $keys = array_keys($ids);
        $keyStr = "'" . implode("','", array_map('addslashes', $keys)) . "'";
        $sql = "SELECT {$meta['key']} AS k, {$meta['value']} AS v FROM {$meta['table']} WHERE {$meta['key']} IN ($keyStr)";
        $rs = db_query($sql);
        while ($row = db_fetch_array($rs, MYSQLI_ASSOC)) {
            $resolvedMaps[$field][$row['k']] = $row['v'];
        }
    }

    // Gắn giá trị hiển thị vào dữ liệu chính (ghi đè)
    foreach ($data as &$row) {
        foreach ($config as $field => $meta) {
            $value = $row[$field] ?? null;
            $resolvedValue = $resolvedMaps[$field][$value] ?? $value;

            // Ghi đè giá trị mã bằng giá trị hiển thị
            $row[$field] = $resolvedValue;
        }
    }
}