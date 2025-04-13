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

// Вставка новой специальности в базу данных
$positionName = $conn->real_escape_string($data['position_name']);
$requirements = $conn->real_escape_string($data['requirements']);
$sql = "INSERT INTO specialties (name, requirements) VALUES ('$positionName', '$requirements')"; // Измените на вашу таблицу

if ($conn->query($sql) === TRUE) {
    echo json_encode(['position_name' => $positionName]);
} else {
    echo json_encode(['error' => 'Ошибка при добавлении специальности']);
}

$conn->close();
?>