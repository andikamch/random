<?php
require '../../../koneksi.php';
session_start();

if (isset($_SESSION['user'])) {
    $sessionUser = $_SESSION['user'];
} else {
    echo "<script>alert('Silahkan Login') 
    location.replace('../../index.php')</script>";
}

$isianuser = $_SESSION['user_id'];


$query = "SELECT * FROM tbl_user WHERE user_id = '$isianuser'";


$result = mysqli_query($conn, $query);


if ($result) {

    $isi = mysqli_fetch_assoc($result);
} else {

    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

$user = $conn->query("SELECT * FROM tbl_user");


if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete = $conn->query("DELETE FROM tbl_user WHERE user_id = '$id'");

    if ($delete) {
        echo '<script>alert("Data Berhasil Dihapus");
            location.replace("");</script>';
    }
}


?>
<!doctype html>
<html lang="en">

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
                <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
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
                        <a href="kelolauser.php" class="nav-link active text-white">
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
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../../berkas/<?= $isi['photo'] ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                        <?php if (isset($sessionUser)) : ?>
                            <strong>
                                <?= $sessionUser['username'] ?>
                            </strong>
                        <?php else : ?>
                            <strong>Guest</strong>
                        <?php endif ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="../../profile/index.php?user_id=<?= $isianuser ?>">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../../../home/">Keluar mode admin</a></li>
                        <li><a class="dropdown-item" href="../../../logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
            <!-- Main Content -->
            <div class="col-md-9 ms-md-auto col-lg-10 px-md-4 main-content">
                <!-- Your content goes here -->
                <section class="home">
                    <div class="container-fluid mt-5">
                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <a class="btn btn-success w-100 mb-2" href="tambahuser.php"><i class="bi bi-plus-square"></i> Tambahkan user</a>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" id="searchInputUser" class="form-control mb-2" placeholder="Cari...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <table class="table table-hover table-light">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Gender</th>
                                                    <th>Photo</th>
                                                    <th>Role</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBodyUser">
                                                <?php $no = 1;
                                                foreach ($user as $row) { ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['username'] ?></td>
                                                        <td><?= $row['email'] ?></td>
                                                        <td><?= $row['password'] ?></td>
                                                        <td><?= $row['gender'] ?></td>
                                                        <td><img src="../../../berkas/<?= $row['photo'] ?>" style="width:200px;" srcset=""></td>
                                                        <td><?= $row['role'] ?></td>
                                                        <td>
                                                            <a href="edituser.php?id=<?= $row["user_id"] ?>" style="" class="btn btn-info text-white btn-sm px-3">Edit</a>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id" value="<?= $row["user_id"] ?>">
                                                                <button type="submit" name="delete" class="btn mt-2 btn-sm btn-danger text-white" value="" <?= $row['user_id'] ?>>Hapus</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
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
<script>
    document.getElementById("searchInputUser").addEventListener("keyup", function() {
        let input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInputUser");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableBodyUser");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            let found = false;
            td_username = tr[i].getElementsByTagName("td")[1]; // Kolom username (indeks 1)
            td_email = tr[i].getElementsByTagName("td")[2]; // Kolom email (indeks 2)
            td_gender = tr[i].getElementsByTagName("td")[4]; // Kolom gender (indeks 4)

            if (td_username || td_email || td_gender) {
                txtValue_username = td_username.textContent || td_username.innerText;
                txtValue_email = td_email.textContent || td_email.innerText;
                txtValue_gender = td_gender.textContent || td_gender.innerText;

                if (txtValue_username.toUpperCase().indexOf(filter) > -1 ||
                    txtValue_email.toUpperCase().indexOf(filter) > -1 ||
                    txtValue_gender.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                }

                if (found) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>

</html>