<?php

class Db {
    private static $instance  = NULL;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = mysqli_connect("mongodb+srv://rainPro:rainPro@rainpro.jvnwmyh.mongodb.net/", "rainPro", "rainPro", "rainPro");
        }
        return self::$instance;
    }
}

?>