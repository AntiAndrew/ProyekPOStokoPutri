<?php
require_once "controller/TransaksiController.php";
$controller = new TransaksiController();

$action = $_GET['action'] ?? 'list';

if ($action == 'form') {
    include "view/transaksi_form.php";
} elseif ($action == 'simpan') {
    $controller->simpanTransaksi($_POST);
    header("Location: index.php");
} elseif ($action == 'edit') {
    $data = $controller->ambilDetail($_GET['id']);
    include "view/transaksi_edit.php";
} elseif ($action == 'update') {
    $controller->updateTransaksi($_POST);
    header("Location: index.php");
} elseif ($action == 'hapus') {
    $controller->hapusTransaksi($_GET['id']);
    header("Location: index.php");
} elseif ($action == 'detail') {
    $data = $controller->ambilDetail($_GET['id']);
    include "view/transaksi_detail.php";
} elseif ($action == 'laporan') {
    $data = $controller->tampilkanDaftar();
    include "view/transaksi_laporan.php";
} else {
    $data = $controller->tampilkanDaftar();
    include "view/transaksi_list.php";
}
?>
