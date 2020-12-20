<?php require "configs/connection.php"?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Главная</title>
    <link rel = "stylesheet" href = "styles\index.css">
</head>
<body>
<header>
    <img id = "Шапка" src="Images\Главная страница\Шапка страницы.png" alt="Шапка страницы">
    <img id = "avatar" src="Images\Главная страница\Аватарка.png" alt="Аватарка">
    <?PHP echo '<div id="name">' . $_SESSION['logged_user']['name'] . '</div>';
    echo '<div id="surname">' . $_SESSION['logged_user']['surname'] . '</div>';?>
    <a href="logout.php" id="logout">LOGOUT</a>
</header>
<?PHP
    if ($_SESSION['logged_user']['records'] == 0){
        echo "<div class='noEvents'>Похоже, у вас нет запланированных мероприятий. Добавить новые вы можете 
            <a href='event.php' style='text-decoration: none; color: #AA4012'>здесь</a></div>";
    }
?>

<div class="container">
    <div class="record">
        <div>
            <?PHP
                
            ?>
        </div>
        <div></div>
    </div>
    <div class="record"></div>
    <div class="record"></div>
</div>

<div class="container">
    <div class="record"></div>
    <div class="record"></div>
    <div class="record"></div>
</div>


</body>
</html>