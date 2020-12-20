<?php
$errors = [];
$q = "'";
if(!preg_match("/^[a-zA-Z0-9а-яА-Я_]{1,}/", $data["name"])){
    $errors[] = "Неккоректное название!";
}
if (mb_strlen($data["name"]) > 19){
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
if (mb_strlen($data["description"]) > 190 || !preg_match("/^[a-zA-Z0-9а-яА-Я_]{1,}/", $data["name"])){
    $errors[] = "Неккоректное описание!";
}