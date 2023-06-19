<?php
$host = 'localhost:3307';
$db   = 'winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
    $pdo = new PDO($dsn, $user, $pass, $options);
} 
catch (\PDOException $e) 
{
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
$stmt = $pdo->query("SELECT * FROM producten");

while ($row = $stmt->fetch()) {
    echo "product_naam ". " : ".  $row['product_naam']."<br>";
    echo "prijs_per_stuk". ' : ' . $row['prijs_per_stuk']."<br>";
    echo "omschrijving" . " : " . $row['omschrijving']."<br>";
}

if (isset($_GET['product_code'])) {

 $product_code = $_GET['product_code'];
 $sql = "DELETE FROM producten WHERE product_code = :product_code";
 $stmt = $pdo->prepare($sql);

    $stmt->execute(['product_code' => $product_code]);

if ($stmt->rowCount() > 0) {
    echo "Het product is verwijderd";
} else {

echo "Het product is niet verwijderd";
    }
}

$sql = "DELETE FROM producten WHERE product_code = :product_code";

?>

<a href="delete.php?product_code=2">Verwijder product 2</a>
    
