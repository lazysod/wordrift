<?php
// Database connection settings
$host = 'localhost';
$db   = 'a_new_wordgame'; // Change to your DB name
$user = 'root';     // Change to your DB username
$pass = 'root';     // Change to your DB password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Database connection successful.<br>";
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Load words.json
$jsonFile = __DIR__ . '/words.json';
if (!file_exists($jsonFile)) {
    die('words.json file not found.');
}
$jsonData = file_get_contents($jsonFile);
$words = json_decode($jsonData, true);
if ($words === null) {
    die('Failed to decode words.json.');
}
echo "Loaded " . count($words) . " words from words.json.<br>";



foreach ($words as $entry) {

    $sql = "INSERT INTO word_list (word) VALUES (:word)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['word' => $entry]);
}

echo "Imported " . count($words) . " words into the database.<br>";
