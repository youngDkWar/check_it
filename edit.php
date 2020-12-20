<?php
require "configs/connection.php";
require "templates/head.php";
$data = $_POST;
if (isset($data['create'])){
    require "templates/form_checker.php";
    if(empty($errors)) {
        $user_id = $_SESSION['logged_user']['id'];
        $query = "UPDATE `records` SET 
              description =" . $q . $data['description'] . $q . ", "
            . "`date` =" .$q . $data['date'] . $q . ", "
            ."`time` =". $q . $data['time'] . $q . " WHERE `id` =".$_SESSION['record']['id'];
        $t = $connection->exec($query);
        if ($t > 0) {
            sleep(1);
            echo "<img src='Images/ok.png' class='message'>";
        }
    }
    else
        echo '<div class="message">' . array_shift($errors). '</div>';
}
require 'templates/header.php';
require 'templates/id_form.php';

$data = $_POST;
if (isset($data["update"])){
    $id = intval($data['id']);
    $t = $connection->query("SELECT `id`, `user_id` FROM `records` WHERE id = $id");
    $record = $t->fetch(PDO::FETCH_ASSOC);
    $_SESSION['record'] = $record;
    if (empty($record) ||  $_SESSION['logged_user']['id'] != $record['user_id']){
        echo '<div class="message">' . "Запись не найдена!" . '</div>';
    }
    else
        require 'templates/record_form.php';
}
if (isset($data["delete"])){
    $id = intval($data['id']);
    $user_id = $_SESSION['logged_user']['id'];
    $t = $connection->query("SELECT `id`, `user_id` FROM `records` WHERE id = $id");
    $record = $t->fetch(PDO::FETCH_ASSOC);
    if (empty($record) ||  $_SESSION['logged_user']['id'] != $record['user_id']){
        echo '<div class="message">' . "Запись не найдена!" . '</div>';
    }
    else {
        $connection->exec("DELETE FROM `records` WHERE id = $id");
        $connection->query("UPDATE `users` SET records = records - 1 WHERE id = $user_id");
        $_SESSION['logged_user']['records'] -= 1;
        echo "<img src='Images/ok.png' class='message'>";
    }
}
require 'templates/footer.php';