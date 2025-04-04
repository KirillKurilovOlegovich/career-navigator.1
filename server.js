// server.js
const express = require('express');
   const bodyParser = require('body-parser');
   const cors = require('cors');
   const path = require('path');

   const app = express();
   const PORT = process.env.PORT || 3000;

   app.use(cors());
   app.use(bodyParser.json());
   app.use(express.static(path.join(__dirname, 'public'))); // Обслуживание статических файлов

// Массив для хранения данных о работодателях
let employers = [];

// Создание личного кабинета работодателя
app.post('/api/employer', (req, res) => {
    const employer = req.body;
    employers.push(employer);
    res.status(201).json(employer);
});

// Размещение информации о специальностях
app.post('/api/employer/positions', (req, res) => {
    const { employerId, position } = req.body;
    const employer = employers.find(emp => emp.id === employerId);
    
    if (employer) {
        employer.positions = employer.positions || [];
        employer.positions.push(position);
        res.status(201).json(position);
    } else {
        res.status(404).json({ message: 'Employer not found' });
    }
});

// Получение профилей выпускников
app.get('/api/graduates', (req, res) => {
    // Здесь можно интегрировать базу данных или другую логику для получения данных о выпускниках
    const graduates = [
        { id: 1, name: 'Иван Иванов', skills: ['JavaScript', 'Node.js'] },
        { id: 2, name: 'Мария Петрова', skills: ['Python', 'Django'] },
    ];
    res.json(graduates);
});

// Запуск сервера
app.listen(PORT, () => {
    console.log("Server is running on http://localhost:${PORT}"); 
});