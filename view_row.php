<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Assign Colleagues</title>
<!-- Import Google Fonts -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&display=swap');
    body {
        font-family: "Afacad", sans-serif;
    }

    strong{
        font-size: 20px;

    }
    p{
        margin-left: 20px;
    }
    h2{
    background-color: lightblue;
    border-radius: 10px;
}
</style>
</head>
<body>

<h2>Header Details</h2>

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

// Check if sno parameter is set in the URL
if(isset($_GET['sno'])) {
    $sno = $_GET['sno'];

    // Retrieve data for the given sno
    $sql = "SELECT * FROM feestructure_add WHERE sno = $sno";
    $result = $conn->query($sql);


    // Display data if row exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p><strong>Fee Header:</strong> ".$row['fee_header']."</p>";
        echo "<p><strong>Academic Session:</strong> ".$row['academic_session']."</p>";
        echo "<p><strong>Selected Wing:</strong> ".$row['select_wings']."</p>";
        echo "<p><strong>Class Section:</strong> ".$row['select_class_section']."</p>";
        echo "<p><strong>Month:</strong> ".$row['month']."</p>";
        echo "<p><strong>Main Header:</strong> ".$row['main_header']."</p>";
        echo "<p><strong>Sub Header:</strong> ".$row['sub_header']."</p>";
        echo "<p><strong>Type:</strong> ".$row['type']."</p>";
        echo "<p><strong>Amount:</strong> ".$row['amount']."</p>";
        echo "<p><strong>Date Added:</strong> ".$row['date_added']."</p>";

    } else {
        echo "<p>No data found for sno: $sno</p>";
    }
} else {
    echo "<p>No sno parameter provided in the URL</p>";
}

// Close connection
$conn->close();
?>

</body>
