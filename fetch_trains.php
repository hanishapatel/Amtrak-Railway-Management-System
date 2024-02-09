<?php
include('connection.php');

$startStationName = $_POST['startStation'];
$endStationName = $_POST['endStation'];

$query = "SELECT t.train_name, t.capacity,t.status, s.departure_time, s.arrival_time, s.day_of_week
          FROM Train t
          JOIN Schedule s ON t.train_id = s.train_id
          JOIN Route r ON s.route_id = r.route_id
          WHERE r.origin_station = ? AND r.destination_station = ?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt, 'ss', $startStationName, $endStationName);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$availableTrains = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_stmt_close($stmt);

mysqli_close($conn);

header('Content-Type: application/json');

echo json_encode($availableTrains);
?>
