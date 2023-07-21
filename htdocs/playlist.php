<?php
    // Structure de base pour le bloc Playlist

    echo '<div class="playlist-block">';
    echo '<h2 class= "playlistTitle">Mes Playlists</h2>';
    echo '<div class="playlist-list">';

    // Formulaire de création de playlist
    echo '<div class="create-playlist-form">';
    echo '<h3 class="newPlaylist">Créer une nouvelle playlist</h3>';
    echo '<form action="/process/insert-playlist.php" method="POST" class="text-center">';
    echo '<input type="text" id="playlist-name" class="ms-1 bg-secondary text-light" name="playlist-name" required placeholder="Nom de la playlist">';
    echo '<button class="createBtn btn btn-outline-warning btn-dark" type="submit">Créer</button>';
    echo '</form>';
    echo '</div>';


    include 'tracks.php';
    echo '</div>';
?>


