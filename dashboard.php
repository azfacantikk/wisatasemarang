<?php
include "koneksi.php";
// 1. Query jumlah article (Kode Asli Kamu)
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

//menghitung jumlah baris data article
$jumlah_article = $hasil1->num_rows; 

// 2. Query jumlah gallery
$sql1 = "SELECT * FROM gallery ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

//menghitung jumlah baris data gallery
$jumlah_gallery = $hasil1->num_rows; 

// 3. Query data user (untuk mengambil foto profil)
$sql_user = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();



?>

<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">
    <div class="col-md-12 text-center">
        <h5> Selamat Datang,</h5>
        
        <h1 class="text-danger fw-bold"><?= $_SESSION['username'] ?></h1>
        
        <div class="my-4">
            <?php
            if ($row_user['foto'] != '' && file_exists('image/' . $row_user['foto'])) {
                // Jika ada foto, tampilkan foto asli
                echo '<img src="image/' . $row_user['foto'] . '" class="rounded-circle border border-dark" style="width: 200px; height: 200px; object-fit: cover;">';
            } else {
                // Jika tidak ada foto, tampilkan gambar default placeholder
                echo '<img src="https://via.placeholder.com/200" class="rounded-circle border border-dark" style="width: 200px; height: 200px; object-fit: cover;">';
            }
            ?>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-newspaper"></i> Article</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_article; ?></span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-camera"></i> Gallery</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_gallery; ?></span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</div>