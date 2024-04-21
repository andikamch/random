<?php
require '../../../koneksi.php';

$id = $_GET['id'];
$films = $conn->query("SELECT * FROM tbl_news WHERE id_news='$id'");
$user = mysqli_fetch_assoc($films);


if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    
    // Proses validasi tipe file foto
    $photo_name = $_FILES['thumbnail_news']['name'];
    $photo_tmp = $_FILES['thumbnail_news']['tmp_name'];
    $photo_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
    
    // Definisikan tipe file foto yang diperbolehkan
    $allowed_photo_types = array('jpg', 'jpeg', 'png', 'gif');
     
    if (isset($photo)) {
        $photo = str_replace(' ', '-', $photo_name);
        move_uploaded_file($photo_tmp, "../../../berkas/" . $photo);
    }else{
        
        $photo = "default.jpg";
    }
    
    // Proses upload foto
    
    // Query SQL untuk menyimpan data ke database
    $sql = $conn->query("UPDATE tbl_news SET thumbnail_news = '$photo_name', judul_news = '$judul', isi = '$isi' WHERE id_news = '$id'");
    
    // Menampilkan pesan sukses dan mengarahkan pengguna ke halaman kelolauser.php
    echo '<script>alert("Datanya Berhasil Diperbarui");</script>';
    echo '<script>location.replace("news.php");</script>';
    
}


?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyFilm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        @font-face {
            font-family: 'Poppins';
            src: url('../../../berkas/font/Poppins-Regular.ttf') format('truetype');
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            background-color: #272829;
            color: white;
            font-family: 'Poppins', sans-serif;
        }

        .buttonplay {
            border: 0px;
        }

        .fav {
            background: rgb(25, 29, 136);
            background: linear-gradient(90deg, rgba(25, 29, 136, 0.49343487394957986) 0%, rgba(255, 255, 255, 0) 0%);
            border: 0px;
        }

        .sidebar {
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }

        .card {
            position: relative;
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            bottom: 0;
            left: 0;
            right: 0;
            color: white;
            padding: 5px;
        }

        .fixed-card {
            position: fixed;
            bottom: 0;
            right: 0;

        }

        /* CSS Anda yang sudah ada */

        /* Menyembunyikan sidebar pada layar kecil (HP) */
        @media (max-width: 767px) {
            .sidebar {
                display: none;
            }

            .main-content {
                width: 100%;
            }

            .collapsed .sidebar {
                display: block;
                position: fixed;
                z-index: 1000;
                top: 0;
                left: 0;
                bottom: 0;
                width: 70%;
                overflow-y: auto;
                transition: 0.3s;
            }

            .collapsed .main-content {
                margin-left: 70%;
            }

            .collapsed .fs-4 {
                cursor: pointer;
            }
        }

        @media (min-width: 768px) {
            .navbar {
                display: none;
            }
        }

        @media (max-width: 767px) {
            .navbar {
                display: block;
            }
        }

        .swiper {
            width: 100%;
            height: 300px;
        }

        .swiper-slide img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .swiper-slide {
            position: relative;
        }

        .slide-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            padding: 20px;
            box-sizing: border-box;
        }

        .slider-container {
            position: relative;
        }

        .image-caption {
            color: white;
            margin: 0;
            width: 70%;
        }

        .text-ellipsis {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>

    <div class="container-fluid " style="font-family: poppins;">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-flex flex-md-column p-3 text-white bg-dark sidebar">
                <a href="../index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32">
                        <use xlink:href="#bootstrap" />
                    </svg>
                    <span class="fs-4">MyFilm</span>
                </a>
                <hr>
                <ul class="nav nav-pills list-unstyled flex-column mb-auto">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link text-decoration-none text-white" aria-current="page">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#home" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php" class="nav-link  text-white">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#speedometer2" />
                            </svg>
                            Edit/Input Film
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="kelolauser.php" class="nav-link  text-white">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#speedometer2" />
                            </svg>
                            kelola user
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="news.php" class="nav-link  text-white">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#speedometer2" />
                            </svg>
                            kelola news
                        </a>
                    </li>

                    <!-- end dropdown here -->


                </ul>
            </div>
            <!-- Main Content -->
            <div class="col-md-9 ms-md-auto col-lg-10 px-md-4 main-content">
                <!-- Your content goes here -->
                <section class="home">
                    <div class="container-fluid mt-5 ">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="content">
                                    <h1>Edit User</h1>
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="row">
                                        <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="judul" class="form-label fw-bold">judul :</label>
                                                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan username" value="<?=$user['judul_news']?>" required>

                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <label for="isi" class="form-label fw-bold">deskripsi :</label>
                                                <textarea id="isi" name="isi" class="form-control" rows="10"><?=$user['isi']?></textarea>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <label for="thumbnail_news" class="form-label fw-bold">Gambar:</label>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="col-lg-12">
                                                            <label for="thumbnail_news"></label>
                                                            <input type="file" class="form-control mt-2" id="thumbnail_news" name="thumbnail_news">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" id="update" name="update" class="btn  btn-primary col-lg-3 mt-0 mb-5">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>
    <script src="../../assets/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>


</body>

</html>