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

        /* Navigation Tabs Styles */
        .nav-container {
            background-color: white;
            border-bottom: 1px solid var(--medium-gray);
            margin-bottom: 30px;
        }

        .nav-tabs {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav-tab {
            padding: 15px 20px;
            color: var(--dark-gray);
            text-decoration: none;
            position: relative;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-tab:hover {
            color: var(--primary-color);
        }

        .nav-tab.active {
            color: var(--primary-color);
        }

        .nav-tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--primary-color);
        }

        /* Content Wrapper */
        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .main-content {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            min-height: 300px;
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

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .user-info {
                margin-top: 10px;
            }

            .nav-tabs {
                overflow-x: auto;
                white-space: nowrap;
            }

            .nav-tab {
                padding: 15px 15px;
            }
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
        }

        .user-info {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
        }

        .user-info:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #00bcd4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 500;
            font-size: 16px;
        }

        .user-name {
            font-weight: 500;
            color: #333;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .user-name::after {
            content: '';
            display: inline-block;
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #333;
            margin-left: 5px;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            min-width: 180px;
            display: none;
            margin-top: 5px;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-item {
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            display: block;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f5f7fa;
        }

        .dropdown-divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 5px 0;
        }

        /* Example header for context */
        .header {
            background-color: white;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
    </style>
</head>
<body>
<section>

</section>
<!-- Navigation Tabs -->
<div class="nav-container">
    <nav class="nav-tabs">
        <a href="#" class="nav-tab active">Детали заказа</a>
        <a href="#" class="nav-tab">Адрес доставки</a>
        <a href="#" class="nav-tab">Товары</a>
        <a href="#" class="nav-tab">История</a>
        <a href="#" class="nav-tab">Рассрочка/Кредит</a>
    </nav>
</div>

<div class="content-wrapper">
    <main class="main-content">
        <p>Содержимое страницы будет отображаться здесь.</p>
    </main>
</div>

<script>
    const tabs = document.querySelectorAll('.nav-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });
</script>
<script>
    const userDropdown = document.getElementById('userDropdown');
    const dropdownMenu = userDropdown.querySelector('.dropdown-menu');

    userDropdown.addEventListener('click', (e) => {
        dropdownMenu.classList.toggle('active');
        e.stopPropagation();
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!userDropdown.contains(e.target)) {
            dropdownMenu.classList.remove('active');
        }
    });
</script>
</body>
</html>
