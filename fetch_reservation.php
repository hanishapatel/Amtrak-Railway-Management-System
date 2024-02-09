<?php
include('connection.php');

session_start();

if (!isset($_SESSION['userType']) || !isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];

$query = "SELECT t.*, r.* FROM Ticket t
          JOIN Reservation r ON t.ticket_id = r.ticket_id
          WHERE t.passenger_id = (SELECT passenger_id FROM Passenger WHERE username = '$username')";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
$reservations = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($reservations);
?>
