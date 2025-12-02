<?php
include "form.php";
include "database.php";
$db = new Database();

$id = $_GET['id'] ?? null;
if (!$id) { header('Location: list.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nim' => $_POST['nim'] ?? '',
        'nama' => $_POST['nama'] ?? '',
        'alamat' => $_POST['alamat'] ?? ''
    ];
    $ok = $db->update('mahasiswa', $data, "id=".intval($id));
    if ($ok) { header('Location: list.php'); exit; }
    else { echo "Gagal update"; }
}

$rows = $db->get('mahasiswa', "id=".intval($id));
$row = $rows[0] ?? null;
if (!$row) { echo "Data tidak ditemukan"; exit; }

// tampilkan form manual (bisa juga extend Form class, untuk kemudahan kita pakai HTML)
?>
<form method="post" action="edit.php?id=<?php echo $id; ?>">
    NIM: <input type="text" name="nim" value="<?php echo htmlspecialchars($row['nim']); ?>"><br>
    Nama: <input type="text" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>"><br>
    Alamat: <input type="text" name="alamat" value="<?php echo htmlspecialchars($row['alamat']); ?>"><br>
    <input type="submit" value="Simpan">
</form>
