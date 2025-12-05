<?php
session_start();

// Configuration de la base de données
$servername = "localhost";
$database = "cours";
$username = "root";
$password = "";

// Créer la connexion
$conn = mysqli_connect($servername, $username, $password, $database);

// Vérifier la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Définir l'encodage des caractères
mysqli_set_charset($conn, "utf8mb4");

// Fonction pour exécuter des requêtes
function executeQuery($sql) {
    global $conn;
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Erreur SQL: " . mysqli_error($conn));
    }
    return $result;
}

// Fonction pour récupérer tous les résultats
function fetchAll($sql) {
    $result = executeQuery($sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Fonction pour récupérer un seul résultat
function fetchOne($sql) {
    $result = executeQuery($sql);
    return mysqli_fetch_assoc($result);
}

// Fonction pour rediriger avec un message
function redirect($url, $message = null, $type = 'success') {
    if ($message) {
        $_SESSION['message'] = $message;
        $_SESSION['message_type'] = $type;
    }
    header("Location: $url");
    exit();
}

// Fonction pour échapper les données
function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8'));
}

// Fonction pour obtenir le dernier ID inséré
function lastInsertId() {
    global $conn;
    return mysqli_insert_id($conn);
}
?>