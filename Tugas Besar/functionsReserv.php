<?php
// membuat koneksi
$conn=mysqli_connect("localhost","root","","barber");

// cek koneksi jika error
if (!$conn) {
    die('Koneksi Error : '.mysqli_connect_errno().
    ' - '.mysqli_connect_error());
}

// ambil data dari tabel mahasiswa / query data mahasiswa
$result=mysqli_query($conn,"SELECT r.* , u.username, p.namaPaket FROM reservasi r
                            LEFT JOIN user u ON r.id = u.id
                            LEFT JOIN paket p ON r.idPaket = p.idPaket");

function add($data) {
    global $conn;

    $id = $_SESSION["id"];
    $idPaket = htmlspecialchars($data["idPaket"]);
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $nohp = htmlspecialchars($data["nohp"]);
    $tanggal = htmlspecialchars($data["tanggal"]);

    $query = "INSERT INTO reservasi
                VALUES
                ('','$id','$idPaket','$nama','$alamat','$nohp','$tanggal')";
    mysqli_query($conn,$query);
    header("Location: antrian.php");
}

function delete($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM reservasi WHERE idReserv = $id");
    return mysqli_affected_rows($conn);
}

function getPaket() {
    global $conn;

    $query = "SELECT * FROM paket";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function getAllReserv()
{
    global $conn;

    $query = "SELECT r.* , u.username, p.namaPaket FROM reservasi r
    LEFT JOIN user u ON r.id = u.id
    LEFT JOIN paket p ON r.idPaket = p.idPaket";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}