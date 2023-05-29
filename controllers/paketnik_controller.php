<?php
include 'models/paketnik.php';

class paketnik_controller {
    public function dodajPaketnik() {
        require_once('views/paketnik/dodajPaketnik.php');
    }
    public function shrani() {
        if($_POST["paketnikId"]!="") {
            $url = 'http://localhost/rainPro/api.php/paketnik/dodaj';
            $data = array('paketnikId' => $_POST["paketnikId"], 'userid' => $_SESSION["USER_ID"]);

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

    public function spremeniIme() {
        require_once ('views/paketnik/spremeniImePaketnik.php');
    }

    public function spremeni()
    {
        if($_POST["paketnikId"]!="") {
            $url = 'http://localhost/rainPro/api.php/paketnik/spremeni';
            $data = array('paketnikId' => $_POST["paketnikId"], 'novoIme' => $_POST["novoIme"]);
            //$data['imePaketnika'] = $_POST["imePaketnika"];

            $options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'PUT',
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
            echo "neuspesna spremenitev imena paketnik";
        }
    }


    public function posodiKljuc() {
        require_once ('views/paketnik/posodiKljuc.php');
    }

    public function posodi()
    {
        if($_POST["paketnikId"]!="") {
            $url = 'http://localhost/rainPro/api.php/paketnik/posodi';
            $data = array('paketnikId' => $_POST["paketnikId"], 'uporabnikId' => $_POST["uporabnikId"]);
            //$data['imePaketnika'] = $_POST["imePaketnika"];

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
            echo "neuspesna spremenitev imena paketnik";
        }
    }
    public function odkleni(){
        require_once('views/logs/odkleniPaketnik.php');
    }
    public function odkleniPaketnik()
    {
        if ($_POST["paketnikId"] != "") {
            $url = 'http://localhost/rainPro/api.php/paketnik/odkleni';
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
        } else {
            echo "neuspesno izbrisan paketnik";
        }
    }
}
?>