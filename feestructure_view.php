<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>

    img{
        cursor: pointer;
    }

    img:hover{
        box-shadow: 5px 5px 5px grey;
    }
</style>
<body>
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

// Select data from feestructure table
$sql = "SELECT * FROM feestructure_add";
$result = $conn->query($sql);

// Start HTML output
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>View Fee Structure</title>";
echo "<style>";
echo "@import url('https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&display=swap');";
echo "table {";
echo "  font-family: 'Afacad', sans-serif;";
echo "  border-collapse: collapse;";
echo "  width: 100%;";
echo "  border-radius: 20px;";
echo "}";
echo "table, th, td {";
echo "  border: 1px solid black;";
echo "  border-radius: 20px;";
echo "}";
echo "h1{";
echo "font-family: 'Afacad', sans-serif;";
echo "background-color: lightblue;";
echo "  border-radius: 20px;";
echo "  height:50px";
echo "}";
echo "th, td {";
echo "  padding: 5px;";
echo "  border-radius: 20px;";
echo "}";
echo "button{";
echo "width: 120px;";
echo "height: 35px;";
echo "margin-left: 1300px;";
echo "margin-top: 20px;";
echo "background-color: salmon;";
echo "border-radius: 10px;";
echo "color: black;";
echo "font-family: 'Afacad', sans-serif;";
echo "cursor: pointer;";
echo "font-size: smaller;";
echo "border-color: white;";
echo "}";
  
echo  "button:hover{";
    echo "background-color: red;";
    echo "color: white;";
    echo  "}";
echo "</style>";
echo "</head>";
echo "<body>";

// Display table header
echo "<h1>Fee Structure</h1>";
echo "<br>";
echo "<a href = 'index.html'><button type= 'button'> + Add Fee Structure</button></a>";
echo "<br>";
echo "<br>";

echo "<table>";
echo "<tr><th>S no.</th><th>Title</th><th>Academic Session</th><th>Class Section</th><th>Date Added</th><th>Last Modified</th><th>View</th><th>Assign</th></tr>";

// Display data row by row
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['sno']."</td>";
        echo "<td>".$row['fee_header']."</td>";
        echo "<td>".$row['academic_session']."</td>";
        echo "<td>".$row['select_class_section']."</td>";
        echo "<td>".$row['date_added']."</td>";
        echo "<td>".$row['last_modified']."</td>";
        echo "<td><a href='view_row.php?sno=".$row['sno']."'><img src = 'view.png'></a></td>";
        echo "<td><a href='assign_row.php?sno=".$row['sno']."'><img src = 'assign.png'></a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>No data found</td></tr>";
}

// Close connection
$conn->close();

// Close table and body
echo "</table>";
echo "</body>";
echo "</html>";
?>

    
</body>
</html>