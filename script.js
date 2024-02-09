function login() {
    const userType = document.getElementById('userType').value;
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Simple validation, you would do server-side validation in a real scenario
    if (username && password) {
        // Use AJAX to send data to the server
        const xhr = new XMLHttpRequest();
        xhr.open('POST', ' login.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert("Login successful!");
                    // Redirect or perform additional actions based on user type
                } else {
                    alert("Login unsuccessful. " + response.message);
                }
            }
        };

        const data = `userType=${userType}&username=${username}&password=${password}`;
        xhr.send(data);
    } else {
        alert('Please enter both username and password.');
    }
}
