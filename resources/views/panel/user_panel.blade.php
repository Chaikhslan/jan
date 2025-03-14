<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель ученика</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
    --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --text-color: #333;
            --light-gray: #f5f7fa;
            --medium-gray: #e9ecef;
            --dark-gray: #6c757d;
            --success-color: #4CAF50;
            --warning-color: #ff9800;
            --danger-color: #f44336;
        }

        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
        }

        body {
    font-family: 'Roboto', sans-serif;
            background-color: var(--light-gray);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
    max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
    background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            margin-bottom: 30px;
        }

        .header-content {
    display: flex;
    justify-content: space-between;
            align-items: center;
        }

        .logo {
    font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .user-info {
    display: flex;
    align-items: center;
        }

        .avatar {
    width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 500;
            margin-right: 10px;
        }

        .user-name {
    font-weight: 500;
        }

        .dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
    background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
    transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
    background-color: var(--primary-color);
            color: white;
            padding: 15px 20px;
            font-weight: 500;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .card-header i {
    margin-right: 10px;
        }

        .card-body {
    padding: 20px;
        }

        .student-info {
    display: flex;
    margin-bottom: 15px;
        }

        .student-avatar {
    width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--medium-gray);
            margin-right: 15px;
            overflow: hidden;
        }

        .student-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
        }

        .student-details h3 {
    margin-bottom: 5px;
            color: var(--primary-color);
        }

        .student-details p {
    color: var(--dark-gray);
    margin-bottom: 3px;
        }

        .info-item {
    display: flex;
    margin-bottom: 10px;
        }

        .info-label {
    width: 120px;
            font-weight: 500;
        }

        .glossary-list {
    list-style: none;
        }

        .glossary-item {
    padding: 10px 0;
            border-bottom: 1px solid var(--medium-gray);
        }

        .glossary-item:last-child {
    border-bottom: none;
        }

        .glossary-term {
    font-weight: 500;
            color: var(--secondary-color);
        }

        .progress-item {
    margin-bottom: 15px;
        }

        .progress-header {
    display: flex;
    justify-content: space-between;
            margin-bottom: 5px;
        }

        .progress-subject {
    font-weight: 500;
        }

        .progress-value {
    font-weight: 700;
        }

        .progress-bar-container {
    height: 10px;
            background-color: var(--medium-gray);
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar {
    height: 100%;
    border-radius: 5px;
        }

        .excellent {
    background-color: var(--success-color);
            width: 90%;
        }

        .good {
    background-color: var(--accent-color);
            width: 75%;
        }

        .average {
    background-color: var(--warning-color);
            width: 60%;
        }

        .lesson-list {
    list-style: none;
        }

        .lesson-item {
    padding: 12px 0;
            border-bottom: 1px solid var(--medium-gray);
            display: flex;
            align-items: center;
        }

        .lesson-item:last-child {
    border-bottom: none;
        }

        .lesson-icon {
    width: 40px;
            height: 40px;
            background-color: var(--light-gray);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-color);
        }

        .lesson-details {
    flex: 1;
}

        .lesson-title {
    font-weight: 500;
            margin-bottom: 3px;
        }

        .lesson-info {
    font-size: 14px;
            color: var(--dark-gray);
        }

        .lesson-link {
    color: var(--primary-color);
    text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .lesson-link i {
    margin-left: 5px;
        }

        .lesson-link:hover {
    text-decoration: underline;
        }

        @media (max-width: 768px) {
    .dashboard {
        grid-template-columns: 1fr;
            }

            .header-content {
        flex-direction: column;
                align-items: flex-start;
            }

            .user-info {
        margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">Образовательная платформа</div>
                <div class="user-info">
                    <div class="avatar">ИП</div>
                    <div class="user-name">Иван Петров</div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="dashboard">
            <!-- Страница ученика -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-graduate"></i>
Страница ученика
</div>
                <div class="card-body">
                    <div class="student-info">
                        <div class="student-avatar">
                            <img src="/placeholder.svg?height=80&width=80" alt="Фото ученика">
                        </div>
                        <div class="student-details">
                            <h3>Иван Петров</h3>
                            <p>Класс: 10-А</p>
                            <p>ID: 12345</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Дата рождения:</div>
                        <div>15.05.2006</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Email:</div>
                        <div>ivan.petrov@example.com</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Телефон:</div>
                        <div>+7 (900) 123-45-67</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Адрес:</div>
                        <div>г. Москва, ул. Примерная, д. 123</div>
                    </div>
                </div>
            </div>

            <!-- Глоссарии -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-book"></i>
Глоссарии
                </div>
                <div class="card-body">
                    <ul class="glossary-list">
                        <li class="glossary-item">
                            <div class="glossary-term">Алгоритм</div>
                            <div class="glossary-definition">Последовательность действий, выполнение которых приводит к решению задачи.</div>
                        </li>
                        <li class="glossary-item">
                            <div class="glossary-term">Функция</div>
                            <div class="glossary-definition">Соответствие между элементами двух множеств, установленное по определённому правилу.</div>
                        </li>
                        <li class="glossary-item">
                            <div class="glossary-term">Интеграл</div>
                            <div class="glossary-definition">Одно из основных понятий математического анализа, обобщающее понятия площади, объёма, массы и т.д.</div>
                        </li>
                        <li class="glossary-item">
                            <div class="glossary-term">Фотосинтез</div>
                            <div class="glossary-definition">Процесс образования органических веществ из углекислого газа и воды на свету при участии фотосинтетических пигментов.</div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Успеваемость -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-line"></i>
Успеваемость
                </div>
                <div class="card-body">
                    <div class="progress-item">
                        <div class="progress-header">
                            <div class="progress-subject">Математика</div>
                            <div class="progress-value">90%</div>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar excellent"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-header">
                            <div class="progress-subject">Физика</div>
                            <div class="progress-value">75%</div>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar good"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-header">
                            <div class="progress-subject">Русский язык</div>
                            <div class="progress-value">60%</div>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar average"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-header">
                            <div class="progress-subject">Информатика</div>
                            <div class="progress-value">85%</div>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar good" style="width: 85%"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-header">
                            <div class="progress-subject">Биология</div>
                            <div class="progress-value">70%</div>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar good" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ссылки на уроки -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-link"></i>
Ссылки на уроки
</div>
                <div class="card-body">
                    <ul class="lesson-list">
                        <li class="lesson-item">
                            <div class="lesson-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <div class="lesson-details">
                                <div class="lesson-title">Тригонометрические функции</div>
                                <div class="lesson-info">Математика • 45 минут</div>
                            </div>
                            <a href="#" class="lesson-link">Перейти <i class="fas fa-arrow-right"></i></a>
                        </li>

                        <li class="lesson-item">
                            <div class="lesson-icon">
                                <i class="fas fa-atom"></i>
                            </div>
                            <div class="lesson-details">
                                <div class="lesson-title">Законы Ньютона</div>
                                <div class="lesson-info">Физика • 60 минут</div>
                            </div>
                            <a href="#" class="lesson-link">Перейти <i class="fas fa-arrow-right"></i></a>
                        </li>

                        <li class="lesson-item">
                            <div class="lesson-icon">
                                <i class="fas fa-language"></i>
                            </div>
                            <div class="lesson-details">
                                <div class="lesson-title">Синтаксис сложного предложения</div>
                                <div class="lesson-info">Русский язык • 40 минут</div>
                            </div>
                            <a href="#" class="lesson-link">Перейти <i class="fas fa-arrow-right"></i></a>
                        </li>

                        <li class="lesson-item">
                            <div class="lesson-icon">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <div class="lesson-details">
                                <div class="lesson-title">Алгоритмы сортировки</div>
                                <div class="lesson-info">Информатика • 50 минут</div>
                            </div>
                            <a href="#" class="lesson-link">Перейти <i class="fas fa-arrow-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
