<?php
include "database.php";
$db = new Database();
$id = $_GET['id'] ?? null;
if ($id) {
    $ok = $db->delete('mahasiswa', "id=".intval($id));
}
header('Location: list.php');
exit;
