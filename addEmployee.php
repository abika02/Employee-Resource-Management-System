<?php
// Output a message to check if the script is executed
echo "helloooo";

// Uncomment these lines for error reporting (remove in a production environment)
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Replace with your database credentials
$hostname = 'localhost';
$username = '';
$password = '';
$database = '';  // Your database name

// Connect to the database
$mysqli = new mysqli($hostname, $username, $password, $database);

// Check for database connection errors
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Collect data from the form
$employee_id = $_POST['employee_id'] ?? '';
$employee_name = $_POST['employee_name'] ?? '';
$designation = $_POST['designation'] ?? '';
$dob = $_POST['dob'] ?? '';
$address = $_POST['address'] ?? '';
$mobile = $_POST['mobile_number'] ?? '';

// Insert data into the 'employee' table
$sql = "INSERT INTO employee (ID, NAME, DESIGNATION, DOB, ADDRESS, MOBILE)
        VALUES (?, ?, ?, ?, ?, ?)";

// Prepare the SQL statement
$stmt = $mysqli->prepare($sql);

// Check if the SQL query preparation was successful
if ($stmt === false) {
    die('Prepare failed: ' . $mysqli->error);
}

// Bind the parameters
$stmt->bind_param('ssssss', $employee_id, $employee_name, $designation, $dob, $address, $mobile);

// Execute the SQL statement
if ($stmt->execute()) {
    // Data insertion successful
    header("Location: addEducation.html?id=$employee_id"); // Redirect to the next page
    exit(); // Terminate the script to prevent further execution
} else {
    // Data insertion failed
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$mysqli->close();
?>
