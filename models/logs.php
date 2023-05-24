<?php

class Logs
{
    public $id;
    public $date;
    public $userId;
    public $paketnikId;

    public function __construct($paketnikId,$userId,$date, $id = 0)
    {
        $this->id = $id;
        $this->paketnikId = $paketnikId;
        $this->userId = $userId;
        $this->date = $date;
    }
    public function odkleni($db)
    {
        $userId = 3;
        //$userId = $_SESSION['user_id'];
        $id = $this->id;
        $paketnikId = $this->paketnikId;
        //$userId = $this->userId;
        $date = date("Y-m-d");

        // Insert a new row into the logs table
        $qs = "INSERT INTO logs (id,date,userId, paketnikid) VALUES (NULL, '2000-05-03',2,3)";
        //$qs = "INSERT INTO logs (id,date,userId, paketnikId) VALUES ($id,'$date','$userId', '$paketnikId');";
        $result = mysqli_query($db, $qs);

        if (mysqli_error($db)) {
            var_dump(mysqli_error($db));
            exit();
        }

        $this->id = mysqli_insert_id($db);
    }
}