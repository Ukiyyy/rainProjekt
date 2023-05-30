<?php
include "backend/models/user.php";
$uid = 2;
class user_controller {
    public function registracija() {
        require_once('frontend/views/user/registracija.php');
    }
    public function shrani() {
        if($_POST["username"]!=""&&$_POST["password"]!=""&&$_POST["email"]!="") {
            $url = 'http://localhost/rainPro/api.php/user/register';
            $data = array('username' => $_POST["username"], 'password' => $_POST["password"], 'email' => $_POST["email"]);

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
            require_once('frontend/views/user/prijava.php');
        }
        else{
            echo "neuspesna registracija";
        }
    }
    public function prijava(){
        if(isset($_POST["username"]) && isset($_POST["password"])){
            $url = 'http://localhost/rainPro/api.php/user/login';
            $data = array('username' => $_POST["username"], 'password' => $_POST["password"]);

            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            if ($result === FALSE) {
                die();
            }

            $obj = json_decode($result);
            print $obj->{'id'};

            var_dump($result);

            $uporabnik = new User($obj->{"id"}, $obj->{"username"}, $obj->{"password"}, $obj->{"email"});
            if($uporabnik){
                $_SESSION["USER_ID"] = $uporabnik->username;
                $_SESSION["USER"] = $uporabnik;
                header("Location: index.php");
            }else{
                require_once('frontend/views/user/prijava.php');
            }
        }else{
            require_once('frontend/views/user/prijava.php');
        }
    }

    public function odjava() {
        session_unset(); //Odstrani sejne spremenljivke
        session_destroy(); //Uniči sejo
        header("Location: index.php"); //Preusmeri na index.php
    }
}
?>
