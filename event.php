<?php
require "configs/connection.php";
require "templates/head.php";
$data = $_POST;
if (isset($data['create'])){
    require 'templates/form_checker.php';
    if(empty($errors)) {
        $user_id = $_SESSION['logged_user']['id'];
        $query = "INSERT INTO `records` 
              VALUES (NULL, $user_id, " . $q . $data['name'] . $q . ", " . $q . $data['description'] . $q . ", "
            . $q . $data['date'] . $q . ", " . $q . $data['time'] . $q . ")";
        $t = $connection->exec($query);
        $connection->query("UPDATE `users` SET records = records + 1 WHERE id = $user_id");
        $_SESSION['logged_user']['records'] += 1;
        if ($t > 0) {
            echo "<img src='Images/ok.png' class='message'>";
        }
    }
    else
        echo '<div class="message">' . array_shift($errors). '</div>';
}
require "templates/header.php";
require 'templates/full_form_with_discription.php';
require 'templates/footer.php';?>