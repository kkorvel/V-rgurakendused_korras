<?php
session_start();
// laeme andmete haldamise meetodid
require 'lennuajad.php';
// laeme andmete modifitseerimise meetodid
require 'kontroll.php';
// rakenduse "ruuter"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $result muutuja indikeerib kas toimus mõni õnnestunud tegevus või mitte
    $result = false;
    switch ($_POST['action']) {
        case 'add':
            $Lähtekoht = $_POST['Lähtekoht'];
            $Sihtkoht = $_POST['Sihtkoht'];
            $Kuupäev = date($_POST['Kuupäev']);
            $Lennualgus = time($_POST['Lennualgus']);
            $Lennualõpp = time($_POST['Lennulõpp']);
            $Vabadkohad = intval($_POST['Vabadkohad']);

            $result = kontroller_add($Sihtkoht, $Lähtekoht, $Kuupäev, $Lennualgus, $Lennulõpp, $Vabadkohad);
            break;
        case 'delete':
            $id = intval($_POST['id']);
            $result = kontroller_delete($id);
            break;
        case 'login':
            $kasutajanimi = $_POST['kasutajanimi'];
            $parool = $_POST['parool'];
            $result = controller_login($kasutajanimi, $parool);
            break;
        case 'logout':
            $result = controller_logout();
            break;
          }
    }
    if ($result) {
        // kuna $result on true siis järelikult toimus mõni õnnestunud tegevus
        // sellisel juhul suuname kasutaja tagasi eelmisele lehele
        header('Location: '.$_SERVER['PHP_SELF']);
    } else {
        header('Content-type: text/plain; charset=utf-8');
        echo 'Päring ebaõnnestus!';
    }
    // POST päringu puhul me sisu ei näita
    exit;
}
if (!empty($_GET['view'])) {
    switch ($_GET['view']) {
        case 'login':
            require 'view_login.php';
            break;
        case 'register':
            require 'view_register.php';
            break;
        default:
            header('Content-type: text/plain; charset=utf-8');
            echo 'Tundmatu valik!';
            exit;
    }
} else {
require 'view.php';
}
mysqli_close($l);
