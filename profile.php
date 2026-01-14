<?php
include "koneksi.php";
include "upload_foto.php";

// 1. Ambil data user yang sedang login
$id_user = $_SESSION['username']; // Sesuaikan dengan session yang kamu simpan (biasanya username)

// Query ambil data user berdasarkan username login
$sql = "SELECT * FROM user WHERE username = '$id_user'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);

// 2. Jika Tombol Simpan Diklik
if (isset($_POST['simpan'])) {
    $password_baru = $_POST['password'];
    $foto_lama = $_POST['foto_lama'];
    $nama_foto = $_FILES['foto']['name'];
    $foto = $foto_lama; // Default foto tetap yang lama

    // A. Logika Ganti Foto
    if ($nama_foto != '') {
        // Jika ada file gambar yang diupload
        $cek_upload = upload_foto($_FILES["foto"]);
        
        if ($cek_upload['status']) {
            $foto = $cek_upload['message']; // Set nama file baru
            
            // Hapus foto lama jika ada dan file fisiknya tersedia
            if ($foto_lama != '' && file_exists('image/' . $foto_lama)) {
                unlink('image/' . $foto_lama);
            }
        } else {
            echo "<script>alert('" . $cek_upload['message'] . "');</script>";
            // Jika gagal upload, hentikan proses
            echo "<script>window.location='admin.php?page=profile';</script>"; 
            exit;
        }
    }

    // B. Logika Ganti Password
    if ($password_baru == '') {
        // Jika password kosong, pakai password lama (tidak diubah)
        $password_sql = $data['password']; 
    } else {
        // Jika password diisi, enkripsi password baru (md5 sesuai sistem kamu)
        $password_sql = md5($password_baru);
    }

    // C. Update Data ke Database
    // Username tidak diupdate karena readonly
    $query_update = "UPDATE user SET 
                     password = '$password_sql', 
                     foto = '$foto' 
                     WHERE username = '$id_user'";

    $update = mysqli_query($conn, $query_update);

    if ($update) {
        echo "<script>
            alert('Profile berhasil diupdate!');
            document.location='admin.php?page=profile';
        </script>";
    } else {
        echo "<script>
            alert('Gagal update profile!');
            document.location='admin.php?page=profile';
        </script>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-left">
        <div class="col-12">
                    <form action="" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="foto_lama" value="<?= $data['foto'] ?>">


                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control bg-light" name="username" value="<?= $data['username'] ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Ganti Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Tuliskan password baru jika ingin mengganti">
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Ganti Foto Profil</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                        </div>

                        <div class="mb-3">
                            <div>Foto Profile saat ini</div>
                            <?php 
                            if ($data['foto'] != '' && file_exists('image/'.$data['foto'])) {
                                echo '<img src="image/'.$data['foto'].'" width="150" height="200" style="object-fit: cover;">';
                            } else {
                                // Gambar default jika belum ada foto
                                echo '<img src="https://via.placeholder.com/150" class="rounded-circle border border-2 border-secondary" width="150" height="150">';
                            }
                            ?>
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="simpan" class="btn btn-primary btn-sm">Simpan</button>
                        </div>

                        <link rel="icon" href="image/image/logo wisata_9_11zon.jpg" />

                    </form>
        </div>
    </div>
</div>