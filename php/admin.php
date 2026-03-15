<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'stats';
$data = json_decode(file_get_contents('php://input'), true);

if ($action === 'stats') {