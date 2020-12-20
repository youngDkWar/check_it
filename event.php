<?php require "configs/connection.php";?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Create</title>
    <link rel="stylesheet" href="Styles/login.css">
    <link rel="stylesheet" href="Styles/index.css">
    <link rel="stylesheet" href="Styles/events.css">
</head>
<?PHP
$data = $_POST;
if (isset($data['create'])){
    $errors = [];
    $q = "'";

    if(!preg_match("/^[a-zA-Z0-9а-яА-Я_]{1,}/", $data["name"])){
        $errors[] = "Неккоректное название!";
    }
    if (strlen($data["name"]) > 19){
        $errors[] = "Слишком длинное название!";
    }
    $d = ['y' => intval(substr($data['date'], 0, 4)),
          'm' => intval(substr($data['date'], 5, 2)),
          'd' => intval(substr($data['date'], 8, 2))];
    if (!checkdate($d['m'], $d['d'], $d['y'])
        || ($d['y'] < date('Y'))
        || ($d['d'] < date('d') && $d['m'] <= date('m') && $d['y'] <= date('Y'))
        || ($d['d'] >= date('d') && $d['y'] <= date('Y') && $d['m'] < date('m'))) {
        $errors[] = "Неккоректная дата!";
    }
    $t = ['h' => intval(substr($data['time'], 0, 2)),
          'm'=> intval(substr($data['time'], 3, 2))];
    if ($t['h'] < 0 || $t['h'] > 23 || $t['m'] < 0 || $t['m'] > 59 || strlen($data['time']) > 5) {
        $errors[] = 'Неккоректное время!';
    }
    $data['time'] = $data['time'] . ':00';
    if (strlen($data["description"]) > 190){
        $errors[] = "Слишком длинное описание!";
    }
    if(empty($errors)) {
        $user_id = $_SESSION['logged_user']['id'];
        $query = "INSERT INTO `records` 
              VALUES (NULL, $user_id, " . $q . $data['name'] . $q . ", " . $q . $data['description'] . $q . ", "
            . $q . $data['date'] . $q . ", " . $q . $data['time'] . $q . ")";
        $t = $connection->exec($query);
        $connection->query("UPDATE `users` SET records = records + 1 WHERE id = $user_id");
        if ($t > 0) {
            sleep(1);
        }
    }
    else
        echo '<div class="message">' . array_shift($errors). '</div>';
}
?>
<body>
<header>
    <img id = "Шапка" src="Images\Главная страница\Шапка страницы.png" alt="Шапка страницы">
    <img id = "avatar" src="Images\Главная страница\Аватарка.png" alt="Аватарка">
    <?PHP echo '<div id="name">' . $_SESSION['logged_user']['name'] . '</div>';
    echo '<div id="surname">' . $_SESSION['logged_user']['surname'] . '</div>';?>
</header>
<div class="reg">
    <form action="event.php" method="post">
        <input type="text" class="form-control" name="name"  placeholder="Название" required><br>
        <input type="text" class="form-control" name="date" placeholder="Дату" required><br>
        <input type="text" class="form-control" name="time" placeholder="Время" required><br>
        <textarea class="form-control area" name="description" required>Не забыть...</textarea>
        <button class="btn" name="create" type="submit">CREATE</button>
    </form>
    <br>
</div>
<div class="information">
    <div id="main"><a href="index.php" style="text-decoration: none">BACK</a></div>
    <div class="help">
        <div class="example">Допустимый формат даты:<div>  гггг-мм-дд</div></div>
        <div class="example">Допустимый формат времени:<div>  чч:мм</div></div>
        <div class="example">Пример:<div>  2020-12-31 23:59</div></div>
        <div class="example">Длина названия:<div>максимум 19 символа</div></div>
        <div class="example">Длина описания:<div>максимум 190 символа</div></div>
    </div>
</div>
<?PHP require 'templates/footer.php';?>