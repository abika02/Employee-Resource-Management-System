<?php
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
$id = $_POST['employee_id'];
$ug = $_POST['ug'];
$pg = $_POST['pg'];

// Update data in the 'employee' table where 'id' matches the provided 'id'
$sql = "UPDATE employee SET UG = ?, PG = ? WHERE ID = ?";

// Prepare the SQL statement
$stmt = $mysqli->prepare($sql);

// Bind the parameters with the correct order of data types
$stmt->bind_param('sss', $ug, $pg, $id);

// Execute the SQL statement
if ($stmt->execute()) {
    // Data update successful
    header("Location: index.html"); // Redirect to a success page
} else {
    // Data update failed
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$mysqli->close();
?>

