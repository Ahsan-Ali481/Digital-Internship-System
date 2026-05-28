<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'stats';
$data = json_decode(file_get_contents('php://input'), true);

if ($action === 'stats') {
    $students = $pdo->query("SELECT COUNT(*) FROM users WHERE role='student'")->fetchColumn();
    $companies = $pdo->query("SELECT COUNT(*) FROM users WHERE role='company'")->fetchColumn();
    $supervisors = $pdo->query("SELECT COUNT(*) FROM users WHERE role='supervisor'")->fetchColumn();
    $internships = $pdo->query("SELECT COUNT(*) FROM internships")->fetchColumn();
    $applications = $pdo->query("SELECT COUNT(*) FROM applications")->fetchColumn();
    $pending = $pdo->query("SELECT COUNT(*) FROM users WHERE status='pending'")->fetchColumn();

    echo json_encode([
        "status" => "success",
        "data" => [
            "students" => $students,
            "companies" => $companies,
            "supervisors" => $supervisors,
            "internships" => $internships,
            "applications" => $applications,
            "pending" => $pending
        ]
    ]);
} elseif ($action === 'update_user_status') {
    $user_uid = $data['userId'] ?? '';
    $status = $data['status'] ?? 'approved';

    $stmt = $pdo->prepare("UPDATE users SET status = ? WHERE user_uid = ?");
    $stmt->execute([$status, $user_uid]);