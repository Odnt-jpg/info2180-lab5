 <?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country'])) {
  $country = $_GET['country'];

  $stmt = $conn->prepare("SELECT * FROM countries WHERE name = :country");
  $stmt->bindParam(':country', $country, PDO::PARAM_STR);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
      echo "<h1>{$result['name']}</h1>";
      echo "<p>Ruled by: {$result['head_of_state']}</p>";
  } else {
      echo "<p>Country not found</p>";
  }
} else {
  echo "<p>No country specified</p>";
}

