<?php

require_once __DIR__ . '/../config/db.php';


function getCertificateDeatils($id) {
    global $conn;
    $sql = "SELECT * FROM badges WHERE unique_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
function getCertificates($query = null, $sort = null, $limit = null) {
    global $conn;
    $sql = "SELECT * FROM badges";
    $params = [];
    $types = "";

    if ($query && !empty($query)) {
        $sql .= " WHERE holder LIKE ? OR badge_name LIKE ? OR badge_type LIKE ?";
        $query = "%$query%";
        $params = array_merge($params, [$query, $query, $query]);
        $types .= "sss";
    }
    // if ($sort) {
    //     $sql .= " ORDER BY $sort";
    // }
    if ($limit) {
        $sql .= " LIMIT ?";
        $params[] = $limit;
        $types .= "i";
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("SQL prepare error: " . $conn->error);
        return []; // Return an empty array if the query preparation fails
    }

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $certificates = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $certificates[] = $row;
        }
    }
    return $certificates;
}

function deleteBadgeById($id) {
    global $conn;
    $sql = "DELETE FROM badges WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

function generateCertificate($holder, $badge_name, $badge_type, $issue_date, $unique_id) {
    global $conn;

    // Prepare the SQL statement to insert details into the badges table
    $query = "INSERT INTO badges (holder, badge_name, badge_type, issue_date, unique_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $holder, $badge_name, $badge_type, $issue_date, $unique_id);

    // Execute the statement and check if the insertion was successful
    if ($stmt->execute()) {
        return true; // Certificate details inserted successfully
    } else {
        return false; // Failed to insert certificate details
    }
}



function Login($username, $password){

    global $conn;
    // Prepare the SQL statement to prevent SQL injection
    $query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $username); // Allow login with either username or email
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return false; // Login failed
}

function Signup($email, $username, $type, $password) {
    global $conn;
    
    // Check if username or email already exists
    $check_query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        return false; // User already exists
    }
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert new user
    $insert_query = "INSERT INTO users (email, username, type, password) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("ssss", $email, $username, $type, $hashed_password);
    
    if ($insert_stmt->execute()) {
        return true; // Signup successful
    } else {
        return false; // Signup failed
    }
}

?>