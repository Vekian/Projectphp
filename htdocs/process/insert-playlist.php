<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playlistName = $_POST['playlist-name'];

    if (isset($_SESSION['LOGGED_USER'])) {
        $nameUser = $_SESSION['LOGGED_USER'];
    } else {
        header('Location: ../index.php');
        exit();
    }
    
    try {
        $baseSpotisma = new PDO('mysql:host=127.0.0.1;dbname=Spotisma;charset=utf8', 'root');
        $baseSpotisma->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Récupérer l'ID de l'utilisateur à partir de la base de données
        $stmtUser = $baseSpotisma->prepare('SELECT id FROM users WHERE name = :nameUser');
        $stmtUser->bindParam(':nameUser', $nameUser);
        $stmtUser->execute();
        $user = $stmtUser->fetch(PDO::FETCH_ASSOC);
        $userId = $user['id'];

        // Insérer la nouvelle playlist dans la base de données
        $stmt = $baseSpotisma->prepare('INSERT INTO playlists (name, id_user) VALUES (:name, :userId)');
        $stmt->bindParam(':name', $playlistName);
        $stmt->bindParam(':userId', $userId);

        $stmt->execute();

        header('Location: ../playlist.php');
        exit();
    } catch (Exception $e) {
        die('Erreur lors de l\'insertion de la playlist : ' . $e->getMessage());
    }
} else {
    header('Location: ../playlist.php');
    exit();
}
?>
