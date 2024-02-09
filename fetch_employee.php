<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['username'])) {
    $username = $_GET['username'];

    $query = "SELECT * FROM Employee WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employeeDetails = $result->fetch_assoc();
        echo json_encode($employeeDetails);
    } else {
        echo json_encode(array('error' => 'Employee not found'));
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'Invalid request'));
}

$conn->close();
?>
