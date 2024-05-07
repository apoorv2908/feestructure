<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Assign Colleagues</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&display=swap');
    body {
        font-family: "Afacad", sans-serif;
    }
    button{
  width: 70px;
  height: 35px;
  margin-left: 1355px;
  margin-top: 20px;
  background-color: salmon;
  border-radius: 10px;
  color: black;
  font-family: "Afacad", sans-serif;
  cursor: pointer;
  font-size: smaller;
  border-color: white;
}

button:hover{
  background-color: red;
  color: white;
}

h2{
    background-color: lightblue;
    border-radius: 10px;
}

del{
    color:red;
}

</style>
</head>
<body>

<h2>Assign Students</h2>

<form id="assignForm" action="save_assign.php" method="post">
<?php
$servername = "localhost";
$username = "mylogin123";
$password = "localhost";
$database = "assignment01";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sno = $_GET['sno'] ?? '';

$sql_select = "SELECT assigned_colleagues FROM feestructure_add WHERE sno = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("s", $sno);
$stmt_select->execute();
$stmt_select->bind_result($assigned_colleagues);
$stmt_select->fetch();
$stmt_select->close(); // Close the statement

$names = array("Rahul", "Arvind", "Narendra", "Manohar", "Mamta", "Rajnath", "Akhilesh", "Adityanath", "Sachin", "Dimple", "Kamalnath", "Mukhtar", "Sheela", "Ateeq", "Menka", "Jaiprakash", "BrijBhushan", "Raja Bhaiyya");

foreach ($names as $name) {
    if (strpos($assigned_colleagues, $name) !== false) {
        echo "<input type='checkbox' name='colleagues[]' value='$name' disabled checked> <del>$name</del><br>";
    } else {
        echo "<input type='checkbox' name='colleagues[]' value='$name'> $name<br>";
    }
}
?>
<input type="hidden" name="sno" value="<?php echo $sno; ?>">
<button type="submit">Save</button>
</form>

</body>
</html>
