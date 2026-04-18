<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'list';
$data = json_decode(file_get_contents('php://input'), true);

if ($action === 'list') {
    $stmt = $pdo->query("SELECT * FROM internships WHERE status = 'active' ORDER BY posted_at DESC");
    echo json_encode(["status" => "success", "data" => $stmt->fetchAll()]);
} elseif ($action === 'create') {
    $company_uid = $data['companyId'] ?? '';
    $title = $data['title'] ?? '';
    $category = $data['category'] ?? '';
    $location = $data['location'] ?? '';
    $duration = $data['duration'] ?? '';
    $stipend = $data['stipend'] ?? '';
    $positions = $data['positions'] ?? 1;
    $deadline = $data['deadline'] ?? '';
    $description = $data['description'] ?? '';
    $requirements = $data['requirements'] ?? '';
    $internship_uid = 'int_' . time();
