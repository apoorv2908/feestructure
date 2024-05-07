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

// Retrieve assigned colleagues and sno from POST data
$colleagues = $_POST['colleagues'] ?? [];
$sno = $_POST['sno'] ?? '';

// Update database with assigned colleagues
$sql = "UPDATE feestructure_add SET assigned_colleagues = ? WHERE sno = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $assigned_colleagues, $sno);

// Check if assigned colleagues are not empty
if (!empty($colleagues)) {
    // Retrieve any previously assigned colleagues
    $sql_select = "SELECT assigned_colleagues FROM feestructure_add WHERE sno = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("s", $sno);
    $stmt_select->execute();
    $stmt_select->bind_result($assigned_colleagues);
    $stmt_select->fetch();
    $stmt_select->close(); // Close the statement explicitly

    // Concatenate assigned colleagues with any previously assigned colleagues
    $assigned_colleagues_array = explode(',', $assigned_colleagues);
    $new_assigned_colleagues = array_unique(array_merge($assigned_colleagues_array, $colleagues));
    $assigned_colleagues = implode(',', $new_assigned_colleagues);

    // Save updated assigned colleagues to the database
    $stmt->execute();
}

// Close statement and connection
$stmt->close();
$conn->close();

// Redirect back to view_row.php with sno parameter
header("Location: feestructure_view.php");
exit();
?>
