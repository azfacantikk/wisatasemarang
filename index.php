<?php
//menyertakan code dari file koneksi
include "koneksi.php";
?>
<!doctype html>
<html lang="en" data-bs-theme="light">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wisata Semarang</title>
    <link rel="icon" href="image/logo wisata_9_11zon.jpg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
      .carousel-item img {
        max-height: 70vh;
        object-fit: cover;
      }
    </style>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">Wisata Semarang</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
            <li class="nav-item">
              <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#article">Article</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#schedule">Schedule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about me">About me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php" target="_blank">Login</a>
            </li>          
            <li class="nav-item ms-3">
                <button id="btn-light" class="btn btn-outline-secondary btn-sm me-1">
                    <i class="bi bi-sun-fill"></i> Light
                </button>
                <button id="btn-dark" class="btn btn-dark btn-sm">
                    <i class="bi bi-moon-stars-fill"></i> Dark
                </button>
            </li>
            </ul>
        </div>
      </div>
    </nav>
    <section id="home" class="text-center p-5 bg-danger-subtle text-sm-start">
      <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="image/mahmur-marganti-i1tiYQ3mcvw-unsplash_6_11zon.jpg" class="img-fluid" width="300" />
          <div>
            <h1 class="fw-bold display-4">
              Create Memories, Save Memories, Everyday
            </h1>
            <h4 class="lead display-6">
              Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali
            </h4>
            <span id="tanggal"></span>
            <span id="jam"></span>
          </div>
        </div>
      </div>
    </section>
    <section id="article" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Article</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">

        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql); 

        while($row = $hasil->fetch_assoc()){

        ?>
        <!-- col begin -->
          <div class="col">
            <div class="card h-100">
              <img src="image/<?= $row["gambar"]?>" class="card-img-top" alt="Kota Lama">
              <div class="card-body">
                <h5 class="card-title"><?= $row["judul"]?></h5>
                <p class="card-text">
                    <?= $row["isi"]?>
                </p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary">
                    <?= $row["tanggal"]?>
                </small>
              </div>
            </div>
          </div>
        <!-- col end -->
         <?php
         }
         ?>
        </div>
    </div>
    </section>
    <section id="gallery" class="text-center p-5 bg-danger-subtle">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Gallery</h1>
        <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="image/Simpang 5_2_11zon.jpg" class="d-block w-100" alt="Simpang 5">
            </div>
            <div class="carousel-item">
              <img src="image/Lawang 2_8_11zon.jpg" class="d-block w-100" alt="Lawang Sewu">
            </div>
            <div class="carousel-item">
              <img src="image/Merbabu_7_11zon.jpg" class="d-block w-100" alt="Merbabu">
            </div>
            <div class="carousel-item">
              <img src="image/Spiegel_3_11zon.jpg" class="d-block w-100" alt="Spiegel">
            </div>
            <div class="carousel-item">
              <img src="image/Ungaran_1_11zon.jpg" class="d-block w-100" alt="Pasar Ungaran">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidd  en="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
  <!-- Schedule -->
