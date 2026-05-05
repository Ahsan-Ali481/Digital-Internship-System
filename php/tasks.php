<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'list';
$data = json_decode(file_get_contents('php://input'), true);

if ($action === 'create') {
    $student_uid = $data['studentId'] ?? '';
    $sup_uid = $data['supervisorId'] ?? '';
    $company_uid = $data['companyId'] ?? '';
    $title = $data['title'] ?? '';
    $desc = $data['description'] ?? '';
    $deadline = $data['deadline'] ?? '';
    $task_uid = 'tsk_' . time();

    if (strtotime($deadline) < strtotime(date('Y-m-d'))) {
        echo json_encode(["status" => "error", "message" => "Task deadline must be a future date."]);