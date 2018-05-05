<?php

session_start();
define('ROOT', dirname(__FILE__));
include_once ROOT . '/core/db.php';


class Html
{
	public static function dbCongigurateForm()
	{
		include ROOT . '/view/form.php';
	}

	public static function printData($d)
	{
		include ROOT . '/view/table.php';
	}
}


// BEGIN APP

if (isset($_SESSION['migrate'])) {
	echo $_SESSION['migrate'];
	unset($_SESSION['migrate']);
}

if (isset($_SESSION['error'])) {
	foreach ($_SESSION['error'] as $alert) {
		echo "<p>$alert</p>";
	}
	unset($_SESSION['error']);
}

file_exists(ROOT . '/config/dbp.php')? Html::printData(Db::getData()) : Html::dbCongigurateForm();