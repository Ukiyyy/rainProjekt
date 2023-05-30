<?php
include 'backend/models/logs.php';

class logs_controller {

    public function odkleni(){
        require_once('frontend/views/logs/odkleniPaketnik.php');
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
            require_once('frontend/views/strani/uspesno.php');
        } else {
            echo "neuspesno izbrisan paketnik";
        }
    }
    public function zgo(){
        require_once('frontend/views/paketnik/getIdZgoPaketnik.php');
    }
    public function zgodovina()
    {
        $url = 'http://localhost/rainPro/api.php/logs/zgodovina?paketnikId=';
        $data = array('userid' => $_SESSION["USER_ID"]);

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'GET',
                'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {
            die();
        }

        $results = json_decode($result, true);

        if ($results === NULL) {
            echo "Error: Failed to decode API response.";
            die();
        }

        require_once('frontend/views/paketnik/zgodovinaPaketnik.php');
    }
}
?>