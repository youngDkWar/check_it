<?php
require "configs/connection.php";
if (!empty($_SESSION['logged_user'])) {

    require "templates/head.php";
    require "templates/header.php";

    if ($_SESSION['logged_user']['records'] == 0) {
        echo "<div class='noEvents'>Похоже, у вас нет запланированных мероприятий. Добавить новые вы можете 
          <a href='event.php' style='text-decoration: none; color: #AA4012'>здесь</a></div>";
    }
    $res = [];
    $statement = $connection->query(
        "SELECT * FROM `records` WHERE user_id =" . $_SESSION['logged_user']['id']." ORDER BY `date`, `time`");

    while ($r = $statement->fetch(PDO::FETCH_OBJ)) {
        array_push($res, ['name' => $r->name, 'description' => $r->description,
            'date' => $r->date, 'time' => $r->time, 'id' => $r->id]);
    }
    $_SESSION['records'] = $res;

    echo "<a class='add' href='event.php'>Add</a>";

    function print_record($i)
    {
        $res = $_SESSION['records'][$i];
        echo '<div class="record">';
        echo "<div class='time'>" . substr($res['time'], 0, 5) . "</div>";
        echo "<div class='heading'>" . $res['name'] . "</div>";
        echo "<div class='description'>" . $res['description'] . "</div>";
        echo "<div class='date'>" . $res['date'] . "</div>";
        echo "<div class='id'>" . $res['id'] . "</div>";
        echo "<a class='edit' href='edit.php'><img src='Images/edit.png'></a>";
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
}
else
    header("Location: login.php");