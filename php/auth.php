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
