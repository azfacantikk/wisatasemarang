<div class="container">
<div class="row mb-2">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-lg"></i> 
            Tambah Article
            </button>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Ketikkan minimal 3 karakter untuk pencarian. .">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th class="w-25">Judul</th>
                        <th class="w-50">Isi</th>
                        <th class="w-25">Gambar</th>
                        <th class="w-25">Aksi</th>
                    </tr>
                </thead>
                <tbody id="result">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTambahLabel">Tambah Artikel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">……
                    <div class="mb-3">
                        <label class="form-label">Judul Artikel</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Artikel</label>
                        <textarea name="isi" class="form-control" rows="5" placeholder="Tulis isi artikel..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Artikel</button>
                </div>
            </form>
            </div>
    </div>
</div>

<script>
    function loadData(keyword = '') {
        $.ajax({
            url: "article_search.php",
            type: "POST",
            data: {
                keyword: keyword
            },
            success: function(data) {
                $("#result").html(data);
            }
        });
    }

    // load awal
    loadData();

    // event pencarian
    $("#search").on("keyup", function() {
        let keyword = $(this).val();

        if (keyword.length >= 3 || keyword.length === 0) {
            loadData(keyword);
        }
    });
</script>

<?php
include "upload_foto.php";
include "koneksi.php";

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the save button is clicked
if (isset($_POST['simpan'])) {
    // Sanitize input data
    $judul = htmlspecialchars($_POST['judul'], ENT_QUOTES, 'UTF-8');
    $isi = htmlspecialchars($_POST['isi'], ENT_QUOTES, 'UTF-8');
    $tanggal = date("Y-m-d H:i:s");

    // Check if the session username is set
    if (!isset($_SESSION['username'])) {
        echo "<script>
            alert('Session expired. Please log in again.');
            document.location='login.php';
        </script>";
        exit;
    }

    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    // Check if a new file is uploaded
    if (!empty($nama_gambar)) {
        // Call the upload_foto function to validate and upload the file
        $cek_upload = upload_foto($_FILES["gambar"]);

        // Check the upload status
        if ($cek_upload['status']) {
            // If successful, get the uploaded file name
            $gambar = $cek_upload['message'];
        } else {
            // If failed, show an error message and redirect
            echo "<script>
                alert('" . htmlspecialchars($cek_upload['message'], ENT_QUOTES, 'UTF-8') . "');
                document.location='admin.php?page=article';
            </script>";
            exit;
        }
    }

    // Check if an ID is sent from the form
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']); // Sanitize the ID
        // Update the article in the database (example query)
        $query = "UPDATE articles SET judul = ?, isi = ?, tanggal = ?, gambar = ? WHERE id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssssi", $judul, $isi, $tanggal, $gambar, $id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Insert a new article into the database (example query)
        $query = "INSERT INTO articles (judul, isi, tanggal, username, gambar) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("sssss", $judul, $isi, $tanggal, $username, $gambar);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect to the admin page after saving
    echo "<script>
        alert('Article saved successfully.');
        document.location='admin.php?page=article';
    </script>";
}
?>