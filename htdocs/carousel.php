<?php
// Récupération des données des chansons depuis la base de données
$stmt = $baseSpotisma->query('SELECT * FROM songs');
$songs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichage des informations des chansons
foreach ($songs as $song) {
    $cover = $song['cover'];
    $title = $song['title'];
    $artist = $song['artist'];
    $file = $song['file'];
    
    // Affichage des informations
    echo '<div>';
    echo '<img src="' . $cover . '" alt="Cover">';
    echo '<h3>' . $title . '</h3>';
    echo '<p>' . $artist . '</p>';
    echo '<audio controls>';
    echo '<source src="' . $file . '" type="audio/mpeg">';
    echo 'Votre navigateur ne prend pas en charge la balise audio.';
    echo '</audio>';
    echo '</div>';
}
?>
