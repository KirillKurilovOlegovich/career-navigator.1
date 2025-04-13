<?php
header('Content-Type: application/json');

// Подключение к базе данных
$servername = "localhost"; // или ваш хост
$username = "root"; // По умолчанию для XAMPP/WAMP
$password = ""; // По умолчанию пусто для XAMPP/WAMP
$dbname = "career-navigator"; // Имя вашей базы данных

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die(json_encode(['error' => 'Ошибка подключения к базе данных: ' . $conn->connect_error]));
}

// SQL-запрос для получения данных о выпускниках, специальностях и компаниях
$sql = "SELECT g.name AS graduate_name, s.name AS specialty_name, c.name AS company_name
        FROM graduates g
        JOIN specialties s ON g.specialty_id = s.id
        JOIN companies c ON s.company_id = c.id";

$result = $conn->query($sql);

$graduates = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $graduates[] = [
            'graduate_name' => $row['graduate_name'],
            'specialty_name' => $row['specialty_name'],
            'company_name' => $row['company_name']
        ];
    }
}

// Закрываем соединение с базой данных
$conn->close();

// Возвращаем данные в формате JSON
echo json_encode($graduates);
?>