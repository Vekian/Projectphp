<?php
include 'header.php';
    // Structure de base pour le bloc Playlist
    echo '<div class="playlist-block">';
    echo '<h2>Playlists</h2>';
    echo '<div class="playlist-list">';

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


include 'tracks.php';
?>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>



