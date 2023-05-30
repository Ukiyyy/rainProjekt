<?php

include "backend/models/user.php";
include "backend/models/paketnik.php";
include "backend/models/logs.php";




$method = $_SERVER["REQUEST_METHOD"];

if(isset($_SERVER['PATH_INFO']))
    $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

else
    $request="";

$db = mysqli_connect("sql7.freemysqlhosting.net", "sql7620703", "syRmuGc8Zd", "sql7620703");//Db::getInstance();

if(isset($request[0])&&($request[0]=='logs')){
    switch ($method) {
        case 'POST':
            parse_str(file_get_contents('php://input'), $input);
            if (isset($input) && isset($request[1]) && $request[1] == 'odkleni' ) {
                //$logs = new logs($input["paketnikId"], $input["userId"],$input["date"],0);
                $logs = new logs(3, 3, "2000-05-05",0);
                //$paketnikId = $input["paketnikId"];
                $logs->odkleni($db);
            }
            break;
        case 'GET':
            parse_str(file_get_contents('php://input'), $input);
            if (isset($request[1]) && $request[1] == 'zgodovina') {
                $paketnikId = $input["userid"];
                $results=Logs::zgodovina($db,$paketnikId);
                echo json_encode($results);
            }

    }
}
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
            if(isset($input) && isset($request[1]) && $request[1] == 'odkleni') {
                //$input_data = json_decode(file_get_contents('php://input'), true);
                $paketnikId = $input['paketnikId'];
                Paketnik::odkleni($paketnikId, $db);
            }
            if(isset($input) && isset($request[1]) && $request[1] == 'dodaj' ) {
                $paketnik = new paketnik($input["userid"],$input["paketnikId"],0);
                $paketnik->dodaj($db);
            }
            if(isset($input) && isset($request[1]) && $request[1] == 'posodi') {
                $paketnik = new paketnik($input["userid"],$input["paketnikId"],0);
                $paketnikId = $input["paketnikId"];
                $imePosojenemu = $input['uporabnikId'];

                $paketnik->posodi($imePosojenemu, $db, $paketnikId);
            }

                break;
        case 'PUT':
            parse_str(file_get_contents('php://input'), $input);
            if(isset($input) && isset($request[1]) && $request[1] == 'spremeni') {
                $paketnikId = $input["paketnikId"];
                $novoIme = $input["novoIme"];
                Paketnik::spremeni($novoIme,$db,$paketnikId);
            }

            break;
        case 'GET':
            parse_str(file_get_contents('php://input'), $input);
            if(isset($request[1]) && $request[1] == 'zgodovina') {
                $paketnikId = $_GET['paketnikId'];
                $results = Paketnik::zgo($paketnikId, $db);
                header('Content-Type: application/json');
                echo json_encode($results);
            }
            else if(isset($input) && isset($request[1]) && $request[1] == 'odkleni') {
                $input_data = json_decode(file_get_contents('php://input'), true);
                $paketnikId = $input_data['paketnikId'];
                Paketnik::odkleni($paketnikId, $db);
            }
            break;
    }
}