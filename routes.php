<?php
function call($controller, $action) {

    require_once('backend/controllers/' . $controller . '_controller.php');
    require_once('backend/models/' . $controller . '.php');

    $o=$controller."_controller";
    $controller=new $o;
    $controller->{ $action }();
}


$controllers = array('strani' => ['index','napaka'],
    'user' => ['prijava', 'odjava','registracija','shrani','dodaj'],
    'paketnik' => ['zgo', 'dodajPaketnik', 'shrani', 'zbrisi', 'zbrisiPaketnik', 'spremeniIme','spremeniImePaketnik','spremeni','posodiKljuc','posodi','zgo','zgodovina'],
    'logs' => ['odkleni', 'odkleniPaketnik','zgodovina','zgo']);



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
