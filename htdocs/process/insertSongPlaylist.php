<?php
    include('../config/connection.php');

    if (!isset($_POST['idSong'])) {
        echo('Veuillez rentrer une chanson valide');
    }

    $idSong = $_POST['idSong'];
    $idPlaylist = $_POST['namePlaylist'];
    $idAlbum = null;

    $stmt = $baseSpotisma->query('SELECT * FROM songs 
                        JOIN albums ON songs.id_album = albums.id
                        WHERE songs.id = "' . $idSong . '"');
    $album = $stmt->fetch(PDO::FETCH_ASSOC);


    if (isset($album['id_album'])) {
        $idAlbum = $album['id_album'];
    }

    $insertSong = $baseSpotisma -> prepare ('INSERT INTO playlist_songs(id_song, id_album, id_playlist) VALUES (:id_song, :id_album, :id_playlist)');
    $insertSong -> execute([
        'id_song' => $idSong,
        'id_album' => $idAlbum,
        'id_playlist' => $idPlaylist
    ]);
header('Location:../index.php');