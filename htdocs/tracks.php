<?php
try {
    $baseSpotisma = new PDO('mysql:host=127.0.0.1;dbname=Spotisma;charset=utf8', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupérer toutes les chansons disponibles
$stmtSongs = $baseSpotisma->query('SELECT * FROM songs');
$songsData = $stmtSongs->fetchAll(PDO::FETCH_ASSOC);

// Récupérer toutes les playlists
$stmtPlaylists = $baseSpotisma->query('SELECT 
                                        p.id AS playlist_id,
                                        p.name AS playlist_name,
                                        u.name AS user_name
                                    FROM
                                        playlists p
                                        INNER JOIN users u ON p.id_user = u.id');
$playlistsData = $stmtPlaylists->fetchAll(PDO::FETCH_ASSOC);


// Boucle pour afficher les playlists
foreach ($playlistsData as $playlistData) {
    $playlistId = $playlistData['playlist_id'];
    $playlistName = $playlistData['playlist_name'];
    $userName = $playlistData['user_name'];

    // Afficher le nom de la playlist et le nom de l'utilisateur
    echo '<div class="playlist-item">';
    echo '<h3>' . $playlistName . ' (Créée par ' . $userName . ')</h3>';
    echo '<ul>';

    // Récupérer les chansons associées à cette playlist
    $stmtPlaylistSongs = $baseSpotisma->prepare('SELECT s.id AS song_id, s.nameSong AS song_name, a.nameAlbum AS album_name
                                                FROM songs s
                                                LEFT JOIN albums a ON s.id_album = a.id
                                                INNER JOIN playlist_songs ps ON s.id = ps.id_song
                                                WHERE ps.id_playlist = :playlistId');
    $stmtPlaylistSongs->bindParam(':playlistId', $playlistId);
    $stmtPlaylistSongs->execute();
    $playlistSongs = $stmtPlaylistSongs->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les chansons de la playlist avec le bouton de suppression
    foreach ($playlistSongs as $song) {
        echo '<li>' . $song['song_name'] . ' - ' . $song['album_name'];
        echo ' <form action="/process/remove-song-from-playlist.php" method="POST" style="display: inline;">';
        echo '<input type="hidden" name="playlist_id" value="' . $playlistId . '">';
        echo '<input type="hidden" name="song_id" value="' . $song['song_id'] . '">';
        echo '<button class="fa-solid fa-trash" id= "trashBtn"></button>';
        echo '</form>';
        echo '</li>';
    }

    echo '</ul>';

    echo '</div>';
}

echo '</div>';
?>


