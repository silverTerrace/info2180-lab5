<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Access the "country" variable from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';
$cities = isset($_GET['lookup']) ? true : false;

$query_statement = null;

if($cities){
  $query_statement = "SELECT
  cities.name,
  cities.district,
  cities.population
  FROM cities
  JOIN countries
  ON cities.country_code = countries.code WHERE countries.name LIKE '%$country%'";
}
else{
  $query_statement = "SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE '%$country%'";
}

// Use the value of "country" in your PHP code
//echo nl2br('country from GET request: ' . $country."\n");

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query($query_statement);
error_log("Received query");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$worldTable = '$worldTable';

switch ($cities) {
  case true:
    $worldTable = '<table>
        <thead>
            <tr>
            <th>Name</th>
            <th>District</th>
            <th>Population</th>
            </tr>
        </thead>
        <tbody>';
    foreach ($results as $row)
    {
        $worldTable .=  '<tr><td>' . $row['name'] .'</td><td>'. $row['district'] . '</td><td>' . $row['population'] .'</td></tr>';
    }
    $worldTable .= '</tbody></table>';
    break;
  case false:
    $worldTable = '<table>
        <thead>
            <tr>
            <th>Name</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
            </tr>
        </thead>
        <tbody>';
    foreach ($results as $row)
    {
        $worldTable .=  '<tr><td>' . $row['name'] .'</td><td>'. $row['continent'] . '</td><td>' . $row['independence_year'] .'</td>
                                  <td>' . $row['head_of_state'] .'</td></tr>';
    }
    $worldTable .= '</tbody></table>';
    break;
  }



echo $worldTable;
/*
?>

<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
*/