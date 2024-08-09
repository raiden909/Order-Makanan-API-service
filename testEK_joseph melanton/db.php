<?php
$servername = "192.168.0.34";
$username = "root";
$password = "mis!2017";
$dbname = "ZKteco"; // ganti sesuai database yang sudah dibuat

// Open database connection
function OpenCon() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Close database connection
function CloseCon($conn) {
    $conn->close();
}
?>
