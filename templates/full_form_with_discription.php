<div class="reg">
    <form action="event.php" method="post">
        <input type="text" class="form-control" name="name"  placeholder="Название" required><br>
        <input type="text" class="form-control" name="date" placeholder="Дата" required><br>
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