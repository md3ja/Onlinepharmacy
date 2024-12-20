<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharma_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM medicines WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Medicine deleted successfully!'); window.location.href='view_medicines.php';</script>";
    } else {
        echo "Error deleting medicine: " . $conn->error;
    }
}

$conn->close();
?>
