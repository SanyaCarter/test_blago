<p>Для начала укажите параметры подключения к <b>пустой тестовой</b> БД, в которую будет добавлена таблица с данными.</p>
<form action="/core/post.php" method="post">
	<p><input type="text" name="host"> Хост <i>(допустимые символы a-z 0-9 .)</i></p>
	<p><input type="number" name="port" value="3306"> Порт <i>(допустимые символы 0-9)</i></p>
	<p><input type="text" name="dbname"> Имя БД <i>(допустимые символы a-z _)</i></p>
	<p><input type="text" name="user"> Логин <i>(допустимые символы a-z _)</i></p>
	<p><input type="text" name="password"> Пароль <i>(допустимые символы a-z 0-9)</i></p>
	<input type="hidden" name="act" value="migrate">
	<p><input type="submit" value="Применить"></p>
</form>
