<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$servername = "feenix-mariadb.swin.edu.au";
$username = "s104000826";
$password = "Megatron101!";
$dbname = "s104000826_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// Fetch transactions
$sql = "SELECT * FROM transactions ORDER BY transaction_date DESC LIMIT 10";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    exit();
}

$transactions = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
}

echo json_encode($transactions);

$conn->close();
?>
