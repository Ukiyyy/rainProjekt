<?php
function call($controller, $action) {

    require_once('controllers/' . $controller . '_controller.php');
    require_once('models/' . $controller . '.php');

    $o=$controller."_controller";
    $controller=new $o;
    $controller->{ $action }();
}


$controllers = array('strani' => ['index','napaka'],
    'user' => ['prijava', 'odjava','registracija','shrani'],
    'paketnik' => ['zgo', 'dodajPaketnik', 'shrani', 'zbrisi', 'zbrisiPaketnik', 'spremeniIme','spremeniImePaketnik','spremeni','posodiKljuc','odkleni','odkleniPaketnik','zgo','zgodovina']);



if (array_key_exists($controller, $controllers)) {


    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    }
    else {
        call('strani', 'napaka');
    }
} else {
    call('strani', 'napaka');
}
?>
