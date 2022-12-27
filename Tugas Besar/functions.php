<?php
// membuat koneksi
$conn=mysqli_connect("localhost","root","","barber");

// cek koneksi jika error
if (!$conn) {
    die('Koneksi Error : '.mysqli_connect_errno().
    ' - '.mysqli_connect_error());
}

// ambil data dari tabel mahasiswa / query data mahasiswa
$result=mysqli_query($conn,"SELECT * FROM user");

// function query menerima isi parameter dari string query yang ada di index2.php
function query($query_kedua){
    // dikarenakan $connn diluar function query maka dibutuhkan scope global $conn
    global $conn;
    $result=mysqli_query($conn,$query_kedua);

    // wadah kosong untuk menampung isi array pada saat looping
    $rows=[];
    while ($row=mysqli_fetch_assoc($result)) {
        $rows[]=$row;
    }
    return $rows;
}

function getAll()
{
    global $conn;

    $query = "SELECT * FROM user";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function getById($id)
{
    global $conn;

    $query = "SELECT * FROM user";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function create ($data) {
    global $conn; 

    $username = htmlspecialchars($data["Username"]);
    $password = htmlspecialchars($data["Password"]);

    $query = "INSERT INTO mahasiswa
                VALUES
                ('','$username','$password')";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

// function delete ($id) {
//     global $conn;
//     mysqli_query($conn,"DELETE FROM user WHERE id=$id");
//     return mysqli_affected_rows($conn);
// }

function update ($data) {
    global $conn; 

    $username = htmlspecialchars($data["Username"]);
    $password = htmlspecialchars($data["Password"]);

    $query = "UPDATE user SET
                Username = '$username',
                Password = '$password'
                WHERE id = $id";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

// function tambah
function tambah($data)
{
    global $conn;

    $username = htmlspecialchars($data["Username"]);
    $password = htmlspecialchars($data["Password"]);

    $query = "INSERT INTO user
                VALUES
                ('','$username','$password','1')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function login($data) {
    global $conn;
    session_start();
    echo "test";

    $username = $data["Username"];
    $password = $data["Password"];

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if($row) {
        $_SESSION["login"] = true;
        $_SESSION["username"] = $row["username"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["id"] = $row["id"];
        
        $_SESSION["level"] = $row["level"];
        header("Location: reservasi.php");
    } else {
        echo "<script>
                alert('Username atau Password salah!');
                document.location.href='login.php';
            </script>";
    }
}

function logout() {
    session_start();
    session_destroy();
    header("Location: reservasi.php");
}

?>