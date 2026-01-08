<?php
session_start(); // Memulai session
include "koneksi.php"; // Menyertakan file koneksi (pastikan variabel koneksi bernama $conn)

// Cek jika sudah login, arahkan ke admin
if (isset($_SESSION['username'])) {
    header("location:admin.php");
    exit;
}

$error_message = ""; // Variabel untuk menampung pesan error

// Cek apakah ada request POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil input dan sanitasi dasar
    $username = $_POST['user'];
    $password = md5($_POST['pass']); // Enkripsi password dengan MD5 (sesuaikan jika database tidak pakai MD5)

    // Validasi input kosong (Backup jika JS dimatikan)
    if (empty($username) || empty($_POST['pass'])) {
        $error_message = "Username dan Password tidak boleh kosong!";
    } else {
        // --- QUERY DATABASE ---
        // Siapkan query untuk cek username dan password
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password); 
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Cek apakah data ditemukan
        if ($result->num_rows > 0) {
            // Jika berhasil login
            $_SESSION['username'] = $row['username']; // Simpan username ke session
            header("location:admin.php");
            exit;
        } else {
            // Jika gagal login
            $error_message = "Username atau Password salah!";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | My Daily Journal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="icon" href="img/logo.png" />
</head>
<body class="bg-danger-subtle">
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow rounded-5">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-person-circle h1 display-4"></i>
                            <p>My Daily Journal</p>
                            <hr />
                        </div>
                        
                        <form action="" method="post" id="loginForm">
                            <input type="text" name="user" id="user" class="form-control my-4 py-2 rounded-4" placeholder="Username" value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user']) : ''; ?>" />
                            <input type="password" name="pass" id="pass" class="form-control my-4 py-2 rounded-4" placeholder="Password" />
                            
                            <div class="text-center my-3 d-grid">
                                <button class="btn btn-danger rounded-4">Login</button>
                            </div>
                            
                            <?php if (!empty($error_message)): ?>
                                <div class="alert alert-danger text-center">
                                    <?php echo $error_message; ?>
                                </div>
                            <?php endif; ?>
                            
                            <p id="errorMsg" class="text-danger text-center"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            const user = document.getElementById("user").value.trim();
            const pass = document.getElementById("pass").value.trim();
            const errorMsg = document.getElementById("errorMsg");

            // Reset pesan error
            errorMsg.textContent = "";

            // Cek username kosong
            if (user === "") {
                errorMsg.textContent = "Username tidak boleh kosong!";
                event.preventDefault(); 
                return;
            }

            // Cek password kosong
            if (pass === "") {
                errorMsg.textContent = "Password tidak boleh kosong!";
                event.preventDefault(); 
                return;
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>