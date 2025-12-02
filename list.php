<?php
include "database.php";
$db = new Database();
$rows = $db->get('mahasiswa');

echo "<a href='add.php'>Tambah Data</a><br><br>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>ID</th><th>NIM</th><th>Nama</th><th>Alamat</th><th>Aksi</th></tr>";
foreach ($rows as $r) {
    echo "<tr>";
    echo "<td>".$r['id']."</td>";
    echo "<td>".$r['nim']."</td>";
    echo "<td>".$r['nama']."</td>";
    echo "<td>".$r['alamat']."</td>";
    echo "<td>
            <a href='edit.php?id=".$r['id']."'>Edit</a> |
            <a href='delete.php?id=".$r['id']."' onclick=\"return confirm('Setuju untuk delete?')\">Delete</a>
          </td>";
    echo "</tr>";
}
echo "</table>";
