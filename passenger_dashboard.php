<?php
session_start();

if (!isset($_SESSION['userType']) || !isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$userType = $_SESSION['userType'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>

    <title>Railway System Passenger Dashboard</title>
</head>
<body>
    <header>
        <h1>Passenger Dashboard</h1>
    </header>
    <div class="welcome-container">
        <div class="welcome-content">
            <p class="welcome-text">Welcome, <?php echo $_SESSION['username']; ?> (Passenger)</p>
            <button class="logout-button" onclick="location.href='logout.php'">Logout</button>
        </div>
    </div>

    
    <nav class="dashboard-nav">
        <ul class="dashboard-nav-list">
            <li class="nav-item"><a href="passenger_dashboard.php" class="nav-link">Book Ticket</a></li>
            <li class="nav-item"><a href="current_reservation.php" class="nav-link">Previous Reservation</a></li>
            <li class="nav-item"><a href="edit_passengers.php" class="nav-link">Edit Passenger</a></li>
        </ul>
    </nav>

    <section class="content-section">
        <h2>Book Ticket</h2>
        <form id="searchForm">
        <label for="startStation">Departure Station:</label>
        <select id="startStation" name="startStation" required>
            <option value="" disabled selected>Select Station</option>
        </select>

        <label for="endStation">Arrival Station:</label>
        <select id="endStation" name="endStation" required>
            <option value="" disabled selected>Select Station</option>
        </select>


            <button type="submit">Search Trains</button>
        </form>
         <table id="searchResults">
            <thead>
                <tr>    
                    <th>Train Name</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Day of Week</th>
                </tr>
            </thead>
            <tbody id="searchResultsBody"></tbody>
        </table>
    </section>

    <section class="content-section" id="selectedTrainSection" style="display: none;">
        <h2>Selected Train Details</h2>
        <form id="selectedTrainForm" action="book_ticket.php" method="POST">

        <input type = "hidden" id="passengerUsername" name="passengerUsername" value="<?php echo $username; ?>">
        <input type = "hidden" id="selectedStartStation" name="selectedStartStation" value="">
    <input type = "hidden" id="selectedEndStation" name="selectedEndStation" value="">

            <label for="selectedTrainName">Train Name:</label>
            <input type="text" id="selectedTrainName" name="selectedTrainName" readonly>

            <label for="selectedTrainCapacity">Train Capacity:</label>
            <input type="text" id="selectedTrainCapacity" name="selectedTrainCapacity" readonly>

            <label for="selectedTrainStatus">Train Status:</label>
            <input type="text" id="selectedTrainStatus" name="selectedTrainStatus" readonly>

            <label for="selectedDepartureTime">Departure Time:</label>
            <input type="text" id="selectedDepartureTime" name="selectedDepartureTime" readonly>

            <label for="selectedArrivalTime">Arrival Time:</label>
            <input type="text" id="selectedArrivalTime" name="selectedArrivalTime" readonly>

            <label for="selectedDayOfWeek">Day of Week:</label>
            <input type="text" id="selectedDayOfWeek" name="selectedDayOfWeek" readonly>

            <label for="selectedSeatNumber">Seat Number:</label>
            <input type="text" id="selectedSeatNumber" name="selectedSeatNumber" readonly>

            <label for="selectedSpecialRequest">Special Request:</label>
            <select id="selectedSpecialRequest" name="selectedSpecialRequest">
                <option value="none">None</option>
                <option value="vegetarian">Vegetarian Meal</option>
                <option value="non-vegetarian">Non-Vegetarian Meal</option>
                <option value="extra-legroom">Extra Legroom</option>
                <option value="extra">Wheelchair Accessibility</option>
                <option value="extra">Medical Assistance</option>
                <option value="extra">Pet Accommodation</option>
            </select>

            <label for="selectedDepartureDate">Departure Date:</label>
            <input type="text" id="selectedDepartureDate" name="selectedDepartureDate" >

            <label for="selectedArrivalDate">Arrival Date:</label>
            <input type="text" id="selectedArrivalDate" name="selectedArrivalDate" readonly>

            <label for="selectedTicketType">Ticket Type:</label>
            <select id="selectedTicketType" name="selectedTicketType" onchange="updatePrice()">
                <option value="standard">Standard</option>
                <option value="economy">Economy</option>
                <option value="business">Business Class</option>
                <option value="first">First Class</option>
            </select>

            <label for="selectedPrice">Price:</label>
            <input type="text" id="selectedPrice" name="selectedPrice" readonly>

            <button type="submit">Book Ticket</button>
            

        </form>
    </section>

    <footer class="dashboard-footer">
        <p class="footer-text">&copy; Amtrak Railway System</p>
    </footer>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
        var startDropdown = document.getElementById('startStation');
        var endDropdown = document.getElementById('endStation');
        var searchForm = document.getElementById('searchForm');
        var searchResultsTable = document.getElementById('searchResultsBody');
        var selectedTrainData;

        var xhrStations = new XMLHttpRequest();
        xhrStations.onreadystatechange = function () {
            if (xhrStations.readyState === 4 && xhrStations.status === 200) {
                startDropdown.innerHTML = xhrStations.responseText;
                endDropdown.innerHTML = xhrStations.responseText;
            }
        };

        xhrStations.open('GET', 'fetch_stations.php', true);
        xhrStations.send();

        searchForm.addEventListener('submit', function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            var xhrTrains = new XMLHttpRequest();
            xhrTrains.open('POST', 'fetch_trains.php', true);
            xhrTrains.onreadystatechange = function () {
                if (xhrTrains.readyState === 4) {
                    if (xhrTrains.status === 200) {
                        var availableTrains = JSON.parse(xhrTrains.responseText);
                        displaySearchResults(availableTrains);
                    selectedTrainForm.selectedStartStation.value = startDropdown.value;
                    selectedTrainForm.selectedEndStation.value = endDropdown.value;
                    } else {
                        console.error('Error fetching trains. Status:', xhrTrains.status);
                    }
                }
            };
            xhrTrains.send(formData);
        });

        function displaySearchResults(trains) {
            searchResultsTable.innerHTML = '';


            if (trains.length === 0) {
                var emptyRow = document.createElement('tr');
                var emptyCell = document.createElement('td');
                emptyCell.textContent = 'No trains found.';
                emptyCell.colSpan = 5;
                emptyRow.appendChild(emptyCell);
                searchResultsTable.appendChild(emptyRow);
            } else {
                trains.forEach(function (train) {
                    var row = document.createElement('tr');
                    ['train_name', 'departure_time', 'arrival_time', 'day_of_week'].forEach(function (key) {
                        var cell = document.createElement('td');
                        cell.textContent = train[key];
                        row.appendChild(cell);
                    });

                    row.children[0].addEventListener('click', function () {
                        selectedTrainSection.style.display = 'block';
                        selectedTrainData = train;
                        selectedTrainForm.selectedTrainName.value = train.train_name;
                        selectedTrainForm.selectedTrainCapacity.value = train.capacity;
                        selectedTrainForm.selectedTrainStatus.value = train.status;
                        selectedTrainForm.selectedDepartureTime.value = train.departure_time;
                        selectedTrainForm.selectedArrivalTime.value = train.arrival_time;
                        selectedTrainForm.selectedDayOfWeek.value = train.day_of_week;
                        selectedTrainForm.selectedSeatNumber.value = generateSeatNumber(train.capacity,train);
                        
                        
                    });

                    searchResultsTable.appendChild(row);
                });
            }
        }


        var selectedDayOfWeekInput = document.getElementById('selectedDayOfWeek');
        var selectedDepartureDateInput = document.getElementById('selectedDepartureDate');
        var selectedArrivalDateInput = document.getElementById('selectedArrivalDate');

        var pikadayDeparture = new Pikaday({
            field: selectedDepartureDateInput,
            format: 'YYYY-MM-DD',
            minDate: moment().toDate(), 
            disableDayFn: function (date) {
                var selectedDayOfWeek = selectedDayOfWeekInput.value.toLowerCase();
                return date.getDay() !== getDayIndex(selectedDayOfWeek);
            },
            onSelect: function () {
                var departureDate = moment(selectedDepartureDateInput.value, 'YYYY-MM-DD');
                var arrivalDate = departureDate.clone().add(1, 'days');
                selectedArrivalDateInput.value = arrivalDate.format('YYYY-MM-DD');
            }
        });

        function getDayIndex(day) {
            var days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
            return days.indexOf(day.toLowerCase());
        }
    });

    function generateSeatNumber(capacity,train) {
       return 'A(' + (250 - capacity) + ')';
    }

    function updatePrice() {
        var selectedTicketType = document.getElementById('selectedTicketType').value;
        var price;

        switch (selectedTicketType) {
            case 'standard':
                price = 25;
                break;
            case 'economy':
                price = 30;
                break;
            case 'business':
                price = 40;
                break;
            case 'first':
                price = 50;
                break;
            default:
                price = 0;
        }

        document.getElementById('selectedPrice').value = price;
    }   
    
    function bookTicket() {
        alert('Ticket booked successfully!'); 
    }

</script>


</body>
</html>
