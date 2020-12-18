<?php require "configs/connection.php";?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Check It!</title>
    <link rel="stylesheet" href="Styles/login.css">
</head>

<?php
$title = "Registration";
$data = $_POST;
if(isset($data['do_signup'])) {
    $errors = [];
    $q = "'";
    if (trim($data['email']) == '') {
        $errors[] = "Введите Email";
    }
    if (trim($data['name']) == '') {
        $errors[] = "Введите Имя";
    }
    if (trim($data['surname']) == '') {
        $errors[] = "Введите фамилию";
    }
    if ($data['password'] == '') {
        $errors[] = "Введите пароль";
    }
    if ($data['password_2'] != $data['password']) {
        $errors[] = "Повторный пароль введен не верно!";
    }
    if (mb_strlen($data['name']) < 2 || mb_strlen($data['name']) > 254) {
        $errors[] = "Недопустимая длина имени";
    }
    if (mb_strlen($data['surname']) < 2 || mb_strlen($data['family']) > 254) {
        $errors[] = "Недопустимая длина фамилии";
    }
    if (mb_strlen($data['password']) < 5 || mb_strlen($data['password']) > 20) {
        $errors[] = "Недопустимая длина пароля (от 5 до 20 символов)";
    }
    if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $data['email'])) {
        $errors[] = 'Неверно введен е-mail';
    }
    if ($connection->query("SELECT * FROM `users` WHERE email =".$q.$data['email'].$q)) {
        $errors[] = "Пользователь с таким Email существует!";
    }
    if (empty($errors)){
        $query = "INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`)
                  VALUES (NULL, ".$q.$data['name'].$q.", ".$q.$data['surname'].$q.", "
            .$q.$data['email'].$q.", ".$q.password_hash($data['password'], PASSWORD_DEFAULT).$q.")";
        $connection->exec($query);
    }
    else
        echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';
}
?>


<body>
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <!-- Форма регистрации -->
            <h2>Форма регистрации</h2>
            <form action="signup.php" method="post">
                <input type="email" class="form-control" name="email" id="email" placeholder="Введите Email"><br>
                <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя" required><br>
                <input type="text" class="form-control" name="surname" id="family" placeholder="Введите фамилию" required><br>
                <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль"><br>
                <input type="password" class="form-control" name="password_2" id="password_2" placeholder="Повторите пароль"><br>
                <button class="btn btn-success" name="do_signup" type="submit">Зарегистрировать</button>
            </form>
            <br>
            <p>Если вы зарегистрированы, тогда нажмите <a href="login.php">здесь</a>.</p>
            <p>Вернуться на <a href="index.php">главную</a>.</p>
        </div>
    </div>
</div>
</body>
