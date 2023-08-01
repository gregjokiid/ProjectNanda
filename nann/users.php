<!DOCTYPE html>
<html lang="en">
<?php
        include_once('conn.php');

        if (!isset($_SESSION['user'])) {
        header("Location: index.php");
    }
    
    if (isset($_POST['tambah'])) {
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $status = $_POST['status'];

        echo $status;

        $sql = "INSERT INTO users (username, nama, alamat,telepon,email,password,status) VALUES ('$username', '$nama','$alamat','$telepon','$email','$password','$status')";
        if (mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>alert('Pengguna berhasil ditambahkan');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error: " . $sql . "<br>" . mysqli_error($conn)."');</script>";
        }
        header("Location: users.php");

      }


        if($_SESSION['access']==3 ){
            header("Location: index.php");
        }
              

    ?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SixTeen</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SixTeen<sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php
                if($_SESSION['access']==1 || $_SESSION['access']==2){
                    echo ('
                    <li class="nav-item">
                    <a class="nav-link" href="users.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Pengguna</span></a>
                    </li>');
                }
                ;
            ?>

            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Barang</span></a>
            </li>


           

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Transaksi
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="masuk.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Barang Masuk</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="keluar.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Barang Keluar</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Keluar</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            <div class="main">
            <div class="row">
                <div class="col-6">
                    <div class="container">
                        <div class="h1">List User</div>
                        <table class="table table-striped border" >
                            <th>#</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                            <?php
                            $sql = "SELECT * FROM users";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_array($result)){
                                ?>
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['telepon']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['alamat']; ?></td>
                                    <td><?php 
                                        if($row['status']==1){
                                            echo "Admin"; 
                                        }
                                        else if($row['status']==2){
                                            echo "Kepala"; 
                                        }else if($row['status']==3){
                                            echo "Staff"; 
                                        }else{
                                            echo "Non-Aktif"; 
                                        }
                                    
                                    ?></td>
                                    <td>
                                        <a href="edit_user.php?id=<?php echo $row['id']; ?>">UBAH</a>
                                        <a href="hapus_user.php?id=<?php echo $row['id']; ?>">NON-AKTIF</a>
                                    </td>
                                </tr>
                               <?php
                            } 
                            ?>
                        </table>
                </div>
            </div>

                <div class="col-6">
                    <div class="container">

                        <div class="h1">Tambah User</div>
                        <form method="POST">
                            <input name="nama" type="text" class="form-control mb-1" placeholder="Nama">
                            <input name="username" type="text" class="form-control mb-1" placeholder="Username">
                            <input name="password" type="password" class="form-control mb-1" placeholder="Password">
                            <input name="email" type="text" class="form-control mb-1" placeholder="Email">
                            <input name="telepon" type="text" class="form-control mb-1" placeholder="Telepon">
                            <input name="alamat" type="text" class="form-control mb-1" placeholder="Alamat">
                            <select name="status" class="form-select mb-1">
                                <option value="1">Admin</option>
                                <option value="2">Kepala Toko</option>
                                <option value="3">Staff</option>
                            </select>

                            <button type="submit" class="btn btn-primary mb-1" name="tambah">Tambah</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SixTeen</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>