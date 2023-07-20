<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si des chansons ont été sélectionnées
    if (isset($_POST['songs']) && is_array($_POST['songs'])) {
        $playlistId = $_POST['playlist_id'];
        $selectedSongs = $_POST['songs'];

        try {
            $baseSpotisma = new PDO('mysql:host=127.0.0.1;dbname=Spotisma;charset=utf8', 'root');
            $baseSpotisma->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparer une requête pour obtenir l'id de l'album de chaque chanson sélectionnée
            $stmtAlbumId = $baseSpotisma->prepare('SELECT id_album FROM songs WHERE id = :songId');

            // Insérer les chansons sélectionnées dans la table playlist_songs avec leur id d'album respectif
            $stmt = $baseSpotisma->prepare('INSERT INTO playlist_songs (id_song, id_playlist, id_album) VALUES (:songId, :playlistId, :albumId)');

            foreach ($selectedSongs as $songId) {
                // Obtenir l'id de l'album de la chanson
                $stmtAlbumId->bindParam(':songId', $songId);
                $stmtAlbumId->execute();
                $albumId = $stmtAlbumId->fetch(PDO::FETCH_ASSOC)['id_album'];

                // Insérer les informations dans la table playlist_songs
                $stmt->bindParam(':songId', $songId);
                $stmt->bindParam(':playlistId', $playlistId);
                $stmt->bindParam(':albumId', $albumId);
                $stmt->execute();
            }

            // Rediriger vers la page de playlist après l'ajout des chansons
            header('Location: ../playlist.php');
            exit();
        } catch (Exception $e) {
            die('Erreur lors de l\'ajout des chansons à la playlist : ' . $e->getMessage());
        }
    } else {
        // Si aucune chanson n'a été sélectionnée, rediriger vers la page de playlist sans effectuer d'ajout
        header('Location: ../playlist.php');
        exit();
    }
} else {
    // Rediriger vers la page de playlist si le formulaire n'a pas été soumis
    header('Location: ../playlist.php');
    exit();
}
?>
