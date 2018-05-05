<?php 
include_once dirname(__FILE__, 2) . '/core/db.php';
session_start();

if (isset($_POST['act']) && $_POST['act'] == 'migrate') {

	$error = [];
	$em = 'Не соответствие шаблону в поле: ';

	if (!preg_match('|^[a-z0-9\.]+$|', $_POST['host'])) $error[] = $em . 'хост';
	if (!preg_match('|^[0-9]+$|', $_POST['port'])) $error[] = $em . 'порт';
	if (!preg_match('|^[a-z_]+$|', $_POST['dbname'])) $error[] = $em . 'имя БД';
	if (!preg_match('|^[a-z_]+$|', $_POST['user'])) $error[] = $em . 'логин';
	if (!preg_match('|^[a-z0-9]+$|', $_POST['password'])) $error[] = $em . 'пароль';

	if (sizeof($error)) {
		$_SESSION['error'] = $error;
	} else {
		$f = fopen(dirname(__FILE__, 2) . '/config/dbp.php', 'w');  
		unset($_POST['act']);
        if (fwrite($f, serialize($_POST))) {
            fclose($f);
			$_SESSION['migrate'] = Db::migrate();
        } else {
			$_SESSION['error'][] = 'Конфиг БД не сохранен!';
        }
	}

	header("Location: ". $_SERVER['HTTP_REFERER']);
}