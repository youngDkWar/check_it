<?php require "configs/connection.php"?>
<!DOCTYPE html>
<html>
    <head>
        <title>Главная</title>
        <link rel = "stylesheet" href = "styles\main.css">
    </head>
    <body>
        <script src="Scripts/script_1.js"></script>

        <header>
            <section>
                <img id = "Шапка" src="Images\Главная страница\Шапка страницы.png" alt="Шапка страницы">
                <img id = "Аватарка" src="Images\Главная страница\Аватарка.png" alt="Аватарка">
                <a class="FIO" href="logout.php" >
                    <div class="V">P.V.</div>
                    <div class="V">IVANOV</div>
                </a>
            </section>
        </header>

        <div class="container">
            <div class = found onclick="searchEvent()"><div class="fText">Found events</div></div>
            <div class="events">AVAILABLE EVENTS</div>
            <div class = "Дни_недели">
                <div class="day mon"><img class="round" src="Images\Главная страница\Выбранные дни недели (кружки)\Понедельник.png" alt="Понедельник" onclick="showSchedule('Понедельник')"></div>
                <div class="day"><img class="round" src="Images\Главная страница\Выбранные дни недели (кружки)\Вторник.png" alt="Вторник" onclick="showSchedule('Вторник')"></div>
                <div class="day"><img class="round" src="Images\Главная страница\Выбранные дни недели (кружки)\Среда.png" alt="Среда" onclick="showSchedule('Среда')"></div>
                <div class="day"><img class="round" src="Images\Главная страница\Выбранные дни недели (кружки)\Четверг.png" alt="Четверг" onclick="showSchedule('Четверг')"></div>
                <div class="day"><img class="round" src="Images\Главная страница\Выбранные дни недели (кружки)\Пятница.png" alt="Пятница" onclick="showSchedule('Пятница')"></div>
                <div class="day"><img class="round" src="Images\Главная страница\Выбранные дни недели (кружки)\Суббота.png" alt="Суббота" onclick="showSchedule('Суббота')"></div>
                <div class="day"><img class="round" src="Images\Главная страница\Выбранные дни недели (кружки)\Воскресение.png" alt="Воскресение" onclick="showSchedule('Воскресение')"></div>
            </div>
        </div>
        <?php if(isset($_SESSION['logged_user'])) ?>
        Привет, <?php echo $_SESSION['logged_user']; ?>

        <div class = "container Мероприятия">
            <div class = "Мероприятие">
                <div class = "choose_event"> Нажмите на день недели </div>
            </div>           
        </div>
    </body>
</html>