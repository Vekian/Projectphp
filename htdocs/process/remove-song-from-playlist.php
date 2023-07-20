<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si les données nécessaires sont présentes
    if (isset($_POST['playlist_id']) && isset($_POST['song_id'])) {
        $playlistId = $_POST['playlist_id'];
        $songId = $_POST['song_id'];

        try {
            $baseSpotisma = new PDO('mysql:host=127.0.0.1;dbname=Spotisma;charset=utf8', 'root');
            $baseSpotisma->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Supprimer la chanson de la playlist
            $stmt = $baseSpotisma->prepare('DELETE FROM playlist_songs WHERE id_playlist = :playlistId AND id_song = :songId');
            $stmt->bindParam(':playlistId', $playlistId);
            $stmt->bindParam(':songId', $songId);
            $stmt->execute();

            // Rediriger vers la page de playlist après la suppression
            header('Location: ../tracks.php');
            exit();
        } catch (Exception $e) {
            die('Erreur lors de la suppression de la chanson de la playlist : ' . $e->getMessage());
        }
    } else {
        // Rediriger vers la page de playlist si les données nécessaires ne sont pas présentes
        header('Location: ../tracks.php');
        exit();
    }
} else {
    // Rediriger vers la page de playlist si le formulaire n'a pas été soumis
    header('Location: ../tracks.php');
    exit();
}
?>
