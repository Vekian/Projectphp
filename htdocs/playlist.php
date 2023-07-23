<?php
    // Structure de base pour le bloc Playlist
    echo '<nav class="navbar navbar-expand-lg " id="navColorPlaylist">
    <button class="navbar-toggler float-right bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-list" style="color: #ffffff;"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">';
    echo '<div class="playlist-block">';
    echo '<h2 class= "playlistTitle">Mes Playlists</h2>';
    echo '<div class="playlist-list">';

    // Formulaire de création de playlist
    echo '<div class="create-playlist-form">';
    echo '<h3 class="newPlaylist">Créer une nouvelle playlist</h3>';
    echo '<form action="/process/insert-playlist.php" method="POST" class="text-center">';
    echo '<input type="text" id="playlist-name" class="ms-1 bg-secondary text-light rounded" name="playlist-name" required placeholder="Nom de la playlist">';
    echo '<button class="createBtn btn btn-outline-warning btn-dark" type="submit">Créer</button>';
    echo '</form>';
    echo '</div>';


    include 'tracks.php';
    echo '</div></div>
    </nav>';
?>


