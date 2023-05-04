<?php

class Db {
    private static $instance  = NULL;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = mysqli_connect("sql7.freemysqlhosting.net", "sql7616003", "AQvIh4ifwr", "sql7616003");
        }
        return self::$instance;
    }
}

?>