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

            <?PHP
            $res = [];
            $statement = $connection->query
                    ("SELECT * FROM `records` WHERE user_id =".$_SESSION['logged_user']['id']);
            while ($r = $statement->fetch(PDO::FETCH_OBJ)){
                array_push($res, ['name' => $r->name, 'description' => $r->description,
                                         'date' => $r->date, 'time' => $r->time]);}
            $_SESSION['records'] = $res;
            ?>
            <?PHP
            function print_record($i)
            {
                $res = $_SESSION['records'][$i];
                echo '<div class="record">';
                echo "<div class='time'>" . substr($res['time'], 0, 5) . "</div>";
                echo "<div class='heading'>" . $res['name'] . "</div>";
                echo "<div class='description'>" . $res['description'] . "</div>";
                echo "<div class='date'>" . $res['date'] . "</div>";
                echo '</div>';
            }
            $c = 0;
            for ($i = 0; $i < count($_SESSION['records']) / 3; $i++) {

                echo '<div class="container">';
                for ($j = 0 + $c; $j < 3 + $c; $j++) {
                    if ($j == count($_SESSION['records']))
                        break;
                    print_record($j);
                }
                echo "</div>";
                $c += 3;
            }
            ?>


</body>
</html>