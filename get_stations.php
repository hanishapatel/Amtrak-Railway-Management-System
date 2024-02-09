<?php

include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['routeId'])) {
    $routeId = $_GET['routeId'];

    $query = "SELECT origin_station, destination_station FROM Route WHERE route_id = $routeId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            echo json_encode(array('startStation' => $row['origin_station'], 'endStation' => $row['destination_station']));
        } else {
 
            echo json_encode(array('error' => 'No data found'));
        }
    } else {
        echo json_encode(array('error' => mysqli_error($conn)));
    }

    mysqli_close($conn);
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'Invalid request'));
}
?>
