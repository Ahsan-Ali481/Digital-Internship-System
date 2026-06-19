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

    echo json_encode(["status" => "success", "message" => "Application submitted."]);
} elseif ($action === 'update_status') {
    $app_uid = $data['appId'] ?? '';
    $status = $data['status'] ?? 'Pending';

    $stmt = $pdo->prepare("UPDATE applications SET status = ? WHERE application_uid = ?");
    $stmt->execute([$status, $app_uid]);

    echo json_encode(["status" => "success", "message" => "Status updated."]);
} elseif ($action === 'schedule_interview') {
    $app_uid = $data['appId'] ?? '';
    $date = $data['date'] ?? '';
    $time = $data['time'] ?? '';
    $mode = $data['mode'] ?? 'Online';
    $meetingLink = $data['meetingLink'] ?? '';

    if (strtotime($date) < strtotime(date('Y-m-d'))) {
        echo json_encode(["status" => "error", "message" => "Interview date must be in the future."]);
        exit();
    }

    $stmt = $pdo->prepare("UPDATE applications SET status = 'Shortlisted' WHERE application_uid = ?");
    $stmt->execute([$app_uid]);

    $stmt = $pdo->prepare("INSERT INTO interviews (application_uid, interview_date, interview_time, mode, meeting_link) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$app_uid, $date, $time, $mode, $meetingLink]);

    echo json_encode(["status" => "success", "message" => "Interview scheduled."]);
} elseif ($action === 'assign_supervisor') {
    $app_uid = $data['appId'] ?? '';
    $sup_uid = $data['supervisorId'] ?? '';
