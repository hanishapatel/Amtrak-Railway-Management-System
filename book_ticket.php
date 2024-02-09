<?php

// Include your connection file
include('connection.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract form data

    
    $passengerUsername = $_POST['passengerUsername'];
    $trainName = $_POST['selectedTrainName'];
    $departureStation = $_POST['selectedStartStation'];
    $arrivalStation = $_POST['selectedEndStation'];
    $departureDate = $_POST['selectedDepartureDate'];
    $arrivalDate = $_POST['selectedArrivalDate'];
    $ticketType = $_POST['selectedTicketType'];
    $price = $_POST['selectedPrice'];

    $passengerIdQuery = "SELECT passenger_id FROM Passenger WHERE username = '$passengerUsername'";
    $passengerIdResult = mysqli_query($conn, $passengerIdQuery);

    if ($passengerIdResult) {
        $passengerIdRow = mysqli_fetch_assoc($passengerIdResult);
        $passengerId = $passengerIdRow['passenger_id'];

        $trainIdQuery = "SELECT train_id FROM Train WHERE train_name = '$trainName'";
        $trainIdResult = mysqli_query($conn, $trainIdQuery);

        if ($trainIdResult) {
            $trainIdRow = mysqli_fetch_assoc($trainIdResult);
            $trainId = $trainIdRow['train_id'];

            $ticketInsertQuery = "INSERT INTO Ticket (passenger_id, train_id, departure_station, arrival_station, departure_date, arrival_date, ticket_type, price)
                                  VALUES ('$passengerId', '$trainId', '$departureStation', '$arrivalStation', '$departureDate', '$arrivalDate', '$ticketType', '$price')";

            if (mysqli_query($conn, $ticketInsertQuery)) {
                $ticketId = mysqli_insert_id($conn); 

                $seatNumber = $_POST['selectedSeatNumber']; 
                $specialRequests = $_POST['selectedSpecialRequest']; 

                $reservationInsertQuery = "INSERT INTO Reservation (ticket_id, passenger_id, seat_number, special_requests)
                                          VALUES ('$ticketId', '$passengerId', '$seatNumber', '$specialRequests')";

                if (mysqli_query($conn, $reservationInsertQuery)) {
                    updateTrainCapacity($trainId);
                    echo "<script>alert('Reservation and Ticket inserted successfully!');</script>";
                } else {
                    echo "Error inserting into Reservation table: " . mysqli_error($conn);
                }

            } else {
                echo "Error inserting into Ticket table: " . mysqli_error($conn);
            }
        } else {
            echo "Error fetching train_id: " . mysqli_error($conn);
        }
    } else {
        echo "Error fetching passenger_id: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

function updateTrainCapacity($trainId) {
    global $conn;
    
    $updateCapacityQuery = "UPDATE Train SET capacity = capacity - 1 WHERE train_id = '$trainId'";

    if (!mysqli_query($conn, $updateCapacityQuery)) {
        echo "Error updating train capacity: " . mysqli_error($conn);
    }
}

?>