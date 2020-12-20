<header>
    <img id = "Шапка" src="Images\Главная страница\Шапка страницы.png" alt="Шапка страницы">
    <img id = "avatar" src="Images\Главная страница\Аватарка.png" alt="Аватарка">
    <?PHP echo '<div id="name">' . $_SESSION['logged_user']['name'] . '</div>';
    echo '<div id="surname">' . $_SESSION['logged_user']['surname'] . '</div>';?>
    <a href="logout.php" id="logout">LOGOUT</a>
</header>