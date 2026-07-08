<?php
require_once 'db.php';

$action = $_GET['action'] ?? '';
$data = json_decode(file_get_contents('php://input'), true);

if ($action === 'login') {
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Please enter email and password."]);
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && ($password === $user['password'] || password_verify($password, $user['password']))) {
        if ($user['status'] === 'pending') {
            echo json_encode(["status" => "error", "message" => "Company account pending admin approval."]);
            exit();
        }
        if ($user['status'] === 'blocked' || $user['status'] === 'rejected') {
            echo json_encode(["status" => "error", "message" => "Account is blocked or rejected."]);
            exit();
        }
        echo json_encode([
            "status" => "success",
            "user" => [
                "id" => $user['user_uid'],
                "role" => $user['role'],
                "name" => $user['name'],
                "email" => $user['email'],
                "companyName" => $user['company_name'],
                "department" => $user['department']
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid credentials."]);
    }
} elseif ($action === 'register') {
    $role = $data['role'] ?? 'student';
    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? 'password123';
    $phone = $data['phone'] ?? '';
    $user_uid = 'usr_' . time();
    $status = ($role === 'company') ? 'pending' : 'approved';

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(["status" => "error", "message" => "User with email already exists."]);
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO users (user_uid, role, name, email, password, phone, status, university, major, grad_year, company_name, industry, website, certificate_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $user_uid,
        $role,
        $name,
        $email,
        $password,
        $phone,
        $status,
        $data['university'] ?? null,
        $data['major'] ?? null,
        $data['gradYear'] ?? null,
        $data['companyName'] ?? null,
        $data['industry'] ?? null,
        $data['website'] ?? null,
        $data['certificateUrl'] ?? null
    ]);

    echo json_encode(["status" => "success", "message" => "User registered successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid endpoint action."]);
}
?>