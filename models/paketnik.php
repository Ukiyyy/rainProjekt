<?php

class Paketnik
{
    public $id;
    public $paketnikId;

    public function __construct($paketnikId, $id = 0)
    {
        $this->id = $id;
        $this->paketnikId = $paketnikId;
    }

    public function dodaj($db)
    {
        $id = $this->id;
        $paketnikId = $this->paketnikId;
        //$db = Db::getInstance();
        $qs = "INSERT INTO paketnik (id,paketnikid) VALUES ($id,'$paketnikId')";
        $result = mysqli_query($db, $qs);

        if (mysqli_error($db)) {
            var_dump(mysqli_error($db));
            exit();
        }

        $this->id = mysqli_insert_id($db);

    }

    public static function zbrisi($paketnikId, $db)
    {
        //$db = Db::getInstance();
        $qs = "DELETE FROM paketnik WHERE paketnikid = '$paketnikId'";

        if (mysqli_query($db, $qs)) {
            echo "Paketnik z ID-jem '$paketnikId' uspešno izbrisan";
        } else {
            echo "Napaka";
        }
    }


    public function spremeni($novoIme, $db, $paketnikId)
    {
        //$paketnikId = $_POST["paketnikId"];

        // Update the name of the Paketnik in the database
        $qs = "UPDATE paketnik SET paketnikid = '$novoIme' WHERE paketnikid = '$paketnikId'";

        if (mysqli_query($db, $qs)) {
            echo "Paketnik z ID-jem '$paketnikId' uspešno izbrisan";
        } else {
            echo "Napaka";
        }

    }

    public function posodi($idUser, $db, $idPaketnik)
    {
        //$paketnikId = $_POST["paketnikId"];

        // Update the name of the Paketnik in the database
        $qs = "UPDATE user_paketnik SET owner = '1' WHERE name = '$idUser'";

        if (mysqli_query($db, $qs)) {
            echo "User '$idUser' uspešno dobil praviec";
        } else {
            echo "Napaka";
        }

    }
    public function odkleni($paketnikId, $db)
    {
        $userId = $_SESSION['user_id'];
        $id = $this->id;
        $date = date("Y-m-d h:i:s");

        // Insert a new row into the logs table
        $qs = "INSERT INTO logs (id,date,userId, paketnikid) VALUES (NULL, '2000:05:03',2,3)";
        //$qs = "INSERT INTO logs (id,date,userId, paketnikid) VALUES ($id,'$date''$userId', '$paketnikId')";
        $result = mysqli_query($db, $qs);

        if (mysqli_error($db)) {
            var_dump(mysqli_error($db));
            exit();
        }

        $this->id = mysqli_insert_id($db);
    }
    public function zgo($paketnikId, $db)
    {
        $qs = "SELECT * FROM logs WHERE paketnikid = '$paketnikId'";
        $result = mysqli_query($db, $qs);

        if (!$result) {
            echo "Napaka pri pridobivanju logov";
            return;
        }

        // Process the result set and return the rows as an array of associative arrays
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }


}