<section id="schedule" class="pt-5 mt-5">
  <header class="bg-pink text-center py-4">
    <h1 class="fw-bold">Schedule</h1>
  </header>

  <div class="container my-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
      <!-- Membaca -->
      <div class="col">
        <div class="card h-100 text-center bg-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
            <i class="bi bi-book" style="font-size: 2.5rem; color: #dc3545;"></i>
            <h5 class="card-title mt-3 mb-2">Membaca</h5>
            <p class="card-text text-muted">Menambah wawasan setiap pagi sebelum beraktivitas.</p>
          </div>
        </div>
      </div>

      <!-- Menulis -->
      <div class="col">
        <div class="card h-100 text-center bg-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
            <i class="bi bi-laptop" style="font-size: 2.5rem; color: #dc3545;"></i>
            <h5 class="card-title mt-3 mb-2">Menulis</h5>
            <p class="card-text text-muted">Mencatat setiap pengalaman harian di jurnal pribadi.</p>
          </div>
        </div>
      </div>

      <!-- Diskusi -->
      <div class="col">
        <div class="card h-100 text-center bg-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
            <i class="bi bi-people" style="font-size: 2.5rem; color: #dc3545;"></i>
            <h5 class="card-title mt-3 mb-2">Diskusi</h5>
            <p class="card-text text-muted">Bertukar ide dengan teman dalam kelompok belajar.</p>
          </div>
        </div>
      </div>

      <!-- Olahraga -->
      <div class="col">
        <div class="card h-100 text-center bg-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
            <i class="bi bi-bicycle" style="font-size: 2.5rem; color: #dc3545;"></i>
            <h5 class="card-title mt-3 mb-2">Olahraga</h5>
            <p class="card-text text-muted">Menjaga kesehatan dengan bersepeda sore hari.</p>
          </div>
        </div>
      </div>

    </div>

    <div class="row row-cols-1 row-cols-sm-2 justify-content-center mt-4">
    <!-- Movie -->
      <div class="col col-lg-3">
        <div class="card h-100 text-center bg-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
            <i class="bi bi-film" style="font-size: 2.5rem; color: #dc3545;"></i>
            <h5 class="card-title mt-3 mb-2">Movie</h5>
            <p class="card-text text-muted">Menonton film yang bagus di bioskop.</p>
          </div>
        </div>
      </div>

      <!-- Belanja -->
      <div class="col col-lg-3">
        <div class="card h-100 text-center bg-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
            <i class="bi bi-cart" style="font-size: 2.5rem; color: #dc3545;"></i>
            <h5 class="card-title mt-3 mb-2">Belanja</h5>
            <p class="card-text text-muted">Membeli kebutuhan bulanan di supermarket.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

     <section id="about me" class="text-center p-5 bg-danger-subtle">
      <h1 class="fw-bold">About Me</h1>
    </header>
    <div class="container my-5">
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">

              Universitas Dian Nuswantoro Semarang (2024-Now)
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>Universitas Dian Nuswantoro, sebuah perguruan tinggi swasta terakreditasi "Unggul" di Semarang. Universitas ini terkenal dengan fokusnya pada inovasi di era digital, terutama di bidang teknologi dan ilmu komputer, dengan berbagai fakultas seperti Ilmu Komputer, Ekonomi dan Bisnis, Kesehatan, Teknik, Ilmu Budaya, dan Kedokteran. UDINUS didirikan secara resmi pada tahun 2001 dan memiliki lokasi strategis di pusat kota Semarang. 
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              SMA NEGERI 1 DEMAK (2021-2024)
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>SMA Negeri 1 Demak adalah sekolah menengah atas negeri yang berlokasi di Jalan Sultan Fatah No. 85, Katonsari, Demak, Jawa Tengah. Sekolah ini dikenal sebagai salah satu sekolah dengan kualitas terukur dan pernah masuk 10 besar SMA terbaik di Jawa Tengah. SMAN 1 Demak aktif menyelenggarakan berbagai kegiatan akademik maupun non-akademik, seperti prestasi di bidang sains nasional hingga kegiatan lingkungan dan ekstrakurikuler. 
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              SMP NEGERI 1 DEMAK (2019-2021)
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>SMP Negeri 1 Demak (SMPN 1 Demak) adalah sekolah menengah pertama yang memiliki visi untuk menjadikan sekolah unggul, berprestasi, kompetitif, dan agamis dengan wawasan global serta peduli lingkungan. Untuk mencapai visinya, sekolah ini fokus pada pembelajaran yang aktif, kreatif, dan efektif dengan pendekatan ICT, bimbingan siswa yang intensif, penyediaan fasilitas pendidikan yang memadai, serta pembentukan karakter siswa yang berakhlak mulia. 
            </div>
          </div>
        </div>
      </div>
     </section>
    </section>
    <footer class="text-center p-5">
      <div>
        <a href="https://www.instagram.com/illaazz_/">
          <i class="bi bi-instagram h2 p-2 text-dark"></i>
        </a>
        <a href="https://x.com/xxxscrta?s=11">
          <i class="bi bi-twitter-x h2 p-2 text-dark"></i>
        </a>
        <a href="https://wa.me/+6281367232322">
          <i class="bi bi-whatsapp h2 p-2 text-dark"></i>
        </a>
      </div>
      <div> Na'ilah Azfa Zarqarida &copy; 2024 </div>
    </footer>
    		<!-- Tombol Back to Top -->
    <button
      id="backToTop"
      class="btn btn-danger rounded-circle position-fixed bottom-0 end-0 m-3 d-none">

      <i class="bi bi-arrow-up" title="Back to Top"></i>
    </button>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script>
    function tampilwaktu(){
      const waktu = new Date();

      const tanggal = waktu.getDate();
      const bulan = waktu.getMonth();
      const tahun = waktu.getFullYear();
      const jam = waktu.getHours();
      const menit = waktu.getMinutes();
      const detik = waktu.getSeconds();

      const arrBulan = ["1", "2", "3", "4","5","6","7","8","9","10","11","12"];

      const tanggal_full = tanggal + "/" + arrBulan[bulan] + "/" + tahun;
      const jam_full = jam + ":" + menit + ":" + detik;

      document.getElementById("tanggal").innerHTML = tanggal_full;
      document.getElementById("jam").innerHTML = jam_full;
    }

    setInterval(tampilwaktu, 1000);

      document.getElementById("btn-light").addEventListener("click", function() {
        document.documentElement.setAttribute("data-bs-theme", "light");
      });
      
      document.getElementById("btn-dark").addEventListener("click", function() {
        document.documentElement.setAttribute("data-bs-theme", "dark");
      });
    </script>
    <script type="text/javascript"> 
      const backToTop = document.getElementById("backToTop");

      	window.addEventListener("scroll", function () {
				if (window.scrollY > 300) {
          backToTop.classList.remove("d-none");
          backToTop.classList.add("d-block");
        } else {
          backToTop.classList.remove("d-block");
          backToTop.classList.add("d-none");
        }
          });

      backToTop.addEventListener("click", function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
      });
    </script>

  </body>
</html>