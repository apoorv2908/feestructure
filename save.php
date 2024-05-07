<?php
// Database connection parameters
$servername = "localhost";
$username = "mylogin123";
$password = "localhost";
$database = "assignment01";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO feestructure_add (fee_header, academic_session, select_wings, select_class_section, month, main_header, sub_header, type, amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("sssssssss", $feeHeader, $academicSession, $selectWings, $selectClassSection, $month, $mainHeader, $subHeader, $type, $amount);

// Get form data
$feeHeader = $_POST['feeHeader'];
$academicSession = $_POST['academicSession'];
$selectWings = $_POST['selectWings'];
$selectClassSection = $_POST['selectClassSection'];

// Iterate over dynamically added input sets
foreach ($_POST['month'] as $key => $value) {
    $month = $_POST['month'][$key];
    $mainHeader = $_POST['main_header'][$key];
    $subHeader = $_POST['sub_header'][$key];
    $type = $_POST['type'][$key];
    $amount = $_POST['amount'][$key];

    // Execute prepared statement
    $stmt->execute();
}

// Close statement and connection
$stmt->close();
$conn->close();

echo "Data saved successfully!";


header("Location: feestructure_view.php");
?>
