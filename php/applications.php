<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'list';
$data = json_decode(file_get_contents('php://input'), true);

if ($action === 'apply') {
    $internship_uid = $data['internshipId'] ?? '';
    $student_uid = $data['studentId'] ?? '';
    $company_uid = $data['companyId'] ?? '';
    $cv_name = $data['cvName'] ?? 'resume.pdf';
    $app_uid = 'app_' . time();

    $stmt = $pdo->prepare("INSERT INTO applications (application_uid, internship_uid, student_uid, company_uid, cv_name, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
    $stmt->execute([$app_uid, $internship_uid, $student_uid, $company_uid, $cv_name]);