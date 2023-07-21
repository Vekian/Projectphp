<?php
// Vérifier si l'utilisateur est connecté avant de récupérer ses playlists
if (isset($_SESSION['LOGGED_USER'])) {
    $userId = $_SESSION['LOGGED_USER'];

    try {
        $baseSpotisma = new PDO('mysql:host=127.0.0.1;dbname=Spotisma;charset=utf8', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // Récupérer l'ID de l'utilisateur connecté
    $stmt = $baseSpotisma->query('SELECT id FROM users WHERE name = "' . $userId . '"');
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $idUser = $user['id'];

    // Récupérer toutes les playlists de l'utilisateur connecté
    $stmt = $baseSpotisma->query('SELECT * FROM playlists WHERE playlists.id_user = "' . $idUser . '"');
    $playlists = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Boucle pour afficher les playlists de l'utilisateur connecté
    foreach ($playlists as $playlist) {
        $playlistId = $playlist['id'];
        $playlistName = $playlist['name'];

        // Afficher le nom de la playlist et le bouton pour afficher les chansons
        echo '<div class="playlist-item">';
        echo '<button class="playlist-title" onclick="toggleSongs(' . $playlistId . ')">' . $playlistName . '<i class="fa-solid fa-bars"></i></button>';

        // Récupérer les chansons associées à cette playlist
        $stmt = $baseSpotisma->query('SELECT songs.id AS song_id, songs.nameSong AS song_name, albums.nameAlbum AS album_name
                                    FROM songs
                                    JOIN playlist_songs ON songs.id = playlist_songs.id_song
                                    LEFT JOIN albums ON songs.id_album = albums.id
                                    WHERE playlist_songs.id_playlist = "' . $playlistId . '"');
        $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Afficher les chansons de la playlist dans une liste déroulante
        echo '<ul id="playlist-songs-' . $playlistId . '" style="display:none;">';
        foreach ($songs as $song) {
            echo '<li><button type="button" class="btn btn-outline-warning btn-dark col-10 buttonPlaylist" value="'. $song['song_id'] . '">' . $song['song_name'] . ' - ' . $song['album_name'] . '</button>';
            echo ' <form action="/process/remove-song-from-playlist.php" method="POST" style="display: inline;">';
            echo '<input type="hidden" name="playlist_id" value="' . $playlistId . '">';
            echo '<input type="hidden" name="song_id" value="' . $song['song_id'] . '">';
            echo '<button class="fa-solid fa-trash" id="trashBtn"></button>';
            echo '</form>';
            echo '</li>';
        }
        echo '</ul>';

        echo '</div>';
    }
}
?>
<script>
    let buttonsPlaylist = document.getElementsByClassName('buttonPlaylist');
    for (let buttonPlaylist of buttonsPlaylist) {
        buttonPlaylist.addEventListener('click', function (e) {
            songId = e.target.value;
            playMusic(songId);
            getComments(songId);
            displayComment.innerHTML = '<button type="button" class="btn btn-outline-warning btn-dark col-4" data-bs-toggle="modal" data-bs-target="#commentModal">Un ptit com\' ?</button></div>';
        });
    }
</script>

<script src="js/playlist.js"></script>




