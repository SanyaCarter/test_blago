<?php 

class Db
{

    public static function migrate()
    {

        return Db::createStructure()? Db::insertTestData() : '<p>Не удалось создать структуру БД!</p>';

    }

    protected function connect()
    {
        //файл конфигурации для подключения к БД
        $file_link = dirname(__FILE__, 2) . '/config/dbp.php';
        if ($file_handle = fopen($file_link, 'r')) {
            $dbparams = unserialize( fread($file_handle, filesize($file_link)) );
            fclose($file_handle);
        }

        if (sizeof($dbparams)) try {
            $db = new PDO("mysql:host={$dbparams['host']};dbname={$dbparams['dbname']};port={$dbparams['dbport']}", $dbparams['user'], $dbparams['password']);
            $db->exec("set names utf8");
        } catch (PDOException $e) {
            header("Location: ". $_SERVER['HTTP_REFERER']);
            die();
        }
        return $db;
    }

    protected function createStructure()
    {
        if (!$pdo = Db::connect()) return false;
        $r = $pdo->query("DROP TABLE IF EXISTS anydays;");
        $r = $pdo->query("  CREATE TABLE anydays (
                            `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                            `anyd_day` TINYINT(3) UNSIGNED NOT NULL,
                            `anyd_month` TINYINT(3) UNSIGNED NOT NULL,
                            `anyd_year` SMALLINT(5) UNSIGNED NOT NULL,
                            PRIMARY KEY (`id`)
                            ) ENGINE=InnoDB;");
        return $r;
    }

    protected function insertTestData()
    {
        if (!$pdo = Db::connect()) return false;
        $r = $pdo->query("  INSERT INTO anydays (anyd_day, anyd_month, anyd_year) VALUES
                            (02,11,1988),
                            (05,09,1988),
                            (03,05,1989),
                            (09,06,1978),
                            (11,03,2001),
                            (09,05,2000),
                            (12,11,2010),
                            (01,08,2011),
                            (01,01,1966);");
        return '<p>Миграция выполнена успешно!</p>';
    }

    public static function getData()
    {
        if (!$pdo = Db::connect()) return false;
        $r = $pdo->prepare("SELECT anyd_day `day`, anyd_month `month`, anyd_year `year` FROM anydays LIMIT 15;");
        $r->setFetchMode(PDO::FETCH_ASSOC);
        return $r->execute()? $r->fetchAll() : false;
    }
}
