
<footer class="footer">
    <div class="footer info">
        <div class="contacts">
            <span class="contacts">Иванов Иван Иванович</span>
            <span class="contacts">inanov@urfu.ru</span>
            <spanp class="contacts">
                <?PHP
                $ini = parse_ini_file("configs/config.ini");
                echo $ini['phone']?>
            </spanp>
        </div>
        <div class="contacts">2020</div>
    </div>
</footer>
</body>
</html>