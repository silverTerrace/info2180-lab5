<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Access the "country" variable from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';

// Use the value of "country" in your PHP code
//echo nl2br('country from GET request: ' . $country."\n");

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
error_log("Received quer");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the object as JSON
//header('Content-Type: application/json');
//echo "This is the result \n";

//$results = array('message' => 'Data from PHP','messae' => 'Dat from PHP');

//echo "TYPE OF DATA: ".gettype($results)."YES\n";

echo json_encode($results);
/*
?>

<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
*/