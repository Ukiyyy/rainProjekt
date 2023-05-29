<?php

class Paketnik
{
    public $id;
    public $paketnikId;
    public $userid;

    public function __construct($userid, $paketnikId, $id = 0)
    {
        $this->id = $id;
        $this->paketnikId = $paketnikId;
        $this->userid = $userid;
    }

    public function dodaj($db)
    {
        $id = $this->id;
        $paketnikId = $this->paketnikId;
        $userid = $this->userid;

        $qs = "INSERT INTO paketnik (id,name,userid) VALUES ($id,'$paketnikId', '$userid')";
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
        $qs = "DELETE FROM paketnik WHERE name = '$paketnikId'";

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
        $qs = "UPDATE paketnik SET name = '$novoIme' WHERE name = '$paketnikId'";

        if (mysqli_query($db, $qs)) {
            echo "Paketnik z ID-jem '$paketnikId' uspešno izbrisan";
        } else {
            echo "Napaka";
        }

    }

    public function userji($db, $uid, $paketnikId)
    {
        //$uid = $_SESSION["USER_ID"];
        //$userid = $this->userid;
        $query = "SELECT * FROM paketnik WHERE userid = '$uid' AND name = '$paketnikId';";
        $res = $db->query($query);
        $users = array();
        while ($u = $res->fetch_object()) {
            array_push($users, $u);
        }
        return $users;
    }
    public function posodi($uporabnikId, $db, $paketnikId)
    {
        $id = $this->id;
        $paketnikId = $this->paketnikId;
        $userid = $this->userid;

        $us = $this->userji($db, $userid, $paketnikId);
        foreach ($us as $u) {
            if($userid == $u->userid) {
                $qs = "INSERT INTO paketnik (id,name,userid) VALUES ($id,'$paketnikId', '$uporabnikId')";
                $result = mysqli_query($db, $qs);

                if (mysqli_error($db)) {
                    var_dump(mysqli_error($db));
                    exit();
                }

                $this->id = mysqli_insert_id($db);
            }
        }
    }

    public function odkleni($paketnikId, $db)
    {
        $userId = $_SESSION['user_id'];

        // Check if the user has access to unlock the paketnik
        $qs = "SELECT * FROM user_paketnik WHERE userid = '$userId' AND paketnikid = '$paketnikId' AND acces = 1";
        $result = mysqli_query($db, $qs);

        if (mysqli_num_rows($result) == 0) {
            echo "Nimate dostopa do odklepanja tega paketnika";
            return;
        }
        /*
        // Unlock the paketnik
        $qs = "UPDATE paketnik SET zaklenjen = 0 WHERE paketnikid = '$paketnikId'";
        $result = mysqli_query($db, $qs);

        if (!$result) {
            echo "Napaka pri odklepanju paketnika";
            return;
        }
        */
        // Insert a new row into the logs table
        $qs = "INSERT INTO logs (userid, paketnikid) VALUES ('$userId', '$paketnikId')";
        $result = mysqli_query($db, $qs);

        if (!$result) {
            echo "Napaka pri zapisovanju v dnevnik";
            return;
        }

        echo "Paketnik uspešno odklenjen";
    }
    /*
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
    */

}