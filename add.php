<?php
include "form.php";
include "database.php";

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nim' => $_POST['nim'] ?? '',
        'nama' => $_POST['nama'] ?? '',
        'alamat' => $_POST['alamat'] ?? ''
    ];
    $ok = $db->insert('mahasiswa', $data);
    if ($ok) {
        header('Location: list.php'); exit;
    } else {
        echo "Gagal insert: ".$db->conn->error;
    }
}

$form = new Form("add.php", "Tambah Data");
$form->addField("nim", "NIM");
$form->addField("nama", "Nama");
$form->addField("alamat", "Alamat");
$form->displayForm();