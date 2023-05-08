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
        $id=$this->id;
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
}