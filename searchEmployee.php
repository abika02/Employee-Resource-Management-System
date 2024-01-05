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

if (isset($_POST['search_employee_id'])) {
    $search_employee_id = $_POST['search_employee_id'];

    // Query the database to fetch employee data by Employee ID
    $sql = "SELECT e.*, ed.UG, ed.PG
            FROM employee e
            LEFT JOIN employee ed ON e.ID = ed.ID
            WHERE e.ID = ?";
    
    // Prepare the SQL statement
    $stmt = $mysqli->prepare($sql);

    // Bind the parameter
    $stmt->bind_param('s', $search_employee_id);

    // Execute the SQL statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Display the employee data
        $row = $result->fetch_assoc();
        echo "<h1>Employee Details</h1>";
        echo "<p><strong>Employee ID:</strong> " . $row['ID'] . "</p>";
        echo "<p><strong>Name:</strong> " . $row['NAME'] . "</p>";
        echo "<p><strong>Designation:</strong> " . $row['DESIGNATION'] . "</p>";
        echo "<p><strong>Date of Birth:</strong> " . $row['DOB'] . "</p>";
        echo "<p><strong>Address:</strong> " . $row['ADDRESS'] . "</p>";
        echo "<p><strong>Mobile Number:</strong> " . $row['MOBILE'] . "</p>";
        echo "<p><strong>UG:</strong> " . $row['UG'] . "</p>";
        echo "<p><strong>PG:</strong> " . $row['PG'] . "</p>";
    } else {
        echo "Employee not found.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Please enter an Employee ID to search.";
}

// Close the database connection
$mysqli->close();
?>
