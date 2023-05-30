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
        $userId = $_SESSION['user_id'];
        $id = $this->id;
        $paketnikId = $this->paketnikId;
        //$userId = $this->userId;
        $date = date("Y-m-d");

        // Insert a new row into the logs table
        //$qs = "INSERT INTO logs (id,date,userId, paketnikid) VALUES (NULL, '2000:05:03',2,3)";
        $qs = "INSERT INTO logs (id,date,userId, paketnikId) VALUES ($id,'$date','$userId', '$paketnikId');";
        $result = mysqli_query($db, $qs);

        if (mysqli_error($db)) {
            var_dump(mysqli_error($db));
            exit();
        }

        $this->id = mysqli_insert_id($db);
    }
    public static function zgodovina($db, $user)
    {
        $qs = "SELECT logs.id, logs.date, logs.userid, logs.paketnikid, user.username, paketnik.name
       FROM logs
       INNER JOIN user ON logs.userid = user.id
       INNER JOIN paketnik ON logs.paketnikid = paketnik.id
       WHERE user.id = $user";



        $result = mysqli_query($db, $qs);

        if (!$result) {
            echo "Napaka pri pridobivanju logov";
            return;
        }

        // Process the result set and return the rows
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

}