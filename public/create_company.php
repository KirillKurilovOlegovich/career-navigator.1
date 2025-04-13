<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);

// Подключение к базе данных
$host = 'localhost';
$db = 'career-navigator';
$user = 'your_username';
$pass = 'your_password';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Ошибка подключения к базе данных']));
}

// Вставка новой компании в базу данных
$companyName = $conn->real_escape_string($data['company_name']);
$sql = "INSERT INTO companies (name) VALUES ('$companyName')"; // Измените на вашу таблицу

if ($conn->query($sql) === TRUE) {
    echo json_encode(['company_name' => $companyName]);
} else {
    echo json_encode(['error' => 'Ошибка при создании компании']);
}

$conn->close();
?>