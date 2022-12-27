<?php
require 'functionsReserv.php';
$reservations = getAllReserv();

session_start();
if(isset($_POST["delete"])) {
    if(delete($_POST["idReservasi"]) > 0) {
        echo "
            <script>
                alert('data berhasil dihapus');
                document.location.href='antrian.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href='antrian.php';
            </script>";
        echo "<br>";
        echo mysqli_error($conn);
    }
}

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
        <link rel="stylesheet" href="styleAntrian.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/9760b73ae6.js" crossorigin="anonymous"></script>
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
    <table class="table">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">No.Hp</th>
      <th scope="col">Paket</th>
      <th scope="col">Tanggal</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
        <?php
        $i = 1;
        foreach($reservations as $reservation) :
        ?>
  
  
    <tr>
      <th scope="row"><?php echo $i ?></th>
      <td><?php echo $reservation["nama"]?></td>
      <td><?php echo $reservation["alamat"]?></td>
      <td><?php echo $reservation["noHp"]?></td>
      <td><?php echo $reservation["namaPaket"]?></td>
      <td><?php echo $reservation["tanggal"]?></td>
      <td>
        <?php
        $idUser = isset($_SESSION["id"]) ? $_SESSION["id"] : "" ;
        $level = isset($_SESSION["level"]) ? $_SESSION["level"] : "" ;
        if ($idUser == $reservation["id"] || $level == "0") {
        ?>
      <form action="" method="post">
        <input type="hidden" name="idReservasi" value="<?= $reservation["idReserv"]; ?>">
        <button type="submit" name="delete" class="btn btn-outline-danger"><i class="fa-solid fa-scissors me-2"></i><b>CANCEL</b></button>
      </form>
      <?php } ?>
      </td>
    </tr>
    <?php 
    $i++;
    endforeach; ?>
  </tbody>
</table><br>
<a href="reservasi.php" class="btn btn-outline-dark"><b>Kembali</b></a>
</div>
    </body>
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
</html>