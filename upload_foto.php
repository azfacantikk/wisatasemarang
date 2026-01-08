<?php
function upload_foto($File) {
    $status = false;
    $message = "";
    $target_dir = "image/"; // Pastikan folder ini sudah kamu buat manual!
    $nama_file = basename($File["name"]);
    $ukuran_file = $File["size"];
    $tipe_file = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $allowed_types = array("jpg", "jpeg", "png", "gif");

    // 1. Cek apakah folder tujuan ada
    if (!is_dir($target_dir)) {
        return array('status' => false, 'message' => "Folder '$target_dir' tidak ditemukan! Buat dulu foldernya.");
    }

    // 2. Cek apakah beneran gambar
    $cek = getimagesize($File["tmp_name"]);
    if ($cek === false) {
        return array('status' => false, 'message' => "File yang diupload bukan gambar.");
    }

    // 3. Cek tipe file (format)
    if (!in_array($tipe_file, $allowed_types)) {
        return array('status' => false, 'message' => "Hanya file JPG, JPEG, PNG, & GIF yang diperbolehkan.");
    }

    // 4. Cek ukuran file (Maksimal 2MB)
    if ($ukuran_file > 2000000) {
        return array('status' => false, 'message' => "Ukuran file terlalu besar (Maks 2MB).");
    }

    // 5. Generate nama unik biar tidak bentrok (misal: 30122025_foto.jpg)
    $nama_baru = date('dmYHis') . '_' . $nama_file;
    $target_file = $target_dir . $nama_baru;

    // 6. Proses Pindah File
    if (move_uploaded_file($File["tmp_name"], $target_file)) {
        $status = true;
        $message = $nama_baru;
    } else {
        $message = "Gagal memindahkan file. Cek permission folder image!";
    }

    return array('status' => $status, 'message' => $message);
}
?>