<?php
include 'models/paketnik.php';

class paketnik_controller {
    public function dodajPaketnik() {
        require_once('views/paketnik/dodajPaketnik.php');
    }
    public function shrani() {
        if($_POST["paketnikId"]!="") {
            $url = 'http://localhost/rainPro/api.php/paketnik/dodaj';
            $data = array('paketnikId' => $_POST["paketnikId"]);

            $options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            if ($result === FALSE) {
                die();
            }
            require_once('views/strani/uspesno.php');
        }
        else{
            echo "neuspesno vnesen paketnik";
        }
    }
    public function zbrisiPaketnik() {
        require_once ('views/paketnik/zbrisiPaketnik.php');
    }
    public function zbrisi() {
        if($_POST["paketnikId"]!="") {
            $url = 'http://localhost/rainPro/api.php/paketnik/zbrisi';
            $data = array('paketnikId' => $_POST["paketnikId"]);

            $options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'DELETE',
                    'content' => http_build_query($data)
                )
            );
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            if ($result === FALSE) {
                die();
            }
            require_once('views/strani/uspesno.php');
        }
        else{
            echo "neuspesno izbrisan paketnik";
        }
    }
}
?>