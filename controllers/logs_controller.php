<?php
include 'models/logs.php';

class logs_controller {

    public function odkleni(){
        require_once('views/logs/odkleniPaketnik.php');
    }
    public function odkleniPaketnik()
    {
        if ($_POST["paketnikId"] != "") {
            $url = 'http://localhost/rainPro/api.php/logs/odkleni';
            $data = array('paketnikId' => "feri",'userId' => 2, 'date' => date("Y-m-d"));

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