<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $namaLengkap = $_POST["namaLengkap"];
    $alamatEmail = $_POST["alamatEmail"];
    $subjek = $_POST["subjek"];
    $pesan = $_POST["pesan"];

    // Prepare the SQL statement
    $sql = "INSERT INTO contact (namaLengkap, alamatEmail, subjek, pesan) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("ssss", $namaLengkap, $alamatEmail, $subjek, $pesan);

    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error inserting data: " . $conn->error;
    }

    $stmt->close(); // Close the statement
}

$conn->close(); // Close the connection
?>