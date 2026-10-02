<?php 

require_once "../config.php";
require_once "../helpers/response.php";

if (isset($_GET['search'])){
    $search = $_GET['search'];

    $q = "SELECT m.id, m.nama, m.nim, j.nama_jurusan AS jurusan FROM mahasiswa m LEFT JOIN jurusan j on m.jurusan_id = j.id WHERE m.nama LIKE '%$search%' OR m.nim LIKE '%$search%' ORDER BY m.id DESC";
    $r = mysqli_query($koneksi, $q);

    if(!$r) {
        sendResponse(false, "Query gagal: " . mysqli_error($koneksi), null, 500);
    }

    $data = mysqli_fetch_assoc($r);

    while ($row = mysqli_fetch_assoc($r)){
        $data[] = $row;
    }

    sendResponse(true, "berhasil", $data, 200);
}

?>