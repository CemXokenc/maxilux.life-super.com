<?php

namespace Core\Service;

use PDO;

class DB
{
    /**
     * @return PDO
     */
    protected static $pdo = null;

    public static function inst() {
        if (self::$pdo == null) {
            self::$pdo = new PDO('mysql:host=' . db_host .';dbname=' . db_name, db_user, db_pass);
            self::$pdo->exec('SET NAMES utf8');
        }

        return  self::$pdo;
    }
}