<?PHP
require 'configs/connection.php';
$data = $_POST;
if(isset($data['do_login'])) {
    $errors = array();
    $q = "'";

    if ($connection->query("SELECT * FROM `users` WHERE email =".$q.$data['email'].$q)){
        echo "SELECT * FROM `users` WHERE email =".$q.$data['email'].$q;
        if($connection->query("SELECT * FROM `users` WHERE password =".$q.$data['password'].$q)) {
            $_SESSION['logged_user'] = $data['email'];
            #header('Location: index.php');
        } else {
            $errors[] = 'Пароль неверно введен!';
        }
    }
    else
        $errors[] = 'Пользователь с таким логином не найден!';
    if(!empty($errors)) {
        echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';
    }
}
require "templates/head.php"; ?>

<img class="welcome" src="Enter_images/Welcome.png" alt="Добро пожаловать!">
<div class="AutologinForm" style="background-image: url(Enter_images/Autologin.png);">
    <img class="Avatar" src="Enter_images/Avatar.png" alt="Аватарка человечка">
    <img class="loginForm" src="Enter_images/Login form.png" alt="Login form">
    <form action="login.php" method="post" class="form">
        <input type="email" class="form email" name="email" placeholder="Email..." required>
        <input type="password" class="form password" name="password" placeholder="Password..." required>
        <label for="" class="checkbox"><input type="checkbox"> Remember me</label>
        <button class="form button" name="do_login" type="submit">LOGIN</button>
        <div class="text-or">or</div>
        <a href="signup.php" class="registration">REGISTRATION</a>
        <a href="" class="reboot-password">Forgot password</a>
    </form>
</div>
<img class="logo" src="Enter_images/Logo.png" alt="Логотип сайта Check It">
<?php require "templates/footer.php";?>
