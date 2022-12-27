<?php
require 'functionsReserv.php';
session_start();
if(isset($_GET['submit'])) {
  if(isset($_SESSION['login'])) {
      add($_GET);
    } else {
      echo "<script>
                alert('Anda harus login terlebih dahulu!');
            </script>";
    }
  };
$paket = getPaket();

require 'functions.php';
if(isset($_POST['login'])) {
  echo "Login Berhasil";
    login($_POST);
  };

if(isset($_POST['logout'])) {
  logout();
}

if (isset($_POST['signUp'])) {
  tambah($_POST);
  header("Location: reservasi.php");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="styleReservasi.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand fs-3" href="#"><b>AֆCE Barbershop</b></a>
        <div class="ml-auto d-flex" id="auth">
        </div>
      </div>
    </nav>
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form method="post" action="">
            <div class="mb-3">
              <label for="inputUsername" class="form-label"><b>Username</b></label>
              <input type="username" name="Username" class="form-control" id="einputUsername">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label"><b>Password</b></label>
              <input type="password" name="Password" class="form-control" id="inputPassword">
            </div>
          </div>
          <div class="modal-footer">
          <button type="submit" name="login" class="btn btn-outline-dark"><b>Submit</b></button>
          </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="signUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form method="post" action="">
            <div class="mb-3">
              <label for="inputUsername" class="form-label"><b>Username</b></label>
              <input type="username" name="Username" class="form-control" id="einputUsername">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label"><b>Password</b></label>
              <input type="password" name="Password" class="form-control" id="inputPassword">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="signUp" class="btn btn-outline-dark"><b>Submit</b></button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <div class="c-container">
      <form class="row g-3">
        <h1>Reservasi</h1>
        <div class="col-12">
          <label for="inputNama" class="form-label"><h5 class="m-0">Nama</h5></label>
          <input type="text" name="nama" class="form-control" id="inputNama">
        </div>
        <div class="col-12">
          <label for="inputAlamat" class="form-label"><h5 class="m-0">Alamat</h5></label>
          <input type="text" name="alamat" class="form-control" id="inputAlamat">
        </div>
        <div class="col-md-6">
          <label for="inputNoHp" class="form-label"><h5 class="m-0">No.Handphone</h5></label>
          <input type="text" name="nohp" class="form-control" id="inputNohp">
        </div>
        <div class="col-md-4">
          <label for="inputPaket" class="form-label"><h5 class="m-0">Paket</h5></label>
          <select id="inputPaket" name="idPaket" class="form-select">
          <option value="" selected></option>
            <?php
            foreach($paket as $p) :
            ?>
            <option value="<?=$p['idPaket']?>"><?=$p['namaPaket']?></option>
            <?php
            endforeach;
            ?>
            </select>
          </div>
          <div class="col-md-2">
            <label for="inputTanggal" class="form-label"><h5 class="m-0">Tanggal</h5></label>
            <input type="text" name="tanggal" class="form-control" id="inputTanggal" placeholder="yyyy-mm-dd">
          </div>
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-outline-dark"><b>Submit</b></button>
            <a href="antrian.php" class="btn btn-outline-dark"><b>Antrian</b></a>
            <a href="index.html" class="btn btn-outline-dark"><b>Kembali</b></a>
          </div>
        </form>
        </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
      <script>
      let login = <?php echo isset($_SESSION["login"]) ? "true" : "false" ?>;
      let username = "<?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "" ?>";

      if(login){
        $("#auth").append(`
        <div class="dropdown pt-3">
          <p class="fw-bold text-light" data-bs-toggle="dropdown" aria-expanded="false">Hello, ${username}</p>
          <div class="dropdown-menu rounded-0">
            <form action="" method="post">
              <button type="submit" name="logout" class="text-center fw-bold rounded-0 dropdown-item text-danger">Logout</button>
            </form>
          </div>
        </div>
        `);
      }else{
        $("#auth").append(`
          <a href="#" class="btn btn-outline-light btn-sm fw-bold me-3 rounded-0" data-bs-toggle="modal" data-bs-target="#login">Login</a>
          <a href="#" class="btn btn-light btn-sm fw-bold rounded-0" data-bs-toggle="modal" data-bs-target="#signUp">Sign Up</a>
        `);
      }
    </script>
    </body>
</html>