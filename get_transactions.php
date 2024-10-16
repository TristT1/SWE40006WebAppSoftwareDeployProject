<?php
header('Content-Type: application/json');

$servername = "feenix-mariadb.swin.edu.au";
$username = "s104000826";
$password = "Megatron101!";
$dbname = "s104000826_db";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed"]);
    exit();
}

$sql = "SELECT * FROM transactions ORDER BY transaction_date DESC LIMIT 10";
$result = $conn->query($sql);

$transactions = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
}

echo json_encode($transactions);

$conn->close();
?>
