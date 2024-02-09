
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Railway System Passenger Dashboard</title>
</head>
<body>
<header>
    <h1 class="header-title">Passenger Dashboard</h1>
    </header>


    <section class="content-section">
        <h2>Add New Passenger</h2>

        <form action="add_passenger.php" method="post">
            <label for="passengerName">Passenger Name:</label>
            <input type="text" id="passengerName" name="passengerName" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" required>

            <label for="role">Create Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="role">Create Password:</label>
            <input type="text" id="password" name="password" required>

            <button type="submit">Add Passenger</button>
            <button type="button" onclick="window.location.href='index.html'" class="form-button" style="margin-top: 10px;">Already a User</button>
        </form>
            
    </section>

    <footer class="dashboard-footer">
        <p class="footer-text">&copy; Amtrak Railway System</p>
    </footer>
</body>
</html>
