<?php

include "models/user.php";
include "models/paketnik.php";


$method = $_SERVER["REQUEST_METHOD"];

if(isset($_SERVER['PATH_INFO']))
    $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

else
    $request="";

$db = mysqli_connect("sql7.freemysqlhosting.net", "sql7616003", "AQvIh4ifwr", "sql7616003");//Db::getInstance();

if(isset($request[0])&&($request[0]=='user')){
    switch ($method) {
        case 'POST':
            parse_str(file_get_contents('php://input'), $input);
            if (isset($input) && isset($request[1]) && $request[1] == 'register' ) {
                $user = new user($input["username"], $input["password"],$input["email"],0);
                $user->dodaj($db);
            }
            if (isset($input) && isset($request[1]) && $request[1] == 'login' ) {
                $user = User::login($input["username"],$input["password"], $db);
                echo json_encode($user);
            }
    }
}
if(isset($request[0])&&($request[0]=='paketnik')) {
    switch ($method) {
        case 'DELETE':
            parse_str(file_get_contents('php://input'), $input);
            if(isset($input) && isset($request[1]) && $request[1] == 'zbrisi') {
                $paketnikId = $input["paketnikId"];
                Paketnik::zbrisi($paketnikId, $db);
            }
            break;
        case 'POST':
            parse_str(file_get_contents('php://input'), $input);
            if(isset($input) && isset($request[1]) && $request[1] == 'dodaj' ) {
                $paketnik = new paketnik($input["paketnikId"],0);
                $paketnik->dodaj($db);
            }
        case 'PUT':
            parse_str(file_get_contents('php://input'), $input);
            if(isset($input) && isset($request[1]) && $request[1] == 'spremeni') {
                $paketnikId = $input["paketnikId"];
                $novoIme = $input["novoIme"];
                $paketnik->spremeni($novoIme,$db,$paketnikId);
            }
            break;

    }
}