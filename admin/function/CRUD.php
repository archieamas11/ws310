<?php
/**
 * Insert data into any table
 */
function insertData($conn, $table, $data) {
    $columns = implode(", ", array_keys($data));
    $placeholders = implode(", ", array_fill(0, count($data), "?"));

    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    $types = "";
    $values = [];
    foreach ($data as $value) {
        $types .= (is_int($value) ? "i" : (is_double($value) ? "d" : "s"));
        $values[] = $value;
    }

    $stmt->bind_param($types, ...$values);
    return $stmt->execute() ? $stmt->insert_id : false;
}

/**
 * Retrieve data from any table with optional conditions
 */
function getData($conn, $table, $conditions = []) {
    $sql = "SELECT * FROM $table";
    if (!empty($conditions)) {
        $whereClauses = [];
        $values = [];
        $types = "";

        foreach ($conditions as $column => $value) {
            $whereClauses[] = "$column = ?";
            $types .= (is_int($value) ? "i" : (is_double($value) ? "d" : "s"));
            $values[] = $value;
        }

        $sql .= " WHERE " . implode(" AND ", $whereClauses);
    }

    $stmt = $conn->prepare($sql);
    if (!empty($conditions)) {
        $stmt->bind_param($types, ...$values);
    }

    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

/**
 * Update data in any table
 */
function updateData($conn, $table, $data, $conditions) {
    $setClauses = [];
    $values = [];
    $types = "";

    foreach ($data as $column => $value) {
        $setClauses[] = "$column = ?";
        $types .= (is_int($value) ? "i" : (is_double($value) ? "d" : "s"));
        $values[] = $value;
    }

    $whereClauses = [];
    foreach ($conditions as $column => $value) {
        $whereClauses[] = "$column = ?";
        $types .= (is_int($value) ? "i" : (is_double($value) ? "d" : "s"));
        $values[] = $value;
    }

    $sql = "UPDATE $table SET " . implode(", ", $setClauses) . " WHERE " . implode(" AND ", $whereClauses);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$values);

    return $stmt->execute();
}

/**
 * Delete data from any table
 */
function deleteData($conn, $table, $conditions) {
    $whereClauses = [];
    $values = [];
    $types = "";

    foreach ($conditions as $column => $value) {
        $whereClauses[] = "$column = ?";
        $types .= (is_int($value) ? "i" : (is_double($value) ? "d" : "s"));
        $values[] = $value;
    }

    $sql = "DELETE FROM $table WHERE " . implode(" AND ", $whereClauses);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$values);

    return $stmt->execute();
}
?>
