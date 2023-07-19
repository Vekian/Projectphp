<?php
try {
    $baseSpotisma = new PDO('mysql:host=127.0.0.1;dbname=Spotisma;charset=utf8', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$stmt = $baseSpotisma->query('SELECT 
                                p.id AS playlist_id,
                                p.name AS playlist_name,
                                u.name AS user_name,
                                s.id AS song_id,
                                s.name AS song_name,
                                a.id AS album_id,
                                a.name AS album_name
                            FROM
                                playlists p
                                INNER JOIN users u ON p.id_user = u.id
                                LEFT JOIN playlist_songs ps ON p.id = ps.id_playlist
                                LEFT JOIN songs s ON ps.id_song = s.id
                                LEFT JOIN albums a ON ps.id_album = a.id');

$playlistsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Structure de base pour le bloc Playlist
echo '<div class="playlist-block">';
echo '<h2>Playlists</h2>';
echo '<div class="playlist-list">';

// Boucle pour afficher les playlists
foreach ($playlistsData as $playlistData) {
    $playlistId = $playlistData['playlist_id'];
    $playlistName = $playlistData['playlist_name'];
    $userName = $playlistData['user_name'];
    $songName = $playlistData['song_name'];
    $albumName = $playlistData['album_name'];

    // Vérifier si la playlist actuelle est différente de la précédente
    if (!isset($currentPlaylistId) || $playlistId !== $currentPlaylistId) {
        // Afficher le nom de la playlist et le nom de l'utilisateur
        echo '<div class="playlist-item">';
        echo '<h3>' . $playlistName . ' (Créée par ' . $userName . ')</h3>';
        echo '<ul>';
    }

    // Afficher les chansons de la playlist
    if ($songName) {
        echo '<li>' . $songName . ' - ' . $albumName . '</li>';
    }

    // Mettre à jour l'ID de la playlist actuelle
    $currentPlaylistId = $playlistId;

    // Vérifier si la playlist actuelle est différente de la suivante
    if (!isset($playlistsData[$playlistId + 1]) || $playlistsData[$playlistId + 1]['playlist_id'] !== $currentPlaylistId) {
        echo '</ul>';
        echo '</div>';
    }
}

echo '</div>';

// Formulaire de création de playlist
echo '<div class="create-playlist-form">';
echo '<h3>Créer une nouvelle playlist</h3>';
echo '<form action="/process/insert-playlist.php" method="POST">';
echo '<label for="playlist-name">Nom de la playlist:</label>';
echo '<input type="text" id="playlist-name" name="playlist-name" required>';
echo '<button type="submit">Créer</button>';
echo '</form>';
echo '</div>';

echo '</div>';
?>

