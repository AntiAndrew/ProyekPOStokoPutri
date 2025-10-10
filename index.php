<?php
require_once 'controllers/BarangController.php';

$controller = new BarangController();

$action = $_GET['action'] ?? 'lihatDaftarBarang';

switch ($action) {
    case 'inputBarang':
        $controller->inputBarang();
        break;
    case 'simpanBarang':
        $controller->simpanBarang();
        break;
    case 'editBarang':
        $controller->editBarang($_GET['id']);
        break;
    case 'updateBarang':
        $controller->updateBarang($_POST['id']);
        break;
    case 'hapusBarang':
        $controller->hapusBarang($_GET['id']);
        break;
    case 'cariBarang':
        $controller->cariBarang();
        break;
    default:
        $controller->lihatDaftarBarang();
        break;
}
