<?php
include_once('header.php');
if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {

    $controller = 'oglas';
    //$action = 'prikaziVse';
}

require_once('frontend/views/layout.php');
include_once('footer.php');