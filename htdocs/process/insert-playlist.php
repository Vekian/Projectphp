<?php
    session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playlistName = $_POST['playlist-name'];

    if (isset($_SESSION['LOGGED_USER'])) {
        $userId = $_SESSION['LOGGED_USER'];
    } else {
        header('Location: ../index.php');
        exit();
    }
    try {
        $baseSpotisma = new PDO('mysql:host=127.0.0.1;dbname=Spotisma;charset=utf8', 'root');
        $baseSpotisma->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

