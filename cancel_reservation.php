<?php

include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticketId = $_POST['ticketId'];

    $deleteReservationQuery = "DELETE FROM Reservation WHERE ticket_id = $ticketId";

    if (mysqli_query($conn, $deleteReservationQuery)) {
        $deleteTicketQuery = "DELETE FROM Ticket WHERE ticket_id = $ticketId";

        if (mysqli_query($conn, $deleteTicketQuery)) {
            echo "Reservation and Ticket canceled successfully!";
        } else {
            echo "Error canceling reservation: " . mysqli_error($conn);
        }
    } else {
        echo "Error canceling reservation: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Invalid request method!";
}

?>
