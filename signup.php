<?php require "configs/connection.php";?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="Styles/login.css">
    <link rel="stylesheet" href="Styles/signup.css">
</head>

<?php
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
    $statement = $connection->query("SELECT * FROM `users` WHERE email =".$q.$data['email'].$q);
    $t = $statement->fetch(PDO::FETCH_ASSOC);
    if (!empty($t)) {
        $errors[] = "Пользователь с таким Email существует!";
    }
    if (empty($errors)){
        $query = "INSERT INTO `users` VALUES 
                           (NULL, ".$q.$data['name'].$q.", ".$q.$data['surname'].$q.", "
                            .$q.$data['email'].$q.", ".$q.$data['password'].$q.", ".'0'.")";
        $connection->exec($query);
    }
    else
        echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';
}
?>

<body>
<div class="reg">
    <h2 style="color: aliceblue">Форма регистрации</h2>
    <form action="signup.php" method="post">
        <input type="email" class="form-control" name="email" id="email" placeholder="Введите Email"><br>
        <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя" required><br>
        <input type="text" class="form-control" name="surname" id="family" placeholder="Введите фамилию" required><br>
        <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль"><br>
        <input type="password" class="form-control" name="password_2" id="password_2" placeholder="Повторите пароль"><br>
        <button class="btn" name="do_signup" type="submit">REGISTRATION</button>
    </form>
    <br>
    <p style="color: aliceblue">Если вы зарегистрированы, тогда нажмите
        <a style="color: #AA4012; text-decoration: none" href="login.php">здесь</a>.</p>
</div>
<?PHP require 'templates/footer.php';?>
