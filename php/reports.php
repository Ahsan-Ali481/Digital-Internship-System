<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'list';
$data = json_decode(file_get_contents('php://input'), true);

if ($action === 'submit') {
    $student_uid = $data['studentId'] ?? '';
    $sup_uid = $data['supervisorId'] ?? '';
    $week = $data['weekNumber'] ?? 1;
    $summary = $data['summary'] ?? '';
    $achievements = $data['achievements'] ?? '';
    $attachment = $data['attachmentName'] ?? 'doc.pdf';
    $report_uid = 'rep_' . time();

    $stmt = $pdo->prepare("INSERT INTO progress_reports (report_uid, student_uid, supervisor_uid, week_number, summary, achievements, attachment_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$report_uid, $student_uid, $sup_uid, $week, $summary, $achievements, $attachment]);