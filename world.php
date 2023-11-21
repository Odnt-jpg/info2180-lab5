<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country'])) {
    $country = $_GET['country'];

    if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities'){
      $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities INNER JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country");
    } else{
      $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    }

    
    $stmt->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "<table >
        <tr>";

        if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
          echo "<th>City Name</th>
                <th>District</th>
                <th>Population</th>";
        }else{
          echo "<th>Country Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>";
      
        }
        echo "</tr>";


        foreach ($results as $row) {
          echo "<tr>";

          if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['district']}</td>";
            echo "<td>{$row['population']}</td>";
         
        } else {
            
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['continent']}</td>";
            echo "<td>{$row['independence_year']}</td>";
            echo "<td>{$row['head_of_state']}</td>";
            
        }
        echo "</tr>";

      } 

        

        echo "</table>";
    } else {
        echo "<p>No matching countries found</p>";
    }
  }

$conn = null;
?>
